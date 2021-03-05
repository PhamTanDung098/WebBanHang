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
            @if(session()->has('massage'))
                <div class="alert alert-success">
                    {{session()->get('massage')}}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
            @endif
            <table class="table table-condensed">
                <form action="{{route('cart.update.ajax')}}" method="POST">
                    @csrf
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if(session()->has('cart'))
                        { 
                            $cartItem = session()->get('cart');
                        }
                        
                        $total = 0;
                    @endphp
                     @php
                        $total_sub = 0;
                     @endphp
                    @if(session()->get('cart'))
                   
                        @foreach ($cartItem as $cart)
                            @php
                                $total+=$cart['product_price'];
                            @endphp)
                            <tr>
                                <td class="cart_product">
                                    <a href="">
                                        <img width="50" src="{{asset('public/uploads/products/'.$cart['product_image'])}}" alt="">
                                    </a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""></a></h4>
                                    <p>Mã: {{$cart['product_name']}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{number_format($cart['product_price']).' vnd'}}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        
                                            <input class="cart_quantity_input" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" size="2" min="1">
                                            <input type="hidden" value="" name="rowId_cart" class="form-control ">
                                            
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        @php
                                            $subtotal = $cart['product_qty']*$cart['product_price'];
                                            $total_sub +=$subtotal; 
                                            echo number_format($subtotal).' vnd';
                                        @endphp
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{route('cart.delete.ajax',$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach                    
                            <tr>
                                <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-warning"></td>
                            </tr>
                    @endif 
                </tbody>
             
            </form>
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
                        $vat = ($total/100)*10;
                        $Sum = $total + $vat;
                    @endphp
                    <ul>
                        <li>Tổng <span>{{number_format($total_sub). 'đ'}}</span></li>
                        {{-- <li>Thuế VAT <span>{{number_format($vat).'đ'}}</span></li> --}}
                        <li>Mã giảm giá :
                            @if (session()->has('coupon'))
                                @foreach (session()->get('coupon') as $key =>$cou)
                                    @if ($cou['coupon_number']==1)
                                         <span>{{$cou['coupon_codition'].'%'}}</span>
                                        <p>
                                            @php
                                                $total_coupon = ($total*$cou['coupon_codition'])/100;
                                                $total_sum = $total - $total_coupon;
                                            @endphp
                                        </p>
                                        
                                    @else
                                         <span>{{number_format($cou['coupon_codition']).'đ'}}</span>
                                        <p>
                                            @php
                                                $total_sum = $total - $cou['coupon_codition'];
                                            @endphp
                                        </p>
                                    @endif
                                @endforeach
                                
                            @else
                                <span>0</span>
                            @endif

                        </li>
                        @if (session()->has('feeship'))
                            @php
                                $feeship = session()->get('feeship');
                                // $total_sum = $total_sum - $feeship;
                            @endphp
                            <li>Phí vận chuyển <span>{{number_format(session()->get('feeship')).'đ'}}</span></li>
                        @else    
                           <li>Phí vận chuyển <span>{{number_format('100000').'đ'}}</span></li>
                        @endif
                        <li>Tổng tiền sau khi giảm 
                            @if (session()->has('coupon'))
                                <span>{{number_format($total_sum).'đ'}}</span>
                            @else
                                <span>{{number_format($total).'đ'}}</span>
                            @endif
                        </li>
                        
                       
                        {{-- <li>Thành tiền <span>{{number_format($Sum).'đ'}}</span></li> --}}
                        @if(session()->has('cart'))
                            <li>
                                <form action="{{route('coupon')}}" method="POST">
                                    @csrf
                                    <input type="text" name="coupon_name" class="form-control" placeholder="Nhập mã giảm giá">
                                    <input type="submit" name="check_coupon" value="Tính mã giảm giá" class="btn btn-warning" style="margin-top:10px">
                                </form>                        
                            </li>
                        @endif
                        
                    </ul>   
                    @if (session()->has('customer'))
                        <a href="{{route('checkout')}}" class="btn btn-warning" style="margin-left:40px"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                    @else
                        <a href="{{route('login-checkout')}}" class="btn btn-warning" style="margin-left:40px">Đặt hàng</a>
                    @endif
                        
                    <a href="{{route('cart.deleteall.ajax')}}" class="btn btn-warning" style="margin-left:40px"><i class="fa fa-crosshairs"></i> Xóa tất cả giỏ hàng</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="total_area">
                    <form action="{{route('feeship.detail')}}" method="POST" style="margin-left:20px">
                        @csrf
                        <h4 class="text-center">Thông tin địa chỉ giao hàng chi tiết</h4>
                        <div class="form-group">
                            <label for="">Tỉnh/Thành phố</label>
                            <select class="city form-control" name="matp" >
                                @foreach ($city as $item)
                                    <option value="{{$item->matp}}">{{$item->name_city}}</option>
                                @endforeach
                            </select>                         
                        </div>
                        <div class="form-group">
                            <label for="">Quận huyện</label>
                            <select class="province form-control" name="maqh" >
                            </select>                         
                        </div>
                        <div class="form-group">
                            <label for="">Thị xã, thôn</label>
                            <select class="wards form-control" name="maxa" >
                            </select>                         
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Gửi thông tin</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //find Province
                $('.city').on('change',function(){         
                        var cat_id = $(this).val(); 
                        var div = $(this).parent();
                        var option = " ";
                        $.ajax({
                            type:'get',
                            url:'{!!URL::to('findPrevince')!!}',
                            data:{'id':cat_id},
                            success:function(data){
                                option+= '<option value="0">Quận, huyện</option>';
                                for(var i =0;i<data.length;i++){
                                    option +='<option value="'+data[i].maqh+'">'+data[i].name_quanhuyen+'</option>';
                                }
                                $('.province').html(" ");
                                $('.province').append(option);
                            },
                            error:function(){
                                console.log('null');
                            }
                        });
                    });
                    //find Wards
                $('.province').on('change',function(){
                    var cat_id = $(this).val();
                    var option = " ";
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('findWards')!!}',
                        data:{'id':cat_id},
                        success:function(data){
                            console.log(data);
                            option+= '<option value="0">Xã, thị trấn</option>';
                                for(var i =0;i<data.length;i++){
                                    option +='<option value="'+data[i].xaid+'">'+data[i].name_xa+'</option>';
                                }
                                console.log(option);
                                $('.wards').html(" ");
                                $('.wards').append(option);
                        }
                    });
                });
                
            </script>
    </div>
</section><!--/#do_action-->

@endsection