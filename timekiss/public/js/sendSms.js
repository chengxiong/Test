$('#sendVerifySmsButton').sms({
    //laravel csrf token
    //该token仅为laravel框架的csrf验证,不是access_token!
    token       : "{{csrf_token()}}",

    //请求间隔时间
    interval    : 60,

    //是否请求语音验证码
    voice       : false,

    //请求参数
    requestData : {
        //手机号
        mobile : function () {
            return $('input[name=mobile]').val();
        },
        //手机号的检测规则
        mobile_rule : 'mobile_required'
    },

    //定义服务器有消息返回时如何展示，默认为alert
    alertMsg    : function (msg, type) {
        alert(msg);
    }
});

