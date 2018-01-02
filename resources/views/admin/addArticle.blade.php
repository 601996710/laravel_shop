@extends("layouts.admin")
@section("content")

    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}文章</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span10">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}文章</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("admin/saveEditArticle"): url("admin/saveArticle") }}" method="post" class="form-horizontal" id="article_form" enctype="multipart/form-data" >
                            <input type="hidden" value="" name="content"/>
                            {{csrf_field()}}

                            @isset($op)
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            @endisset
                            @if(!empty($cate))
                            <div class="control-group">

                                <label class="control-label">文章分类 :</label>

                                <div class="controls">
                                    <select name="cate_id">

                                        <option value="">请选择</option>
                                        @foreach($cate as $v)
                                        <option value="{{$v['id']}}"  @if(!empty($op) && $v['id'] == $data['cate_id'])
                                        selected
                                                @endif>{{$v['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            @endif
                            <div class="control-group">

                                <label class="control-label">文章标题 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['title'] or ''}}" name="title" placeholder="文章标题" />

                                </div>

                            </div>


                            <div class="control-group">

                                <label class="control-label">封面：</label>

                                <div class="controls">

                                    <input type="file" class="span11" value="{{$data['sort'] or ''}}"  name="file"  onchange="preview(this)"  />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"></label>

                                <div class="controls" id="preview">
                                    @isset($data)
                                    <img src="{{ Storage::url($data['image']) }}" />
                                    @endisset
                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">关键词 :</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['keyword'] or ''}}"  name="keyword" placeholder="关键词" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">跳转链接 :</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['link'] or ''}}"  name="link" placeholder="链接 例如 http://www.baidu.com 则文章内容则无效 点击该文章则直接跳转" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">排序：</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['sort'] or '1'}}"  name="sort" placeholder="排序 从小到大" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">文章详情：</label>

                                <div class="controls" id="sum" style="padding-right: 20px;">

                                    <div class="summernote" >{!! $data['content'] or '' !!}</div>

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


    <style>
        #preview img{
            width:440px;
        }
    </style>
    <script>
                function preview(file)
                {
                    var prevDiv = document.getElementById('preview');
                    if (file.files && file.files[0])
                    {
                        var reader = new FileReader();
                        reader.onload = function(evt){
                            prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
                        }
                        reader.readAsDataURL(file.files[0]);
                    }
                    else
                    {
                        prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
                    }
                }
        $(function(){

        $('.summernote').summernote({
            minHeight: 200,
            height: 200,
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


           $("#article_form").submit(function(){
                $("input[name='content']").val( $('.summernote').summernote("code"));
        })


    })
    </script>
@endsection

