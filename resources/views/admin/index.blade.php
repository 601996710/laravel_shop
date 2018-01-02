@extends('layouts.admin')
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("/admin/welcome") }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
                            <h5>系统介绍</h5>
                        </div>
                        <div class="widget-content">
                            laravel cms 可以加快网站开发的速度和减少开发的成本。
                        </div>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
                        <h5>制作人员</h5>
                    </div>
                    <div class="widget-content">
                       xx 联系qq 601996710
                    </div>
                </div>
            </div>
        </div>

@endsection