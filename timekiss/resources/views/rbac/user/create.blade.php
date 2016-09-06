@extends('layouts.admin')
@section('content')
<div class="col-md-10">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">用户添加</h3>
        </div>
        <form role="form" method="POST" action="{{ route('user.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label>*用户名</label>
                    <input type="text" required="required" class="form-control" name="name" value="{{ old('name') }}" placeholder="请输入用户名">
                </div>
                <div class="form-group">
                    <label>*用户email</label>
                    <input type="email" required="required" class="form-control" name="email" value="{{ old('email') }}" placeholder="请输入用户邮箱">
                </div>
                <div class="form-group">
                    <label>密码*</label>
                    <input type="password" name="password" placeholder="请输入密码" class="form-control input-sm" required="required" />

                </div>
                <div class="form-group">
                    <label>确认密码*</label>
                    <input type="password" name="password_confirmation" placeholder="确认密码" class="form-control input-sm"/>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
</div>
@endsection
