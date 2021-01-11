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
                        <form role="form" action="{{route('banner.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session()->get('massage'))
                            <div class="alert alert-success">
                                {{session()->get('massage')}}
                            </div>
                            @php
                                Session::forget('massage');
                            @endphp
                        @endif
                        <div class="form-group">
                            <label for="">Tên Slider</label>
                            <input type="text" name="slider_name" class="form-control" id="" >
                        </div>
                        <div class="form-group">
                          <label for="">Image</label>
                          <input type="file" class="form-control-file" name="slider_image" id="" required="true"> 
                        </div>
                        <div class="form-group">
                              <label for="">Hiển thị sản phẩm</label>
                              <select class="form-control" name="slider_status" id="">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                              </select>                          
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả về slider</label>
                            <textarea type="text" name="slider_desc" class="form-control" id="" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <button type="submit"  class="btn btn-info">Thêm Slider</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
    
@endsection