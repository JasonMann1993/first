<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('plugins') }}/bootstrap/css/bootstrap.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/toastr/toastr.min.css">
    <style>
        body{
            background:#f7f8fa;
        }
        .row div{
            text-align: center;
            margin: 50px 0 10px 0;
            font-size: 27px;
        }
        .content{
            width: 50%;
            background: #fff;
            height: 350px;
            border-radius: 5px;
            margin: 0 auto;
            margin-top: -175px;
            top: 50%;
            position: absolute;
            color: #adb0b7;
            left: 0;
            right: 0;
        }
        form{
            margin: 50px 0px;
        }
        form .form-group{
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div>后台登陆</div>
        </div>

        {!! Form::open(['url' => '/manage/user/login/'  ,'method' => 'post', 'class'=> 'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('name', '用户名', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-8">
                {!! Form::text('name', null, ['class' => 'form-control','required'=>'true']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', '密码', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-8">
                {!! Form::password('password', ['class' => 'form-control','required'=>'true']) !!}
            </div>
        </div>


        <div class="col-sm-offset-2">
            {!! Form::submit('登陆', ['class' => 'btn btn-default submit-button']) !!}
        </div>
        {!! Form::close() !!}
    </section>
</div>

<!-- jQuery 2.2.3 -->
<script src="{{ asset('plugins') }}/jquery/jquery-2.2.3.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('plugins') }}/toastr/toastr.min.js"></script>
<script>
    @foreach(['success', 'info' ,'error','warning'] as $v)
        @if(Session::has($v))
$(function(){
        toastr['{{ $v }}']("{{ session($v) }}");
    });
    @endif
@endforeach
@if($errors->any())
$(function(){
        @foreach($errors->all() as $error)
            toastr["error"]("{{ $error }}");
        @endforeach
    });
    @endif
</script>
</body>
</html>
