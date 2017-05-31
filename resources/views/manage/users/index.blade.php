@extends('manage.layouts.app')
@section('content')
     <div class="row">
        <div class="col-xs-12">
        	 @include('manage.public.nav',['navs'=> [
                ['name' => '用户列表', 'active'=> 'true'],
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
                            <label class="col-md-1 control-label">Openid</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="openid"
                                       value="{{ \Illuminate\Support\Facades\Input::get('openid') }}"/>
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
                            <th>Id</th>
                            <th>openid</th>
                            <th>头像</th>
                            <th>名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                       @foreach($lists as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->openid }}</td>
                                <td>{{ $item->name }}</td>
                                <td><img src="{{ $item->avatar }}"></td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ url('/manage/users/' . $item->id) }}"
                                       class="btn btn-default btn-sm">详情</a>
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