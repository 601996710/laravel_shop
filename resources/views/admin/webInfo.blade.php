@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">网站设置</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span6">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5> 网站设置 </h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ url("/admin/saveWebInfo") }}" method="post" class="form-horizontal">

                            {{csrf_field()}}

                            <div class="control-group">

                                <label class="control-label">网站名称 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['webName'] or ''}}" name="webName" placeholder="网站名称" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">description :</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['description'] or ''}}"  name="description" placeholder="网站描述" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">keyword：</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['keyword'] or ''}}"  name="keyword" placeholder="关键词" />

                                </div>

                            </div>

                            <div class="form-actions">

                                <button type="submit" class="btn btn-success">保存</button>

                            </div>

                        </form>

                    </div>

                </div>


            </div>


        </div>

    </div>
@endsection