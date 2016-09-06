@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/tab.css') }}">
@endsection
@section('content-header')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
{!! Breadcrumbs::render('hostel_create') !!}
@endsection
@section('content')
<div class="col-md-12">
    <div class="tab-pane active" id="tab_1">
        <div class="info_form clearfix">
            <form class="" action="{{ route('hostel.layoutUpdate',$layout->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <ul>
                    <li><span>房型名：</span><input type="text" name='name' value="{{ $layout->name }}" class="form-control"></li>
                    <li><span>房间简介：</span><input type="text" name='introduction' value="{{ $layout->introduction }}" class="form-control"></li>              
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection