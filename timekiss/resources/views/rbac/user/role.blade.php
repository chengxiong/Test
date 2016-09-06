@extends('layouts.admin')

@section('content')
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">用户对应角色</h3>
            </div>
            <form role="form" method="POST" action="{{ route('user.storeRole',$user->id) }}">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="checkbox">
                        @foreach($role_list as $role)
                            @if(in_array($role->id,$has_role))
                                <label>
                                    <input type="checkbox" name="role[]" checked value="{{ $role->id }}"> {{ $role->display_name }}
                                </label>
                            @else
                                <label>
                                    <input type="checkbox" name="role[]" value="{{ $role->id }}"> {{ $role->display_name }}
                                </label>
                            @endif
                            <p>{{ $role->description }}</p>
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