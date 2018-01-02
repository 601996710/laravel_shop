@extends("layouts.index")
@section("content")
    <header id="header-web">
        <div class="header-main"> <a href="/" class="logo2 "  rel="home"><img src="{{ asset("images/logo.png") }}" alt="新疆风物LOGO"></a>

            <nav class="header-nav2 ">
                <div class="menu-container">
                    <ul id="menu" class="menu">
                        <li  class="menu-item menu-item-type-custom menu-item-object-custom ">
                            <a href="{{ url("a/7") }}">旅游攻略</a>
                        </li>
                        <li  class="menu-item menu-item-type-custom menu-item-object-custom ">
                            <a href="{{ url("a/8") }}">名俗文化</a>
                        </li>
                        <li   class="menu-item menu-item-type-custom menu-item-object-custom ">
                            <a href="{{ url("a/9") }}">精选美食</a>
                        </li>
                        <li i  class="menu-item menu-item-type-custom menu-item-object-custom">
                            <a href="{{ url("a/10") }}">娱乐活动</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--header-web-->
    <div id="container-page">
        <article class="box">
            <header class="pagetitle">
                <h1 class="p3">
                    {{ $data['title']  }}
                </h1>
                <p class="p2">
                    {{ str_replace("-",".",substr($data['created_at'],0,10)) }}
                </p>
                <!--msccaddress-->
            </header>
            <div class="content-text">
                {!!   $data['content'] !!}
            </div>
            <!--content_text-->
            @if(!empty($randArticle))
            <div class="xianguan">
                <div class="xianguantitle">随机热文！</div>
                <ul class="pic">
                    @foreach($randArticle as $v)
                    <li>
                        <a href="{{ url("show/$v[id]") }}"  >
                            <img src="{{ Storage::url($v['image']) }}" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                        </a>
                        <a rel="bookmark" href="{{ url("show/$v[id]") }}" class="link" >
                            {{$v['title']}}
                        </a>
                        <address class="xianaddress">
                            <time>
                                {{ str_replace("-",".",substr($v['created_at'],0,10)) }}     </time>
                            -
                            阅
                            {{$v['view']}}
                        </address>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!--相关文章-->
        </article>
        <!--相关文章-->
    </div>

@endsection