@extends('manage.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('manage.public.nav',['navs'=> [
                ['name' => '用户列表', 'url'=> '/manage/user'],
                ['name' => '用户详情', 'active'=> 'true'],
            ]])

            <div class="panel panel-info">
                <div class="panel-heading">详情</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li>
                            <div class="col-sm-2 label">用户</div>
                            <div class="col-sm-10 text">
                                <img src="{{ $info->avatar }}" class="avatar">
                                {{ $info->name }}
                            </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">openid</div>
                            <div class="col-sm-10 text"> {{ $info->openid }} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">性别</div>
                            <div class="col-sm-10 text"> {{ $info->sexText[$info->sex] }} </div>
                        </li>
                        <li>
                            <div class="col-sm-2 label">添加时间</div>
                            <div class="col-sm-2 text"> {{ $info->created_at }} </div>
                        </li>

                    </ul>
                </div>
            </div>


            @foreach($info->modelWithControllers as $k => $v)
                @if($info->hasMany($k)->count() > 0)
                <div class="panel panel-info">
                    <div class="panel-heading">Ta 发布g的{{ $info->modelWithTexts[$k] }}</div>
                    <div class="panel-body table-responsive">
                        <table class="table table-hover">
                            @foreach($info->hasMany($k)->get() as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="images">
                                        <img src="{{ $item->imgs->first()->img}}">
                                    </td>
                                    <td><a href="{{ url()->action('\\' . $v .'@'. 'show',['id'=>$item->id]) }}">{{ $item->name }}</a></td>
                                    <td>
                                        <span class="label label-{{ array_get([
                                    0=>'primary' ,
                                    1 => 'success',
                                    2 => 'warning',
                                    3 => 'danger'
                                    ],$item->status) }}"> {{ $item->statusText[$item->status] }} </span>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endif
            @endforeach

        </div>
    </div>


@endsection
