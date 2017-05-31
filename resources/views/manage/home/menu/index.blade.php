@extends('manage.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('manage.public.nav',['navs'=> [
                ['name' => '菜单列表', 'active'=> 'true'],
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
                            <label class="col-md-1 control-label">Url</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="url"
                                       value="{{ \Illuminate\Support\Facades\Input::get('url') }}"/>
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
                            <th>名称</th>
                            <th>Url</th>
                            <th>排序</th>
                            <th>Icon</th>
                            <th>状态</th>
                            <th>创建时间</th>
                        </tr>

                        @foreach($lists as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ str_repeat('&nbsp;',$item->level * 10) }}{{ $item->name }}</td>
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->sort }}</td>
                                <td>{{ $item->icon }}</td>
                                <td>
                                    <span class="label label-{{ $item->status ? 'success' : 'danger' }}"> {{ $item->statusText[$item->status] }} </span>
                                </td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
