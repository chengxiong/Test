@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/tab.css') }}">
<style>
    checkbox {
        margin-left: 20px;
    }
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
    <div class="tab-pane active" id="tab_4">
        <div class="info_form clearfix">
            <form class="" action="{{ route('hostel.landlordRoleStore',$bnb->bid) }}" method="post">
                {{ csrf_field() }}
                <ul>
                    @foreach($hostel_list as $hostel)
                    <div class="checkbox radio">
                        <span>{{ $hostel->name }}</span>
                            @if(!empty($has_hostel['hoster']) && in_array($hostel->hid,$has_hostel['hoster']))
                                <label>                        
                                    <input type="radio" name="hoster" class="col-sm-2" checked="checked" value="{{ $hostel->hid }}"> 房东
                                </label>
                            @else
                                <label>                        
                                    <input type="radio" name="hoster" value="{{ $hostel->hid }}"> 房东
                                </label>
                            @endif
                            @if(!empty($has_hostel['manager']) && in_array($hostel->hid,$has_hostel['manager']))
                                <label>                        
                                    <input type="checkbox" name="manager[]" checked="checked" value="{{ $hostel->hid }}"> 管家
                                </label>
                            @else
                                <label>                        
                                    <input type="checkbox" name="manager[]" value="{{ $hostel->hid }}"> 管家
                                </label>
                            @endif
                    </div>
                    @endforeach                                                    
                </ul>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection




