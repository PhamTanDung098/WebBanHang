@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin khách hàng
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên người mua</th>
              <th>Số điện thoại</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
              <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{$index++}}</td>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->customer_phone}}</td>
                
              </tr>
          </tbody>
        </table>
      </div>
      
    </div>
</div>
  <br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin vận chuyển
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên người vận chuyển</th>
              <th>Địa chỉ </th>
              <th>Số điện thoại </th>
              <th>Phương thức thanh toán</th>
              <th>Ghi chú</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
              <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{$index++}}</td>
                <td>{{$shipping->shipping_name}}</td>
                <td>{{$shipping->shipping_address}}</td>
                <td>{{$shipping->shipping_phone}}</td>
                <td>
                  @if ($shipping->shipping_method==1)
                      Thanh toán bằng tiền mặt
                  @else
                      Thanh toán chuyển khoản
                  @endif
                
                </td>
                <td>{{$shipping->shipping_note}}</td>
                
              </tr>
          </tbody>
        </table>
      </div>
      
    </div>
</div>
  <br>
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              {{-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th> --}}
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Só lượng kho</th>
              <th>Số lượng </th>
              <th>Giá</th>
              <th>Phí ship</th>
              <th>Mã giảm giá</th>
              <th>Tổng tiền</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
          
            @php
                if(session()->has('message')){
                  echo session()->get('message');
                  session()->put('message',null);
                }
                $total_sum = 0;
            @endphp
            @foreach ($order_details as $item)
            <tr>
                @php
                    $phantram = (($item->product_price)/100)*12; 
                @endphp
                <td>{{$index++}}</td>
                <td>{{$item->product_name}}</td>
                <td>{{$item->products->product_quatity}}</td>
                <td>
                  <input type="number" class="order_qty_{{$item->product_id}}" min="1" value="{{$item->product_sale_quatity}}" name="product_sale_quantity" height="5">
                  <input type="hidden" name="order_checkout_quantity" value="{{$item->product_id}}" class="order_product_id">
                  <button class="btn btn-default update_quantity_order" data-product_id="{{$item->product_id}}" name="update_quantity" >Cập nhật</button>
                </td>
                <td>{{number_format($item->product_price).'đ'}}</td>
                <td>{{number_format($item->product_feeship).'đ'}}</td>
                <td>
                    @if ($item->product_coupon=='COVID1')
                        
                        @php
                            $total_coupon = 500000;
                        @endphp
                        {{number_format($total_coupon).'đ'}}
                    @else
                        {{number_format($phantram).'đ'}}
                        @php
                            $total_coupon = $phantram;
                        @endphp
                    @endif
                  </td>
                <td>@php
                    $sum = $item->product_sale_quatity *$item->product_price;
                    
                @endphp
                    {{number_format($sum).'đ'}}  
              </td>
                {{-- <td>{{$item->product_name}}</td> --}}
               
              </tr>
            @php
                    
              $total_sum += $sum; 
           @endphp
            @endforeach 
            <tr>
              <td colspan="6">
                  @if($orders->order_status==1)
                    <form> 
                      @csrf
                      <select class="form-control order_details">
                        <option value="" selected>---- Chọn hình thức đơn hàng ----</option>
                        <option id="{{$orders->id}}" selected value="1">Chưa xử lí</option>
                        <option id="{{$orders->id}}" value="2">Đã xử lí - Đã thanh toán</option>
                        <option id="{{$orders->id}}" value="3">Hủy đơn hàng - tạm giữ</option>
                      </select>
                    </form>
                  @elseif($orders->order_status==2)
                    <form > 
                      @csrf
                      <select class="form-control order_details">
                        <option value="">----Chọn hình thức đơn hàng----</option>
                        <option id="{{$orders->id}}" value="1">Chưa xử lí</option>
                        <option id="{{$orders->id}}" selected value="2">Đã xử lí - Đã thanh toán</option>
                        <option id="{{$orders->id}}" value="3">Hủy đơn hàng - tạm giữ</option>
                      </select>
                  </form>
                  @else
                  <form > 
                    @csrf
                    <select class="form-control order_details">
                      <option value="">----Chọn hình thức đơn hàng----</option>

                      <option id="{{$orders->id}}" value="1">Chưa xử lí</option>
                      <option id="{{$orders->id}}" value="2">Đã xử lí - Đã thanh toán</option>
                      <option id="{{$orders->id}}" selected value="3">Hủy đơn hàng - tạm giữ</option>
                    </select>
                </form>
                  @endif
              </td>
            </tr>
          </tbody>
        </table>
        <p class="text-right text-danger" style="padding-right:80px">Tổng tiền <span>{{number_format($total_sum).'đ'}}</span></p>
        {{-- <p class="text-right " style="padding-right:50px"> <b > Tổng tiền thanh toán: <span>{{$all_order->order_total}} vnd</span></b></p> --}}
      </div>
      <a href="{{route('pdf.order',$item->order_code)}}" class="btn btn-primary">In đơn hàng</a>
    </div>
  </div>
  <br>
  @endsection