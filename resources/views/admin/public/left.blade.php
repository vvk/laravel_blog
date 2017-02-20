<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header" style="padding: 10px 25px">
                <div class="dropdown profile-element">
                    <a href="{{url('admin')}}">
                        <img class="img-circle rotation3" src="{{asset('static/image/logo.png')}}" style="width: 65px" />
                    </a>
                </div>
                <div class="logo-element"><img class="img-circle rotation3" src="{{asset('static/image/logo.png')}}" style="width: 25px" /></div>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span class="nav-label">文章管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{asset('admin/article')}}" target="content">文章列表</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/category')}}" target="content">分类管理</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/tag')}}" target="content">标签管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span class="nav-label">系统设置</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{asset('admin/banner')}}" target="content">轮播图</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/link')}}" target="content">友情链接</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>