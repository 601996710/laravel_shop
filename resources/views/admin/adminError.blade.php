@extends("layouts.admin")
@section("content")

        <div id="content-header">
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a>  <a href="#" class="current">消息提示</a> </div>

        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>消息提示</h5>
                        </div>
                        <div class="widget-content">
                            <div class="error_ex">

                                <h3>{!! $error !!}</h3>
                                <p></p>
                                <a class="btn btn-warning btn-big"  href="{{url("admin/welcome")}}">返回首页</a>
                                <a class="btn btn-danger btn-big"  href="javascript:history.go(-1)">返回上一页</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection