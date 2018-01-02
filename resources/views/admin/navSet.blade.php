@extends("layouts.admin")
@section("content")
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">导航设置</a> </div>
        </div>


        <div class="container-fluid">

            <div class="widget-box">



                <div class="widget-content">

                    <ol>
                        <li>导航最多添加三级</li>
                    </ol>
                </div>

            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> </span>
                            <h5>导航设置</h5>
                            <div class="buttons">
                                <a href="{{ url('/admin/addNav') }}" class="btn btn-primary btn-mini"><i class="icon-plus icon-white"></i> 添加新的导航 </a></div>

                        </div>


                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="text-align: left" >序号</th>
                                    <th style="text-align: left" >名称</th>
                                    <th style="text-align: left" >链接</th>
                                    <th style="text-align: left" >排序</th>
                                    <th style="text-align: left"  >操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key=> $val)
                                <tr class="even gradeA">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val['name'] }}</td>
                                    <td>{{ $val['link'] }}</td>
                                    <td>{{ $val['sort'] }}</td>
                                    <td>
                                        <a href="{{url("admin/addSonNav/$val[id]")}}">
                                            <button class="btn btn-danger">
                                            新增子导航
                                            </button>
                                        </a>
                                        <a href="{{url("admin/editNav/$val[id]")}}">
                                            <button class="btn btn-info">
                                            编辑
                                            </button>
                                        </a>
                                        <a href="javascript:if(confirm('确认删除？')){
                                        window.location.href = '{{url("admin/delNav/$val[id]")}}'
                                        }">
                                            <button class="btn btn-inverse">
                                                删除
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="pagination ">
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>


@endsection