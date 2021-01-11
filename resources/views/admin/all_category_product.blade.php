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
              <th>Tên danh mục</th>
              <th>Mô tả về danh mục </th>
              <th>Hiển thị</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $index =1
            @endphp
            @foreach ($Category_Product as $item)
            @php
                if(session()->has('message')){
                  echo session()->get('message');
                  session()->put('message',null);
                }
            @endphp
              <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{$index++}}</td>
                <td>{{$item->category_name}}</td>
                <td><span class="text-ellipsis">{{$item->category_desc}}</span></td>
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
                  <a href="{{route('categoryproduct.active',$item->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                </span></td>
                <td>
                  <a href="" class="active" ui-toggle-class="">
                    <a href="{{route('categoryproduct.edit',$item->id)}}" ><i class="fas fa-edit edit" ></i></a>
                    <a href="{{route('categoryproduct.delete',$item->id)}}" ><i class="fas fa-trash-alt delete"></i></a>
                    
                  </a>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer> --}}
    </div>
  </div>
@endsection