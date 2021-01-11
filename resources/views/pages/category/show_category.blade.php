@extends('master')
@section('content')
<div class="features_items"><!--features_items-->
    {{-- nút chia sẻ --}}
    <div class="fb-share-button" data-href="http://localhost:81/Project_WebBanHang/" 
    data-layout="button_count" data-size="large"><a target="_blank"
     href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%3A81%2FProject_WebBanHang%2F&amp;src=sdkpreparse" 
     class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
     {{--  --}}

     {{-- nut chia se --}}
     <div class="fb-like" data-href="http://localhost:81/Project_WebBanHang/danhmuc/18" 
     data-width="" data-layout="standard" 
     data-action="like" data-size="large" data-share="false"></div>



     {{--  --}}
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
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
    <div class="fb-comments" data-href="http://localhost:81/Project_WebBanHang/danhmuc/18" data-width="" data-numposts="20"></div>
    
</div>
@endsection