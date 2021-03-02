<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category_Product;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Feeship;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use Cart;
class CartController extends Controller
{
    public function saveCart(Request $req){   
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        $product_id = $req->product_id_hidden;
        $quantity = $req->qlt;
        $product_info = Product::where('id',$product_id)->first();
        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image']= $product_info->product_image;
        $data['weight'] = '123';
        Cart::add($data);
        return Redirect::to('/show-cart'); 
    }
    public function show_cart(){
        $slider = Slider::all();
        $city = City::all();
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('cart.show_cart',['cate'=>$cate,'brand'=>$brand,'city'=>$city,'slider'=>$slider]);
    }
    public function delete_cart($rowId){
         Cart::update($rowId,0);
         return Redirect::to('/show-cart');
    }

    public function update_cart_quality(Request $req){
        $rowId= $req->rowId_cart;
        $quantity = $req ->cart_quantity;
        Cart::update($rowId,$quantity);
        return Redirect::to('/show-cart');

    }
    public function add_cart_ajax(Request $req){
        // Session::flush();
        $data = $req->all();
        $session_id = substr(md5(\microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart!=null){
                $is_avaiable = 0;
                foreach ($cart as $car) {
                    if($car['product_id'] == $data['cart_product_id'])
                    {
                        $is_avaiable++;
                    }
                }
                if($is_avaiable == 0){
                    array_push($cart,[
                        'session_id'=> $session_id,
                        'product_name'=>$data['card_product_name'],
                        'product_id'=>$data['cart_product_id'],
                        'product_price'=>$data['cart_product_price'],
                        'product_image'=>$data['cart_product_image'],
                        'product_qty'=>$data['cart_product_qty']
                    ]);
                    Session::put('cart',$cart);
                } 
        }
        else
        {
            $cart = array([
                'session_id'=> $session_id,
                'product_name'=>$data['card_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_price'=>$data['cart_product_price'],
                'product_image'=>$data['cart_product_image'],
                'product_qty'=>$data['cart_product_qty']
            ]);
            Session::put('cart',$cart);
        }
        Session::save();
    }
    public function show_cart_ajax(Request $req){
        $city = City::all();
        $slider = Slider::all();
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('cart.cart_ajax',['cate'=>$cate,'brand'=>$brand,'city'=>$city,'slider'=>$slider]);
    }
    public function delete_cart_ajax($id){
        $cart = Session::get('cart');
        echo '<pre>';
        print_r($cart);
        if($cart){
            foreach($cart as $key=>$val){
                if($val['session_id'] ==$id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return \redirect()->back()->with('massage','Xoa san pham thanh cong');
        }
        else
        {
            return \redirect()->back()->with('error','Xoa san pham that bai');
        }
    }
    public function update_cart_ajax(Request $req){
        $data = $req ->all();
        $cart = Session::get('cart');
        if($cart){
            foreach($data['cart_qty'] as $key =>$qty){
                foreach($cart as $session =>$val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return \redirect()->back()->with('massage','Cập nhật thành công');
        }
    }
    public function delete_all(){
        Session::forget('coupon');
        Session::forget('feeship');
        $cart = Session::get('cart');
        if($cart){
            Session::forget('cart');
            return \redirect()->back()->with('massage','Đã xóa toàn bộ giỏ hàng thành công');
        }
        else
        {
            return \redirect()->back()->with('massage','Chưa có sản phẩm nào để xóa');
        }
    }
    public function check_coupon(Request $req){
        $data = $req->all();
        Session::forget('coupon');
        $coupon = Coupon::where('coupon_code','=',$req->coupon_name)->first();
        if($coupon){
            $cou[] = array(
                'coupon_code' =>$coupon->coupon_code,
                'coupon_codition' =>$coupon->coupon_codition,
                'coupon_number' =>$coupon->coupon_number
            );
            Session::put('coupon',$cou);
            return \redirect()->back()->with('massage','Thêm mã giảm giá thành công');
        }
        else{
            return \redirect()->back()->with('error','Mã giảm giá không đúng');   
        }

    }
    public function detail_feeship(Request $req){
        $feeship1 = Feeship::where('matp',$req->matp)->where('maqh',$req->maqh)->where('maxp',$req->maxa)->select('fee_id','feeship')->first();

        if(Session::has('feeship')){
            Session::forget('feeship');
        }
        if($feeship1){
            Session::put('feeship',$feeship1->feeship);
            Session::save();
        }
        else{
            Session::put('feeship',100000);
            Session::save();
        }
        return \redirect()->route('cart.show.ajax');
    }
    
}
