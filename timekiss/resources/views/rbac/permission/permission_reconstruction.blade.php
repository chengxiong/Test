@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('permission.store') }}" method="post" class="form-horizontal " enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name" class="col-xs-1 control-label">选中文件*</label>
                <div class="col-xs-4">
                    <div id="permissions" class="form-checkboxes">
                        @foreach($class_name as $key=>$class)
                            <label>{{ $key }} </label><br/>
                            @if(count($class) > 0)
                                @foreach($class as $k=>$file)
                                    <input type="checkbox" id="edit-permissions-{{ $k }}" name="permissions[]" value="\{{ $key }}\{{ $file }}">
                                    <label for="edit-permissions-{{ $k }}">{{ $file  }} </label><br/>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
                <p class="help-block">每个文件对应了一个路由控制器(增删该查权限)。 只会建立选中文件对应的权限</p>
            </div>
            <input type="submit" class="btn btn-success" value="重新构建权限" />
        </form>
    </div>
@endsection