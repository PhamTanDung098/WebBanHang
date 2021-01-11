@extends('admin_layout')
@section('content')
    <table class="table table-striped b-t b-light">
        <thead class="">
            <tr>
                <th>STT</th>
                <th>Mã Thành phố</th>
                <th>Mã Quận huyện</th>
                <th>Mã Thị xã</th>
                <th>Phí ship</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $index =1;
                @endphp
                @foreach ($feeship as $item)
                    <tr>
                        <td >{{$index++}}</td>
                        <td>{{$item->city->name_city}}</td>
                        <td>{{$item->province->name_quanhuyen}}</td>
                        <td>{{$item->wards->name_xa}}</td>
                        <td>{{$item->feeship}}</td>
                        <td>
                            <a href="{{route('feeship.edit',$item->fee_id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('feeship.delete',$item->fee_id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
    </table>
@endsection