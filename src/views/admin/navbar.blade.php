<div class="navbar navbar-default">
    <div class="container">
        <a href="#" class="navbar-brand">{{{ Config::get('admin::admin.name') }}}</a>

        @if (Auth::check())
        <ul class="nav navbar-nav">
            @foreach (Config::get('admin::admin.menu') as $menu_item)
            @if (!isset($menu_item['submenu']))
            <li><a href="{{ url(Config::get('admin::admin.url').'/'.$menu_item['url']) }}">{{{ $menu_item['text'] }}}</a></li>
            @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{ $menu_item['text'] }}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @foreach ($menu_item['submenu'] as $submenu_item)
                    <li><a href="{{ url(Config::get('admin::admin.url').'/'.$menu_item['url'].'/'.$submenu_item['url']) }}">{{{ $submenu_item['text'] }}}</a></li>
                    @endforeach
                </ul>
            </li>            
            @endif
            @endforeach
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li {{ Request::is('admin/account*') ? 'class="active"' : '' }}><a href="{{ route('admin.account') }}">Admin account</a></li>
            <li><a href="{{ route('admin.logout') }}">Sign out</a></li>
        </ul>
        @endif
    </div>
</div>