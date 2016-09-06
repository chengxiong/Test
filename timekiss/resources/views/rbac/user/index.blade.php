@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    {!! Breadcrumbs::render('user_list') !!}
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="col-sm-6">
                    <h3 class="box-title">用户列表</h3>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_filter" id="example1_filter">
                        <a href="{{ route('user.create') }}" class="btn bg-olive">添加用户</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="role">
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">用户名</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">用户邮箱</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_list as $user)
                                    <tr role="row" class="odd">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->id >= 2)
                                            <a href="{{ route('user.edit',$user->id) }}">编辑</a>
                                            <a href="{{ route('user.role',$user->id) }}">角色</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {!! $user_list->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection