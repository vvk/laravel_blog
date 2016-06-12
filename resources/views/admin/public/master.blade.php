<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>{{config('web.web_site')}}博客后台管理系统</title>

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    @section('css')
    <link href="{{asset('static/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/admin_common.css')}}" rel="stylesheet">
    @show
</head>

<body class="gray-bg">

    @if(isset($breadcrumb))
        <div class="panel panel-default crumbs">
            <div class="panel-body">
                <ol class="breadcrumb">
                    @foreach($breadcrumb as $k=>$v)
                        <li>{{$v}}</li>
                    @endforeach

                    <div class="breadcrumb-button">
                        @section('breadcrumb_button')
                        @show
                    </div>
                </ol>
            </div>
        </div>

    @endif

    <div class="panel panel-default" style="margin: 10px 20px">
    @yield('content')
    </div>

 @section('js')
<script src="{{asset('static/js/jquery.min.js')}}"></script>
<script src="{{asset('static/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/js/plugins/layer/layer.js')}}"></script>
<script src="{{asset('static/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
@show

</body>
</html>