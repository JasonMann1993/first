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
@section('script')
    <script>
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
                ['name' => '原因列表', 'url'=> '/manage/reasons'],
                ['name' => '原因修改', 'active'=> 'true'],
            ]])

            <div class="panel panel-info">
                <div class="box-body">
                    {!! Form::model($info,['url' => '/manage/reasons/' . $info->id ,'method' => 'put', 'class'=> 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('common_type', '类型', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('common_name', null, ['class' => 'form-control','required' => 'true','readonly'=>'true']) !!}
                            {!! Form::hidden('common_type', $info->common_type, ['class' => 'form-control','required' => 'true','readonly'=>'true']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('reasons', '原因', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10 reasons">
                            {!! Form::text('reasons', null, ['class' => 'form-control','required' => 'true']) !!}
                        </div>
                    </div>
                    <div class="col-sm-offset-2">
                        {!! Form::submit('保存', ['class' => 'btn btn-primary submit-button']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
