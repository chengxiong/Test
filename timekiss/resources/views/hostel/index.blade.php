@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/bnb.css') }}">
@endsection
@section('content-header')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
{!! Breadcrumbs::render('hostel_list') !!}
@endsection
@section('content')
<div class="box-body">
    <form action="{{ route('hostel.search') }}" method="get">
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="orderId" class="form-control" placeholder="订单号查询">
            </div>
            <div class="col-xs-3">
                <input type="text" name="bookingPerson" class="form-control" placeholder="预定人查询">
            </div>
            <div class="col-xs-3">
                <input type="text" name="bnbName" class="form-control" value="{{ $bnb_name }}" placeholder="民宿查询">
            </div>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary btn-flat">搜索</button>
            </span>
        </div>
    </form>
</div>
<p>
    <a href="{{ route('hostel.implode') }}" style="float:left; margin-left:20px;" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">导入</a>
    <a href="{{ route('hostel.create') }}"><button type="submit" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加民宿</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>联络情况</th>
                        <th>城市</th>
                        <th>区域</th>
                        <th>民宿名称</th>
                        <th>网址</th>
                        <th>地址</th>
                        <th>网上电话</th>
                        <th>价格区间</th>
                        <th>建筑时间</th>
                        <th>房间数</th>
                        <th>房间价格</th>
                        <th>操作</th>
                    </tr>
                    @foreach($bnb_list as $bnb)
                    <tr>
                        <td class="cont_show">{{ $bnb->contactStatus }}</td>
                        <td class="cont_show">{{ $bnb->province }}-{{ $bnb->city }}</td>
                        <td class="cont_show">{{ $bnb->region }}</td>
                        <td class="cont_show">{{ $bnb->name }}</td>
                        <td class="cont_show">{{ $bnb->website }}</td>
                        <td class="cont_show">{{ $bnb->address }}</td>
                        <td class="cont_show">{{ $bnb->phone }}</td>
                        <td class="cont_show">4500.00元-5000.00元</td>
                        <td class="cont_show">{{ $bnb->buildDate }}</td>
                        <td class="cont_show">{{ $bnb->totalRoom }}</td>
                        <td class="cont_show">4000.00元</td>
                        <!--<td class="return-list"><a href="{{ route('tag.tag',$bnb->bid) }}">TAG</a> <a href="{{ route('bnb.account',$bnb->bid) }}">关联账号</a> <a href="{{ route('hostel.landlordRole',$bnb->bid) }}">房东/管家</a> <a href="{{ route('hostel.layout',$bnb->bid) }}">民宿房型</a> <a href="{{ route('hostel.base',$bnb->bid) }}">编辑</a></td>-->
                        <td class="return-list"><a href="{{ route('tag.tag',$bnb->bid) }}">TAG</a> <a href="{{ route('hostel.layout',$bnb->bid) }}">民宿房型</a> <a href="{{ route('hostel.base',$bnb->bid) }}">编辑</a></td>
                    </tr>
                    <tr class="cont_list" style="display: none;">
                        <td colspan="13" style="padding:0; margin:0;">
                            <table class="table table-bordered">
                                <tbody><tr class="table-color2">
                                        <th>微距离</th>
                                        <th>设施</th>
                                        <th>周边环境</th>
                                        <th>特色项目</th>
                                        <th>附近好的餐厅</th>
                                        <th colspan="4">附近好的咖啡厅</th>
                                    </tr>
                                    <tr>
                                        <th>13KM</th>
                                        <th>高尔夫、私人影院、书房、游泳池</th>
                                        <th>交通便利、出行方便</th>
                                        <th>私人影院、游泳池</th>
                                        <th>XX餐厅、XX餐厅、XX餐厅</th>
                                        <th colspan="4">XX咖啡厅、XX咖啡厅、XX咖啡厅</th>
                                    </tr>
                                    <tr class="table-color2">
                                        <th>主人昵称</th>
                                        <th>电话</th>
                                        <th>微信</th>
                                        <th>性别</th>
                                        <th>照片</th>
                                        <th>年龄</th>
                                        <th>星座</th>
                                        <th>婚否</th>
                                        <th>特征</th>
                                    </tr>
                                    <tr>
                                        <th>张三</th>
                                        <th>18888888888</th>
                                        <th>18888888888</th>
                                        <th>男</th>
                                        <th></th>
                                        <th>38</th>
                                        <th>双子座</th>
                                        <th>未婚</th>
                                        <th>幽默风趣</th>
                                    </tr>
                                    <tr class="table-color2">
                                        <th>管家昵称</th>
                                        <th>电话</th>
                                        <th>微信</th>
                                        <th>性别</th>
                                        <th>照片</th>
                                        <th>年龄</th>
                                        <th>星座</th>
                                        <th>婚否</th>
                                        <th>特征</th>
                                    </tr>
                                    <tr>
                                        <th>张三</th>
                                        <th>18888888888</th>
                                        <th>18888888888</th>
                                        <th>男</th>
                                        <th></th>
                                        <th>38</th>
                                        <th>双子座</th>
                                        <th>未婚</th>
                                        <th>幽默风趣</th>
                                    </tr>
                                </tbody></table>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! $bnb_list->render() !!}
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/table.js') }}"></script>
@endsection