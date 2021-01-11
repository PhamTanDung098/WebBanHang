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
                        <form role="form" action="{{route('categoryproduct.save')}}" method="POST">
                        @csrf
                        @php
                        if(session()->has('message')){
                            echo session()->get('message');
                            session()->put('message',null);
                        }
                        @endphp
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea type="password" rows="5" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea>
                        </div>
                        <div class="form-group">
                              <label for="">Hiển thị sản phẩm</label>
                              <select class="form-control" name="category_product_status" id="">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
           
                              </select>                          
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
    
@endsection