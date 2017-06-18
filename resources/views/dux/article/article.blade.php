@extends('dux.public.master')


@section('after_css')

@endsection

{{--@section('head_js')
    <script src="https://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
@endsection--}}

@section('content')

    <section class="container">
        <div class="content-wrap article_content">
            <div class="content">
                <header class="article-header">
                    <h1 class="article-title">{{$data->name}}</h1>
                    <div class="article-meta">
                        <span class="item"><i class="fa fa-clock-o"></i> 编辑时间：@if($data->modify_time) {{date('Y-m-d H:i:s', $data->modify_time)}} @else {{date('Y-m-d H:i:s', $data->create_time)}} @endif</span>
                        <span class="item"><i class="fa fa-clock-o"></i> 发布时间：{{date('Y-m-d H:i:s', $data->publish_time)}}</span>
                        <span class="item"><i class="fa fa-eye"></i> 浏览量：{{$data->view_count}}</span>
                        <span class="item"><i class="fa fa-folder"></i> 分类：
                            <span class="article-category-item">
                                @if($data->category)
                                    @foreach($data->category as $category)
                                        <a href="{{url('category/'.$category->id)}}" rel="category tag">{{$category->name}}</a>
                                    @endforeach
                                @endif
                            </span>
                        </span>
                        <span class="item"></span>
                    </div>
                </header>

                <!-- 文章 start -->
                <article class="article-content">
                    {!! $data->content !!}

                </article>
                <!-- 文章 end -->

                @if(!$data->is_reprint)
                    <div>
                        <p class="post-copyright">
                            本文章为本站原创，如转载请注明文章出处：<a href="{{$url}}">{{$url}}</a>
                        </p>
                    </div>
                @endif

                <div>
                    <div class="bdsharebuttonbox">
                        <span style="height: 25px;line-height: 25px;">分享到：</span>
                        {{--<wb:share-button appkey="720629087" addition="number" type="button" default_text="【{{$data->name}}】{{$description}}" @if($data->artitle_img_src)pic="{{implode('||', $data->artitle_img_src)}}"@endif ralateUid="1306149274"></wb:share-button>--}}
                        <a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                        <script>window._bd_share_config={"common":{"bdSnsKey":{"tsina":"720629087"},"bdText":"【{{$data->name}}】{{$description}}","bdMini":"2","bdMiniList":false,"bdPic":"{{implode('||', $data->artitle_img_src)}}","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='{{asset('static/js/baidu_share.js')}}?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                    </div>
                </div>

                @if($data->tag)
                    <div class="article-tags"><i class="fa fa-tags"></i> 标签：
                        @foreach($data->tag as $k=>$v)
                            <a href="{{url('tag/'.$v['name'])}}" rel="tag">{{$v['name']}}</a>
                        @endforeach
                    </div>
                @endif

                <div class="article-sibling">
                    <span class="article-preview"><i class="fa fa-arrow-left"></i>上一篇：
                        @if($siblingArticle['preview'])
                            <a href="{{url('archives/'.$siblingArticle['preview']->id)}}" title="{{$siblingArticle['preview']->name}}">{{$siblingArticle['preview']->name}}</a>
                        @else
                            <span class="no-article-sibling">没有了</span>
                        @endif
                    </span>
                    <span class="article-next"><i class="fa fa-arrow-right"></i>下一篇：
                        @if($siblingArticle['next'])
                            <a href="{{url('archives/'.$siblingArticle['next']->id)}}" title="{{$siblingArticle['next']->name}}">{{$siblingArticle['next']->name}}</a>
                        @else
                            <span class="no-article-sibling">没有了</span>
                        @endif
                    </span>
                </div>

                @if($relevanceArticle)
                    <div class="relates">
                        <div class="title">
                            <h3>相关文章</h3>
                        </div>
                        <ul>
                            @foreach($relevanceArticle as $k=>$v)
                                <li><a href="{{url('archives/'.$v['id'])}}">{{$v['name']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
            @endif

                <div id="comments">
                        <div id="SOHUCS" sid="{{$data->id}}" ></div>
                            <script type="text/javascript">
                                (function(){
                                    var appid = 'cysUgIez9';
                                    var conf = 'prod_1c8de72b828eb4772941f50abbb504cb';
                                    var width = window.innerWidth || document.documentElement.clientWidth;
                                    if (width < 960) {
                                        window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("https://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })();
                            </script>

                </div>
            </div>
        </div>

        <aside class="sidebar">
        @include('dux.public.right_recommend_article')

        @include('dux.public.right_hot_article')

        <!-- 最新评论 start -->
            {{--<div class="widget widget_ui_comments">--}}
                {{--<h3>最新评论</h3>--}}
                {{--<ul class="ds-recent-comments"  data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"><ul></ul></ul>--}}
                {{--<div id="cyReping" role="cylabs" data-use="reping"></div>--}}
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

        </aside>
    </section>
@endsection