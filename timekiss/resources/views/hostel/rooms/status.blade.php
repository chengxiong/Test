<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">房间上下架</h4>
</div>
<form method="POST" action="{{ route('rooms.updateStatus',$room->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="modal-body">
        <div class="form-group">
            @if($room->status)
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" checked="checked">上架
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="0">下架
                </label>
            </div>            
            @else
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1">上架
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="0" checked="checked">下架
                </label>
            </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">确认</button>
    </div>
</form>


