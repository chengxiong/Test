<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">取消订单</h4>
</div>
<form method="POST" action="">
    {{ csrf_field() }}
<div class="modal-body mars-list clearfix">
        <ul class="clearfix">
            <li>预定人：Andy</li>
            <li>订单号：000001</li>
            <li><label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"><span>无手续费</span></label></li>
            <li><label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"><span>有手续费</span></label><input name="fee" type="text"></li>
            <li><label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"><span>赔付</span></label><input name="pay" type="text"></li>
        </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-primary">确认</button>
</div>
</form>