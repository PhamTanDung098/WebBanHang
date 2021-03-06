@extends('master')
@section('content')
 
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('Home')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng của tôi</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                @php
                    $content =  Cart::content();
                   
                @endphp
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach ($content as $item)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img width="50" src="{{asset('public/uploads/products/'.$item->options->image)}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$item->name}}</a></h4>
                                <p>Mã: {{$item->id}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($item->price).' VND'}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="{{route('cart.update')}}" method="POST">
                                        @csrf
                                        <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$item->qty}}" autocomplete="off" size="2">
                                        <input type="hidden" value="{{$item->rowId}}" name="rowId_cart" class="form-control ">
                                        <input type="submit" value="Update" name="update_qty" class="btn btn-default ">
                                </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    @php
                                        $sub = $item ->price * $item->qty;
                                        echo $sub;
                                    @endphp
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{route('cart.delete',$item->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    

                    
                </tbody>
            </table>
        </div>
    </div>
</section> 
<!--/#cart_items-->
<section id="do_action">
    <div class="container">      
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    @php
                        Cart::setGlobalTax(10);
                    @endphp
                    <ul>
                        <li>Tổng <span>{{Cart::initial().' VND'}}</span></li>
                        <li>Thuế VAT<span>{{Cart::tax(). ' VND'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total().' VND'}}</span></li>
                    </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a> --}}
                        @php
                        if(session()->has('customer_id')!=null)
                        {
                        @endphp
                        <a href="{{route('checkout')}}" class="btn btn-warning" style="margin-left:40px"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                        @php
                            }else {	
                        @endphp	
                        <a href="{{route('login-checkout')}}"  class="btn btn-warning " style="margin-left:40px"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                        @php

                        }
                        @endphp

                </div>
            </div>
            
        </div>
    </div>
</section><!--/#do_action-->

@endsection