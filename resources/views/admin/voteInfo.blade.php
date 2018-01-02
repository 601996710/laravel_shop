@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="{{ url("admin/vote") }}"  >投票列表</a> <a href="#" class="current">投票管理</a> </div>
    </div>


    <div class="container-fluid">

        <div class="widget-box">

            <div class="widget-content">

                <ol>
                    <li>投票管理</li>
                </ol>
            </div>

        </div>


        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> </span>
                        <h5>投票管理</h5>
                        <div class="buttons">
                            <a href="{{ url("/admin/addVoteInfo/$vid") }}" class="btn btn-primary btn-mini"><i class="icon-plus icon-white"></i> 添加内容 </a></div>

                    </div>


                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: left" >序号</th>
                                <th style="text-align: left" >问题</th>
                                <th style="text-align: left" >类型</th>
                                <th style="text-align: left" >排序</th>
                                <th style="text-align: left" >操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data))
                            @foreach($data as $key=> $val)
                                <tr class="even gradeA">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val['name'] }}</td>
                                    <td>
                                        @if($val['type'] == 1)单选
                                        @elseif($val['type'] == 2)多选
                                        @elseif($val['type'] == 3)单行文本
                                        @elseif($val['type'] == 4)多行文本
                                        @endif
                                    </td>
                                    <td>{{ $val['sort'] }}</td>
                                    <td>

                                        <a href="{{url("admin/editVoteInfo/$val[id]/$vid")}}">
                                            <button class="btn btn-info">
                                                编辑
                                            </button>
                                        </a>

                                        <a href="javascript:if(confirm('确认删除？')){
                                        window.location.href = '{{url("admin/delVoteInfo/$val[id]/$vid")}}'
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