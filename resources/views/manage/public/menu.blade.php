<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="sidebar-user-info">
                <p>欢迎您， 管理员</p>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            @foreach ($menuLists as $item)
                @if($item->child->count())
                    <li class="treeview">
                        <a href="{{ $item->url }}">
                            <i class="fa fa-{{ $item->icon or 'link' }}"></i>
                            <span>{{ $item->name }}</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @foreach($item->child as $childItem)
                                <li class="{{ (trim($childItem->url,'/') == request()->path()) ? 'active' : '' }}">
                              
                                    <a href="{{ $childItem->url }}">
                                        <i class="fa fa-{{ $childItem->icon or 'link' }}"></i>
                                        <span>{{ $childItem->name }}</span>
                                    </a>

                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="{{ (trim($item->url,'/') == request()->path()) ? 'active' : '' }}">
                        <a href="{{ $item->url }}">
                            <i class="fa fa-{{ $item->icon }}"></i>
                            <span>{{ $item->name or 'link' }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </section>
</aside>

