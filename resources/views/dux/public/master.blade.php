<!--
  _____                                     _   _
 |  __ \                                   | | | |
 | |__) |___ __      __ ___  _ __  ___   __| | | |__   _   _   ___  _   _  _ __ __      __ __ _
 |  ___// _ \\ \ /\ / // _ \| '__|/ _ \ / _` | | '_ \ | | | | / __|| | | || '_ \\ \ /\ / // _` |
 | |   | (_) |\ V  V /|  __/| |  |  __/| (_| | | |_) || |_| | \__ \| |_| || | | |\ V  V /| (_| |
 |_|    \___/  \_/\_/  \___||_|   \___| \__,_| |_.__/  \__, | |___/ \__,_||_| |_| \_/\_/  \__, |
                                                        __/ |                                | |
                                                       |___/                                 |_|
  ______                    _  _                                                              _         _
 |  ____|                  (_)| |  _                                       ____              (_)       (_)
 | |__    _ __ ___    __ _  _ | | (_)  ___  _   _  _ __ __      __ __ _   / __ \  ___ __   __ _  _ __   _  _ __    __ _     ___  ___   _ __ ___
 |  __|  | '_ ` _ \  / _` || || |     / __|| | | || '_ \\ \ /\ / // _` | / / _` |/ __|\ \ / /| || '_ \ | || '_ \  / _` |   / __|/ _ \ | '_ ` _ \
 | |____ | | | | | || (_| || || |  _  \__ \| |_| || | | |\ V  V /| (_| || | (_| |\__ \ \ V / | || |_) || || | | || (_| | _| (__| (_) || | | | | |
 |______||_| |_| |_| \__,_||_||_| (_) |___/ \__,_||_| |_| \_/\_/  \__, | \ \__,_||___/  \_/  |_|| .__/ |_||_| |_| \__, |(_)\___|\___/ |_| |_| |_|
                                                                     | |  \____/                | |                __/ |
                                                                     |_|                        |_|               |___/


/**
 * ----------Dragon be here!----------/
 * 　　　┏┓　　　┏┓
 * 　　┏┛┻━━━┛┻┓
 * 　　┃　　　　　　　┃
 * 　　┃　　　━　　　┃
 * 　　┃　┳┛　┗┳　┃
 * 　　┃　　　　　　　┃
 * 　　┃　　　┻　　　┃
 * 　　┃　　　　　　　┃
 * 　　┗━┓　　　┏━┛
 * 　　　　┃　　　┃神兽保佑
 * 　　　　┃　　　┃代码无BUG！
 * 　　　　┃　　　┗━━━┓
 * 　　　　┃　　　　　　　┣┓
 * 　　　　┃　　　　　　　┏┛
 * 　　　　┗┓┓┏━┳┓┏┛
 * 　　　　　┃┫┫　┃┫┫
 * 　　　　　┗┻┛　┗┻┛
 * ━━━━━━神兽出没━━━━━━
*/
-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-title" content="龙卷风">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title>@section('title')@if(isset($title) && $title) {{$title}} - @endif{{config('web.web_title')}}@show</title>
    <meta name="keywords" content="@section('keywords')@if(isset($keywords) && $keywords){{$keywords}}@else{{config('web.web_keywords')}}@endif @show">
    <meta name="description" content="@section('description')@if(isset($description) && $description){{$description}}@else{{config('web.web_description')}}@endif @show">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    @yield('before_css')
    @section('css')
        <link rel="stylesheet" href="{{asset('static/bootstrap/css/bootstrap.min.css')}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset('static/css/font-awesome/css/font-awesome.min.css')}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset('static/css/main.css')}}" type="text/css" media="all">
    @show
    @yield('after_css')
    @yield('head_js')
</head>

<body class="nav_fixed">

@include('dux.public.header')

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="fcode">
            @if(isset($friendLink) && $friendLink && $friendLink->count() > 0)
                <div class="friend_link">
                    <ul>
                        <li><span>友情链接：</span></li>
                        @foreach($friendLink as $item)
                            <li style='vertical-align:middle'>
                				<a href="{{$item['url']}}" target="_blank" title="{{$item['description'] ? $item['description'] : $item['name']}}">
                				    @if(!empty($item['image']))
                				        <img src="{{$item['image']}}" style='height:30px' />
                				    @else
                					   {{$item['name']}}
                				    @endif
                				</a>
            			    </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <p>Copyright © 2016-{{date('Y')}} {{config('web.web_site')}} All Rights Reserved  {!! config('web.site_stat_code') !!}</p>
    </div>
</footer>

<div class="m-mask">12</div>
<div class="rollbar" style="display: none;">
    <ul>
        <li>
            <a href="javascript:(scrollTo());"><i class="fa fa-angle-up"></i></a>
            <h6>去顶部<i></i></h6>
        </li>
    </ul>
</div>

@yield('before_js')
@section('js')
    <script>
        window.jsui={
            uri: '/static/',
            ver:'1.0',
            roll: ["1","2"]
        };
    </script>
    <script type="text/javascript" src="{{asset('static/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/loader.js')}}"></script>
@show
@yield('after_js')

</body>
</html>

