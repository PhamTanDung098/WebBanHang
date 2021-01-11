@extends('master')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Thương hiệu</h2>
    @foreach ($product as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <a href="{{route('product.chitiet',$item->id)}}">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('public/uploads/products/'.$item->product_image)}}" alt="iphone 7" width="100px" height="200">
                            <h2>{{number_format($item->product_price)}} VND</h2>
                            <p>{{$item->product_desc}}</p>
                            <a href="{{route('product.chitiet',$item->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        {{-- <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{number_format($item->product_price)}} VND</h2>
                                <p>{{$item->product_content}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div> --}}
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                            </ul>
                        </div>
            </div>
        </a>
        </div>
    @endforeach
    
</div>
@endsection