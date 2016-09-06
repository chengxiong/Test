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
            <form action="{{ route('account.update',$account->accountId) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <ul>
                    <li><span>用户名：</span><input type="text" required="required" name='username' value="{{ $account->username }}" class="form-control"></li>
                    <li><span>密码：</span><input type="password" name='password' value="{{ old('password') }}" class="form-control"></li>
                    <li><span>确认密码：</span><input type="password" name='password_confirmation' value="{{ old('password_confirmation') }}" class="form-control"></li> 
                    <li><span>电话：</span><input type="text" name='telephone' required="required" value="{{ $account->telephone }}" class="form-control"></li>
                    <li><span>生日：</span><input type="date" name='birthday' required="required" value="{{ $account->birthday }}" class="form-control"></li>
                    <li><span>星座：</span><input type="text" name='starSigns' required="required" value="{{ $account->starSigns }}" class="form-control"></li>
                    <li><span>职业：</span><input type="text" name='profession' required="required" value="{{ $account->profession }}" class="form-control"></li>
                    <li><span>email：</span><input type="email" name='email' required="required" value="{{ $account->email }}" class="form-control"></li>
                    <li><span>头像：</span><img src="{{ $account->avatar }}"></li>
                    <li><span>修改头像：</span><input type="file" name="file" class="form-control"></li>
                    <li><span>性别：</span>
                        <select class="form-control" name="gender">
                            @if($account->gender == 1)
                            <option value="1" selected="selected">男</option>
                            <option value="2">女</option>
                            @else
                            <option value="1">男</option>
                            <option value="2" selected="selected">女</option>
                            @endif
                        </select>
                    </li> 
                    <li><span>个性签名：</span><input type="text" name='slogan' required="required" value="{{ $account->slogan }}" class="form-control"></li>             
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection