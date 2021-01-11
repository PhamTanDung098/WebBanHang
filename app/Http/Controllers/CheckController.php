<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category_Product;
use App\Models\Brand;
use App\Models\Customer;



use App\Models\Payment;
use App\Models\City;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Order_details;
use App\Models\Shipping;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use Cart;

class CheckController extends Controller
{
    public function confirm_order(Request $req){
        // dd(Session::get('cart'));
        $shipping = new Shipping;
        $shipping ->shipping_name = $req ->shipping_name;
        $shipping ->shipping_address=$req ->shipping_address;
        $shipping ->shipping_phone= $req ->shipping_phone ;
        $shipping ->shipping_email= $req ->shipping_email;
        $shipping ->shipping_note= $req ->shipping_note;
        $shipping ->shipping_method= $req->payment_select;
        $shipping->save();
        $checkout_code = \substr(md5(\microtime()),rand(0,26),5);
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping ->id;
        $order ->order_status = 1;
        $order->order_code =$checkout_code;
        $order->save();
        if(Session::get('feeship')){
            $feeship = Session::get('feeship');
        }
        else{
            $feeship =0;
        }
        if(Session::get('coupon')){
            foreach(Session::get('coupon') as $key){
                $coupon = $key['coupon_code'];
            }
        }
        else
        {
            $coupon = '';
        }
        if(Session::get('cart')){
            foreach (Session::get('cart') as $key=> $item)
            {
                $order_detail = new Order_details;
                $order_detail ->order_code =$checkout_code;
                $order_detail ->product_id = $item['product_id'];
                $order_detail ->product_name = $item['product_name'];
                $order_detail ->product_price =$item['product_price'];
                $order_detail ->product_sale_quatity = $item['product_qty'];
                $order_detail ->product_feeship = $feeship;
                $order_detail ->product_coupon = $coupon;
                $order_detail->save();
            }
        }
        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('feeship');
        return \redirect()->route('home1')->with('Đã đặt hàng');

    }
    //
    public function login_checkout(){
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('pages.checkout.login_checkout',['cate'=>$cate,'brand'=>$brand]);
    }
    public function add_customer(Request $req){
        $data = new Customer;
        $data->customer_name = $req->customer_name;
        $data->customer_email =$req->customer_email;
        $data->customer_password=md5($req->customer_password);
        $data->customer_phone = $req->customer_phone;
        $data->save();
        $shipping_id = Customer::where('customer_name',$req->customer_name)->select('id')->first();
        Session::put('customer_id',$shipping_id);
        Session::put('customer_name',$req->customer_name);
        return \redirect()->route('checkout');
      
    }
    public function checkout(){
        $city = City::all();
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('pages.checkout.checkout',['cate'=>$cate,'brand'=>$brand,'city'=>$city]);
    }
    public function save_checkout(Request $req){
        // dd($req ->all());
        $data = new Shipping;
        $data->shipping_name = $req->shipping_name;
        $data->shipping_email =$req->shipping_email;
        $data->shipping_note=$req->shipping_note;
        $data->shipping_phone = $req->shipping_phone;
        $data->shipping_address = $req->shipping_address;
        $data->save();
        $shipping_id = Shipping::where('shipping_name',$req->shipping_name)->select('id')->first();
        Session::put('shipping_id',$shipping_id->id);
        Session::put('shipping_name',$req->customer_name);
        return Redirect('payment');

    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');

    }
    public function login_customer(Request $req){
        $email = $req->email;
        $password = md5($req->password);
        $result = Customer::where('customer_email',$email)->where('customer_password',$password)->first();
        Session::put('customer_id',$result->id);
        return Redirect::to('/checkout');
    }
    public function payment(){
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('pages.checkout.payment',['cate'=>$cate,'brand'=>$brand]);

    }
    public function orderplace(Request $req){
        $content = Cart::content();
        // get payment method
        $data = new Payment;
        $data->payment_method = $req->payment_option;
        $data->payment_status = 'Đang chờ xử lí';
        $data->save();
        $payment_id = $data->id;

        //order_data

        $order_data =new Order;
        $order_data ->customer_id = Session::get('customer_id');
        $order_data ->shipping_id =  Session::get('shipping_id');
        $order_data ->payment_id = $payment_id;
        $order_data ->order_total = Cart::total();
        $order_data ->order_status = 'Đang chờ xử lí';
        $order_data->save();
        $order_id = Order::max('id');
        //order detail
        foreach ($content as $ct)
        {
            $order_detail =new Order_details;
            $order_detail->order_id=$order_id;
            $order_detail->product_id=$ct ->id;
            $order_detail->product_name=$ct->name;
            $order_detail->product_price= $ct->price;
            $order_detail->product_sale_quatity= $ct->qty;
            $order_detail->save();
        }
        if($data->payment_method==1){
            echo 'Thanh toán bằng ATM';
        }
        else{
            Cart::destroy();
            // echo 'Thanh toán bằng tiền mặt';
            $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('pages.checkout.hashcard',['cate'=>$cate,'brand'=>$brand]);
        }
        
        // return Redirect::to('/'); 
    }
    //order admin 
    public function manager_order(){
        $user = Session::has('user');
        if($user){
            $all_order = DB::table('tbl_orders')
            ->join('tbl_customer','tbl_orders.customer_id','tbl_customer.id')
            ->select('tbl_orders.*','tbl_customer.customer_name')
            ->orderBy('tbl_orders.id','desc')->get();
            return view('admin.manager_order',['all_order'=>$all_order]); 
        }
        else{
            return Redirect::to('login');
        }
    }
    public function view_order($id){
        // dd($id);
        $all_order = DB::table('tbl_orders')
            ->join('tbl_customer','tbl_orders.customer_id','tbl_customer.id')
            ->join('tbl_shipping','tbl_shipping.id','tbl_orders.shipping_id')
            ->where('tbl_orders.id',$id)
            ->select('tbl_orders.*','tbl_customer.*','tbl_shipping.*')
            ->first();
        $all_details = Order_details::where('order_id',$id)->get();
           
            // dd($all_order);
        // dd($order_detail);
        return view('admin.view_order',['all_order'=>$all_order,'all_details'=>$all_details]);
    }
}
