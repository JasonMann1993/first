@extends('manage.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('manage.public.nav',['navs'=> [
                ['name' => '回收列表', 'active'=> 'true'],
            ]])

            <div class="panel panel-info">
                <div class="panel-heading">筛选</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="search">
                        <div class="form-group">
                            <label class="col-md-1 control-label">名称</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="name"
                                       value="{{ \Illuminate\Support\Facades\Input::get('name') }}"/>
                            </div>
                            <label class="col-md-1 control-label">状态</label>
                            <div class="col-md-3">
                                <select class="form-control" name="status">
                                    <option value="">不限</option>
                                    @foreach(app(\App\Models\Recovery::class)->statusText as $key => $item)
                                        <option value="{{ $key }}" {{ (\Illuminate\Support\Facades\Input::get('status') != '' && \Illuminate\Support\Facades\Input::get('status') == $key) ? 'selected': '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-offset-1 col-md-2">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> 确定
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-info panel-table">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>用户</th>
                            <th>名称</th>
                            <th>图片</th>
                            <th>地址</th>
                            <th>电话</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>

                        @foreach($lists as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ str_limit($item->user->name,10) }}</td>
                                <td>{{ str_limit($item->name,10) }}</td>
                                <td class="images">
                                    <img src="{{ $item->imgs->first()->img}}">
                                </td>
                                <td>{{ str_limit($item->address,10) }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <span class="label label-{{ array_get([
                                    0=>'primary' ,
                                    1 => 'success',
                                    2 => 'warning',
                                    3 => 'danger'
                                    ],$item->status) }}"> {{ $item->statusText[$item->status] }} </span>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ url('/manage/Recovery/' . $item->id) }}"
                                       class="btn btn-default btn-sm">详情</a>
                                    <a href="{{ url('/manage/Recovery/hide/' . $item->id) }}"
                                       class="btn btn-default btn-sm patch">{{ $item->typeText[!$item->type] }}</a>
                                    <a href="{{ url('/manage/Recovery/' . $item->id) }}"
                                       class="btn btn-default btn-sm delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $lists->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection
