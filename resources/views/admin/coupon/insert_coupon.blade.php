@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mã giảm giá
                </header>
               
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('coupon.insert')}}" method="POST">
                        @csrf
                        @if (session()->has('massage'))
                            <div class="alert alert-success">
                                {{session()->get('massage')}}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giám giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá</label>
                            <textarea type="password" rows="5" name="coupon_code" class="form-control" id="exampleInputPassword1" > </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                            <input type="number" rows="5" name="coupon_times" class="form-control" id="exampleInputPassword1"> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng mã</label>
                            <select class="form-control" name="coupon_number" id="">
                                <option value="0">Chọn</option>
                                <option value="1">Giảm theo %</option>
                                <option value="2">Giảm theo tiền</option>
           
                              </select>                         </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                            <input type="number"  name="coupon_codition" class="form-control"  >
                        </div>
                        
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm mã giảm giá</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
    
@endsection