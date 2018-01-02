@extends("layouts.admin")
@section("content")

    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}投票内容</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span6">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}投票内容</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("admin/saveEditVoteInfo"): url("admin/saveVoteInfo") }}" method="post" class="form-horizontal" id="aform">
                            <input type="hidden" value="" name="content"/>
                            {{csrf_field()}}

                            <input type="hidden" name="vote_id" value="{{$id}}" />
                            @isset($op)
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            @endisset

                            <div class="control-group">

                                <label class="control-label">类型 :</label>

                                <div class="controls">
                                    <select name="vote_type" class="span6" >
                                        <option value="1" @if(!empty($data['type']) && $data['type'] == 1)selected @endif > 单选 </option>
                                        <option value="2" @if(!empty($data['type']) && $data['type'] == 2)selected @endif> 多选 </option>
                                        <option value="3" @if(!empty($data['type']) && $data['type'] == 3)selected @endif> 单行文本 </option>
                                        <option value="4" @if(!empty($data['type']) && $data['type'] == 4)selected @endif > 多行文本 </option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label">标题 :</label>

                                <div class="controls">

                                    <input type="text" class="span6"  value="{{$data['name'] or ''}}" name="name" placeholder="标题" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">排序 :</label>

                                <div class="controls">

                                    <input type="text" class="span6"  value="{{$data['sort'] or ''}}" name="sort" placeholder="排序" />

                                </div>

                            </div>

                            @if(!empty($data['info']))
                            @foreach($data['info'] as $v)
                            <div class="control-group one @if($data['type'] == 3 || $data['type'] == 4) hide @endif" >

                                <label class="control-label">选项 :</label>

                                <div class="controls">

                                    <input type="text" class="span6" value="{{$v or ''}}"  name="data[]" placeholder="选项"  /> <a href="javascript:void(0)" class="btn btn-info" id="addOne" >增加选项</a>

                                </div>

                            </div>
                            @endforeach
                            @else
                                <div class="control-group one " >

                                    <label class="control-label">选项 :</label>

                                    <div class="controls">

                                        <input type="text" class="span6" value=""  name="data[]" placeholder="选项"  /> <a href="javascript:void(0)" class="btn btn-info" id="addOne" >增加选项</a>

                                    </div>

                                </div>
                            @endif


                            <div class="form-actions">

                                <button type="submit" class="btn btn-success">保存</button>

                            </div>

                        </form>

                    </div>

                </div>


            </div>


        </div>

    </div>

    <style>
        #sum .modal{
            display: none;
        }
    </style>


    <script>
        $(function() {
            $("#addOne").click(function(){
                var html = '<div class="control-group one"> ' +
                                '<label class="control-label">选项 :</label>' +
                                '<div class="controls">' +
                                '<input type="text" class="span6" value=""  name="data[]" placeholder="选项"  /> <a href="javascript:void(0)" class="btn btn-danger delOne" >删除选项</a>' +
                                '</div>' +
                            '</div>';
                $(".one:last").after(html);
            })
            $("#aform").on("click",".delOne",function(){
                $(this).parents(".one").remove();
            })

            $("select[name='vote_type']").change(function(){
                var val = $(this).val();

                switch(val){
                    case "1":
                         $(".one").show();
                         $("#addOne").show();
                        break;
                    case "2":
                         $(".one").show();
                         $("#addOne").show();
                        break;
                    case "3":
                        $(".one").hide();
                        $("#addOne").hide();
                        break;
                    case "4":
                        $(".one").hide();
                        $("#addOne").hide();
                    break;
                }

            })

        })
    </script>
@endsection

