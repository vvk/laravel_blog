<!--
  _____                                     _   _
 |  __ \                                   | | | |
 | |__) |___ __      __ ___  _ __  ___   __| | | |__   _   _   ___  _   _  _ __ __      __ __ _
 |  ___// _ \\ \ /\ / // _ \| '__|/ _ \ / _` | | '_ \ | | | | / __|| | | || '_ \\ \ /\ / // _` |
 | |   | (_) |\ V  V /|  __/| |  |  __/| (_| | | |_) || |_| | \__ \| |_| || | | |\ V  V /| (_| |
 |_|    \___/  \_/\_/  \___||_|   \___| \__,_| |_.__/  \__, | |___/ \__,_||_| |_| \_/\_/  \__, |
                                                        __/ |                                | |
                                                       |___/                                 |_|
                          _  _                                                             _         _
                         (_)| | _                                       ____              (_)       (_)
   ___  _ __ ___    __ _  _ | |(_)  ___  _   _  _ __ __      __ __ _   / __ \  ___ __   __ _  _ __   _  _ __    __ _     ___  ___   _ __ ___
  / _ \| '_ ` _ \  / _` || || |    / __|| | | || '_ \\ \ /\ / // _` | / / _` |/ __|\ \ / /| || '_ \ | || '_ \  / _` |   / __|/ _ \ | '_ ` _ \
 |  __/| | | | | || (_| || || | _  \__ \| |_| || | | |\ V  V /| (_| || | (_| |\__ \ \ V / | || |_) || || | | || (_| | _| (__| (_) || | | | | |
  \___||_| |_| |_| \__,_||_||_|(_) |___/ \__,_||_| |_| \_/\_/  \__, | \ \__,_||___/  \_/  |_|| .__/ |_||_| |_| \__, |(_)\___|\___/ |_| |_| |_|
                                                                  | |  \____/                | |                __/ |
                                                                  |_|                        |_|               |___/
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>博客后台登录</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('static/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">庆</h1>
        </div>

        <form class="m-t" role="form" action="index.html">
            <div class="form-group">
                <input type="username" name="username" class="form-control username" placeholder="用户名">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control password" placeholder="密码">
            </div>
            <button type="button" class="btn btn-primary block full-width m-b login">登 录</button>
        </form>
    </div>
</div>
<script src="{{asset('static/js/jquery.min.js')}}"></script>
<script src="{{asset('static/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('.login').click(function(){
            login();
        })

        $('.username').keydown(function(event){
            if(event.keyCode==13){
                login();
                return false;
            }
        })
        $('.password').keydown(function(event){
            if(event.keyCode==13){
                login();
                return false;
            }
        })
    })

    function login(){
        $('.login').text('登录中...').attr('disabled', true);

        var username = $.trim($('.username').val());
        var password = $.trim($('.password').val());

        if(!username){
            swal({title:"登录失败",text:"用户名不能为空", 'type':'error'});
            $('.login').text('登 录').attr('disabled', false);
            return false;
        }

        if(!password){
            swal({title:"登录失败",text:"密码不能为空", 'type':'error'});
            $('.login').text('登 录').attr('disabled', false);
            return false;
        }

        var data = {username:username, password:password, _token:'{{csrf_token()}}'};
        var url = '{{url('admin/user/authenticate')}}';
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:url,
            data:data,
            success:function(response){
                if(response.status==0){
                    window.location.href='/admin';
                }else{
                    swal({title:"登录失败",text:response.msg, 'type':'error'});
                    $('.login').text('登 录').attr('disabled', false);
                    return false;
                }
            }
        });
    }

</script>



</body>

</html>