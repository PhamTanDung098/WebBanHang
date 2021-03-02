<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset("public/backend/css/style.css")}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link href="{{asset('public/backend/css/font.css')}}" rel="stylesheet"  type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/6b88d56780.js" crossorigin="anonymous"></script>
<!-- calendar -->
<link href="{{asset('public/backend/css/monthly.css')}}" rel="stylesheet" >
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>

<style>
    .fa-edit{
      width: 50px;
      height: 50px;
    }
    .edit{
      color: chartreuse;
      width: 50px;
      height: 50px;
    }
    .delete{
      color: red;
  
    }
  </style>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{route('home1')}}" class="logo">
        E-SHOPPER
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset("public/backend/images/2.png")}}">
                <span class="username">@php
                    if(session()->has('user')){
                        echo session()->get('user')->admin_name;
		            }
                @endphp</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{route('admin.logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{route('dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tong quan</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('delivery')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Banner</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('banner.add')}}">Thêm Slider</a></li>
						<li><a href="{{route('banner.list')}}">Danh sách Slider</a></li>
				
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('admin.manager_order')}}">Quản lí đơn hàng </a></li>
				
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('coupon.add')}}">Quản lí mã giảm giá</a></li>
						<li><a href="{{route('coupon.list')}}">Danh sách mã giảm giá</a></li>
				
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm </span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('brand.add')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{route('brand.all')}}">Liệt thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm </span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('categoryproduct.add')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{route('categoryproduct.all')}}">Liệt kê danh mục sản phẩm</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thêm phí ship</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('feeship.add')}}">Thêm phí ship</a></li>
						<li><a href="{{route('feeship.list')}}">Liệt kê danh mục sản phẩm</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('product.add')}}">Thêm sản phẩm</a></li>
						<li><a href="{{route('product.all')}}">Liệt kê sản phẩm</a></li>

                    </ul>
                </li>
                
                <li>
                    <a href="{{route('home1')}}">
                        <i class="fa fa-user"></i>
                        <span>Login Page</span>
                    </a>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
{{--  validate --}}
<script src="{{asset('public/backend/js/js.formValidation.min.js')}}"></script>

<script >
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace("ckeditor");
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        // alert(order_status);
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
         quantity = [];
        $('input[name="product_sale_quantity"]').each(function(){
            quantity.push($(this).val());
        });
        order_product_id =[];
        $('input[name="order_checkout_quantity"]').each(function(){
            order_product_id.push($(this).val());
        });
        $.ajax({
            url: '{{url('/update-quantity')}}',
            method: 'POST',
            data:{_token:_token,order_status:order_status,quantity:quantity
                ,order_id:order_id,order_product_id:order_product_id},
     
            success:function(data){
                alert("Cập nhật số lượng thành công");
                // location.reload();
            }
        });

    });

</script>
<script type = "text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = 
    });


</script>

{{-- <script type="text/javascript">
    $.validate({
    });
</script> --}}
<!-- morris JavaScript -->	
{{-- <script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });  
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		} 
	});
    </script> --}}
    
<!-- calendar -->

	
    
	<!-- //calendar -->
</body>
</html>
