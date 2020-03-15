<!-- 推荐文章 start -->
@if(isset($recommendArticle) && $recommendArticle && $recommendArticle->count() > 0)
    <div class="widget widget_ui_posts">
        <h3>置顶推荐</h3>
        <ul>
            @foreach($recommendArticle as $item)
                <li>
                    @if($options->get('list_show_article_thumb') == 1)
                        <span class="thumbnail">
                            <a href="{{url('archives/'.$item->id)}}">
                                @if($item->thumb)
                                    <img src="{{asset($item->thumb)}}" class="thumb lazy transitionAll" alt="">
                                @elseif($item->category[0]->thumb)
                                    <img src="{{asset($item->category[0]->thumb)}}" class="thumb lazy transitionAll" alt="">
                                @else
                                    <img src="{{asset('static/image/img_error.png')}}" class="thumb lazy transitionAll" alt="">
                                @endif
                            </a>
                        </span>
                    @endif
                    <span class="text"><a href="{{url('archives/'.$item->id)}}">{{$item->name}}</a></span>
                    <span class="muted"><i class="fa fa-clock-o"></i> {{date('Y-m-d', $item->publish_time)}}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
<!-- 推荐文章 end -->