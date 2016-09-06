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
            <form action="{{ route('bnb.bnbAccount',$bnb->bid) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    @foreach($account_list as $account)
                    <div class="checkbox">
                        <label>
                            @if(in_array($account->accountId,$has_account))
                            <input type="checkbox" checked="checked" value="{{ $account->accountId }}" name="account[]">{{ $account->username }}
                            @else
                            <input type="checkbox" value="{{ $account->accountId }}" name="account[]">{{ $account->username }}
                            @endif
                        </label>
                    </div>
                    @endforeach  
                </div>
                <button type="submit" class="btn btn-success btn-flat">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection




