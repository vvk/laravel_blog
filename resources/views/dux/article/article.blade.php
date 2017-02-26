@extends('dux.public.master')


@section('after_css')

@endsection

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
                    <div class="ds-share" data-thread-key="{{$data->id}}" data-title="{{$data->name}}" data-content="{{$data->name}}" data-url="{{$url}}">
                        <div class="ds-share-inline">
                            <ul  class="ds-share-icons-16">
                                <li data-toggle="ds-share-icons-more"><a class="ds-more" href="javascript:void(0);">分享到：</a></li>
                                <li><a class="ds-weibo" href="javascript:void(0);" data-service="weibo">微博</a></li>
                                <li><a class="ds-qzone" href="javascript:void(0);" data-service="qzone">QQ空间</a></li>
                                <li><a class="ds-qqt" href="javascript:void(0);" data-service="qqt">腾讯微博</a></li>
                                <li><a class="ds-wechat" href="javascript:void(0);" data-service="wechat">微信</a></li>
                            </ul>
                            <div class="ds-share-icons-more">
                            </div>
                        </div>
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

            <!-- 多说评论框 start -->
                <div id="comments">
                    <div  class="ds-thread" data-thread-key="{{$data->id}}" data-title="{{$data->name}}" data-url="{{$url}}"></div>
                </div>
                <!-- 多说评论框 end -->
            </div>
        </div>

        <aside class="sidebar">
        @include('dux.public.right_recommend_article')

        @include('dux.public.right_hot_article')

        <!-- 最新评论 start -->
            <div class="widget widget_ui_comments">
                <h3>最新评论</h3>
                <ul class="ds-recent-comments"  data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"><ul></ul></ul>
            </div>
            <!-- 最新评论 end -->

            @if(isset($usedTags) && $usedTags)
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
            <div class="widget widget_ui_readers">
                <h3>最近访客</h3>
                <ul class="ds-recent-visitors" data-num-items="20" ></ul>
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
