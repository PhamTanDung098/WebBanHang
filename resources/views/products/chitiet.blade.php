@extends('master')
@section('content')
@foreach ($product_detail as $item)
    

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{asset('public/uploads/products/'.$item->product_image)}}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active" style="margin-left:7px">
                      <a href=""><img src="{{asset('public/uploads/products/iphone-8-plus-hh-600x600-600x60078.jpg' )}} " width="84" height="84" alt=""></a>
                      <a href=""><img src="{{asset('public/uploads/products/637008702547566121_ss-note-10-pl-glow-1-1_365.png' )}} " width="84" height="84" alt=""></a>
                      <a href=""><img src="{{asset('public/uploads/products/Apple-iPhone-7-Plus-128-Go-5-5-Rouge92.jpg' )}} " width="84" height="84" alt=""></a>
                    </div>  
                </div>
              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$item->product_name}}</h2>
            <p>ID: {{$item->id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{route('cart.save')}}" method="POST">
                @csrf
                <span>
                    <span>{{number_format($item->product_price).'VND'}}</span>
                </span>
                <p><b>Tình trạng:</b> Còn hàng</p>
                <p><b>Điều kiện:</b> Mới 100%</p>
                <p><b>Thương hiệu:</b> {{$item->brand_name}}</p>
                <p><b>Danh muc:</b> {{$item->category_name}}</p>
                <label>Quantity:</label>
                <input type="number" min="1" value="1" name='qlt'/>
                <input  type="hidden" name="product_id_hidden" type="hidden" value="{{$item->product_id}}">
                <button type="submit" class="btn btn-fefault cart " style="margin:0;">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                </button>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </form>
        </div><!--/product-information-->
    </div>
</div>

{{-- end product --}}


<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>           
            <li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{!!$item->product_desc !!}</p>
            
        </div>
        
        <div class="tab-pane fade " id="companyprofile" >
            <p>{!!$item->product_content !!}</p>
            
        </div>
        
        <div class="tab-pane fade" id="tag" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        <div class="tab-pane fade " id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                @foreach ($relate_product as $relate)
                    <a href="{{route('product.chitiet',$relate->id)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('public/uploads/products/'.$relate->product_image)}}" alt="" />
                                        <h2>{{number_format($relate->product_price)}}</h2>
                                        <p>{{$relate->product_name}}</p>
                                        <button type="button" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Thêm giỏ hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->

</div>
@endsection