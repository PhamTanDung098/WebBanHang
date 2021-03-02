@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Sản phẩm
                </header>
               
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @php
                        if(session()->has('message')){
                            echo session()->get('message');
                            session()->put('message',null);
                        }
                        @endphp
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control"  placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="">
                                Số lượng sản phẩm
                            </label>
                            <input type="text" name="product_quantity" class="form-control" >
                        </div>
                        
                        <div class="form-group">
                            <label for="">Thương hiệu sản phẩm</label>
                            <select class="form-control thuonghieu" name="brand_id" >
                                <option value="">Danh sách thương hiệu sản phẩm</option>
                              @foreach ($brand as $brand)
                                  <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                              @endforeach
                            </select>
                            {{-- <label for="">Danh mục sản phẩm</label>
                            <select class="form-control" name="category_id"  class="danhmuc"> --}}
                             {{-- <option value="">Danh sách sản phẩm</option> --}}
                                {{-- @foreach ($cate as $item)
                                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach --}} 
                            {{-- </select> --}}
                          </div>
                          
                        <div class="form-group">
                          <label for="">Danh mục sản phẩm</label>
                          <select class="form-control danhmuc" name="category_id" id="danhmuc">
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả sản phẩm</label>
                            <textarea type="password" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Chi tiết sản phẩm</label>
                            <textarea type="number" rows="5" name="product_quatity" class="form-control"  placeholder="Product Quantity"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng sản phẩm</label>
                            <input type="number" rows="5" name="product_size" class="form-control"  placeholder="Mô tả danh mục"> 
                        </div>
                        <div class="form-group">
                            <label for="">Màu</label>
                            <input type="text" rows="5" name="product_color" class="form-control"  placeholder="Mô tả danh mục"> 
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="number" rows="5" name="product_price" class="form-control"  placeholder="Mô tả danh mục"> 
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
  
    <script type="text/javascript">
        $('.thuonghieu').on('change',function(){         
                var cat_id = $(this).val();  
                console.log(cat_id);
                var div = $(this).parent();
                var option = " ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findProductName')!!}',
                    data:{'id':cat_id},
                    success:function(data){
                          console.log(data);
                        option+= '<option value="0">Select State with Country</option>';
                        for(var i =0;i<data.length;i++){
                            option +='<option value="'+data[i].id+'">'+data[i].category_name+'</option>';
                        }

                        console.log(option);
                        $('.danhmuc').html(" ");
                        $('.danhmuc').append(option);
                    },
                    error:function(){
                        console.log('null');
                    }
                });
            });


    </script>
</div>

    
@endsection