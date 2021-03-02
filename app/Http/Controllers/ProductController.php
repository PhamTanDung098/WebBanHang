<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category_Product;
use App\Models\Brand;
use App\Models\Slider;
use Session;
use DB;

class ProductController extends Controller
{
    public function add_product(){
        $cate = Category_Product::all();
        $brand = Brand::all();
        return view('products.add_product',['cate'=>$cate,'brand'=>$brand]);
    }
    public function all_product(){
        
        $product = Product::all();
        $slider = Slider::all();
        return view('products.all_product',['product'=>$product,'slider'=>$slider]);
    }
    public function save_product(Request $req){
        $products = new Product;
        $products->category_id = $req->category_id;
        $products->brand_id = $req->brand_id;
        $products->product_name= $req->product_name;
        $products->product_status = $req->product_status;
        $products->product_desc = $req->product_desc;
        $products->product_price = $req->product_price;
        $products->product_content = $req->product_content;
        $products->product_size = $req->product_size;
        $products->product_color = $req->product_color;
        $products->product_quatity = $req->product_quantity;
        $get_image =$req ->file('product_image');
        if($get_image){
            $name = $get_image->getClientOriginalName();
            $name_current = current(explode('.',$name));
            $new_image =$name_current.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/products',$new_image);
            $products->product_image = $new_image;
            $products->save();
            Session::put('message','Thêm thành công');
            return \redirect()->route('product.add');
        }
        $products->product_image = ' ';
        $products->save();
        Session::put('message','Thêm thành công');
        return \redirect()->route('product.add');
    }
    public function product_actice($id){
        $cate = Product::find($id);
        if($cate ->product_status == 0)
        {
            $cate->product_status =1;
            Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        }
        else
        {
            $cate->product_status =0;
            Session::put('message','Đã tắt kích hoạt danh mục sản phẩm');
        }
        $cate ->save();
        
        return \redirect()->route('product.all');
    }
    public function product_update($id, Request $req){
        $cate = Product::find($id);
        $cate ->update($req->all());
        $cate->save();
        Session::put('message','Update Thanh cong');
        return \redirect()->route('product.all');
    }
    public function product_edit($id){
        $cate = Category_Product::all();
        $brand = Brand::all();
        $product = Product::find($id);
        return view('products.edit_product',['product'=>$product,'cate'=>$cate,'brand'=>$brand]);
    }
    public function product_delete($id){
        $cate = Product::find($id);
        $cate ->delete();
        Session::put('message','Xóa thành công');
        return \redirect()->route('product.all');
    }
    public function chitietsanpham($id,Request $req){
        $meta_desc = "Chuyên bán điện thoại giá rẻ Chuyên bán điện thoại giá rẻ Chuyên bán điện thoại giá rẻ";     
        $meta_keywords = "Điện thoại phụ kiện giá rẻ";
        $meta_title = "Search E-Shop";
        $slider = Slider::all();
        $meta_canonical = $req->url();
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        $product_detail = DB::table('tbl_products')
        ->join('tbl_category_product','tbl_products.category_id','=','tbl_category_product.id')
        ->join('tbl__brand','tbl_products.brand_id','=','tbl__brand.id')
        ->where('tbl_products.id',$id)->select('tbl_products.*','tbl_products.id as product_id','tbl__brand.brand_name','tbl_category_product.*')->get();
        // dd($product_detail);
        foreach ($product_detail as $detail) {
            $category_id = $detail->category_id;
        }
        // dd($category_id);
        $relate_product = DB::table('tbl_products')
        ->join('tbl_category_product','tbl_products.category_id','=','tbl_category_product.id')
        ->join('tbl__brand','tbl_products.brand_id','=','tbl__brand.id')
        ->where('tbl_category_product.id',$category_id)->whereNotIn('tbl_products.id',[$id])->select('tbl_products.*','tbl__brand.brand_name','tbl_category_product.*')->get();
        // dd($relate_product);
        return view('products.chitiet',['product_detail'=>$product_detail,'cate'=>$cate,'brand'=>$brand,'relate_product'=>$relate_product
        ,'meta_desc'=>$meta_desc,
        'meta_keywords'=>$meta_keywords,'meta_title'=>$meta_title,'meta_canonical'=>$meta_canonical,'slider'=>$slider]);
    }
    // findDanhmuc ajax
    public function findProductName(Request $req){
        $data = Category_Product::select('category_name','id')->where('brand_id',$req->id)->get();
        return \response()->json($data);
    }
}
