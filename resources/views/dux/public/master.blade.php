<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-title" content="龙卷风">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title>@section('title')@if(isset($title) && $title) {{$title}} - @endif{{$web_title}}@show</title>
    <meta name="keywords" content="@section('keywords')@if(isset($keywords) && $keywords){{$keywords}}@else{{$web_keywords}}@endif @show">
    <meta name="description" content="@section('description')@if(isset($description) && $description){{$description}}@else{{$web_description}}@endif @show">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    @section('css')
    <link rel="stylesheet" href="{{asset('static/bootstrap-3.3.5/css/bootstrap.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('static/css/font-awesome/css/font-awesome.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('static/css/main.css')}}" type="text/css" media="all">
    @show

</head>

<body class="nav_fixed">

@include('dux.public.header')


@yield('content')

<footer class="footer">
    <div class="container">
        <div class="fcode">
            <div class="friend_link">
                <ul>
                    <li><span>友情链接：</span></li>
                    @foreach($friendLink as $item)
                        <li><a href="{{$item['url']}}" target="_blank" title="{{$item['description']}}">{{$item['name']}}</a> </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <p>Copyright © 2016 龙卷风 All Rights Reserved</p>
        <div class="hide">网站统计代码可以放在这</div>
    </div>
</footer>

@section('js')
<script>
    window.jsui={
        uri: '/static/',
        ver:'1.0',
        roll: ["1","2"]
    };

</script>
<script type="text/javascript" src="{{asset('static/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/bootstrap-3.3.5/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/js/loader.js')}}"></script>
@show

<div class="m-mask"></div>
<div class="rollbar" style="display: none;">
    <ul>
        <li>
            <a href="javascript:(scrollTo());"><i class="fa fa-angle-up"></i></a>
            <h6>去顶部<i></i></h6>
        </li>
    </ul>
</div>
</body>
</html>