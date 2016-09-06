@extends('layouts.admin')

@section('content')
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">编辑角色</h3>
            </div>
            <form role="form" method="POST" action="{{ route('role.update',$role->id) }}">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">*机器名</label>
                        <input type="text" class="form-control" readonly name="name" value="{{ $role->name }}" placeholder="只允许输入英文字母">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">*角色名</label>
                        <input type="text" class="form-control" name="display_name" value="{{ $role->display_name }}" placeholder="请输入角色名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">描述</label>
                        <input type="text" class="form-control" name="description" value="{{ $role->description }}" placeholder="请输入关于角色的描述">
                    </div>
                </div>
                {{ method_field('PUT') }}
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
@endsection
