@extends('master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->
        <!--/checkout-options-->

        <div class="register-req">
            <p>Điền thông tin gửi hàng và địa chỉ gửi</p>
        </div><!--/register-req-->
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix ">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="form-one">
                            <form method="POST" action="{{route('confirm-order')}}">
                                @csrf           
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên *">
                                <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_note" class="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
                                <div class="form-group">
                                  <label for="">Chọn hình thức thanh toán</label>
                                  <select name="payment_select" class="payment_select form-group" id="">
                                      <option value="0" class="payment_select">Thanh toán chuyển khoản</option>
                                      <option value="1" class="payment_select">Thanh toán trực tiếp bằng tiền mặt</option>
                                  </select>
                                </div>
                         
                                <input type="submit" class="btn btn-warning btn-block" value="Gửi thông tin">
                                 
                            </form>
                        </div>
                      
                    </div>
                </div>
           
                				
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
            {{-- <script type="text/javascript">
                $(document).ready(function(){
                    $('.submit').click(function(){
                    var shipping_name =$('.shipping_name').val();
                    var shipping_email =$('.shipping_email').val();
                    var shipping_address =$('.shipping_address').val();
                    var shipping_phone =$('.shipping_phone').val();
                    var shipping_note =$('.shipping_note').val();
                    var payment_select =$('.payment_select').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{!!URL::to('confirm-order')!!}',
                        method: 'get',
                        data:{
                            shipping_name:shipping_name,shipping_email:shipping_email,shipping_address:shipping_address,shipping_phone:shipping_phone
                            ,shipping_note:shipping_note,payment_select:payment_select,_token:_token
                        },
                        success:function(){
                            alert('Đặt hàng thành công');
                        }
                    });
                });
                });
            
            </script> --}}
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
</section> <!--/#cart_items-->


@endsection