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
    <div class="tab-pane active" id="tab_1">
        <div class="info_form clearfix">
            <form class="" action="{{ route('rooms.store',$layout->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul>
                    <li><span>房间名：</span><input type="text" name='name' value="{{ old('name') }}" class="form-control"></li>
                    <li><span>房间简介：</span><input type="text" name='introduction' value="{{ old('introduction') }}" class="form-control"></li>
                    <li><span>价格：</span><input type="text" name='price' value="{{ old('price') }}" class="form-control"></li>
                    <li>
                        <div class="radio">
                            <span>房东改价：</span>
                            <label>                        
                                <input type="radio" name="changePrice" value="1"> 是
                            </label>
                            <label>                        
                                <input type="radio" name="changePrice" checked="checked" value="0"> 否
                            </label>
                        </div>
                    </li>
                    <li><span>最大入住人数：</span><input type="number" name='number' value="{{ old('number') }}" class="form-control"></li>
                    <li><span>房间面积：</span><input type="text" name='size' value="{{ old('size') }}" class="form-control"></li>
                    <li><span>床型：</span><input type="text" name='bed_type' value="{{ old('bed_type') }}" class="form-control"></li>
                    <li><span>床宽：</span><input type="text" name='bed_width' value="{{ old('bed_width') }}" class="form-control"></li>
                    <li><span>图片：</span><input type="file" multiple="multiple" name="file[]" class="form-control"></li>
                    <li>
                        <div class="radio">
                            <span>态客包房：</span>
                            <label>                        
                                <input type="radio" name="tkOwned" value="1"> 包房
                            </label>
                            <label>                        
                                <input type="radio" name="tkOwned" checked="checked" value="0"> 不包房
                            </label>
                        </div>
                    </li>
                    <li><span>包房日期：</span>
                        <textarea placeholder="填写日期 格式yyyy-mm-dd 逗号分开" name="tkTime"></textarea>
                    </li>
                    <input type="hidden" value="0" name="status">
                    <li><span>Check-in：</span><input type="text" placeholder="24小时制 14:00" name='checkInTime' value="{{ old('checkInTime') }}" class="form-control"></li>
                    <li><span>Check-out：</span><input type="text" placeholder="24小时制 12:00" name='checkOutTime' value="{{ old('checkOutTime') }}" class="form-control"></li>
                    <li>
                        <div class="radio">
                            <span>早餐：</span>
                            <label>                        
                                <input type="radio" name="breakfast" value="1"> 有
                            </label>
                            <label>                        
                                <input type="radio" name="breakfast" checked="checked" value="0"> 没有
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="radio">
                            <span>接送：</span>
                            <label>                        
                                <input type="radio" name="shuttle" value="1"> 有
                            </label>
                            <label>                        
                                <input type="radio" name="shuttle" checked="checked" value="0"> 没有
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="radio">
                            <span>态客沃：</span>
                            <label>                        
                                <input type="radio" name="tk_wow" value="1"> 是
                            </label>
                            <label>                        
                                <input type="radio" name="tk_wow" checked="checked" value="0"> 否
                            </label>
                        </div>
                    </li>
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection
