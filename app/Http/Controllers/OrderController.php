<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Shipping;
use App\Models\Customer;
use PDF;

class OrderController extends Controller
{
    public function print_pdf($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
    
        $order_details = Order_details::where('order_code',$checkout_code)->get();

        $sum = 0;
        foreach ($order_details as $value) {
          
            $feeship = $value ->product_feeship;
            $coupon = $value ->product_coupon;
            $sum += $value->product_price;
        }
        if($coupon =='COVID1'){
            $coupon =500000;
        }
        else if($coupon =='MGG2'){
            $coupon = ($sum/100)*12;
        }
        $sumnew = $sum -($coupon+$feeship);
        $order = Order::where('order_code',$checkout_code)->first();
        $shipping_id = $order['shipping_id'];
        $customer_id = $order->customer_id;
        $customer = Customer::find($customer_id);
        $shipping = Shipping::find($shipping_id);
        $method = $shipping->shipping_method;
        if($method == '1')
        {
            $method = 'Thanh toán bằng tiền mặt';
        }
        else{
            $method = 'Thanh toán chuyển khoản';
        }

        $output = '
            <style>
                body{
                    font-family: DejaVu Sans, sans-serif;
                }
                table{
                    border:1px solid #000;
                }
                table tr td{
                    border:1px solid #000;
                    text-align:center;
                
                }
                table tr th{
                    border:1px solid #000;
                
                }
            </style>
            <h4><center>Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam</center></h4>
            <h4><center>ĐỌC LẬP - TỰ DO - HẠNH PHÚC</center></h4>
            <h3 style="text-align:center">PHIẾU BIÊN LAI</h3>
            <p>Tên người mua: '.$customer->customer_name.'</p>
            <p>Số điện thoại: '.$customer->customer_name.'</p>
            <p>Địa chỉ chuyển hàng: '.$shipping->shipping_address.'</p>
            <p>Số điện thoại: '.$shipping->shipping_phone.'</p>
            <p>Phương thức thanh toán: '.$method.'</p>
            <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt hàng</th>
                </tr>
            </thead>
            <tbody>
        ';
        $index =0;
        foreach ($order_details as $key ) {
            $index++;
            $sumt = $key->product_sale_quatity * $key->product_price;
            
        $output.='
            <tr>
                <td scope="row">'.$index.'</td>
                <td scope="row">'.$key->product_name.'</td>
                <td scope="row">'.$key->product_sale_quatity.'</td>
                <td scope="row">'.number_format($key->product_price).'đ</td>
                <td scope="row">'.number_format($sumt).'đ</td>
                <td scope="row">'.$key->created_at.'</td>
            </tr>
        ';
        }
        $output.='
            </tbody>
            <p>Tổng tiền phải trả: '.number_format($sumnew).'đ</p>
            <p>Tổng tiền chưa giảm: '.number_format($sum).'đ</p>
            <p>Phí ship: '.number_format($feeship).'đ</p>
            <p>Giảm giá: '.number_format($coupon).'đ</p>
            </table>
            <p style= "text-align:right;margin-right:60px">Người nhận hàng</p>
            <p style= "margin-top:60px;text-align:right;margin-right:60px">'.$shipping->shipping_name.'</p>
        
        ';
        return $output;
    }
    public function manager_order(){
        $order = Order::orderBy('created_at','DESC')->get();

        return view('admin.manager_order',['order'=>$order]);
    }
    public function view_order($order_code){
        $order_details = Order_details::where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->first();
        $shipping_id = $order['shipping_id'];
        $customer_id = $order->customer_id;
        $customer = Customer::find($customer_id);
        $shipping = Shipping::find($shipping_id);
        return view('admin.view_order',['order_details'=>$order_details,'customer'=>$customer,'shipping'=>$shipping]);
    }
}
