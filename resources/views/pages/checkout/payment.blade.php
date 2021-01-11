@extends('master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('Home')}}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->
        <!--/checkout-options-->

        <div class="register-req">
            <p>Đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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
                                <p class="cart_total_price">@php
                                    $sub = $item ->price * $item->qty;
                                    echo $sub;
                                @endphp</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{route('cart.delete',$item->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4 style="margin:40px 0;font-size:20px">Chọn hình thức thanh toán</h4>
        <form action="{{route('order.place')}}" method="POST">
            @csrf
            <div class="payment-options">
                    <span>
                        <label><input name="payment_option" type="checkbox" value="1">Trả bằng thẻ ATM</label>
                    </span>
                    <span>
                        <label><input type="checkbox" name="payment_option" value="2"> Nhận tiền mặt</label>
                    </span>
                    <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary ">

            </div>
        </form>
    </div>
</section> <!--/#cart_items-->


@endsection