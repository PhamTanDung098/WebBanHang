<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_Product;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Slider;
use Session;
use DB;

class CategoryProduct extends Controller
{
    public function add_categoryproduct(){
        return view('admin.add_categoryproduct');
    }
    public function all_categoryproduct(){
        $Category_Product = Category_Product::all();
        return view('admin.all_category_product',['Category_Product'=>$Category_Product]);
    }
    public function save_categoryproduct(Request $req){
        $Category_Product = new Category_Product;
        $Category_Product->category_name = $req->category_product_name;
        $Category_Product->category_desc = $req->category_product_desc;
        $Category_Product->category_status = $req->category_product_status;
        $Category_Product->save();
        Session::put('message','Thêm thành công');
        return \redirect()->route('categoryproduct.add');

    }
    public function active_categoryproduct($id){
        $cate = Category_Product::find($id);
        if($cate ->category_status == 0)
        {
            $cate->category_status =1;
            Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        }
        else
        {
            $cate->category_status =0;
            Session::put('message','Đã tắt kích hoạt danh mục sản phẩm');
        }
        $cate ->save();
        return \redirect()->route('categoryproduct.all');
    }
    public function update_categoryproduct($id, Request $req){
        $cate = Category_Product::find($id);
        $cate ->update($req->all());
        $cate->save();

        Session::put('message','Update Thanh cong');

        return \redirect()->route('categoryproduct.all');
    }
    public function edit_categoryproduct($id){
        $cate = Category_Product::find($id);
        return view('admin.edit_category_product',['cate'=>$cate]);
    }
    public function delete_categoryproduct($id){
        $cate = Category_Product::find($id);
        $cate ->delete();
        Session::put('message','Xóa thành công');
        return \redirect()->route('categoryproduct.all');
    }
    // End function admin page
    public function showCategoryHome($id,Request $req){
        $meta_canonical = $req->url();
        $slider = Slider::all();
        $product = DB::table('tbl_products')
        ->join('tbl_category_product','tbl_products.category_id','=','tbl_category_product.id')
        ->where('tbl_products.category_id',$id)->select('tbl_products.*')->get();
        $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
        return view('pages.category.show_category',['cate'=>$cate,'product'=>$product,'brand'=>$brand,'meta_canonical'=>$meta_canonical,'slider'=>$slider]);
    }

}
