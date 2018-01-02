@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="#" class="current">{{$op or "添加"}}友情链接</a> </div>
    </div>

    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span6">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{$op or "添加"}}友情链接</h5>

                    </div>

                    <div class="widget-content nopadding">

                        <form action="{{ isset($op)?url("/admin/saveEditWebLink"):url("/admin/saveWebLink") }}" method="post" class="form-horizontal" enctype="multipart/form-data">

                            {{csrf_field()}}

                            @isset($op)
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

                                    <input type="text" class="span11" value="{{$data['link'] or ''}}"  name="link" placeholder="链接 例如 http://www.baidu.com" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">排序：</label>

                                <div class="controls">

                                    <input type="text" class="span11" value="{{$data['sort'] or ''}}"  name="sort" placeholder="排序 从小到大" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">类型：</label>

                                <div class="controls">
                                   @if(isset($data))
                                    @if($data['type'] == 1)
                                    <label>

                                        <span class="checked"><input type="radio" value="1" name="type" style="opacity: 0;" checked ></span>

                                        文字</label>

                                    <label>

                                        <span class=""><input type="radio" name="type" value="2" style="opacity: 0;"></span>

                                        图片</label>
                                    @else
                                        <label>

                                            <span class="checked"  ><input type="radio" value="1" name="type"   style="margin: 0"  ></span>

                                            文字</label>

                                        <label>

                                            <span class=""><input type="radio" name="type" value="2"  checked   style="margin: 0" ></span>

                                            图片</label>
                                    @endif
                                       @else
                                        <label>

                                            <span class="checked"><input type="radio" value="1" name="type"   style="margin: 0"  checked ></span>

                                            文字</label>

                                        <label>

                                            <span class=""><input type="radio" name="type" value="2"   style="margin: 0" ></span>

                                            图片</label>
                                    @endif

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label">选择图片：</label>

                                <div class="controls">

                                    <input type="file" class="span11" value=""  name="webImg"  onchange="preview(this)"  />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"></label>

                                <div class="controls" id="preview">
                                    @isset($data['image'])
                                    <img src="{{ Storage::url($data['image']) }}" />
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