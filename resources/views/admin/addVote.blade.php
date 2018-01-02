@extends("layouts.admin")
@section("content")

    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}投票</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span12">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}投票</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("admin/saveEditVote"): url("admin/saveVote") }}" method="post" class="form-horizontal" id="article_form">
                            <input type="hidden" value="" name="content"/>
                            {{csrf_field()}}

                            @isset($op)
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            @endisset

                            <div class="control-group">

                                <label class="control-label">名称 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['name'] or ''}}" name="name" placeholder="请输入名称" />

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

