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
            <li><a href="{{ route('hostel.base',$bnb->bid) }}">基本信息</a></li>
            <li class="active"><a href="#tab_2" data-toggle="tab">添加内容</a></li>
            <li><a href="{{ route('hostel.image',$bnb->bid) }}">上传图片</a></li>
            <li><a href="{{ route('hostel.service',$bnb->bid) }}">服务</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_2">
                <div class="info_form clearfix">
                    <form class="" action="{{ route('hostel.storeContent',$bnb->bid) }}" method="post">
                        {{ csrf_field() }}
                        
                        @include('UEditor.head')
                        @if($bnb->bnbContent()->count() > 0)
                        @foreach($bnb->bnbContent()->get() as $content)
                        <script id="ueditor">
                            {!! $content->content !!}
                        </script>
                        <input type="hidden" name="content_id" value="{{ $content->id }}">
                        @endforeach
                        @else
                        <script id="ueditor"></script>
                        @endif
                        <script>
                            var ue = UE.getEditor("ueditor");
                            ue.ready(function () {
                                //因为Laravel有防csrf防伪造攻击的处理所以加上此行
                                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                            });
                        </script> 
                        <input type="hidden" id="content" name="content" value=""/>
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
    $("form").submit(function(e){
        var content = $("iframe").contents().find("body.view").html();
        $("#content").val(content);
    })
</script>
@endsection