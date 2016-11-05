<!-- 文章 start -->
<div class="article-list">
    @foreach($data as $item)
        <article class="excerpt">
            <a class="focus" href="{{url('archives/'.$item->id)}}" target="_blank">
                <div style="transitionAll-box">
                    @if($item->thumb)
                        <img src="{{asset('static/image/grey.gif')}}" data-original="{{asset($item->thumb)}}" class="thumb lazy transitionAll" alt="">
                    @elseif($item->category->thumb)
                        <img src="{{asset('static/image/grey.gif')}}" data-original="{{asset($item->category->thumb)}}" class="thumb lazy transitionAll" alt="">
                    @endif
                </div>
            </a>
            <div>
                <header>
                    <a class="cat" href="{{url('category/'.$item->category->id)}}">{{$item->category->name}}<i></i></a>
                    <h2>
                        <a href="{{url('archives/'.$item->id)}}" title="" target="_blank">{{$item->name}}</a>
                    </h2>
                </header>
                <p class="meta">
                    <time><i class="fa fa-clock-o"></i>{{date('Y-m-d', $item->publish_time)}}</time>
                    <span class="author"><i class="fa fa-user"></i>sunwq</span>
                    {{--<a class="pc" href=""><i class="fa fa-comments-o"></i>评论(0)</a>--}}
                </p>
                <p class="note">
                    @if($item->description)
                        {{$item->description}}
                    @else
                        {{str_limit(str_replace(array('&nbsp;', "\r\n", "\r", "\n"), '', strip_tags($item->content)), 270)}}
                    @endif
                </p>
            </div>
        </article>
    @endforeach
</div>
<!-- 文章 end -->

<div class="pagination">
    {!! $page !!}
</div>