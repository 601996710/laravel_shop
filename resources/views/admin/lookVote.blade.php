@extends("layouts.admin")
@section("content")
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url("admin/welcome")}}" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> 首页</a> <a href="{{ url("admin/vote") }}"  >投票列表</a> <a href="#" class="current">投票预览</a> </div>
    </div>


    <div class="container-fluid">


            <div class="span12">

                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

                        <h5>{{ $data['name'] }}</h5>

                    </div>

                    <div class="widget-content nopadding form-horizontal">

                            @if(!empty($data['voteInfo']))
                            @foreach($data['voteInfo'] as $v)
                            <div class="control-group">

                                <label class="control-label">{{$v['name']}}</label>

                                @if($v['type'] == 1 )

                                <div class="controls">
                                    @foreach($v['list'] as $l)
                                    <label>

                                        <span class="checked"><input type="radio" value="1" name="type"   style="margin: 0"   ></span>
                                        {{$l}}
                                    </label>
                                    @endforeach
                                </div>
                                @endif
                                @if($v['type'] == 2 )
                                <div class="controls">
                                    @foreach($v['list'] as $l)
                                    <label>
                                        <span class="checked"><input type="checkbox" value="1" name="type"   style="margin: 0"   ></span>
                                        {{$l}}
                                    </label>
                                    @endforeach
                                </div>
                                @endif

                                @if($v['type'] == 3 )
                                <div class="controls">
                                    @foreach($v['list'] as $l)
                                    <label>
                                        <span  ><input type="text" value="" name="type"   style="margin: 0"   ></span>
                                        {{$l}}
                                    </label>
                                    @endforeach
                                </div>
                                @endif

                                @if($v['type'] == 4 )
                                <div class="controls">
                                    @foreach($v['list'] as $l)
                                    <label>
                                        <span ><textarea></textarea></span>
                                        {{$l}}
                                    </label>
                                    @endforeach
                                </div>
                                @endif

                            </div>
                            @endforeach
                            @endif

                            <div class="form-actions">

                                <button type="button" class="btn btn-success">提交</button>

                            </div>


                    </div>

                </div>

            </div>
    </div>
@endsection