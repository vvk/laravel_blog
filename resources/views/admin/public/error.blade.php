<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{app_name()}}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link href="{{asset('static/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/common.css')}}" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="middle-box text-center animated fadeInDown" style="padding-top: 10%">
    <h3 class="font-bold">
        <img class="login-logo rotation3" style="width: 25px" src="{{asset('static/image/logo.png')}}"/>
        {{$msg}}
    </h3>

    <div class="error-desc">
        <a href="javascript:history.go(-1)" class="btn btn-danger m-t">返回</a>
    </div>
</div>
</body>
</html>