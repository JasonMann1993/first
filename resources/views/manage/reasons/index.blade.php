@extends('manage.layouts.app')
@section('content')
 <div class="row">
    <div class="col-xs-12">
    	 @include('manage.public.nav',['navs'=> [
            ['name' => '原因列表', 'active'=> 'true'],
            ['name'=>'添加原因', 'url' => '/manage/reasons/create']
        ]])
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="search">
                    <div class="form-group">
                        <label class="col-md-1 control-label">类型</label>
                        <div class="col-md-3">
                            <select class="form-control" name="common_type">
                                <option value="">不限</option>
                                @foreach(app(\App\Models\Reason::class)->commonName as $key => $item)
                                    <option value="{{ $key }}" {{ (\Illuminate\Support\Facades\Input::get('common_type') != '' && \Illuminate\Support\Facades\Input::get('common_type') == $key) ? 'selected': '' }}>{{ $item }}</option>
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
                        <th>类型</th>
                        <th>原因</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    @if(!empty($lists))
                    @foreach($lists as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->commonName[$item->common_type] }}</td>
                            <td>{{ $item->reasons }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ url('/manage/reasons/' . $item->id) }}"
                                   class="btn btn-default btn-sm delete">删除</a>
                            	<a href="{{ url('/manage/reasons/'.$item->id.'/edit') }}" class="btn btn-default btn-sm">修改</a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </table>
                {{ $lists->links() }}
            </div>
        </div>
    </div>
</div>
@endsection()