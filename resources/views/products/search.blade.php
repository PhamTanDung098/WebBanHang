@extends('master')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach ($search as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <a href="{{route('product.chitiet',$item->id)}}">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="public/uploads/products/{{$item->product_image}}" alt="" />
                            <h2>{{number_format($item->product_price)}} VND</h2>
                            <p>{{$item->product_desc}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        
                    </div>
                </a>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    
</div><!--features_items-->
@endsection