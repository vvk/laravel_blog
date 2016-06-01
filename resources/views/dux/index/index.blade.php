@extends('dux.public.master')

@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">

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

                <article class="excerpt-minic excerpt-minic-index">
                    <h2>
                        <a class="red" href="">【今日观点】</a>
                        <a href="" title="从下载看我们该如何做事-DUX主题演示">从下载看我们该如何做事</a>
                    </h2>
                    <p class="note">一次我下载几部电影，发现如果同时下载多部要等上几个小时，然后我把最想看的做个先后排序，去设置同时只能下载一部，结果是不到一杯茶功夫我就能看到最想看的电影。 这就像我们一段时间内想干成很多事情，是同时干还是有选择有顺序的干，结果很不一样。同时...</p>
                </article>
                <div class="title">
                    <h3>最新发布</h3>
                    <div class="more">
                        <a href="">热门标签</a><a href="http://daqianduan.com/">大前端</a>
                        <a href="">themebetter</a>
                        <a href="">见识多</a>
                    </div>
                </div>

                <!-- 文章 start -->
                <div class="article-list">
                    @foreach($data as $item)
                        <article class="excerpt">
                            <a class="focus" href="detail.html">
                                <div style="transitionAll-box">
                                    <img src="{{asset('static/image/grey.gif')}}" data-original="{{asset($item->thumb)}}" class="thumb lazy transitionAll" alt="">
                                </div>
                            </a>
                            <div>
                                <header>
                                    <a class="cat" href="{{url('category/'.$item->category->id)}}.html">{{$item->category->name}}<i></i></a>
                                    <h2>
                                        <a href="" title="">{{$item->name}}}</a>
                                    </h2>
                                </header>
                                <p class="meta">
                                    <time><i class="fa fa-clock-o"></i>{{date('Y-m-d', $item->publish_time)}}</time>
                                    <span class="author"><i class="fa fa-user"></i>sunwq</span>
                                    {{--<a class="pc" href=""><i class="fa fa-comments-o"></i>评论(0)</a>--}}
                                </p>
                                <p class="note">本主题支持手机端视频播放，如不能播放请检测手机是否安装播放视频插件flash，插入视频请复制视频网站上的HTML代码，如 &lt;embed src="http://player.youku.com/player.php/sid/XMTM4...</p>
                            </div>
                        </article>
                    @endforeach


                </div>
                <!-- 文章 end -->

                <div class="pagination">
                    {{--<ul>--}}
                        {{--<li class="prev-page"><a href="">上一页</a></li>--}}
                        {{--<li><a href="">1</a></li>--}}
                        {{--<li class="active"><span>2</span></li>--}}
                        {{--<li class="next-page"></li>--}}
                        {{--<li><span>共 2 页</span></li>--}}
                    {{--</ul>--}}
                    {!! $data->links() !!}
                </div>
            </div>
        </div>

        <aside class="sidebar">

            <!-- 网站公告、会员中心 start -->
            <div class="widget widget-tops affix-top" style="top: 0px;">
                <ul class="widget-nav">
                    <li class="active">网站公告</li>
                    <li class="">会员中心</li>
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
                        <h4>需要登录才能进入会员中心</h4>
                        <p>
                            <a href="javascript:;" class="btn btn-primary signin-loader">立即登录</a>
                            <a href="javascript:;" class="btn btn-default signup-loader">现在注册</a>
                        </p>
                    </li>
                </ul>
            </div>
            <!-- 网站公告、会员中心 end -->

            <div class="widget widget_ui_textasb" style="top: 0px;">
                <a class="style02" href="">
                    <strong>吐血推荐</strong>
                    <h2>DUX主题 新一代主题</h2>
                    <p>DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...</p>
                </a>
            </div>

            <!-- 置顶推荐 start -->
            <div class="widget widget_ui_posts">
                <h3>置顶推荐</h3>
                <ul>
                    <li>
							<span class="thumbnail">
								<a href="">
                                    <img src="./image/16-220x105.jpg" alt="" class="thumb transitionAll ">
                                </a>
							</span>
                        <span class="text"><a href="">Matterport 获 3000 万美元融资</a></span>
                        <span class="muted">2015-06-27</span>
                        <span class="muted">评论()</span>
                    </li>
                    <li>
							<span class="thumbnail">
								<a href="">
                                    <img src="./image/1-220x132.png" alt="" class="thumb transitionAll">
                                </a>
							</span>
                        <span class="text"><a href="">什么样的芯片才配被博物馆永久收藏？</a></span>
                        <span class="muted">2015-06-27</span>
                        <span class="muted">评论()</span>
                    </li>
                    <li>
							<span class="thumbnail">
								<a href="">
                                    <img src="./image/1-220x132.png" alt="" class="thumb transitionAll">
                                </a>
							</span>
                        <span class="text"><a href="">什么样的芯片才配被博物馆永久收藏？</a></span>
                        <span class="muted">2015-06-27</span>
                        <span class="muted">评论()</span>
                    </li>
                    <li>
							<span class="thumbnail">
								<a href="">
                                    <img src="./image/1-220x132.png" alt="" class="thumb transitionAll">
                                </a>
							</span>
                        <span class="text"><a href="">什么样的芯片才配被博物馆永久收藏？</a></span>
                        <span class="muted">2015-06-27</span>
                        <span class="muted">评论()</span>
                    </li>
                </ul>
            </div>
            <!-- 置顶推荐 end -->

            <div class="widget widget_ui_posts">
                <h3>热门文章</h3>
                <ul>
                    <li>
                        <!-- <span class="thumbnail">
                            <a href="">
                                <img src="{{asset('static/image/111-220x147.jpg')}}" alt="" class="thumb transitionAll">
                            </a>
                        </span> -->
                        <span class="text"><a href="">什么样的芯片才配被博物馆永久收藏？</a></span>
                        <span class="muted">2015-06-27</span>
                        <span class="muted">评论()</span>
                    </li>
                    <li>
							<span class="thumbnail">
								<a href="">
                                    <img src="{{asset('static/image/111-220x147.jpg')}}" alt="" class="thumb transitionAll">
                                </a>
							</span>
                        <span class="text"><a href="">什么样的芯片才配被博物馆永久收藏？</a></span>
                        <span class="muted">2015-06-27</span>
                        <span class="muted">评论()</span>
                    </li>
                </ul>
            </div>

            <div class="widget widget_ui_ads">
                <div class="item">
                    <a href=""><img src="./image/asb-01.jpg" /></a>
                </div>
            </div>

            <!-- 最新评论 start -->
            <div class="widget widget_ui_comments">
                <h3>最新评论</h3>
                <ul class="ds-recent-comments" data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"><ul></ul></ul>
            </div>
            <!-- 最新评论 end -->

            <div class="widget widget_ui_tags">
                <h3>热门标签</h3>
                <div class="items">
                    <a href="">融资 (2)</a>
                    <a href="">移动支付 (2)</a>
                    <a href="">app (2)</a>
                    <a href="">亚马逊 (1)</a>
                    <a href="">机器学习 (1)</a>
                    <a href="">Airbnb (1)</a>
                    <a href="">浏览器 (1)</a>
                    <a href="">移动 (1)</a>
                    <a href="">iPhone (1)</a>
                    <a href="">ios (1)</a>
                </div>
            </div>

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



