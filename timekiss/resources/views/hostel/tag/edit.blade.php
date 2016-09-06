<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">添加TAG</h4>
</div>
<form method="POST" action="{{ route('tag.update',$tag->tid) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="modal-body">
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputPassword1">TAG名称</label>
                <input type="text" name="name" value="{{ $tag->name }}" class="form-control" placeholder="TAG名称">
            </div>
            <div class="form-group">
                <label>TAG类型</label>
                <select name="type" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    @if($tag->type == 1)
                    <option value="1" selected="selected">民宿</option>
                    <option value="2">美学</option>
                    <option value="3">用户</option>
                    @elseif($tag->type ==2)
                    <option value="1">民宿</option>
                    <option value="2" selected="selected">美学</option>
                    <option value="3">用户</option>
                    @else
                    <option value="1">民宿</option>
                    <option value="2">美学</option>
                    <option value="3" selected="selected">用户</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">确认</button>
    </div>
</form>
