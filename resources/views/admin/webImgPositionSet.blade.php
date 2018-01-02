@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="{{ url("admin/webImgSet") }}"  >{{ $name }}</a>  <a href="#" class="current">幻灯片</a> </div>
    </div>


    <div class="container-fluid">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> </span>
                        <h5>{{ $name }}幻灯片</h5>
                        <div class="buttons">
                            <a href="{{ url('/admin/addWebImagesPosition',$id) }}" class="btn btn-primary btn-mini"><i class="icon-plus icon-white"></i> 添加新幻灯片 </a></div>

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
                            @isset($data)
                            @foreach($data as $key=> $val)
                                <tr class="even gradeA">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val['name'] }}</td>
                                    <td>{{ $val['link'] }}</td>
                                    <td>{{ $val['sort'] }}</td>
                                    <td>
                                        <a href="{{url("admin/editWebImagesPosition/$val[id]")}}">
                                            <button class="btn btn-info">
                                                编辑
                                            </button>
                                        </a>
                                        <a href="javascript:if(confirm('确认删除？')){
                                        window.location.href = '{{url("admin/delImagePosition/$val[id]")}}'
                                        }">
                                            <button class="btn btn-inverse">
                                                删除
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>

                </div>

                @isset($data)
                <div class="pagination ">
                    {!! $data->links() !!}
                </div>
                @endisset
            </div>
        </div>
    </div>
@endsection