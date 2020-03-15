@extends('dux.public.master')

@section('after_css')
    <link rel="stylesheet" href="{{asset('static/css/figure-bed.css')}}" type="text/css" media="all">
@endsection

@section('content')
    <section class="container">
        <div class="content-wrap article_content">
            <div class="content">
                <header class="article-header">
                    <h1 class="article-title">免费图床</h1>
                    <div class="article-meta">
                        高效稳定的免费 CDN 图床，禁止上传色情、反动、博彩、黑产等相关违法图片。由于资源有限，请酌情使用，图片大小不能超过5M。
                    </div>
                </header>

                <div class="page-container">
                    <div class="panel-body">
                        <div class="upload-container">
                            <div class="upload-img-box">
                                <p class="loading-text">加载中...</p>
                            </div>
                        </div>
                        <p class="upload-msg"></p>
                        <div class="text-center upload-btn-box">
                            <input type="file" name="file" style="height: 0;width: 0">
                            <button type="button" class="btn btn-primary upload-btn hide">上传图片</button>
                        </div>
                    </div>
                </div>

                <div class="url-container hide">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" style="margin-top: 15px"></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <aside class="sidebar">
            @include('dux.public.right_recommend_article')
            @include('dux.public.right_hot_article')
        </aside>
    </section>
@endsection

@section('after_js')
    <script type="text/javascript">
        var uploadUrl = '{{url("figure-bed/upload")}}';
    </script>
    <script type="text/javascript" src="{{asset('static/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/libs/clipboard.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/figure-bed.js')}}"></script>
@endsection