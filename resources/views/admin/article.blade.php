@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">文章管理</a> </div>
    </div>


    <div class="container-fluid">

        <div class="widget-box">

            <div class="widget-content">

                <ol>
                    <li>文章管理</li>
                </ol>
            </div>

        </div>


        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> </span>
                        <h5>文章管理</h5>
                        <div class="buttons">
                            <a href="{{ url('/admin/addArticle') }}" class="btn btn-primary btn-mini"><i class="icon-plus icon-white"></i> 添加文章 </a></div>

                    </div>


                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: left" >序号</th>
                                <th style="text-align: left" >名称</th>
                                <th style="text-align: left" >链接</th>
                                <th style="text-align: left" >排序</th>
                                <th style="text-align: left" >封面</th>
                                <th style="text-align: left"  >操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data))
                            @foreach($data as $key=> $val)
                                <tr class="even gradeA">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val['title'] }}</td>
                                    <td>{{ $val['link'] }}</td>
                                    <td>{{ $val['sort'] }}</td>
                                    <td><a href="{{ Storage::url($val['image']) }}" target="_blank"><img src="{{ Storage::url($val['image']) }}" style="max-height:40px;max-width:40px;" /></a> </td>
                                    <td>
                                        <a href="{{url("admin/editArticle/$val[id]")}}">
                                            <button class="btn btn-info">
                                                编辑
                                            </button>
                                        </a>
                                        <a href="javascript:if(confirm('确认删除？')){
                                        window.location.href = '{{url("admin/delArticle/$val[id]")}}'
                                        }">
                                            <button class="btn btn-inverse">
                                                删除
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>

                @if(!empty($data))
                <div class="pagination ">
                    {!! $data->links() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection