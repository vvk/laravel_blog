<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>孙万庆博客后台管理系统</title>

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link href="{{asset('static/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/style.min.css')}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    @include('admin.public.lefe')
    <div id="page-wrapper" class="gray-bg dashbard-1" style="height:100%">
        <div class="row J_mainContent" style="height:100%">
            <iframe name="content" width="100%" height="100%" src="{{url('admin/home')}}" frameborder="0" data-id="index_v1.html" seamless></iframe>
        </div>
    </div>
</div>
<script src="{{asset('static/js/jquery.min.js')}}"></script>
<script src="{{asset('static/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('static/js/plugins/layer/layer.js')}}"></script>
<script src="{{asset('static/js/hplus.min.js')}}"></script>
</body>
</html>