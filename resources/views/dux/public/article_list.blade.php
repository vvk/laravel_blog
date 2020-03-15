<!-- 文章 start -->
<div class="article-list">
    @foreach($data as $item)
        <article class="excerpt">
            @if($options->get('list_show_article_thumb') == 1)
                <a class="focus" href="{{url('archives/'.$item->id)}}" target="_blank">
                    <div style="transitionAll-box">
                        @if($item->thumb)
                            <img src="{{asset('static/image/grey.gif')}}" data-original="{{asset($item->thumb)}}" class="thumb lazy transitionAll" alt="">
                        @elseif($item->category[0]->thumb)
                            <img src="{{asset('static/image/grey.gif')}}" data-original="{{asset($item->category[0]->thumb)}}"  class="thumb lazy transitionAll" alt="">
                        @else
                            <img src="{{asset('static/image/grey.gif')}}" data-original="{{asset('static/image/img_error.png')}}"  class="thumb lazy transitionAll" alt="">
                        @endif
                    </div>
                </a>
            @endif
            <div>
                <header>
                    <a class="cat" href="{{url('category/'.$item->category[0]->id)}}">{{$item->category[0]->name}}<i></i></a>
                    <h2>
                        <a href="{{url('archives/'.$item->id)}}" title="" target="_blank">{{$item->name}}</a>
                    </h2>
                </header>
                <p class="meta">
                    <time><i class="fa fa-clock-o"></i>{{date('Y-m-d', $item->publish_time)}}</time>
                    <span class="author"><i class="fa fa-user"></i>sunwq</span>
                    <span class="author"><i class="fa fa-eye"></i>{{$item->view_count}}</span>
                    @if(articleHasImg($item->content))
                        <span class="author"><i class="fa fa-picture-o"></i></span>
                    @endif
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