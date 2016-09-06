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
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('hostel.base',$bnb->bid) }}">基本信息</a></li>
            <li><a href="{{ route('hostel.content',$bnb->bid) }}">添加内容</a></li>
            <li><a href="{{ route('hostel.image',$bnb->bid) }}">上传图片</a></li>
            <li class="active"><a href="#tab_4" data-toggle="tab">服务</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_4">
                <div class="info_form clearfix">
                    <form class="" action="{{ route('hostel.storeService',$bnb->bid) }}" method="post">
                        {{ csrf_field() }}
                        <ul>
                            @foreach($service_list as $service)
                            @if(in_array($service->id,$has_service))
                            <li><span>{{ $service->name }}：</span>
                                <input type="checkbox" name="services[]" checked="checked" value="{{ $service->id }}" class="">
                            </li>
                            @else
                            <li><span>{{ $service->name }}：</span>
                                <input type="checkbox" name="services[]" value="{{ $service->id }}" class="">
                            </li>
                            @endif
                            @endforeach                                                         
                        </ul>
                        <button type="submit" class="btn btn-success btn-flat">保存</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
</div>
@endsection


