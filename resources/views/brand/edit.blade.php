@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
               
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('brand.update',$brands->id)}}" method="POST">
                        @csrf
                        @php
                        if(session()->has('message')){
                            echo session()->get('message');
                            session()->put('message',null);
                        }
                        @endphp
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input value="{{$brands->brand_name}}" type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea value="{{$brands->brand_desc}}" type="text" rows="5" name="brand_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea>
                        </div>
                        <div class="form-group">
                              <label for="">Hiển thị thương hiệu</label>
                              <select class="form-control" name="brand_status" id="">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
           
                              </select>                          
                        </div>
                        <button type="submit" name="add_brand" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
    
@endsection