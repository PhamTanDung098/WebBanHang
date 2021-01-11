@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách danh mục sản phẩm
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped b-t b-ligh  t">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên mã giám giá</th>
              <th>Mã giảm giá </th>
              <th>Số lượng mã</th>
              <th>Tính năng mã</th>
              <th>Số tiền giảm giá</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
            @if (session()->has('massage'))
              <div class="alert alert-success">
                {{session()->get('massage')}}
              </div>
            @endif
            @foreach ($coupon as $item)
              <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{$index++}}</td>
                <td>{{$item->coupon_name}}</td>
                <td>{{$item->coupon_code}}</td>
                <td>{{$item->coupon_times}}</td>
                <td>
                    @php
                        if($item->coupon_number==1)
                        {
                            echo 'Giảm giá theo %';
                        }
                        else {
                            echo 'Giảm giá theo số tiền';
                        }
                    @endphp
                </td>
                <td>{{$item->coupon_codition}}</td>
                <td>
                    {{-- <a href="{{route('coupon.delete',$item->coupon_id)}}" onclick="Bạn có chắc chắn muốn xóa không?" ><i class="fas fa-edit edit" ></i></a> --}}
                    <a href="{{route('coupon.delete',$item->coupon_id)}}" onclick="Bạn có chắc chắn muốn xóa không?" ><i class="fas fa-trash-alt delete"></i></a>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
@endsection