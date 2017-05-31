@extends('manage.layouts.app')
@section('script')
    <script>
        $(function () {

            // 地图
            window.addEventListener('message', function (event) {
                var loc = event.data;
                if (loc && loc.module == 'locationPicker') {
                    $('input[name="longitude"]').val(loc.latlng.lng)
                    $('input[name="latitude"]').val(loc.latlng.lat)
                    $('input[name="address"]').val(loc.poiaddress)
                }
            }, false);
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('manage.public.nav',['navs'=> [
                ['name' => '搬家列表', 'url'=> '/manage/service/HouseMove'],
                ['name' => '编辑', 'active'=> 'true'],
            ]])


            <div class="panel panel-info">
                <div class="box-body">
                    {!! Form::model($info,['url' => '/manage/service/HouseMove/' . $info->id ,'method' => 'put', 'class'=> 'form-horizontal']) !!}

                    <div class="form-group">
                        {!! Form::label('name', '名称', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', null, ['class' => 'form-control','required'=>'true']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone', '电话', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('phone', null, ['class' => 'form-control','required' => 'true']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('remark', '备注', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows'=>5]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', '地址', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('address', null, ['class' => 'form-control', 'required']) !!}
                            <iframe id="mapPage" width="100%" height="600" frameborder=0
                                    src="http://apis.map.qq.com/tools/locpicker?search=1&type=1&key={{ env('TX_MAP_KEY') }}&referer=myapp">
                            </iframe>
                            {!! Form::hidden('longitude', null, []) !!}
                            {!! Form::hidden('latitude', null, []) !!}
                        </div>
                    </div>

                    <div class="col-sm-offset-2">
                        {!! Form::hidden('url', \Illuminate\Support\Facades\Input::get('url'), []) !!}
                        {!! Form::submit('保存', ['class' => 'btn btn-primary submit-button']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
