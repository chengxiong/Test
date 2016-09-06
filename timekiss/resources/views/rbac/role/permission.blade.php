@extends('layouts.admin')

@section('content')
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">角色对应权限</h3>
            </div>
            <form role="form" method="POST" action="{{ route('role.perStore',$role->id) }}">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="checkbox">
                        @foreach($permission_list as $permission)
                            @if(in_array($permission->id,$has_permission))
                                <label>
                                    <input type="checkbox" name="permission[]" checked value="{{ $permission->id }}"> {{ $permission->display_name }}
                                </label>
                            @else
                                <label>
                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"> {{ $permission->display_name }}
                                </label>
                            @endif
                            <p>{{ $permission->description }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
@endsection