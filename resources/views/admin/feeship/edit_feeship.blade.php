@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm phí vận chuyển cho các tỉnh thành
                </header>
               
                <div class="panel-body">
                    @if (session()->has('massage'))
                        <div class="alert alert-success">
                            {{session()->get('massage')}}
                        </div>
                     @endif
                    <div class="position-center">
                        <form action="{{route('feeship.update',$feeship->fee_id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Tỉnh/Thành phố</label>
                                <select class="city form-control" name="matp" >
                                    @foreach ($city as $item)
                                        <option value="{{$item->matp}}">{{$item->name_city}}</option>
                                    @endforeach
                                </select>                         
                            </div>
                            <div class="form-group">
                                <label for="">Quận huyện</label>
                                <select class="province form-control" name="maqh" >
                                </select>                         
                            </div>
                            <div class="form-group">
                                <label for="">Thị xã, thôn</label>
                                <select class="wards form-control" name="maxa" >
                                </select>                         
                            </div>
                            <div class="form-group">
                            <label for="">Phí ship</label>
                            <input type="text" name="feeship" class="form-control">
                            </div>
                            <input type="submit" value="Chỉnh sửa" class="btn btn-info">
                        </form>
                    </div>

                </div>
            </section>

    </div>
    <script type="text/javascript">
    //find Province
        $('.city').on('change',function(){         
                var cat_id = $(this).val(); 
                var div = $(this).parent();
                var option = " ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findPrevince')!!}',
                    data:{'id':cat_id},
                    success:function(data){
                        option+= '<option value="0">Quận, huyện</option>';
                        for(var i =0;i<data.length;i++){
                            option +='<option value="'+data[i].maqh+'">'+data[i].name_quanhuyen+'</option>';
                        }
                        $('.province').html(" ");
                        $('.province').append(option);
                    },
                    error:function(){
                        console.log('null');
                    }
                });
            });
            //find Wards
        $('.province').on('change',function(){
            var cat_id = $(this).val();
            var option = " ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findWards')!!}',
                data:{'id':cat_id},
                success:function(data){
                    console.log(data);
                    option+= '<option value="0">Xã, thị trấn</option>';
                        for(var i =0;i<data.length;i++){
                            option +='<option value="'+data[i].xaid+'">'+data[i].name_xa+'</option>';
                        }
                        console.log(option);
                        $('.wards').html(" ");
                        $('.wards').append(option);
                }
            });
        });
        
    </script>
    {{-- <script type="text/javascript">
         function fetch_delivery(){
            fetch_delivery();
            var _token = $('input[name="_token"]').val();
            $.ajax(
                type:'get',
                url:'{!!URL::to('select-delivery')!!}',
                
                data:{_token:_token}
                success:function(data){
                    console.log(data);
                    $(#load_delivery).html(data);
                }
            });
    }
    </script> --}}
</div>
    
@endsection