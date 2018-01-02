@extends("layouts.admin")
@section("content")

    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}管理员</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span6">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}管理员</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("admin/saveEditAdmin"): url("admin/saveAdmin") }}" method="post" class="form-horizontal" >
                            <input type="hidden" value="" name="content"/>
                            {{csrf_field()}}

                            @isset($op)
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            @endisset

                            <div class="control-group">

                                <label class="control-label">管理员邮箱 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['email'] or ''}}" name="email" placeholder="管理员邮箱" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">管理员名称 :</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['name'] or ''}}"  name="name" placeholder="管理员名称" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">管理员密码 :</label>

                                <div class="controls">

                                    <input type="password" class="span11" value=""  name="passwd" placeholder="管理员密码" />

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

