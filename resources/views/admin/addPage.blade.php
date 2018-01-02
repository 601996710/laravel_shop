@extends("layouts.admin")
@section("content")

    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}页面</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span12">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}页面</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("admin/saveEditPage"): url("admin/savePage") }}" method="post" class="form-horizontal" id="article_form">
                            <input type="hidden" value="" name="content"/>
                            {{csrf_field()}}

                            @isset($op)
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            @endisset 
                            <div class="control-group">

                                <label class="control-label">页面标题 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['title'] or ''}}" name="title" placeholder="页面标题" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">关键词 :</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['keyword'] or ''}}"  name="keyword" placeholder="关键词" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">描述 :</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['description'] or ''}}"  name="description" placeholder="描述" />

                                </div>

                            </div>


                            <div class="control-group">

                                <label class="control-label">页面详情：</label>

                                <div class="controls" id="sum" style="padding-right: 20px;">

                                    <div class="summernote" ></div>

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

    <style>
        #sum .modal{
            display: none;
        }
    </style>


    <script>
        $(function(){

        $('.summernote').summernote({
            minHeight: 200,
            height: 300,
            tabsize: 1,
            lang: 'zh-CN',
            callbacks : {
                onImageUpload : function(files) {
                    var file = files[0];
                    var filename = false;
                    try{
                        filename = file['name'];
                    } catch(e){
                        filename = false;
                    }

                    //以上防止在图片在编辑器内拖拽引发第二次上传导致的提示错误
                    var data = new FormData();
                    data.append("file", file);
                    data.append("_token", "{{csrf_token()}}");
                    $.ajax({
                        data: data,
                        type: 'post',
                        dataType:'json',
                        url: "{{url("/admin/editUploadImg")}}",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('.summernote').summernote('insertImage', data.image);
                        },
                        error:function(){
                            alert("上传失败！");
                            return;
                        }
                    });
                }
            }
        });
            var text = '{!! $data['content'] or '' !!}';
            //
            $('.summernote').summernote("code",text);


           $("#article_form").submit(function(){
                $("input[name='content']").val( $('.summernote').summernote("code"));
        })


    })
    </script>
@endsection

