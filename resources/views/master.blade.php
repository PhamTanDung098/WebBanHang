<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	{{-- SEo --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="description" content="{{$meta_desc}}"> --}}
    <meta name="description" content="meta 1 ">
	<meta name="author" content="">
	{{-- <meta name="keywords" content="{{$meta_keywords}}"> --}}
	<meta name="keywords" content="Điện thoại phụ kiện giá rẻ">
	<meta name="robots" content="INDEX,FOLLOW">
	{{-- <link rel="canonical" href="{{$meta_canonical}}">  --}}
	{{-- <title>{{$meta_title}}</title> --}}
	{{-- Share fb --}}
	{{-- <meta property="og:image" content="http://localhost:81/Project_WebBanHang/"> --}}
	<meta property="og:site_name" content="http://localhost:81/Project_WebBanHang/">
	{{-- <meta property="og:description" content="{{$meta_desc}}"> --}}
	<meta property="og:description" content="Chuyên bán điện thoại giá rẻ">
	<meta property="og:title" content="E - SHOP">
	{{-- <meta property="og:url" content="{{$meta_canonical}}"> --}}
	<meta property="og:type" content="website">
	<link rel="icon" href="">
	{{--  --}}
    <title>E-SHOP</title>
    <link href="{{asset("public/forntend/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("public/forntend/css/font-awesome.min.css")}}" rel="stylesheet">
    <link href="{{asset("public/forntend/css/prettyPhoto.css")}}" rel="stylesheet">
    <link href="{{asset('public/forntend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset("public/forntend/css/animate.css")}}" rel="stylesheet">
	<link href="{{asset('public/forntend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset("public/forntend/css/responsive.css")}}" rel="stylesheet">
	<link href="{{asset("public/forntend/css/sweetalert.css")}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	
	<![endif]-->  
	<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>     
    <link rel="shortcut icon" href="{{asset("public/forntend/images/ico/favicon.ico")}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset("public/forntend/images/ico/apple-touch-icon-144-precomposed.png")}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset("public/forntend/images/ico/apple-touch-icon-114-precomposed.png")}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset("public/forntend/images/ico/apple-touch-icon-72-precomposed.png")}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset("public/forntend/images/ico/apple-touch-icon-57-precomposed.png")}}">
</head><!--/head-->

<body>

	@php
		$customer_id = Session::get('customer_id');
		echo '<br>';
		$shipping_id =  Session::get('shipping_id');
	@endphp
	<header id="header"><!--header-->
		
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{route('home1')}}"><img src="{{asset('public/forntend/images/home/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>								
								@php
									if(session()->get('customer_id')!=null && session()->get('shipping_id')==null)
									{
								@endphp
								<li><a href="{{route('cart.show.ajax')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								@php
									}elseif(session()->get('customer_id')!=null && session()->get('shipping_id')!=null ) {	
								@endphp	
									<li><a href="{{route('cart.show.ajax')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>						
									@php

									}else{
									@endphp
									<li><a href="{{route('login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>						
									@php
									}
									@endphp


								
								<li><a href="{{route('cart.show.ajax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								@php
									if(session()->has('customer_id')!=null)
									{
								@endphp
								<li><a href="{{route('logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								
								@php
									}else {	
								@endphp	
								<li><a href="{{route('login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>					
									@php
									}
									@endphp	
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{route('home1')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="{{route('cart.show')}}">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
								
                                    </ul>
                                </li> 
								<li><a href="{{route('cart.show')}}">Giỏ hàng</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{route('search')}}" method="POST">
							@csrf
						<div class="search_box pull-right">
							<input type="text" name="keywords" placeholder="Tìm kiếm"/>
							<input type="submit" class="btn btn-success btn-sm" value="Tìm kiếm" name="search_item" style="width:81px;height:35px">
						</div> 
						
					</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		@include('pages.carousel')
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						{{-- <h2>Danh mục sản phẩm</h2> --}}
						{{-- <div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								@foreach ($cate as $item)
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('home.showdanhmuc',$item->id)}}">{{$item->category_name}}</a></h4>
								</div>
								@endforeach
								
							</div>
							
						</div>
						<!--/category-products--> --}}
						<div class="brands_products"><!--brands_products-->
							<h2>Danh mục sản phẩm</h2>
							@foreach ($cate as $item)
								{{-- <div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('home.showdanhmuc',$item->id)}}">{{$item->category_name}}</a></h4>
								</div> --}}
								<div class="brands-name">
									<ul class="nav nav-pills nav-stacked">
										<li class="pl-3"><a href="{{route('home.showdanhmuc',$item->id)}}">{{$item->category_name}}</a></li>
									</ul>
								</div>
								@endforeach
							
						</div>
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							@foreach ($brand as $brand)
								<div class="brands-name">
									<ul class="nav nav-pills nav-stacked">
										<li><a href="{{route('home.showbrand',$brand->id)}}"> <span class="pull-right">(50)</span>{{$brand->brand_name}}</a></li>
									</ul>
								</div>
							@endforeach
							
						</div>
					
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					@yield('content')
					{{-- comment facebook --}}
					<div class="fb-comments" data-href="http://localhost:81/Project_WebBanHang/danhmuc/18" data-width="" data-numposts="20"></div>
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="https://www.youtube.com/watch?v=j4oVP6aoS1A" target="_blank">
									<div class="iframe-img">
										<img src="{{asset("public/uploads/products/iphone-8-plus-hh-600x600-600x60078.jpg")}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="https://www.youtube.com/watch?v=BeOkYfCcyqU" target="_blank">
									<div class="iframe-img">
										<img src="{{asset('public/uploads/products/s1054.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="https://www.youtube.com/watch?v=j4oVP6aoS1A" target="_blank">
									<div class="iframe-img">
										<img src="{{asset('public/uploads/products/Apple-iPhone-7-Plus-128-Go-5-5-Rouge92.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="https://www.youtube.com/watch?v=7pV9B3smeno" target="_blank">
									<div class="iframe-img">
										<img src="{{asset('public/uploads/products/apple-watch-s6-lte-40mm-vien-nhom-day-cao-su-ava-600x60074.jpg')}}" alt="1" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{asset('public/forntend/images/home/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	
	

  
    <script src="{{asset("public/forntend/js/jquery.js")}}"></script>
	<script src="{{asset("public/forntend/js/bootstrap.min.js")}}"></script>
	<script src="{{asset("public/forntend/js/jquery.scrollUp.min.js")}}"></script>
	<script src="{{asset("public/forntend/js/price-range.js")}}"></script>
    <script src="{{asset("public/forntend/js/jquery.prettyPhoto.js")}}"></script>
	<script src="{{asset("public/forntend/js/main.js")}}"></script>
	<script src="{{asset('public/forntend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('public/forntend/js/sweetalert.js')}}"></script>

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" 
		src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="2uj4shAe">
	</script>
	<script type= "text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id');
				// alert(id);
				var cart_product_id = $('.card_product_id_'+ id).val();
				var card_product_name = $('.card_product_name_'+id).val();
				var cart_product_image = $('.card_product_image_'+id).val();
				var cart_product_price = $('.card_product_price_'+id).val();
				var cart_product_qty = $('.card_product_qty_'+id).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:'{{url('/add-cart-ajax')}}',
					method:'get',
					data:{
						cart_product_id:cart_product_id,
						card_product_name:card_product_name,
						cart_product_image:cart_product_image,
						cart_product_price:cart_product_price,
						cart_product_qty:cart_product_qty,
						_token:_token
					},
					success:function(){
						// swal("Here's a message!", "It's pretty, isn't it?")
						swal("Đã thêm sản phẩm vào giỏ hàng!", "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để thanh toán!", "success")
						// swal({
						// 	title: "Đã thêm sản phẩm vào giỏ hàng",
						// 	text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để thanh toán",
						// 	showCancelButton: true,
						// 	cancelButtonText:"Xem tiếp",
						// 	confirmButtonClass: "btn-success",
						// 	confirmButtonText: "Đi đến giỏ hàng",
						// 	closeOnConfirm:true

						// },function(){
						// 	window.location.href("{{url('/show-cart-ajax')}}");
						// });
					}
				});
			});
		});
	</script>

	
	
</body>
</html>