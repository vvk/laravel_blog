@extends('dux.public.master')

@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">

                @if(!isset($cuttentCategory) && !isset($tagInfo))
                <!-- 轮播图 start -->
                <div id="focusslide" class="carousel slide" data-ride="carousel" style="touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    <ol class="carousel-indicators">
                        <li data-target="#focusslide" data-slide-to="0" class="active"></li>
                        <li data-target="#focusslide" data-slide-to="1" class=""></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <a target="_blank" href="">
                                <img src="{{asset('static/image/hs-xiu.jpg')}}">
                            </a>
                        </div>
                        <div class="item">
                            <a target="_blank" href="">
                                <img src="{{asset('static/image/hs-xiu(1).jpg')}}">
                            </a>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#focusslide" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="/#focusslide" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <!-- 轮播图 end -->
                @endif

                <div class="title">
                    <h3>@if(isset($cuttentCategory) && $cuttentCategory)
                            {{$cuttentCategory->name}}
                        @elseif(isset($tagInfo) && $tagInfo)
                            标签：{{$tagInfo->name}}
                        @else 最新发布
                        @endif
                    </h3>

                    @if($hotTags)
                        <div class="more">
                            <span><i class="fa fa-tags"></i> 热门标签：</span>
                            @foreach($hotTags as $item)
                                <a href="{{url('tag/'.$item->name)}}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    @endif
                </div>


                @include('dux.public.article_list')

            </div>
        </div>

        <aside class="sidebar">

            <!-- 网站公告、会员中心 start -->
            <div class="widget widget-tops affix-top" style="top: 0px;">
                <ul class="widget-nav">
                    <li class="active">网站公告</li>
                    <li class="">联系我</li>
                </ul>
                <ul class="widget-navcontent">
                    <li class="item item-01 active">
                        <ul>
                            <li>
                                <time>06-30</time>
                                <a target="_blank" href="">大前端和阿里百秀背后的团队</a>
                            </li>
                            <li>
                                <time>06-30</time>
                                <a target="_blank" href="">你是否希望大前端做服务器合租代管服务？</a>
                            </li>
                            <li>
                                <time>06-30</time>
                                <a target="_blank" href="">大前端D8主题等其他主题支持wordpress 3.8版本</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item item-02">
                        <h3>如有疑问,请留言或邮件咨询<br/><a href="mailto:sunwq@sviping.com">sunwq@sviping.com</a></h3>
                    </li>
                </ul>
            </div>
            <!-- 网站公告、会员中心 end -->

            {{--<div class="widget widget_ui_textasb" style="top: 0px;">
                <a class="style02" href="">
                    <strong>吐血推荐</strong>
                    <h2>DUX主题 新一代主题</h2>
                    <p>DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...</p>
                </a>
            </div>--}}

            @include('dux.public.right_recommend_article')

            @include('dux.public.right_hot_article')

            <!-- 最新评论 start -->
            <div class="widget widget_ui_comments">
                <h3>最新评论</h3>
                <ul class="ds-recent-comments" data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"><ul></ul></ul>
            </div>
            <!-- 最新评论 end -->

            @if(isset($allTags) && $allTags)
            <div class="widget widget_ui_tags">
                <h3>标签云</h3>
                <div class="items">
                    @foreach($allTags as $item)
                    <a href="{{url('tag/'.$item['name'])}}">{{$item['name']}} ({{$item['count']}})</a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- 最近访客 start -->
            <div class="widget widget_ui_readers">
                <h3>最近访客</h3>
                <ul class="ds-recent-visitors" data-num-items="20"></ul>
            </div>
            <!-- 最近访客 end -->


        </aside>
    </section>
@endsection


@section('js')
    @parent

    <script type="text/javascript">
        var duoshuoQuery = {short_name:"sunwq"};
        (function() {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';ds.async = true;
            ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0]
            || document.getElementsByTagName('body')[0]).appendChild(ds);
        })();
    </script>

@endsection



