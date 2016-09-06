@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">角色删除</h3>
                </div>
                <form role="form" method="POST" action="{{ route('role.destroy',$role->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">你确定删除该角色么？会同时解除该角色与权限的对应关系</label>
                        </div>
                    </div>
                    {{ method_field('DELETE') }}
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <a href="{{ route('role.index') }}" class="btn btn-primary">取消</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
