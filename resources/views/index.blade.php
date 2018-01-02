@extends("layouts.index")
@section("content")

    <header id="header-web">
        <div class="header-main"> <a href="/" class="logo " title="LOGO" rel="home"><img src="{{ asset("images/logo.png") }}" alt="新疆风物LOGO"></a>
            <nav class="header-nav ">
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
    <!--幻灯片-->
    @if(!empty($banner))
    <div class="hmFocus">
        <div class="swiper-container autoImg">
            <div class="swiper-wrapper">
                @foreach($banner as $v)
                <div class="swiper-slide"> <a href="{{ $v['link'] or "#" }}"  ><img src="{{ Storage::url($v['image']) }}" 　alt=""></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @endif
    <script language="javascript">
        var swiper = new Swiper('.hmFocus .swiper-container', {
            pagination: '.swiper-pagination',
            loop: true,
            autoplay: 5500,
            paginationClickable: true
        });
    </script>
    <div id="container-page">
        <article class="box2">
            @foreach($article as $v)
                @if(!empty($v['image']))
                    <section class="list">
            <span class="titleimg">
                <a href="{{ url("show/$v[id]") }}"  >
                    <img   src="{{ Storage::url($v['image']) }}" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">  </a>
            </span>
                        <div class="mecc">
                            <h2 class="mecctitle">
                                <a href="{{ url("show/$v[id]") }}" >
                                    {{$v['title']}}
                                </a>
                            </h2>
                            <time>
                                {{ str_replace("-",".",substr($v['created_at'],0,10)) }} -
                                阅
                                {{$v['view']}}
                            </time>
                        </div>
                        <div class="clear"></div>
                    </section>
                    @endif
                    @endforeach
                            <!--list-->
                    <div class="clear"></div>
                    {{$article->links("index_page")}}

        </article>
        <div class="clear"></div>
    </div>

@endsection