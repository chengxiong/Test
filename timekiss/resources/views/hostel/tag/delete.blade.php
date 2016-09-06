<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">确定删除民宿关联</h4>
</div>
<form method="POST" action="{{ route('tag.deleteRelation',array($bnb->bid,$tag->tid)) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="modal-body">
        确定删除该民宿与标签关联?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">确认</button>
    </div>
</form>

