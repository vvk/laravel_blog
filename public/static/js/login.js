$(function () {
    $('.login-btn').click(function () {
        login();
    })

    $('.login-container .username, .login-container .password, .login-container .captcha').keydown(function (e) {
        if (e.keyCode == 13) {
            login();
        }
    });
    $('.login-container .username, .login-container .password, .login-container .captcha').focus(function () {
        $('.login-container .login-error').text('');
    })
});


function login() {
    $('.login-container .login-btn').text('登录中...').attr('disabled', true);
    $('.login-container .login-error').text('');

    var data = {};
    data.username = $.trim($('.login-container .username').val());
    data.password = $.trim($('.login-container .password').val());
    data._token = $.trim($('.login-container ._token').val());
    data.captcha = $.trim($('.login-container .captcha').val());

    if (!data._token) {
        loginError('系统错误，请稍后重试');
        return false;
    }

    if (!data.username) {
        loginError('用户名不能为空');
        return false;
    }

    if (!data.password) {
        loginError('密码不能为空');
        return false;
    }

    if (!data.captcha) {
        loginError('验证码不能为空');
        return false;
    }

    $.ajax({
        type:'POST',
        dataType:'JSON',
        url:'',
        data:data,
        success:function(response){
            if(response.status==0){
                window.location.href='/admin';
            }else{
                loginError(response.msg);
                $('.login-container .captcha').val('');
                $('.login-container .captcha-img').attr('src', captcha_src + Math.random());
                return false;
            }
        }
    });
}

function loginError(msg) {
    $('.login-container .login-error').text(msg);
    $('.login-container .login-btn').removeAttr('disabled').text('登 录');
}