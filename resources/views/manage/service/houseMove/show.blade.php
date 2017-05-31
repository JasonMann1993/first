@extends('manage.layouts.app')
@section('head')
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key={{ env('TX_MAP_KEY') }}"></script>
@endsection
@section('script')
    <script>
        $(function () {
            // 地图
            var center = new qq.maps.LatLng({{ $info->latitude }}, {{ $info->longitude }});
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
            $('.do-action .re-audit').click(function () {
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
                ['name' => '搬家列表', 'url'=> '/manage/service/HouseMove'],
                ['name' => '搬家详情', 'active'=> 'true'],
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
                            <div class="col-sm-2 label">名称</div>
                            <div class="col-sm-10 text"> {{ $info->name }} </div>
                        </li>

                        <li>
                            <div class="col-sm-2 label">图片</div>
                            <div class="col-sm-10 text">
                                <ul id="images">
                                    @foreach($info->imgs as $item)
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
                            <div class="col-sm-2 label">电话</div>
                            <div class="col-sm-10 text"> {{ $info->phone }} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">添加时间</div>
                            <div class="col-sm-2 text"> {{ $info->created_at }} </div>
                            <div class="col-sm-2 label">审核时间</div>
                            <div class="col-sm-2 text"> {{ $info->verify or '-'}} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">备注</div>
                            <div class="col-sm-10 text"> {{ $info->remark }} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">当前状态</div>
                            <div class="col-sm-2 text">
                                    <span class="label label-{{ array_get([
                                    0=>'primary' ,
                                    1 => 'success',
                                    2 => 'warning',
                                    3 => 'danger'
                                    ],$info->status) }}"> {{ $info->statusText[$info->status] }} </span>
                            </div>

                            <div class="col-sm-2 label">显示状态</div>
                            <div class="col-sm-2 text">
                                    <span class="label label-{{ array_get([
                                    1 => 'success',
                                    0 => 'danger'
                                    ],$info->type) }}"> {{ $info->typeText[$info->type] }} </span>
                            </div>
                        </li>

                        <li class="do-action">
                            <div class="col-sm-12 text-center">
                                <a class="btn btn-default" href="{{ url('/manage/service/HouseMove/'. $info->id . '/edit?url=' . back()->getTargetUrl()) }}">修改信息</a>
                                @if($info->status != 0)
                                    <a href="" class="re-audit">重新审核</a>
                                @endif
                            </div>
                        </li>
                        <li class="audit" style="{{ $info->status != 0 ? 'display: none' : '' }}">
                            <h3>审核：</h3>
                            <div class="col-sm-2 label">备注</div>
                            {!! Form::open(['url' => '/manage/service/HouseMove/audit/' . $info->id ,'method' => 'patch' ,'class'=> 'form-horizontal']) !!}
                            <div class="col-sm-10 text">
                                {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows'=>5]) !!}
                                {!! Form::hidden('url', back()->getTargetUrl(), []) !!}
                                {!! Form::hidden('type', 1, []) !!}
                            </div>
                            <div class="col-sm-10 col-sm-offset-2">
                                <a class="btn btn-success margin-r-5" data-type="1">通过</a>
                                <a class="btn btn-warning margin-r-5" data-type="2">驳回</a>
                                <a class="btn btn-danger" data-type="3">垃圾信息</a>
                            </div>
                            {!! Form::close() !!}
                        </li>
                    </ul>
                    </ul>
                </div>
            </div>

        </div>
    </div>


@endsection
