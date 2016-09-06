<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">导入</h4>
</div>
<form method="POST" action="{{ route('hostel.implodeBnb') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="modal-body">
    <ul class="clearfix">
        <li><span>文件(.xls)：</span><input type="file" name="file" required="required" class="form-control"></li>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-primary">确认</button>
</div>
</form>
