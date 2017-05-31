@extends('manage.layouts.app')
@section('content')
 <div class="row">
    <div class="col-xs-12">
    	 @include('manage.public.nav',['navs'=> [
            ['name' => '投诉列表', 'active'=> 'true'],
        ]])
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="search">
                    <div class="form-group">
                        <label class="col-md-1 control-label">状态</label>
                        <div class="col-md-3">
                            <select class="form-control" name="status">
                                <option value="">不限</option>
                                @foreach(app(\App\Models\Complaint::class)->statusText as $key => $item)
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
                        <th>Id</th>
                        <th>用户</th>
                        <th>投诉类型</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>

                   @foreach($lists as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ str_limit($item->user->name,10) }}</td>
                            <td>{{ $item->commonName[$item->common_type] }}</td>
                            <td> <span class="label label-{{ array_get([
                                    1=>'primary' ,
                                    2 => 'success'
                                    ],$item->status) }}">
                            @if($item->status==1)
                            待处理
                            @elseif($item->status==2)
                            已处理
                            @endif
                            </span>
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                            	<a href="{{ url('/manage/complaints/' . $item->id) }}" class="btn btn-default btn-sm">详情</a>
                            	<a href="{{ url('/manage/complaints/' . $item->id) }}"
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
@endsection()