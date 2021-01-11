@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách slider muốn hiển thị
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
              <th>Tên Slider</th>
              <th>Hình ảnh</th>
              <th>Mô tả</th>
              <th>Tình trang hiển thị</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
            
            @foreach ($slider as $item)
            @if (session()->get('massage'))
                <div class="alert alert-success">
                    {{session()->get('massage')}}
                </div>
                @php
                    session()->forget('massage');
                @endphp
             @endif
              <tr>
                <td>{{$index++}}</td>
                <td>{{$item->slide_name}}</td>
                <td>
                    <img src="public/uploads/products/{{$item->slider_image}}" alt="" width="50px" height="50px">
                </td>
                <td>{{$item->slider_desc}}</td>
                <td>
                    @if ($item->slider_status == 0)
                        <a href="{{route('banner.status',$item->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    @else
                        <a href="{{route('banner.status',$item->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                    @endif
                 </td>
                <td>
                <td><span class="text-ellipsis">
                 
                  <a href="" class="active" ui-toggle-class="">
                    <a href="{{route('brand.edit',$item->slider_id)}}" ><i class="fas fa-edit edit"></i></a>
                    <a href="{{route('brand.delete',$item->slider_id)}}"><i class="fas fa-trash-alt delete"></i></a>
                  </a>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection