<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header" style="padding: 10px 25px">
                <div class="dropdown profile-element">
                    <a href="{{url('admin')}}">
                        <img class="img-circle" src="{{asset('static/img/profile.jpg')}}" style="width: 65px" />
                    </a>
                    <a href="{{url('admin/user/logout')}}" class="logout glyphicon glyphicon-log-out" style="margin-left: 15px" title="退出"></a>
                </div>
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
                        <a href="{{asset('admin/article/add')}}" target="content">写文章</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-columns"></i>
                    <span class="nav-label">分类管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{asset('admin/category')}}" target="content">分类列表</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/category/add')}}" target="content">添加分类</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span class="nav-label">标签管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{asset('admin/tag')}}" target="content">标签列表</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/tag/add')}}" target="content">添加标签</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-link"></i>
                    <span class="nav-label">友情链接管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{asset('admin/link')}}" target="content">友情链接列表</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/link/add')}}" target="content">友情链接标签</a>
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
                        <a href="{{asset('admin/option/index/1')}}" target="content">基本设置</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/option/index/2')}}" target="content">显示设置</a>
                    </li>
                    <li>
                        <a href="{{asset('admin/option/option')}}" target="content">配置列表</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>