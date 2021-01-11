<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller
{
    public function list_feeship(){
        $feeship = Feeship::all();
        return view('admin.feeship.list_feeship',['feeship'=>$feeship]);
    }
    public function add_feeship(){
        $city = City::all();
        return view('admin.feeship.add_feeship',['city'=>$city]);
    }
    public function findPrevince(Request $req){
        $d = $req->id;
        $data = Province::select('maqh','name_quanhuyen')->where('matp','=',$d)->get();
        return \response()->json($data);

    }
    public function findWards(Request $req){
        $d = $req->id;
        $data = Wards::select('xaid','name_xa')->where('maqh','=',$d)->get();
        return \response()->json($data);
    }
    public function insert_feeship(Request $req){
        $feeship = new Feeship;
        $feeship->matp = $req->matp;
        $feeship->maqh =$req->maqh;
        $feeship->maxp = $req->maxa;
        $feeship->feeship = $req->feeship;
        $feeship->save();
        return \redirect()->route('feeship.add')->with('massage','Thêm thông tin thành công');
    }
    public function edit_feeship($id){
        $feeship = Feeship::find($id);
        $city = City::all();
        return view('admin.feeship.edit_feeship',['feeship'=>$feeship,'city'=>$city]);
    }
    public function update_feeship($fee_id,Request $req){
        $feeship = Feeship::find($fee_id);
        $feeship ->matp = $req->matp;
        $feeship ->maqh = $req->maqh;
        $feeship ->maxp =$req->maxa;
        $feeship ->feeship = $req->feeship;
        $feeship->save();
        return \redirect()->route('feeship.list')->with('massage','Sửa thành công');
    }
    public function delete_feeship($id){
        $feeship = Feeship::find($id);
        $feeship->delete();
        return \redirect()->route('feeship.list')->with('massage','Xóa thành công');
    }
    // public function select_delivery(){
    //     $feeship = Feeship::orderBy('fee_id','DESC')->get();
    //     $output ='';
    //     $output.="<div class='table-responsize'>
    //         <table class='table table-bordered'>
    //             <thread>
    //                 <tr>
    //                     <th>Tên thành phố</th>
    //                     <th>Tên quận huyện</th>
    //                     <th>Tên xã phường</th>
    //                     <th>Phí ship</th>
    //                 </tr>
    //             </thread>
    //             <tbody>
    //             ";
    //     foreach($feeship as $value){
    //         $output.='
    //                 <tr>
    //                     <td>'.$value->city->name_city.'</td>
    //                     <td>'.$value->province->name_quanhuyen.'</td>
    //                     <td>'.$value->wards->name_xa.'</td>
    //                     <td contenteditable data-feeship_id="'.$value->fee_id.'">'.number_format($value->feeship).'</td>

    //                </tr>       
    //     ';
    //     }
    //     $output.='
    //         </tbody>
    //         </table></div>
        
    //     ';
    //     dd($output);
    //     echo $output;
        
                    
       
    // }
}
