<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">修改账号状态</h4>
</div>
<form method="POST" action="{{ route('account.changeStatus',$account->accountId) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="modal-body">
        <div class="radio">
            @if($account->status)
            <label>                        
                <input type="radio" name="status" checked="checked" value="1"> 启用
            </label>
            <label>                        
                <input type="radio" name="status" value="0"> 禁用
            </label>
            @else
            <label>                        
                <input type="radio" name="status" value="1"> 启用
            </label>
            <label>                        
                <input type="radio" name="status" checked="checked" value="0"> 禁用
            </label>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">确认</button>
    </div>
</form>
