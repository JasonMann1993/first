@extends('manage.layouts.app')
@section('head')
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key={{ env('TX_MAP_KEY') }}"></script>
    <style type="text/css">
    .panel-info .panel-heading {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }
    </style>
@endsection
@section('script')
    <script>
        $(function () {
            // 地图
            var center = new qq.maps.LatLng({{ $res->latitude }}, {{ $res->longitude }});
            map = new qq.maps.Map( document.getElementById("map"), {
                    center: center,
                    zoom: 16,
                }
            );
            var marker = new qq.maps.Marker({
                position: center,
                map: map
            });
            // 重新审核
            $('#re-audit').click(function () {
                $('.audit').slideToggle()
                return false;
            })
            // 提交
            $('.audit a').click(function () {
                $('input[name="type"]').val($(this).data('type'))
                $('.audit form').submit()
                return false;
            })
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('manage.public.nav',['navs'=> [
                ['name' => '投诉列表', 'url'=> '/manage/complaints'],
                ['name' => '投诉详情', 'active'=> 'true'],
            ]])

            <div class="panel panel-info">
                <div class="panel-heading">详情</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li>
                            <div class="col-sm-2 label">来自</div>
                            <div class="col-sm-10 text">
                                <img src="{{ $info->user->avatar }}" class="avatar">
                                {{ $info->user->name }}
                            </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">添加时间</div>
                            <div class="col-sm-2 text"> {{ $info->created_at }} </div>
                            <div class="col-sm-2 label">处理时间</div>
                            <div class="col-sm-2 text"> {{ $info->audited_at or '-'}} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">原因</div>
                            <div class="col-sm-10 text">
                            @foreach($info->reasons as $item)
                             {{ $item }}
                            @endforeach
                            </div>
                        </li>
                        <li>
                        <div class="col-sm-2 label">投诉描述</div>
                        <div class="col-sm-10 text"> {{ $info->detail }} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">当前状态</div>
                            <div class="col-sm-2 text">
                                    <span class="label label-{{ array_get([
                                    1=>'primary' ,
                                    2 => 'success',
                                    3 => 'warning',
                                    4 => 'danger'
                                    ],$info->status) }}"> {{ $info->statusText[$info->status] }} </span>
                            </div>
                        </li>
                        <li class="do-action">
                            <div class="col-sm-12 text-center">
                                @if($info->status != 1)
                                    <a href="" class="re-audit" id="re-audit">重新处理</a>
                                @endif
                            </div>
                        </li>
                        <li class="audit" style="{{ $info->status != 1 ? 'display: none' : '' }}">
                            <h3>处理：</h3>
                            <div class="col-sm-2 label">日志备注</div>
                            {!! Form::open(['url' => '/manage/complaints/audit/' . $info->id ,'method' => 'patch' ,'class'=> 'form-horizontal']) !!}
                            <div class="col-sm-10 text">
                                {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows'=>5]) !!}
                                {!! Form::hidden('url', back()->getTargetUrl(), []) !!}
                                {!! Form::hidden('type', 1, []) !!}
                            </div>
                            <div class="col-sm-10 col-sm-offset-2">
                                <a class="btn btn-success margin-r-5" data-type="1">下架</a>
                                <a class="btn btn-warning margin-r-5" data-type="2">忽略</a>
                            </div>
                            {!! Form::close() !!}
                        </li>
                    </ul>
                </div>
            </div>
                        <!-- 投诉类型详情 start -->
            <div class="panel panel-info">
                <div class="panel-heading">投诉类型详情</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li>
                            <div class="col-sm-2 label">名称</div>
                            <div class="col-sm-10 text"><a href="/manage/{{$common}}/{{$res->id}}">{{ $res->name }}</a></div>
                        </li>

                        <li>
                            <div class="col-sm-2 label">图片</div>
                            <div class="col-sm-10 text">
                                <ul id="images">
                                    @foreach($res->imgs as $item)
                                        <li> <img src="{{ $item->img }}" alt=""> </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">地址</div>
                            <div class="col-sm-10 text">
                                <div id="map"></div>
                            </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">添加时间</div>
                            <div class="col-sm-2 text"> {{ $res->created_at }} </div>
                            <div class="col-sm-2 label">审核时间</div>
                            <div class="col-sm-2 text"> {{ $res->verify or '-'}} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">备注</div>
                            <div class="col-sm-10 text"> {{ $res->remark }} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">当前状态</div>
                            <div class="col-sm-2 text">
                                    <span class="label label-{{ array_get([
                                    0=>'primary' ,
                                    1 => 'success',
                                    2 => 'warning',
                                    3 => 'danger',
                                    4 => 'danger'
                                    ],$res->status) }}"> {{ $res->statusText[$res->status] }} </span>
                            </div>

                            <div class="col-sm-2 label">显示状态</div>
                            <div class="col-sm-2 text">
                                    <span class="label label-{{ array_get([
                                    1 => 'success',
                                    0 => 'danger'
                                    ],$res->type) }}"> {{ $res->typeText[$res->type] }} </span>
                            </div>
                        </li>
                        <!-- 投诉类型详情 end -->

                    </ul>
                </div>
            </div>

        </div>
    </div>


@endsection
