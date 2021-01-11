<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Session;

class BannerController extends Controller
{
    public function delivery(){
       
    }
    public function add_banner(){
        return view('admin.slider.add_banner');
    }
    public function save_banner(Request $req){

        $slider = new Slider;
        $slider->slide_name = $req->slider_name;
        $slider->slider_status = $req->slider_status;
        $slider->slider_desc = $req->slider_desc;
        $get_image =$req ->file('slider_image');
        if($get_image){
            $name = $get_image->getClientOriginalName();
            $name_current = current(explode('.',$name));
            $new_image =$name_current.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/products',$new_image);
            $slider->slider_image = $new_image;
            $slider->save();
            Session::put('message','Thêm thành công');
            return \redirect()->route('banner.add');
        }
        $slider->slider_image = ' ';
        $slider->save();
        Session::put('message','Thêm thành công');
        return \redirect()->route('product.add');
    }
    public function list_banner(){
        $slider = Slider::all();
        return view('admin.slider.list_slider',['slider'=>$slider]);
    }
    public function banner_status($id){
        $slider = Slider::find($id);
        if($slider->slider_status == 0){
            $slider->slider_status =1;
            $slider->save();
            Session::put('massage','Đã kích hoạt hiển thị Slider');
        }
        else
        {
            $slider->slider_status =0;
            $slider->save();
            Session::put('massage','Đã tắt kích hoạt hiển thị Slider');
        }
        return \redirect()->route('banner.list');
    }

}
