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
    <a href="{{ route('hostel.layoutCreate',$bnb->bid) }}"><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加房型</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>房型名</th>
                        <th>房型简介</th>
                        <th>操作</th>
                    </tr>
                    @foreach($layout_list as $layout)
                    <tr>
                        <td>{{ $layout->name }}</td>
                        <td>{{ $layout->introduction }}</td>
                        <td><a href="{{ route('rooms.index',$layout->id) }}">房间列表</a> <a href="{{ route('hostel.layoutEdit',$layout->id) }}">编辑</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! $layout_list->render() !!}
        </div>
    </div>
</div>
@endsection

