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
            <form class="" action="{{ route('landlord.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul>
                    <li><span>姓名：</span><input type="text" name='name' value="{{ old('name') }}" class="form-control"></li>
                    <li><span>性别：</span>
                        <select class="form-control" name="gender">
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </li>  
                    <li><span>电话：</span><input type="text" name='telephone' required="required" value="{{ old('telephone') }}" class="form-control"></li>
                    <li><span>微信：</span><input type="text" name='weixin' required="required" value="{{ old('weixin') }}" class="form-control"></li>
                    <li><span>年龄：</span><input type="number" name='age' required="required" value="{{ old('age') }}" class="form-control"></li>
                    <li><span>婚姻状况：</span><input type="text" name='maritalStatus' required="required" value="{{ old('maritalStatus') }}" class="form-control"></li>
                    <li><span>特征：</span><input type="text" name='feature' required="required" value="{{ old('feature') }}" class="form-control"></li>
                    <li><span>头像：</span><input type="file" required="required" name="file" class="form-control"></li>
                    <li><span>描述：</span><input type="text" name='description' required="required" value="{{ old('description') }}" class="form-control"></li>             
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection