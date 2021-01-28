<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
// Send mail
Route::get('/send-mail', [HomeController::class,'send_mail'])->name('send_mail');
//facebook
Route::get('/login-facebook',[AdminController::class,'login_facebook'])->name('login-facebook');
Route::get('/login/callback',[AdminController::class,'callback_facebook']);

// Fornt-end-----------------------------------------------------------------
Route::get('/',[HomeController::class,'index'])->name('home1');
Route::post('/timkiem',[HomeController::class,'search'])->name('search');
// Danh muc san pham
Route::get('/danhmuc/{id}',[CategoryProduct::class,'showCategoryHome'])->name('home.showdanhmuc');
//Thương hiệu
Route::get('/brand/{id}',[BrandController::class,'showBrand'])->name('home.showbrand');
//Chi tiết sản phẩm
Route::get('/chitiet/{id}',[ProductController::class,'chitietsanpham'])->name('product.chitiet');
// Back-end-------------------------------------------------------------------
Route::get('/home', [HomeController::class,'index'])->name('Home');

// login
Route::get('/content', [AdminController::class,'content'])->name('content');
Route::get('/login', [AdminController::class,'index'])->name('login');
Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
Route::post('/admin-dashboard', [AdminController::class,'dashboard'])->name('admin.login');
Route::get('/admin-logout',[AdminController::class,'logout'])->name('admin.logout');
// category Products
Route::get('/add-categoryproduct',[CategoryProduct::class,'add_categoryproduct'])->name('categoryproduct.add');
Route::post('/save-categoryproduct',[CategoryProduct::class,'save_categoryproduct'])->name('categoryproduct.save');
Route::post('/uppate-categoryproduct/{id}',[CategoryProduct::class,'update_categoryproduct'])->name('categoryproduct.update');
Route::get('/edit-categoryproduct/{id}',[CategoryProduct::class,'edit_categoryproduct'])->name('categoryproduct.edit');
Route::get('/delete-categoryproduct/{id}',[CategoryProduct::class,'delete_categoryproduct'])->name('categoryproduct.delete');
Route::get('/all-categoryproduct',[CategoryProduct::class,'all_categoryproduct'])->name('categoryproduct.all');
Route::get('/active-categoryproduct/{id}',[CategoryProduct::class,'active_categoryproduct'])->name('categoryproduct.active');
//Brand
Route::get('/add-brand',[BrandController::class,'addBrand'])->name('brand.add');
Route::post('/save-brand',[BrandController::class,'saveBrand'])->name('brand.save');
Route::get('/all-brand',[BrandController::class,'allBrand'])->name('brand.all');
Route::get('/active-brand/{id}',[BrandController::class,'brand_actice'])->name('brand.active');
Route::post('/uppate-brand/{id}',[BrandController::class,'update_brand'])->name('brand.update');
Route::get('/edit-brand/{id}',[BrandController::class,'edit_brand'])->name('brand.edit');
Route::get('/delete-brand/{id}',[BrandController::class,'delete_brand'])->name('brand.delete');
//product
Route::get('/add-product',[ProductController::class,'add_product'])->name('product.add');
Route::post('/save-product',[ProductController::class,'save_product'])->name('product.save');
Route::get('/all-product',[ProductController::class,'all_product'])->name('product.all');
Route::get('/active-product/{id}',[ProductController::class,'product_actice'])->name('product.active');
Route::post('/uppate-product/{id}',[ProductController::class,'product_update'])->name('product.update');
Route::get('/edit-product/{id}',[ProductController::class,'product_edit'])->name('product.edit');
Route::get('/delete-product/{id}',[ProductController::class,'product_delete'])->name('product.delete');
//Cart
Route::post('/save-cart',[CartController::class,'saveCart'])->name('cart.save');
Route::get('/show-cart',[CartController::class,'show_cart'])->name('cart.show');
Route::get('/delete-cart/{id}',[CartController::class,'delete_cart'])->name('cart.delete');
Route::post('/update-cart-quatity',[CartController::class,'update_cart_quality'])->name('cart.update');
Route::get('/delete-cart-ajax/{id}',[CartController::class,'delete_cart_ajax'])->name('cart.delete.ajax');
// ====================================Cart Ajax
Route::any('/add-cart-ajax',[CartController::class,'add_cart_ajax'])->name('cart.ajax');
Route::get('/show-cart-ajax',[CartController::class,'show_cart_ajax'])->name('cart.show.ajax');
Route::post('/update-cart-ajax',[CartController::class,'update_cart_ajax'])->name('cart.update.ajax');
Route::get('/delete-all',[CartController::class,'delete_all'])->name('cart.deleteall.ajax');
// Coupon 
Route::post('/coupon',[CartController::class,'check_coupon'])->name('coupon');
Route::get('/add-coupon',[CouponController::class,'add_coupon'])->name('coupon.add');
Route::post('/insert-coupon',[CouponController::class,'insert_coupon'])->name('coupon.insert');
Route::get('/list-coupon',[CouponController::class,'list_coupon'])->name('coupon.list');
Route::get('/delete-coupon/{id}',[CouponController::class,'delete_coupon'])->name('coupon.delete');

//Check out
Route::get('/login-checkout',[CheckController::class,'login_checkout'])->name('login-checkout');
Route::get('/logout-checkout',[CheckController::class,'logout_checkout'])->name('logout-checkout');
Route::get('/checkout',[CheckController::class,'checkout'])->name('checkout');
/////



Route::any('/order-place',[CheckController::class,'orderplace'])->name('order.place');


//customer
Route::post('/addcustomer',[CheckController::class,'add_customer'])->name('check.addcustomer');
Route::post('/save-checkout-customer',[CheckController::class,'save_checkout'])->name('check.save');
Route::post('/login-customer',[CheckController::class,'login_customer'])->name('customer.login');
Route::get('/payment',[CheckController::class,'payment'])->name('payment');


//Order 
Route::get('/manager-order',[OrderController::class,'manager_order'])->name('admin.manager_order');
Route::get('/view-order/{ordercode}',[OrderController::class,'view_order'])->name('admin.view_order');


// ajax find product
Route::get('/findDanhmuc',[ProductController::class, 'findDanhmuc'])->name('findDanhmuc');
Route::get('/findProductName',[ProductController::class,'findProductName']);

// ajax feeship
Route::get('/add-feeship',[DeliveryController::class,'add_feeship'])->name('feeship.add');
Route::get('/findPrevince',[DeliveryController::class,'findPrevince'])->name('findPrevince');
Route::get('/findWards',[DeliveryController::class,'findWards'])->name('findWards');
Route::post('/insert-feeship',[DeliveryController::class,'insert_feeship'])->name('feeship.insert');
Route::get('/list-feeship',[DeliveryController::class,'list_feeship'])->name('feeship.list');
Route::get('/edit-feeship/{id}',[DeliveryController::class,'edit_feeship'])->name('feeship.edit');
Route::post('/update-feeship/{id}',[DeliveryController::class,'update_feeship'])->name('feeship.update');
Route::get('/delete-feeship/{id}',[DeliveryController::class,'delete_feeship'])->name('feeship.delete');
Route::post('/detail-feeship',[CartController::class,'detail_feeship'])->name('feeship.detail');
// ajax order
Route::post('confirm-order',[CheckController::class,'confirm_order'])->name('confirm-order');


// PDF
Route::get('/print-order/{order_code}',[OrderController::class,'print_pdf'])->name('pdf.order');
// banner
Route::get('/manage-banner',[BannerController::class,'delivery'])->name('delivery');
Route::get('/add-banner',[BannerController::class,'add_banner'])->name('banner.add');
Route::get('/list-banner',[BannerController::class,'list_banner'])->name('banner.list');
Route::post('/save-banner',[BannerController::class,'save_banner'])->name('banner.save');
Route::get('/status-banner/{id}',[BannerController::class,'banner_status'])->name('banner.status');