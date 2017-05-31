@extends('manage.layouts.app')
@section('head')
    <style type="text/css">
        .panel-info .panel-heading {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('manage.public.nav',['navs'=> [
                ['name' => '原因列表', 'url'=> '/manage/reasons'],
                ['name' => '添加原因', 'active'=> 'true'],
            ]])

            <div class="panel panel-info">
                <div class="box-body">
                    {!! Form::open(['url' => '/manage/reasons' ,'method' => 'post', 'class'=> 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('common_type', '类型', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('common_type',['App\Models\PublicToilet'=>'公厕','App\Models\CoalGass'=>'煤气','App\Models\DeliverWater'=>'送水','App\Models\HouseMoving'=>'搬家','App\Models\Recovery'=>'回收','App\Models\Rental'=>'租房','App\Models\Unlock'=>'开锁'],null, ['class' => 'form-control','required' => 'true']) !!}
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('reasons', '原因', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10 reasons">
                            {!! Form::text('reasons', null, ['class' => 'form-control', 'rows'=>5]) !!}
                        </div>
                    </div>
                    <div class="col-sm-offset-6" >
                        {!! Form::submit('保存', ['class' => 'btn btn-primary submit-button']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>,
            </div>
        </div>
    </div>
@endsection
