<!DOCTYPE html>
<html lang="en">
<head>
    <title>后台管理</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{url("/admin/css/bootstrap.min.css")}}" />
    <link rel="stylesheet" href="{{url("/admin/css/matrix-style.css")}}" />
    <link rel="stylesheet" href="{{url("/admin/css/matrix-media.css")}}" />
    <link rel="stylesheet" href="{{url("/admin/font-awesome/css/font-awesome.css")}}" />
    <link rel="stylesheet" href="{{url("/admin/css/summernote.css")}}" />


    <script src="{{url("/admin/js/excanvas.min.js")}}"></script>
    <script src="{{url("/admin/js/jquery.min.js")}}"></script>
    <script src="{{url("/admin/js/bootstrap.min.js")}}"></script>
    <script src="{{url("/admin/js/matrix.js")}}"></script>

    <script src="{{url("/admin/js/ajaxfileupload.js")}}"></script>


    <script src="{{url("/admin/js/summernote/summernote.js")}}"></script>
    <script src="{{url("/admin/js/summernote/lang/summernote-zh-CN.js")}}"></script>


</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="{{ url('/admin/welcome') }}">后台管理</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse ">
    <ul class="nav">
        <li  class="dropdown" id="profile-messages" >
            <a   href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text"> {{ auth('admin')->user()->name }}</span></a>

        </li>
        <li class=""><a href="{{ url('/admin/logout') }}"><i class="icon icon-share-alt"></i> <span class="text">退出登录</span></a></li>
    </ul>
</div>

<!--sidebar-menu-->

<div id="sidebar">
    <ul>
        <li >
            <a href="{{ url('/admin/welcome') }}"><i class="icon icon-home"></i> <span>欢迎界面</span></a>
        </li>

        <li class="submenu">
            <a href="#"><i class="icon icon-cog"></i> <span>设置</span></a>
            <ul>
                <li><a href="{{ url('/admin/webInfo') }}">网站信息</a></li>
                <li><a href="{{ url('/admin/navSet') }}">导航设置</a></li>
                <li><a href="{{ url('/admin/webImgSet') }}">幻灯片设置</a></li>
                <li><a href="{{ url('/admin/webLinkSet') }}">友情链接</a></li>
            </ul>
        </li>

        <li class="submenu"> <a href="#"><i class="icon icon-list"></i> <span>信息管理</span></a>
            <ul>
                <li><a href="{{ url('/admin/article') }}">文章管理</a></li>
                <li><a href="{{ url('/admin/articleCate') }}">文章分类</a></li>
                <li><a href="{{ url('/admin/page') }}">页面管理</a></li>
                <li><a href="{{ url('/admin/vote') }}">投票管理</a></li>
                <li><a href="{{ url('/admin/message') }}">留言管理</a></li>
            </ul>
        </li>

        <li class="submenu"> <a href="#"><i class="icon icon-user-md"></i> <span>用户管理</span></a>
            <ul>
                <li><a href="{{ url('/admin/webUser') }}">用户管理</a></li>
            </ul>
        </li>


        <li class="submenu"> <a href="#"><i class="icon icon-cogs"></i> <span>其他设置</span></a>
            <ul>
                <li><a href="{{ url('/admin/adminSet') }}">管理员设置</a></li>
            </ul>
        </li>

    </ul>
</div>

<div id="content">
    @yield("content")
</div>
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2018 &copy; laravel cms by xx </div>
</div>
<!--end-Footer-part-->

<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>
</body>
</html>
