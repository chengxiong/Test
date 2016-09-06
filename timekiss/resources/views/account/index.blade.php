@extends('layouts.admin')
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    {!! Breadcrumbs::render('hostel_landlord') !!}
@endsection
@section('content')
<p>
    <a href="{{ route('account.create') }}"><button type="submit" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加账号</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>姓名</th>
                        <th>电话</th>
                        <th>uuid</th>
                        <th>注册时间</th>
                        <th>上次登录时间</th>
                        <th>生日</th>
                        <th>星座</th>
                        <th>职业</th>
                        <th>邮箱</th>
                        <th>头像</th>
                        <th>性别</th>
                        <th>操作</th>
                    </tr>
                    @foreach($account_list as $account)
                    <tr>
                        <td>{{ $account->username }}</td>
                        <td>{{ $account->telephone }}</td>
                        <td>{{ $account->uuid }}</td>
                        <td>{{ $account->registerTime }}</td>
                        <td>{{ $account->lastLoginTime }}</td>
                        <td>{{ $account->birthday }}</td>
                        <td>{{ $account->starSigns }}</td>
                        <td>{{ $account->profession }}</td>
                        <td>{{ $account->email }}</td>
                        <td><img style="width:100px" src="{{ $account->avatar }}"/></td>                        
                        <td>
                            @if($account->gender == 1)
                                男
                            @else
                                女
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('account.edit',$account->accountId) }}">编辑</a> <a href="{{ route('account.status',$account->accountId) }}" data-toggle="modal" data-target="#myModal">账号状态</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! $account_list->render() !!}
        </div>
    </div>
</div>
@endsection

