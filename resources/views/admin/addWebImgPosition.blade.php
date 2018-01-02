@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}幻灯片</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span6">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}幻灯片</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)? url('admin/saveEditWebImagesPosition'):route('admin.saveWebImagePosition') }}" method="post" class="form-horizontal"  enctype="multipart/form-data" >

                            {{csrf_field()}}


                            <input type="hidden" name="web_images_id" value="{{$web_images_id}}" />

                            @isset($data)

                            <input type="hidden" name="id" value="{{$data['id']}}" />

                            @endisset

                            <div class="control-group">

                                <label class="control-label">名称 :</label>

                                <div class="controls">

                                    <input type="text" class="span11"  value="{{$data['name'] or ''}}" name="name" placeholder="名称" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">链接 :</label>

                                <div class="controls">

                                    <input type="url" class="span11" value="{{$data['link'] or ''}}"  name="link" placeholder="链接 例如 http://www.baidu.com" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">排序：</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['sort'] or ''}}"  name="sort" placeholder="排序 从小到大" />

                                </div>

                            </div>


                            <div class="control-group">

                                <label class="control-label">图片：</label>

                                <div class="controls">

                                    <input type="file" class="span11" value="{{$data['sort'] or ''}}"  name="webImg"  onchange="preview(this)"  />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"></label>

                                <div class="controls" id="preview">
                                    @isset($data)
                                    <img src="{{Storage::url("$data[image]")}}" />
                                    @endisset
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
        #preview img{
            width:440px;
        }
    </style>

    <script type="text/javascript">
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
    </script>
@endsection