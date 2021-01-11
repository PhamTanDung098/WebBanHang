@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
               
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('product.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @php
                        if(session()->has('message')){
                            echo session()->get('message');
                            session()->put('message',null);
                        }
                        @endphp
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation-length="min10" data-validation-error-msg="Lam" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number"  name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="">Thương hiệu sản phẩm</label>
                            <select class="form-control" name="brand_id" id="">
                                <option value="">Danh sách thương hiệu sản phẩm</option>
                              @foreach ($brand as $brand)
                                  <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                          <label for="">Danh mục sản phẩm</label>
                          <select class="form-control" name="category_id" id="">
                            <option value="">Danh sách sản phẩm</option>
                                @foreach ($cate as $item)
                                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach
                          </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea type="password" name="product_desc" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chi tiết sản phẩm</label>
                            <textarea type="number" rows="5" name="product_content" class="form-control" id="ckeditor" placeholder="Mô tả danh mục"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng sản phẩm</label>
                            <input type="number" rows="5" name="product_size" class="form-control" id="" placeholder="Mô tả danh mục"> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Màu</label>
                            <input type="text" rows="5" name="product_color" class="form-control" id="" placeholder="Mô tả danh mục"> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá sản phẩm</label>
                            <input type="number" rows="5" data-validation="number" data-validation-error-msg="Làm ơn điền đầy đủ thông tin" name="product_price" class="form-control" id="" placeholder="Mô tả danh mục"> 
                        </div>
                        <div class="form-group">
                          <label for="">Image</label>
                          <input type="file" class="form-control-file" name="product_image" id="" required="true"> 
                        </div>
                        <div class="form-group">
                              <label for="">Hiển thị sản phẩm</label>
                              <select class="form-control" name="product_status" id="">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                              </select>                          
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
    
@endsection