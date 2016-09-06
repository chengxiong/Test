@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/tab.css') }}">
<style>
    .img{ position:relative; width: 100px; height: 100px; float:left; margin-right: 10px; margin-top: 10px;}
    .img a{ cursor: pointer; position: absolute; width: 20px; line-height: 20px; height: 20px; border-radius: 50%; text-align: center; right:-5px; top:-5px; background: #ccc; color:#fff;}
    .info_form ul li{ width: 100%; float:left;}
    .info_form button{ float:left;}
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
    <div class="tab-pane active" id="tab_1">
        <div class="info_form clearfix">
            <form class="" action="{{ route('rooms.update',$room->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <ul>
                    <li><span>房间名：</span><input type="text" name='name' value="{{ $room->name }}" class="form-control"></li>
                    <li><span>房间简介：</span><input type="text" name='introduction' value="{{ $room->introduction }}" class="form-control"></li>
                    <li><span>价格：</span><input type="text" name='price' value="{{ $room->price }}" class="form-control"></li>
                    <li>
                        <div class="radio">
                            <span>房东改价：</span>
                            @if($room->changePrice)
                            <label>                        
                                <input type="radio" name="changePrice"  checked="checked" value="1"> 是
                            </label>
                            <label>                        
                                <input type="radio" name="changePrice" value="0"> 否
                            </label>                            
                            @else
                            <label>                        
                                <input type="radio" name="changePrice" value="1"> 是
                            </label>
                            <label>                        
                                <input type="radio" name="changePrice" checked="checked" value="0"> 否
                            </label>                            
                            @endif
                        </div>
                    </li>
                    <li><span>最大入住人数：</span><input type="number" name='number' value="{{ $room->number }}" class="form-control"></li>
                    <li><span>房间面积：</span><input type="text" name='size' value="{{ $room->size }}" class="form-control"></li>
                    <li><span>床型：</span><input type="text" name='bed_type' value="{{ $room->bed_type }}" class="form-control"></li>
                    <li><span>床宽：</span><input type="text" name='bed_width' value="{{ $room->bed_width }}" class="form-control"></li>
                    @if($room->image()->count() > 0)
                    @foreach($room->image()->get() as $image)
                    <div>
                        <div class="img"><img id="{{ $image->id }}" src="{{ $image->url }}?imageView2/2/w/100/h/100/q/100"><a href="javascript:;">x</a></div>
                    </div>
                    @endforeach
                    @endif  
                    <input type="hidden" name="img_id" id="img_id" value="">
                    <li><span>图片：</span><input type="file" multiple="multiple" name="file[]" class="form-control"></li>
                    <li>
                        <div class="radio">
                            <span>态客包房：</span>
                            @if($room->tkOwned)
                            <label>                        
                                <input type="radio" name="tkOwned" checked="checked" value="1"> 包房
                            </label>
                            <label>                        
                                <input type="radio" name="tkOwned" value="0"> 不包房
                            </label>
                            @else
                            <label>                        
                                <input type="radio" name="tkOwned" value="1"> 包房
                            </label>
                            <label>                        
                                <input type="radio" name="tkOwned" checked="checked" value="0"> 不包房
                            </label>
                            @endif
                        </div>
                    </li>
                    <li><span>重构包房：</span>
                        <div  class="form-group checkbox">
                            <label>
                                <input type="checkbox" name="restructure" value="1"> 重构包房数据                            
                            </label>
                        </div>
                    </li>
                    <li><span>包房日期：</span>
                        <textarea class="form-control" placeholder="填写日期 格式yyyy-mm-dd 逗号分开" name="tkTime">@if($room->tkTime()->count() > 0) @foreach($room->tkTime()->get() as $price){{ $price->priceDate }},@endforeach @endif</textarea>
                    </li>
                    <li><span>Check-in：</span><input type="text" placeholder="24小时制 14:00" name='checkInTime' value="{{ $room->checkInTime }}" class="form-control"></li>
                    <li><span>Check-out：</span><input type="text" placeholder="24小时制 12:00" name='checkOutTime' value="{{ $room->checkOutTime }}" class="form-control"></li>
                    <li>
                        <div class="radio">
                            <span>早餐：</span>
                            @if($room->breakfast)
                            <label>                        
                                <input type="radio" name="breakfast" checked="checked" value="1"> 有
                            </label>
                            <label>                        
                                <input type="radio" name="breakfast" value="0"> 没有
                            </label>
                            @else
                            <label>                        
                                <input type="radio" name="breakfast" value="1"> 有
                            </label>
                            <label>                        
                                <input type="radio" name="breakfast" checked="checked" value="0"> 没有
                            </label>                            
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="radio">
                            <span>接送：</span>
                            @if($room->shuttle)
                            <label>                        
                                <input type="radio" name="shuttle" checked="checked" value="1"> 有
                            </label>
                            <label>                        
                                <input type="radio" name="shuttle" value="0"> 没有
                            </label>
                            @else
                            <label>                        
                                <input type="radio" name="shuttle" value="1"> 有
                            </label>
                            <label>                        
                                <input type="radio" name="shuttle" checked="checked" value="0"> 没有
                            </label>                            
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="radio">
                            <span>态客沃：</span>
                            @if($room->tk_wow)
                            <label>                        
                                <input type="radio" name="tk_wow" checked="checked" value="1"> 是
                            </label>
                            <label>                        
                                <input type="radio" name="tk_wow" value="0"> 否
                            </label>                        
                            @else
                            <label>                        
                                <input type="radio" name="tk_wow" value="1"> 是
                            </label>
                            <label>                        
                                <input type="radio" name="tk_wow" checked="checked" value="0"> 否
                            </label>                            
                            @endif
                        </div>
                    </li>
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var img_id = new Array();
    $('.img a').click(function () {
        $(this).parent().remove();
        var id = $(this).prev('img').attr('id');
        img_id.push(id);
        $('#img_id').val(img_id);
    });
</script>
@endsection