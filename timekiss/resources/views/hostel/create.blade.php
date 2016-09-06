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
            <li class="disabled"><a href="#tab_2" data-toggle="tab">添加内容</a></li>
            <li class="disabled"><a href="#tab_3" data-toggle="tab">上传图片</a></li>
            <li class="disabled"><a href="#tab_4" data-toggle="tab">服务</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="info_form clearfix">
                    <form class="" action="{{ route('hostel.store') }}" method="post">
                        {{ csrf_field() }}
                        <ul>
                            <li><span>民宿名字：</span><input type="text" name='name' value="{{ old('name') }}" class="form-control"></li>
                            <li><span>标题：</span><input type="text" name='title' value="{{ old('title') }}" class="form-control"></li>
                            <li><span>副标题1：</span><input type="text" name='subTitle1' value="{{ old('subTitle1') }}" class="form-control"></li>
                            <li><span>副标题2：</span><input type="text" name='subTitle2' value="{{ old('subTitle2') }}" class="form-control"></li>
                            <li><span>民宿设计师：</span><input type="text" name='author' value="{{ old('author') }}" class="form-control"></li>
                            <li><span>地址：</span><input type="text" name='address' value="{{ old('address') }}" class="form-control"></li>
                            <li><span>经度：</span><input type="text" name='lng' value="{{ old('lng') }}" class="form-control"></li>
                            <li><span>纬度：</span><input type="text" name='lat' value="{{ old('lat') }}" class="form-control"></li>
                            <li><span>联系电话：</span><input type="text" name='phone' value="{{ old('phone') }}" class="form-control"></li>
                            <li><span>民宿状态：</span>
                                <select class="form-control" name="status">
                                    <option value ="0">联络中</option>
                                    <option value="1">未上架</option>
                                    <option value="2">已上架</option>
                                </select>
                            </li>
                            <li><span>颜值：</span><input type="text" name='score1' value="{{ old('score1') }}" class="form-control"></li>
                            <li><span>X值：</span><input type="text" name='score2' value="{{ old('score2') }}" class="form-control"></li>
                            <li><span>睡值：</span><input type="text" name='score3' value="{{ old('score3') }}" class="form-control"></li>
                            <li><span>点击数：</span><input type="number" name='clickNum' value="{{ old('clickNum') }}" class="form-control"></li>
                            <li><span>收藏数：</span><input type="number" name='likeNum' value="{{ old('likeNum') }}" class="form-control"></li>
                            <li><span>联络情况：</span><input type="text" name='contactStatus' value="{{ old('contactStatus') }}" class="form-control"></li>
                            <li><span>网址：</span><input type="url" name='website' value="{{ old('website') }}" class="form-control"></li>
                            <li><span>建筑时间：</span><input type="datetime" name='buildDate' value="{{ old('buildDate') }}" class="form-control"></li>
                            <li><span>房间数：</span><input type="number" name='totalRoom' value="{{ old('totalRoom') }}" class="form-control"></li>
                            <li><span>等级：</span><input type="text" name='level' value="{{ old('level') }}" class="form-control"></li>
                            <li><span>房东说：</span><input type="text" name='hosterSay' value="{{ old('hosterSay') }}" class="form-control"></li>
                            <li><span>国家：</span><input type="text" name='country' value="{{ old('country') }}" class="form-control"></li>
                            <li><span>省份：</span><input type="text" name='province' value="{{ old('province') }}" class="form-control"></li>
                            <li><span>城市：</span><input type="text" name='city' value="{{ old('city') }}" class="form-control"></li>
                            <li><span>区域：</span><input type="text" name='region' value="{{ old('region') }}" class="form-control"></li>                    </ul>
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
@section('js')
<script>
    $('.disabled').on('show.bs.tab', function (e) {
        e.preventDefault();
    });
</script>
@endsection