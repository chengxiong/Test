@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/tab.css') }}">
<style>
    .img{ position:relative; width: 100px; height: 100px; float:left; margin-right: 10px; margin-top: 10px;}
    .img a{ cursor: pointer; position: absolute; width: 20px; line-height: 20px; height: 20px; border-radius: 50%; text-align: center; right:-5px; top:-5px; background: #ccc; color:#fff;}
</style>
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
            <li><a href="{{ route('hostel.base',$bnb->bid) }}">基本信息</a></li>
            <li><a href="{{ route('hostel.content',$bnb->bid) }}">添加内容</a></li>
            <li class="active"><a href="#tab_3" data-toggle="tab">上传图片</a></li>
            <li><a href="{{ route('hostel.service',$bnb->bid) }}">服务</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_3">
                @if($bnb->bnbImage()->count() > 0)
                @foreach($bnb->bnbImage()->get() as $image)
                <div>
                    <div class="img"><img id="{{ $image->id }}" src="{{ $image->url }}?imageView2/2/w/100/h/100/q/100"><a href="javascript:;">x</a></div>
                </div>
                @endforeach
                @endif    
                <div class="info_form clearfix" style=" float:left; width: 100%; margin-top: 20px;">
                    <form class="" action="{{ route('hostel.storeImage',$bnb->bid) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <ul>
                            <li><span>图片：</span><input type="file" multiple="multiple" name="file[]" class="form-control"></li>
                            <input type="hidden" id="img_id" name="img_id" value="">
                        </ul>
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
var img_id = new Array();
$('.img a').click(function(){
    $(this).parent().remove();
    var id = $(this).prev('img').attr('id');
    img_id.push(id);
    $('#img_id').val(img_id);
});
</script>
@endsection

