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
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">基本信息</a></li>
            <li><a href="{{ route('hostel.content',$bnb->bid) }}">添加内容</a></li>
            <li><a href="{{ route('hostel.image',$bnb->bid) }}">上传图片</a></li>
            <li><a href="{{ route('hostel.service',$bnb->bid) }}">服务</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="info_form clearfix">
                    <form class="" action="{{ route('hostel.updateContent',$bnb->bid) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <ul>
                            <li><span>民宿名字：</span><input type="text" name='name' value="{{ $bnb->name }}" class="form-control"></li>
                            <li><span>标题：</span><input type="text" name='title' value="{{ $bnb->title }}" class="form-control"></li>
                            <li><span>副标题1：</span><input type="text" name='subTitle1' value="{{ $bnb->subTitle1 }}" class="form-control"></li>
                            <li><span>副标题2：</span><input type="text" name='subTitle2' value="{{ $bnb->subTitle2 }}" class="form-control"></li>
                            <li><span>民宿设计师：</span><input type="text" name='author' value="{{ $bnb->author }}" class="form-control"></li>
                            <li><span>地址：</span><input type="text" name='address' value="{{ $bnb->address }}" class="form-control"></li>
                            <li><span>经度：</span><input type="text" name='lng' value="{{ $bnb->lng }}" class="form-control"></li>
                            <li><span>纬度：</span><input type="text" name='lat' value="{{ $bnb->lat }}" class="form-control"></li>
                            <li><span>联系电话：</span><input type="text" name='phone' value="{{ $bnb->phone }}" class="form-control"></li>
                            <li><span>民宿状态：</span>
                                <select class="form-control" name="status">
                                    @if($bnb->status == 2)
                                    <option value ="0">联络中</option>
                                    <option value="1">未上架</option>
                                    <option value="2" selected="selected">已上架</option>
                                    @elseif($bnb->status == 1)
                                    <option value ="0">联络中</option>
                                    <option value="1" selected="selected">未上架</option>
                                    <option value="2">已上架</option>
                                    @else
                                    <option value ="0" selected="selected">联络中</option>
                                    <option value="1">未上架</option>
                                    <option value="2">已上架</option>
                                    @endif
                                </select>
                            </li>
                            <li><span>颜值：</span><input type="text" name='score1' value="{{ $bnb->score1 }}" class="form-control"></li>
                            <li><span>X值：</span><input type="text" name='score2' value="{{ $bnb->score2 }}" class="form-control"></li>
                            <li><span>睡值：</span><input type="text" name='score3' value="{{ $bnb->score3 }}" class="form-control"></li>
                            <li><span>点击数：</span><input type="number" name='clickNum' value="{{ $bnb->clickNum }}" class="form-control"></li>
                            <li><span>收藏数：</span><input type="number" name='likeNum' value="{{ $bnb->likeNum }}" class="form-control"></li>
                            <li><span>联络情况：</span><input type="text" name='contactStatus' value="{{ $bnb->contactStatus }}" class="form-control"></li>
                            <li><span>网址：</span><input type="url" name='website' value="{{ $bnb->website }}" class="form-control"></li>
                            <li><span>建筑时间：</span><input type="datetime" name='buildDate' value="{{ $bnb->buildDate }}" class="form-control"></li>
                            <li><span>房间数：</span><input type="number" name='totalRoom' value="{{ $bnb->totalRoom }}" class="form-control"></li>
                            <li><span>等级：</span><input type="text" name='level' value="{{ $bnb->level }}" class="form-control"></li>
                            <li><span>房东说：</span><input type="text" name='hosterSay' value="{{ $bnb->hosterSay }}" class="form-control"></li>
                            <li><span>国家：</span><input type="text" name='country' value="{{ $bnb->country }}" class="form-control"></li>
                            <li><span>省份：</span><input type="text" name='province' value="{{ $bnb->province }}" class="form-control"></li>
                            <li><span>城市：</span><input type="text" name='city' value="{{ $bnb->city }}" class="form-control"></li>
                            <li><span>区域：</span><input type="text" name='region' value="{{ $bnb->region }}" class="form-control"></li>                    </ul>
                        <button type="submit" class="btn btn-success btn-flat">保存 & 下一步</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
</div>
@endsection

