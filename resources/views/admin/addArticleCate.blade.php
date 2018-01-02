@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}分类</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span6">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}分类</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("admin/saveEditArticleCate"):url("admin/saveArticleCate")}}" method="post" class="form-horizontal">

                            {{csrf_field()}}

                            @isset($op)
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            @endisset
                            @isset($pdata['id'])
                            <input type="hidden" name="pid" value="{{$pdata['id']}}" />
                            @endisset
                            <div class="control-group">

                                <label class="control-label">名称 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['name'] or ''}}" name="name" placeholder="导航名称" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">描述：</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['description'] or ''}}"  name="description" placeholder="描述" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">排序：</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['sort'] or ''}}"  name="sort" placeholder="排序 从小到大" />

                                </div>

                            </div>
                            @isset($data['pid'])

                            <div class="control-group">

                                <label class="control-label">上级：</label>

                                <div class="controls" >

                                        <select name="pid">
                                            <option value="0">请选择</option>
                                            @if(!empty($all))
                                            @foreach($all as $v)
                                                <option value="{{$v['id']}}"  @if($v['id'] == $data['id'])selected @endif >{{$v['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                </div>

                            </div>

                            @endisset



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