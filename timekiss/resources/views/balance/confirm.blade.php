@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    {!! Breadcrumbs::render('balance_confirm') !!}
@endsection
@section('content')
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <tr class="table-color">
                        <th>编号</th>
                        <th>民宿</th>
                        <th>总款金额</th>
                        <th>佣金0%</th>
                        <th>结款金额</th>
                        <th>操作</th>
                    </tr>
                    <tr>
                        <th><input type="checkbox">268</th>
                        <th>山水谈</th>
                        <th>168364.00</th>
                        <th>0.00</th>
                        <th>168364.00</th>
                        <th><a href="javascript:;">结算</a></th>
                    </tr>
                    <tr>
                        <th><input type="checkbox">268</th>
                        <th>山水谈</th>
                        <th>168364.00</th>
                        <th>0.00</th>
                        <th>168364.00</th>
                        <th><a href="javascript:;">结算</a></th>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        });
    </script>
@endsection