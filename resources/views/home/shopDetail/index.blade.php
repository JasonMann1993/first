<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
</head>
<style>
    .container{
        margin: 20px 10px;
    }
</style>
<script>
    $(function () {


        @if(session('success'))
                toastr.success('{{ session('success') }}');
        @endif
    })
</script>
<body>
<div class="container">
    <div class="row">
        <input class="btn btn-default pull-right" type="button" value="添加数据" onclick="window.location.href='{{ url('/home/shopDetail/create') }}'">
    </div>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>名称</th>
            <th>手机号</th>
            <th>地址</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $item)
        <tr>
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->address }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $lists->links() }}
</div>
</body>
</html>