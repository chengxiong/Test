@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    {!! Breadcrumbs::render('order_confirm') !!}
@endsection
@section('content')
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <tr class="table-color">
                        <th>入住时间</th>
                        <th>时间/订单号</th>
                        <th>地点</th>
                        <th>民宿</th>
                        <th>房型</th>
                        <th>房价*晚*间</th>
                        <th>总价</th>
                        <th>预定人</th>
                        <th>操作</th>
                        <th>赔付</th>
                        <th>手续费</th>
                        <th>最终金额</th>
                        <th>操作人</th>
                    </tr>
                    <tr>
                        <th class="cont_show">2016/10/01<br />2016/10/02</th>
                        <th class="cont_show">20160708&emsp;12:30<br />000001</th>
                        <th class="cont_show">杭州</th>
                        <th class="cont_show">山水谈</th>
                        <th class="cont_show">雪景高级房</th>
                        <th class="cont_show">1500.00*3*1</th>
                        <th class="cont_show">4500.00</th>
                        <th class="cont_show">Andy</th>
                        <th><a href="javascript:;">已确认</a>&emsp;<a href="{{ route('order.cancelShow','1') }}" data-toggle="modal" data-target="#myModal">取消订单</a></th>
                        <th class="cont_show">1000.00</th>
                        <th class="cont_show">1000.00<br />状态：20160708&emsp;12:30</th>
                        <th class="cont_show">3500.00<br />&emsp;状态</th>
                        <th class="cont_show">房东</th>
                    </tr>
                    <tr class="cont_list">
                        <td colspan="3">支付方式：微信支付/支付宝支付<br />交易单号：234334cere33f2</td>
                        <td colspan="3">预定人：Andy&emsp;&emsp;电话：18274752249<br>民宿方：Andy&emsp;&emsp;电话：18274752249</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>2016/10/01<br />2016/10/02</th>
                        <th>20160708&emsp;12:30<br />000001</th>
                        <th>杭州</th>
                        <th>山水谈</th>
                        <th>雪景高级房</th>
                        <th>1500.00*3*1</th>
                        <th>4500.00</th>
                        <th>Andy</th>
                        <th class="return-list"><a href="javascript:;">已确认</a>&emsp;<a href="javascript:;">取消订单</a></th>
                        <th>1000.00&emsp;状态<br />20160708&emsp;12:30</th>
                        <th>1000.00&emsp;状态</th>
                        <th>3500.00&emsp;状态</th>
                        <th>房东</th>
                    </tr>
                    <tr class="cont_list">
                        <td colspan="3">支付方式：微信支付/支付宝支付<br />交易单号：234334cere33f2</td>
                        <td colspan="3">预定人：Andy&emsp;&emsp;电话：18274752249<br>民宿方：Andy&emsp;&emsp;电话：18274752249</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>2016/10/01<br />2016/10/02</th>
                        <th>20160708&emsp;12:30<br />000001</th>
                        <th>杭州</th>
                        <th>山水谈</th>
                        <th>雪景高级房</th>
                        <th>1500.00*3*1</th>
                        <th>4500.00</th>
                        <th>Andy</th>
                        <th class="return-list"><a href="javascript:;">已确认</a>&emsp;<a href="javascript:;">取消订单</a></th>
                        <th>1000.00&emsp;状态<br />20160708&emsp;12:30</th>
                        <th>1000.00&emsp;状态</th>
                        <th>3500.00&emsp;状态</th>
                        <th>房东</th>
                    </tr>
                    <tr class="cont_list">
                        <td colspan="3">支付方式：微信支付/支付宝支付<br />交易单号：234334cere33f2</td>
                        <td colspan="3">预定人：Andy&emsp;&emsp;电话：18274752249<br>民宿方：Andy&emsp;&emsp;电话：18274752249</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>2016/10/01<br />2016/10/02</th>
                        <th>20160708&emsp;12:30<br />000001</th>
                        <th>杭州</th>
                        <th>山水谈</th>
                        <th>雪景高级房</th>
                        <th>1500.00*3*1</th>
                        <th>4500.00</th>
                        <th>Andy</th>
                        <th class="return-list"><a href="javascript:;">已确认</a>&emsp;<a href="javascript:;">取消订单</a></th>
                        <th>1000.00&emsp;状态<br />20160708&emsp;12:30</th>
                        <th>1000.00&emsp;状态</th>
                        <th>3500.00&emsp;状态</th>
                        <th>房东</th>
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
    <script src="{{ asset('js/table.js') }}"></script>
@endsection