<ul class="nav nav-tabs">
@foreach($navs as $item)
    <!--        <li class="active"><a href="javascript:void(0)">菜单管理</a></li>-->
        <!--        <li><a href="{:U('menus/add')}">添加菜单</a></li>-->
        <li class="{{ array_get($item, 'active') ? 'active': '' }}">
            @if(array_get($item,'active'))
                <a href="javascript:void(0)">
            @else
                <a href="{{ url(array_get($item,'url')) }}">
            @endif
                    {{ array_get($item, 'name') }}
                </a></li>
    @endforeach
</ul>
