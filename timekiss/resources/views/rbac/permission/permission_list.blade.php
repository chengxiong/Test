@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    {!! Breadcrumbs::render('permission_list') !!}
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="col-sm-6">
                    <h3 class="box-title">权限列表</h3>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_filter" id="example1_filter">
                        <form action="{{ route('permission.store') }}" method="post" class="form-horizontal " enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="submit" class="btn bg-olive" value="重新构建权限" />
                        </form>
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
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">名字</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">描述</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permission_list as $permission)
                                    <tr class="odd">
                                        <td>{{ $permission->id }}</td>
                                        <td>
                                            {{ $permission->display_name }}
                                        </td>
                                        <td>
                                            {{ $permission->description }}
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
                                {!! $permission_list->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection