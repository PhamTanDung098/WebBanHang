@extends('master')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach ($product as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                           
                                <input type="hidden" name="" value="{{$item->id}}"
                                 class="card_product_id_{{$item->id}}">

                                <input type="hidden" name="" value="{{$item->product_name}}"
                                 class="card_product_name_{{$item->id}}">
                                 
                                <input type="hidden" name="" value="{{$item->product_image}}"
                                 class="card_product_image_{{$item->id}}">

                                <input type="hidden" name="" value="{{$item->product_price}}"
                                 class="card_product_price_{{$item->id}}">

                                <input type="hidden" name="" value="1"
                                 class="card_product_qty_{{$item->id}}">
                         
                                <a href="{{route('product.chitiet',$item->id)}}">
                                    <img src="public/uploads/products/{{$item->product_image}}" alt="" />
                                    <h2>{{number_format($item->product_price)}} VND</h2>
                                    <p>{{$item->product_desc}}</p>
                                {{-- <a href="{{route('product.chitiet',$item->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> --}}
                                </a>
                                <button type="submit" class="btn btn-default add-to-cart" data-id="{{$item->id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            
                        </div>
                        
                    </div>
              
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    
    
</div>
<div class="text-center" >
    {{$product->links('pagination::bootstrap-4')}}
</div>

@endsection