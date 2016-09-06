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
            <form class="" action="{{ route('landlord.update',$hoster->hid) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <ul>
                    <li><span>姓名：</span><input type="text" name='name' value="{{ $hoster->name }}" class="form-control"></li>
                    <li><span>性别：</span>
                        <select class="form-control" name="gender">
                            @if($hoster->gender == 1)
                            <option value="1" selected="selected">男</option>
                            <option value="2">女</option>
                            @else
                            <option value="1">男</option>
                            <option value="2" selected="selected">女</option>
                            @endif
                        </select>
                    </li>  
                    <li><span>电话：</span><input type="text" name='telephone' required="required" value="{{ $hoster->telephone }}" class="form-control"></li>
                    <li><span>微信：</span><input type="text" name='weixin' required="required" value="{{ $hoster->weixin }}" class="form-control"></li>
                    <li><span>年龄：</span><input type="number" name='age' required="required" value="{{ $hoster->age }}" class="form-control"></li>
                    <li><span>婚姻状况：</span><input type="text" name='maritalStatus' required="required" value="{{ $hoster->maritalStatus }}" class="form-control"></li>
                    <li><span>特征：</span><input type="text" name='feature' required="required" value="{{ $hoster->feature }}" class="form-control"></li>
                    <li><span>头像：</span><img src="{{ $hoster->image }}"></li>
                    <li><span>修改头像：</span><input type="file" name="file" class="form-control"></li>
                    <li><span>描述：</span><input type="text" name='description' required="required" value="{{ $hoster->description }}" class="form-control"></li>             
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection