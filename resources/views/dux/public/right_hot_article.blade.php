@if(isset($hotArticle) && $hotArticle && $hotArticle->count() > 0)
    <div class="widget widget_ui_posts">
        <h3>热门文章</h3>
        <ul>
            @foreach($hotArticle as $item)
                <li>
                    <span class="thumbnail">
                        <a href="{{url('archives/'.$item->id)}}" target="_blank">
                            @if($item->thumb)
                                <img src="{{asset($item->thumb)}}" alt="" class="thumb transitionAll">
                            @elseif ($item->category[0]->thumb)
                                <img src="{{asset($item->category[0]->thumb)}}" alt="" class="thumb transitionAll">
                            @endif
                        </a>
                    </span>
                    <span class="text"><a target="_blank" href="{{url('archives/'.$item->id)}}">{{$item->name}}</a></span>
                    <span class="muted"><i class="fa fa-clock-o"></i> {{date('Y-m-d', $item->publish_time)}}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif