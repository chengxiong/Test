@extends('layouts.admin')
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    {!! Breadcrumbs::render('hostel_landlord') !!}
@endsection
@section('content')
<p>
    <a href="{{ route('landlord.create') }}"><button type="submit" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加房东/管家</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>姓名</th>
                        <th>身份</th>
                        <th>性别</th>
                        <th>电话</th>
                        <th>微信</th>
                        <th>年龄</th>
                        <th>婚姻状况</th>
                        <th>特征</th>
                        <th>头像</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    @foreach($hoster_list as $hoster)
                    <tr>
                        <td>{{ $hoster->name }}</td>
                        <td>
                            @if($hoster->role()->count() > 0)
                                @foreach($hoster->role()->get() as $role)
                                    @if($role->role == 1)
                                        房东 
                                    @elseif($role->role == 2)
                                        管家
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($hoster->gender == 1)
                                男
                            @else
                                女
                            @endif
                        </td>
                        <td>{{ $hoster->telephone }}</td>
                        <td>{{ $hoster->weixin }}</td>
                        <td>{{ $hoster->age }}</td>
                        <td>{{ $hoster->maritalStatus }}</td>
                        <td>{{ $hoster->feature }}</td>
                        <td><img src="{{ $hoster->image }}"></td>
                        <td>{{ $hoster->description }}</td>
                        <td>
                            <a href="{{ route('landlord.edit',$hoster->hid) }}">编辑</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! $hoster_list->render() !!}
        </div>
    </div>
</div>
@endsection