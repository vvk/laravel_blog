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
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>{{config('app.name')}}博客后台管理系统</title>

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link href="{{asset('static/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/common.css')}}" rel="stylesheet">
    <style type="text/css">
        .top-navigation-right-content{float:right;height: 40px;overflow: hidden;font-size:0;text-size-adjust:none;}
        .top-navigation-right-content a{
            height: 40px;
            outline:0;
            color:#999;
            border-left: solid 1px #eee;
            text-align: center;
            padding-left:10px;
            padding-right:10px;
            display: inline-block;
            font-size:12px;
        }
        .top-navigation-right-content a:hover{background:#f2f2f2;color: #777}
        .top-navigation-right-content a:first-child{border-left: none}
    </style>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">

    <!--左侧导航开始-->
    @include('admin.public.left')
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft navbar-minimalize"><i class="fa fa-bars"></i></button>
            <div class="top-navigation-right-content">
                <a href="{{url('/')}}" target="_blank"><i class="fa fa-home"></i> 博客首页</a>
                <a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> 退出</a>
            </div>

        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="content" width="100%" height="100%" src="{{url('admin/home')}}" frameborder="0" seamless></iframe>
        </div>
        <div class="footer">
            <div class="text-center">Copyright © 2016-{{date('Y')}} 龙卷风 All Rights Reserved</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->

</div>
<script src="{{asset('static/js/jquery.min.js')}}"></script>
<script src="{{asset('static/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('static/js/plugins/layer/layer.js')}}"></script>
<script src="{{asset('static/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('static/js/hplus.min.js')}}"></script>
</body>
</html>