<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_Product;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Slider;
use Mail;
class HomeController extends Controller
{
    //
    public function index(Request $req){
        // SEO
        $meta_desc = "Chuyên bán điện thoại giá rẻ Chuyên bán điện thoại giá rẻ Chuyên bán điện thoại giá rẻ";     
        $meta_keywords = "Điện thoại phụ kiện giá rẻ";
        $meta_title = "E-SHOP";
        $meta_canonical = $req->url();
        // endSEO
        $slider = Slider::all();
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();     
        $brand = Brand::where('brand_status','=','1')->get();
        $product = Product::where('product_status','1')->paginate(9);
        // $product->setBaseUrl('custom/url');
        return view('pages.home',['cate'=>$cate,'brand'=>$brand,'product'=>$product,'meta_desc'=>$meta_desc,
        'meta_keywords'=>$meta_keywords,'meta_title'=>$meta_title,'meta_canonical'=>$meta_canonical,'slider'=>$slider]);
    }
    public function search(Request $req){
        $meta_desc = "Chuyên bán điện thoại giá rẻ Chuyên bán điện thoại giá rẻ Chuyên bán điện thoại giá rẻ";     
        $meta_keywords = "Điện thoại phụ kiện giá rẻ";
        $meta_title = "Search E-Shop";
        $meta_canonical = $req->url();
        $keyword = $req->keywords;
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();     
        $brand = Brand::where('brand_status','=','1')->get();
        $search = Product::where('product_name','like','%'.$keyword.'%')->get();
        // $product = Product::where('product_status','1')->get();
        return view('products.search',['cate'=>$cate,'brand'=>$brand,'search'=>$search,'meta_desc'=>$meta_desc,
        'meta_keywords'=>$meta_keywords,'meta_title'=>$meta_title,'meta_canonical'=>$meta_canonical]);
    }
    // Cấu hình gửi mail
    public function send_mail(){
        $to_name = "Dungpham";
        $to_email = "phamtandung098@gmail.com";
        $data = ['name'=>'Mail từ khách hàng','body'=>'Mail gửi về vấn đề hàng hóa'];
        Mail::send('sendmail', $data, function ($message) use ($to_name,$to_email) {
            $message->to($to_email);
            $message->from($to_email,$to_name);
            $message->subject('Test thử gửi mail google');
        });
    }
    public function carousel(){
        $slider = Slider::all();
        return view('pages.carousel',['slider'=>$slider]);
    }
   
}
