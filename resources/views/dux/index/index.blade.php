@extends('dux.public.master')

@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">

            @if(isset($banner) && $banner && $banner->count() > 0)
                <!-- 轮播图 start -->
                <div id="focusslide" class="carousel slide" data-ride="carousel" style="touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    <ol class="carousel-indicators">
                        @foreach($banner as $k=>$v)
                            <li data-target="#focusslide" data-slide-to="{{$k}}" @if($k == 0)class="active"@endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($banner as $k=>$v)
                            <div class="item @if($k == 0) active @endif">
                                <a href="@if($v->url){{$v->url}}@else javascript:void(0) @endif" @if($v->url && $v->target) target="_blank" @endif>
                                    <img src="{{$v->image}}">
                                </a>
                            </div>
                        @endforeach
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
                <h3>
                    @if(isset($s) && $s)
                        搜索：{{$s}}
                    @elseif(isset($category) && $category)
                        分类：{{$category->name}}
                    @elseif(isset($tagInfo) && $tagInfo)
                        标签：{{$tagInfo->name}}
                    @else 最新发布
                    @endif
                </h3>

                @if($hotTags)
                    <div class="more">
                        <span><i class="fa fa-tags"></i> 热门标签：</span>
                        @foreach($hotTags as $item)
                            <a href="{{url('tag/'.$item->tag->name)}}">{{$item->tag->name}}</a>
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

                        </ul>
                    </li>
                    <li class="item item-02">
                        <h3 style="background: none">如有疑问,请留言或邮件咨询<br/><a href="mailto:sunwq@sviping.com">sunwq@sviping.com</a></h3>
                    </li>
                </ul>
            </div>
            <!-- 网站公告、会员中心 end -->

            @include('dux.public.right_recommend_article')

            @include('dux.public.right_hot_article')

            <!-- 最新评论 start -->
            {{--<div class="widget widget_ui_comments">--}}
                {{--<h3>最新评论</h3>--}}
                {{--<ul class="ds-recent-comments" data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"><ul></ul></ul>--}}
            {{--</div>--}}
            <!-- 最新评论 end -->

            @if(isset($usedTags) && $usedTags && $usedTags->count() > 0)
                <div class="widget widget_ui_tags">
                    <h3>标签云</h3>
                    <div class="items">
                        @foreach($usedTags as $item)
                            <a href="{{url('tag/'.$item->tag->name)}}">{{$item->tag->name}} ({{$item->count}})</a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 最近访客 start -->
            {{--<div class="widget widget_ui_readers">--}}
                {{--<h3>最近访客</h3>--}}
                {{--<ul class="ds-recent-visitors" data-num-items="20"></ul>--}}
            {{--</div>--}}
            <!-- 最近访客 end -->
        </aside>
    </section>
@endsection
