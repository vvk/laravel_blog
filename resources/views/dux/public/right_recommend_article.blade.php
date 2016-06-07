<!-- 推荐文章 start -->
@if($recommendArticle)
    <div class="widget widget_ui_posts">
        <h3>置顶推荐</h3>
        <ul>
            @foreach($recommendArticle as $item)
                <li>
                    <span class="thumbnail">
                        <a href="{{url('archives/'.$item->id)}}">
                            @if($item->thumb)
                                <img src="{{asset($item->thumb)}}" class="thumb lazy transitionAll" alt="">
                            @elseif($item->category->thumb)
                                <img src="{{asset($item->category->thumb)}}" class="thumb lazy transitionAll" alt="">
                            @endif
                        </a>
                    </span>
                    <span class="text"><a href="{{url('archives/'.$item->id)}}">{{$item->name}}</a></span>
                    <span class="muted"><i class="fa fa-clock-o"></i> {{date('Y-m-d', $item->publish_time)}}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
<!-- 推荐文章 end -->