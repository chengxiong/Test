<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">关联TAG</h4>
</div>
<form method="get" action="{{ route('tag.search') }}">
    <div class="modal-body">
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" required="required" id="tag_name" name="tag_name" placeholder="请输入要搜索的TAG">
                <p class="help-block" id="msg"></p>
            </div>
            <div class="col-sm-2">
                <button type="button" id="searchTag" class="btn btn-info pull-right">查询 TAG</button>           
            </div>
            <div class="col-sm-2">
                <a href="{{ route('tag.index') }}"><button type="button" class="btn btn-info pull-right">添加 TAG</button></a>           
            </div>
            <div class="col-sm-2">
                <button type="button" id="emptyTag" class="btn btn-info pull-right">清空 选择</button>           
            </div>
        </div>
    </div>
</form>
<form method="POST" action="{{ route('tag.tagStore',$bnb->bid) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-sm-12">
                <div class="checkbox" id="tagSelect">

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">确认</button>
    </div>
</form>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
$("#emptyTag").click(function(){
    $('#tagSelect').html('');
});
$("#searchTag").click(function () {
    $('#msg').html('');
    var tag_name = $('#tag_name').val();
    if (!tag_name) {
        $('#msg').html('请输入tag名称');
        return false;
    }
    $.ajax({
        type: "get",
        url: "{{ route('tag.search') }}",
        data: {tag_name: tag_name},
        dataType: 'json',
        success: function (data) {
            var dataObj = eval(data);
            $.each(dataObj, function (i, item) {
                //todo:需要判断是否已经存在相同值得checkbox 存在不添加              
                var str = '<label class="col-sm-2"><input type="checkbox" name="tag[]" checked="checked" value="' + item.id + '">' + item.name + '</label>';
                $('#tagSelect').append(str);
            });
            return false;
        },
        error: function () {
            $('#msg').html('获取数据失败');
            return false;
        }
    });
});
</script>

