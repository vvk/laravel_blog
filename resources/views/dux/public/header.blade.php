<header class="header">
    <div class="container">
        <h1 class="logo">
            <a href="{{url('')}}" title=""><img src="{{asset('static/image/logo.png')}}"></a>
        </h1>
        <div class="brand">我不生产代码<br>我只是代码的搬运工</div>
        <ul class="site-nav site-navbar">
            <li class="">
                <a href="{{url('/')}}"><i class="fa fa-home"></i> 首页</a>
            </li>
            <li class="">
                <a href="{{url('category/1')}}"><i class="fa fa-code"></i> PHP</a>
            </li>
            <li class="">
                <a href="{{url('figure-bed')}}"><i class="fa fa-image"></i> 图床</a>
            </li>
            <li class="navto-search">
                <a href="javascript:;" class="search-show active"><i class="fa fa-search"></i></a>
            </li>
        </ul>
        <div class="topbar">
            <ul class="site-nav topmenu">
                <li class="menusns">
                    <a href="javascript:;">关注本站 <i class="fa fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li>
                            <a class="sns-wechat" href="javascript:;" title="我的微信公众帐号" data-src="{{asset('static/image/weixin-qrcode.jpg')}}">
                                <i class="fa fa-wechat"></i> 微信
                            </a>
                        </li>
                        <li>
                            <a rel="external nofollow" title="sunwq@sviping.com" href="mailto:sunwq@sviping.com">
                                <i class="fa fa-envelope-o"></i> 邮箱
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <i class="fa fa-bars m-icon-nav"></i>
    </div>
</header>

<!-- 搜索表单 start -->
<div class="site-search">
    <div class="container">
        <form method="get" class="site-search-form" action="{{url('/')}}">
            <input class="search-input" name="s" type="text" placeholder="输入关键字" value="">
            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!-- 搜索表单 end -->