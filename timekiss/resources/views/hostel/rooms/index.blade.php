@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/bnb.css') }}">
@endsection
@section('content-header')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
{!! Breadcrumbs::render('hostel_list') !!}
@endsection
@section('content')
<p>
    <a href="{{ route('rooms.create',$layout->id) }}"><button type="button" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加房间</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>房间名</th>
                        <th>价格</th>
                        <th>入住人数</th>
                        <th>面积</th>
                        <th>床型</th>
                        <th>床宽</th>
                        <th>是否包房</th>
                        <th>是否上架</th>
                        <th>操作</th>
                    </tr>
                    @foreach($room_list as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->number }}</td>
                        <td>{{ $room->size }}</td>
                        <td>{{ $room->bed_type }}</td>
                        <td>{{ $room->bed_width }}</td>
                        <td>
                            @if($room->tkOwned)
                                包房
                            @else
                                不包
                            @endif
                        </td>
                        <td>
                            @if($room->status)
                                上架
                            @else
                                下架
                            @endif
                        </td>
                        <td><a href="{{ route('rooms.status',$room->id) }}"  data-toggle="modal" data-target="#myModal">上/下架</a>  <a href="{{ route('rooms.price',$room->id) }}">包房价格</a>  <a href="{{ route('rooms.edit',$room->id) }}">编辑</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! $room_list->render() !!}
        </div>
    </div>
</div>
@endsection

