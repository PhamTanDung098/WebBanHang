<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Brand;
use App\Models\Category_Product;
use App\Models\Product;

class BrandController extends Controller
{
    public function addBrand(){
        return view('brand.add_brand');
    }
    public function saveBrand(Request $req){
        $brand = new Brand;
        $brand->brand_name = $req->brand_name;
        $brand->brand_desc = $req->brand_desc;
        $brand->brand_status = $req->brand_status;
        $brand->save();
        Session::put('message','Thêm danh mục thành công');
        return \redirect()->route('brand.add');
    }
    public function allBrand(){
        $brand = Brand::all();
        return view('brand.all_brand',['brands'=>$brand]);
    }
    public function brand_actice($id){
        $brand = Brand::find($id);
        if($brand ->brand_status == 0)
        {
            $brand->brand_status =1;
            Session::put('message','Kích hoạt thương hiệu thành công');
        }
        else
        {
            $brand->brand_status =0;
            Session::put('message','Đã tắt kích hoạt thương hiệu sản phẩm');
        }
        $brand ->save();
        return \redirect()->route('brand.all');
    }
    public function edit_brand($id){
        $brand = Brand::find($id);
        return view('brand.edit',['brands'=>$brand]);
    }
    public function update_brand(Request $req,$id){
        $brand = Brand::find($id);
        $brand->update($req->all());
        $brand->save();
        return \redirect()->route('brand.all');
    }
    public function delete_brand($id){
        $brand = Brand::find($id);
        $brand ->delete();
        Session::put('message','Xóa thành công');
        return \redirect()->route('brand.all');
    }
    // End Brand
    public function showBrand($id){
        $product = DB::table('tbl_products')
        ->join('tbl__brand','tbl_products.brand_id','=','tbl__brand.id')
       ->where('tbl_products.brand_id',$id)->select('tbl_products.*','tbl__brand.brand_name')->get();
       $cate = Category_Product::where('category_status','1')->orderby('id','desc')->get();
        $brand = Brand::where('brand_status','=','1')->get();
       return view('pages.category.show_brand',['product'=>$product,'cate'=>$cate,'brand'=>$brand]);
    }
}
