<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加数据 </title>
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
        @if($errors)
            @foreach($errors->all() as $error)
                toastr.warning('{{ $error }}');
                @break
            @endforeach
        @endif


        @if(session('error'))
                toastr.error('{{ session('error') }}');
        @endif
    })
</script>
<body>
<div class="container">
    <form method="post" action="{{ url('home/shopDetail') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>名称</label>
            <input type="text" class="form-control" name="name" placeholder="" required>
        </div>
        <div class="form-group">
            <label>手机号</label>
            <input type="number" class="form-control" name="phone" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">位置</label>
            <iframe id="mapPage" width="100%" height="450" frameborder=0
                    src="http://apis.map.qq.com/tools/locpicker?search=1&type=1&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&referer=myapp">
            </iframe>
            <input type="hidden" name="lng">
            <input type="hidden" name="lat">
            <input type="hidden" name="address">
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
</div>
</body>
<script>
    window.addEventListener('message', function (event) {
        // 接收位置信息，用户选择确认位置点后选点组件会触发该事件，回传用户的位置信息
        var loc = event.data;
        if (loc && loc.module == 'locationPicker') {//防止其他应用也会向该页面post信息，需判断module是否为'locationPicker'
            console.log(loc)
            $('input[name="lng"]').val(loc.latlng.lng)
            $('input[name="lat"]').val(loc.latlng.lat)
            $('input[name="address"]').val(loc.poiaddress)
        }
    }, false);
</script>
</html>