//默认提示
jQuery.extend(jQuery.validator.messages, {
  required: NO_EMPTY,
  email: EMAIL_ERROR_TIPS,
  number: NUMBER_ERROR_TIPS,
});

//额外规则
jQuery.validator.addMethod("userName", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9_]+$/.test(value);
}, USERNAME_EXTRA_TIPS);

jQuery.validator.addMethod("isSmtpHost", function(value, element) {
  return this.optional(element) || /^[a-z0-9](.*)\.[a-z0-9]+\.[a-z0-9]+$/.test(value);
}, SMTPHOST_ERROR_TIPS);

$(function(){
    //登陆页表单验证
    $("#loginform").validate({
        rules:{
            username:{required:true,maxlength:12,minlength:5},
            password:{required:true,maxlength:15,minlength:7},
        },
        messages: {
            username: {
                required: USERNAME_NULL_TIPS,
                minlength: USERNAME_ERROR_TIPS,
                maxlength: USERNAME_ERROR_TIPS,
            },
            password: {
                required: PASSWORD_NULL_TIPS,
                minlength: PASSWORD_ERROR_TIPS,
                maxlength: PASSWORD_ERROR_TIPS,
            },
        },
        errorPlacement: function(error, element) {
            $('.errortips').html('');
            error.appendTo($('.errortips'));
        },
    });

    //添加权限组页
    $('#addgroup').validate({
        rules:{ title:{required:true} },
        messages: { title: {required: USERGROUP_NULL_TIPS}},
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        },
    });

    //用户页
    $('#userform').validate({
        rules:{
            nickname:{required:true},
            username:{required:true,maxlength:12,minlength:5,userName:true,
                      remote:{url: USERNAME_CHECK_URL,type: "post",
                              data: { username: function() { return $('input[name="username"]').val();}}
                            }
                     },
            password:{required:true,maxlength:15,minlength:7},
            repassword:{required:true,equalTo:'input[name="password"]'},
            oldpassword:{required:true,
                        remote:{url: PASSWORD_CHECK_URL,type: "post",
                              data: { oldpassword: function() { return $('input[name="oldpassword"]').val();}}
                            }
                     },
        },
        messages: {
            nickname: {required:NICKNAME_NULL_TIPS},
            username: {
                required: USERNAME_NULL_TIPS,
                minlength: USERNAME_ERROR_TIPS,
                maxlength: USERNAME_ERROR_TIPS,
                remote:USERNAME_EXISTS,
            },
            password: {
                required: PASSWORD_NULL_TIPS,
                minlength: PASSWORD_ERROR_TIPS,
                maxlength: PASSWORD_ERROR_TIPS,
            },
            repassword:{
                required:REPASSWORD_NULL_TIPS,
                equalTo:REPASSWORD_ERROR_TIPS,
            },
            oldpassword:{
                required: CURRENT_PASSWORD_NULL_TIPS,
                remote:CURRENT_PASSWORD_ERROR_TIPS,
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        },
    });

     //发件人表单
     $('#senderform').validate({
        rules:{
            sender_email:{required:true,email:true}
        },
        messages: {
            sender_email: {required: EMAIL_NULL_TIPS,email:EMAIL_ERROR_TIPS}
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

     //smtp表单验证
     $('#smtpform').validate({
        rules:{
            account_name:{required:true},
            smtp_host:{required:true,isSmtpHost:true},
            smtp_username:{required:true},
            smtp_password:{required:true},
            smtp_port:{required:true,number:true},
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

    //ses表单验证
     $('#sesform').validate({
        rules:{
            account_name:{required:true},
            access_key_id:{required:true},
            secret_access_key:{required:true},
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

    //mailgun表单验证
     $('#mgform').validate({
        rules:{
            account_name:{required:true},
            mg_domain:{required:true},
            mg_api_key:{required:true},
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

     //邮件组添加验证
     $('#emailgroupform').validate({
        rules:{
            group_name:{required:true},
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

     //模板添加验证
     $('#themeform').validate({
        rules:{
            theme_name:{required:true},
        },
        errorPlacement: function(error, element) {
            error.appendTo (element.next());
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

     //任务添加验证
     $('#taskform').validate({
        rules:{
            task_name:{required:true},
            subject:{required:true},
            tpl_id:{required:true},
            unsubscribe_tpl_id:{required:true},
            'account_id[]':{required:true},
        },
        messages: {
            task_name: {required: TASK_NAME_NULL_TIPS},
            subject: {required: SUBJECT_NULL_TIPS},
            tpl_id: {required: PLEASE_SELECT_THEME},
            unsubscribe_tpl_id: {required: PLEASE_SELECT_THEME},
            'account_id[]': {required: PLEASE_SELECT_ACCOUNT},
        },
        errorPlacement: function(error, element) {
            if ( element.is(":checkbox") ){
                 error.appendTo(element.parent());
            }else{
                error.appendTo(element.next());
            }
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

    //订阅添加验证
    $('#subscribeform').validate({
        rules:{
            subscribe_failed_id:{required:true},
            subscribe_success_id:{required:true},
            style:{required:true},
        },
        messages: {
            subscribe_failed_id: {required: PLEASE_SELECT_THEME},
            subscribe_success_id: {required: PLEASE_SELECT_THEME},
            style: {required: PLEASE_SELECT_SUBSCRIBE_STYLE},
        },
        errorPlacement: function(error, element) {
            if ( element.is(":radio") ){
                 error.appendTo(element.parent().parent());
            }else{
                error.appendTo(element.next());
            }
        },
        success: function(label) {
           label.html("&nbsp;").addClass("right");
        }
    });

})