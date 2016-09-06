@extends('layouts.admin')
@section('content-header')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
{!! Breadcrumbs::render('hostel_tag') !!}
@endsection
@section('content')
<p>
    <a href="{{ route('tag.tagRelation',$bnb->bid) }}" data-toggle="modal" data-target="#myModal"><button type="submit" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加关联</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>TAG名称</th>
                        <th>TAG类型</th>
                        <th>操作</th>
                    </tr>
                    @if($bnb->tag()->count() > 0)
                    @foreach($bnb->tag()->orderBy('id','desc')->get() as $tag)
                    <tr>
                        <td class="cont_show">{{ $tag->name }}</td>
                        <td class="cont_show">
                            @if($tag->type == 1)
                            民宿
                            @elseif($tag->type == 2)
                            美学
                            @elseif($tag->type == 3)
                            用户
                            @else
                            无分类
                            @endif
                        </td>
                        <td class="return-list"><a href="{{ route('tag.delete',array($bnb->bid,$tag->tid)) }}" data-toggle="modal" data-target="#deleteTag">取消关联</a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="modal fade" id="deleteTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
@endsection
