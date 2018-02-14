<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录 -- {{config('web.web_title')}}</title>
    <meta name="keywords" content="{{config('web.web_keywords')}}">
    <meta name="description" content="{{config('web.web_description')}}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link href="{{asset('static/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/common.css')}}" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div class="login-container">
            <div style="margin-top:20% ">
                <a href="{{asset('/')}}"><img class="login-logo" src="{{asset('static/image/logo.png')}}"/></a>
            </div>
            <form class="m-t" role="form">
                <div class="form-group">
                    <input type="text" name="username" class="form-control username" placeholder="用户名">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control password" placeholder="密码">
                </div>
                <div class="form-group" style="text-align: left">
                    <input type="text" name="captcha" class="form-control captcha" placeholder="验证码" style="width:100px;display:inline;">
                    <img src="{{captcha_src()}}" class="captcha-img" onclick="this.src='{{captcha_src()}}'+Math.random()" style="cursor: pointer" title="看不清？换一张" />
                </div>
                <div class="login-error" style="margin-bottom:10px;color:red"></div>
                <input type="hidden" name="_token" class="_token" value="{{csrf_token() }}">
                <button type="button" class="btn btn-danger block full-width m-b login-btn">登 录</button>
            </form>
        </div>
    </div>
<script type="text/javascript">
    var captcha_src = '{{captcha_src()}}';
</script>
<script src="{{asset('static/js/jquery.min.js')}}"></script>
<script src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/js/login.js')}}"></script>
</body>
</html>