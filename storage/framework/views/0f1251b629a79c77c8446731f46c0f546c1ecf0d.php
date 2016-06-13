<header class="header">
    <div class="container">
        <h1 class="logo">
            <a href="<?php echo e(url('')); ?>" title=""><img src="<?php echo e(asset('static/image/logo.png')); ?>">DUX主题演示</a>
        </h1>
        <div class="brand">我不生产代码<br>我只是代码的搬运工</div>
        <ul class="site-nav site-navbar">
            <li class="">
                <a href=""><i class="fa fa-home"></i> 首页</a>
            </li>
            <li class="">
                <a href="<?php echo e(url('category/2')); ?>"><i class="fa fa-code"></i> PHP</a>
            </li>

            <?php /*<li class="current-menu-item">
                <a href=""><i class="fa fa-plug"></i> 科技</a>
            </li>
            <li class="">
                <a href=""><i class="fa fa-tablet"></i> 移动</a>
            </li>
            <li class=""><a href="">
                    <i class="fa fa-money"></i>  融资</a>
            </li>
            <li class="">
                <a><i class="fa fa-file-text-o"></i> 独立页面</a>
                <ul class="sub-menu">
                    <li><a href="link.html">友情链接</a></li>
                    <li><a href="archives.html">页面存档</a></li>
                    <li><a href="readers.html">读者墙</a></li>
                    <li><a href="no-sidebar.html">无边栏页面</a></li>
                    <li><a href="tag.html">标签云</a></li>
                </ul>
            </li>*/ ?>
            <li class="navto-search">
                <a href="javascript:;" class="search-show active"><i class="fa fa-search"></i></a>
            </li>
        </ul>
        <div class="topbar">
            <ul class="site-nav topmenu">
                <?php /*<li><a href="tag.html">标签云</a></li>*/ ?>
                <?php /*<li><a href="">读者墙</a></li>*/ ?>
                <?php /*<li><a href="archives.html">页面存档</a></li>*/ ?>
                <?php /*<li><a href="link.html">友情链接</a></li>*/ ?>
                <li class="menusns">
                    <a href="javascript:;">关注本站 <i class="fa fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li>
                            <a class="sns-wechat" href="javascript:;" title="我的微信公众帐号" data-src="<?php echo e(asset('static/image/weixin-qrcode.jpg')); ?>">
                                <i class="fa fa-wechat"></i> 微信
                            </a>
                        </li>
                        <li>
                            <a target="_blank" rel="external nofollow" href="http://www.weibo.com/1306149274">
                                <i class="fa fa-weibo"></i> 微博
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
            <?php /*<a href="javascript:;" class="signin-loader">Hi, 请登录</a>&nbsp; &nbsp;
            <a href="javascript:;" class="signup-loader">我要注册</a>&nbsp; &nbsp;
            <a href="">找回密码</a>*/ ?>
        </div>
        <i class="fa fa-bars m-icon-nav"></i>
    </div>
</header>

<!-- 搜索表单 start -->
<div class="site-search">
    <div class="container">
        <form method="get" class="site-search-form" action="<?php echo e(url('/')); ?>">
            <input class="search-input" name="s" type="text" placeholder="输入关键字" value="">
            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!-- 搜索表单 end -->