@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách đơn hàng
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
              <th>Mã đơn hàng</th>
              <th>Tình trạng đơn hàng </th>
              <th>Ngày đặt hàng </th>
              <th>Action</th>
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
                $index = 1;
            @endphp
              <tr>
                @foreach ($order as $item)
                    <tr>
                      <td>{{$index++}}</td>
                      <td>{{$item->order_code}}</td>
                      <td>
                        @if ($item->order_status ==1)
                            Đơn hàng mới
                        @else
                            Đơn hàng đã xử lí
                        @endif
                      
                      </td>
                      <td>{{$item->created_at}}</td>
                      <td>
                        <a href="{{route('admin.view_order',$item->order_code)}}" ><i class="fas fa-eye edit text-success" ></i></a>
                        <a href="{{route('categoryproduct.delete',$item->id)}}" ><i class="fas fa-trash-alt delete"></i></a>
                      </td>
                    </tr>
                @endforeach
                
              </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection