@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách danh mục sản phẩm 
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
              <th>Số lượng sản phẩm </th>
              <th>Mô tả sản phẩm</th>
              <th>Chi tiết sản phẩm</th>
              <th>Màu</th>
              <th>image</th>
              <th>Giá</th>
              <th>Status</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
            @foreach ($product as $item)
            @php
                if(session()->has('message')){
                  echo session()->get('message');
                  session()->put('message',null);
                }
            @endphp
              <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{$index++}}</td>
                <td>{{$item->product_name}}</td>
                <td>{{$item->product_quatity}}</td>
                {{-- <td>{{$item->category_id}}</td>
                <td>{{$item->brand_id}}</td> --}}
                <td><span class="text-ellipsis">{{$item->product_desc}}</span></td>
                <td><span class="text-ellipsis">{{$item->product_content}}</span></td>
                <td><span class="text-ellipsis">{{$item->product_color}}</span></td>
                @php
                    $image =$item->product_image;
                @endphp
                <td><span class="text-ellipsis"><img src="public/uploads/products/{{$image}}" alt="" width="50px" height="50px"></span></td>
                <td><span class="text-ellipsis">{{$item->product_price}}</span></td>
                
                <td><span class="text-ellipsis">
                  {{-- @php
                    if($item->category_status == 1)
                    {
                      echo "<a href=""><span class="fa-thumb-styling fa fa-thumbs-up"></span> </a>";
                    }
                    else {
                      echo "<a href=""><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>";
                    }
                  @endphp                 --}}
                  <a href="{{route('product.active',$item->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                </span></td>
                <td>
                  
                  <a href="" class="active" ui-toggle-class="">
                    <a href="{{route('product.edit',$item->id)}}"><i class="fas fa-edit edit"></i></a>
                    <a href="{{route('product.delete',$item->id)}}" ><i class="fas fa-trash-alt delete"></i></a>
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