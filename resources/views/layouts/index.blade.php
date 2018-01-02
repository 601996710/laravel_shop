<!DOCTYPE html>
<html>
<head>
    <title>新疆风物 - 新疆风情 </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <meta name="description" content="{{ $web_info["description"] }}">
    <meta name="keywords" content="{{ $web_info["keyword"] }}">

    <link rel='stylesheet' id='sytle-css' href='{{ asset('css/style.css') }}' type='text/css' media='all'>
    <link rel='stylesheet' id='sytle-css' href='{{ asset('css/gardenl-pc.css') }}' type='text/css' media='all'>
    <link rel='stylesheet' id='sytle-css' href='{{ asset('css/gardenl-phone.css') }}' type='text/css' media='all'>

    <script type='text/javascript' src='{{ asset('js/html5shiv.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/selectivizr-min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/swiper.min.js') }}'></script>

</head>
<body>
@yield("content")
<footer id="dibu">
    <div class="dibu-main">
        <div class="bleft">
              <div class="bottom"> © 2018
                    新疆风物
                </div>
        </div>
        <div class="bottomlist">
            <div class="weixin2">
                <div class="weixin"><span>公众号 : xjfww369</span> <img src="{{ asset("images/weixin.png") }}"  title="微信公众号"> <img src="{{ asset("images/weixin.jpg") }}" class="xixii" alt=""></div>
            </div>
        </div>
    </div>

    <div class="off">
        <div class="scroll" id="scroll" style="display:none;"> ︿ </div>
    </div>
    <script type="text/javascript">
        $(function(){
            showScroll();
            function showScroll(){
                $(window).scroll( function() {
                    var scrollValue=$(window).scrollTop();
                    scrollValue > 500 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
                } );
                $('#scroll').click(function(){
                    $("html,body").animate({scrollTop:0},200);
                });
            }
        })
    </script>
</footer>
<!--dibu-->
</body></html>