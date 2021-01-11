<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;

class CouponController extends Controller
{
    public function add_coupon(){
        return view('admin.coupon.insert_coupon');
    }
    public function insert_coupon(Request $req){
        $data = $req->all();
        $coupon = new Coupon;
        $coupon ->coupon_name = $req ->coupon_name;
        $coupon ->coupon_code = $req ->coupon_code;
        $coupon ->coupon_times = $req ->coupon_times;
        $coupon ->coupon_number = $req ->coupon_number;
        $coupon ->coupon_codition = $req ->coupon_codition;
        $coupon->save();
        Session::put('massage','Thêm mã giảm giá thành công');
        return \redirect()->route('coupon.add');
    }
    public function list_coupon(){
        $coupon = Coupon::all();
        return view('admin.coupon.list_coupon',['coupon'=>$coupon]);
    }
    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('massage','Xóa thành công');
        return \redirect()->route('coupon.list');
    }
}
