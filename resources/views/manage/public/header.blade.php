<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', '后台管理系统')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="_token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/ionicons/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/adminlte/css/skins/skin-blue.min.css">
      
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/toastr/toastr.min.css">

    <!-- Bootstrap Date -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/datepicker/bootstrap-datetimepicker.min.css">
    <!-- Bootstrap Select -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/bootstrap-select/dist/css/bootstrap-select.css">

    <!-- Sweetalert -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/sweetalert/sweetalert.css">

    <link rel="stylesheet" href="{{ asset('css') }}/manage/main.css">


    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('plugins') }}/jquery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins') }}/adminlte/js/app.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins') }}/toastr/toastr.min.js"></script>
    <!-- Sweetalert -->
    <script src="{{ asset('plugins') }}/sweetalert/sweetalert.min.js"></script>


    <!-- Bootstrap Date -->
    <script src="{{ asset('plugins') }}/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('plugins') }}/datepicker/locales/bootstrap-datetimepicker.zh-CN.js"></script>

    <!-- Bootstrap Select -->
    <script src="{{ asset('plugins') }}/bootstrap-select/js/bootstrap-select.js"></script>

    {{-- Viewer --}}
    <link rel="stylesheet" href="{{ asset('plugins') }}/viewer/viewer.min.css">
    <script src="{{ asset('plugins') }}/viewer/viewer.min.js"></script>


    <!-- request.js -->
    <script src="{{ asset('js') }}/manage/request.js"></script>

    {{-- Main Js --}}
    <script src="{{ asset('js') }}/manage/main.js"></script>

    @yield('head')
</head>
<body class="hold-transition sidebar-mini skin-blue">
@yield('script')
<script>


    $(function () {
        $('.date-time-picker').datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss",
            language: 'zh-CN',
            todayBtn: true,
            autoclose: true,
            todayHighlight: true
        });
    })
</script>
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
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <p class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>手</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>便民</b>小助手</span>
        </p>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <ul class="dropdown-menu">
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

