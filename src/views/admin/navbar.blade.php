<div class="navbar navbar-default">
    <div class="container">
        <a href="{{ route('admin') }}" class="navbar-brand">{{{ Config::get('admin::admin.name') }}}</a>

        @if (Auth::admin()->check())
        <ul class="nav navbar-nav">
            @foreach (Config::get('admin::admin.menu') as $menu_item)
                {{-- Menú normal --}}
                @if (!isset($menu_item['submenu']))
                <li><a href="{{ url(Config::get('admin::admin.url').'/'.$menu_item['url']) }}">{{{ $menu_item['text'] }}}</a></li>
                @else
                {{-- Menú con sub menú --}}
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
            
            {{-- Accounts administration only for super admins --}}
            @if (Auth::admin()->get()->super_admin)
            <li {{ Request::is('admin/account*') ? 'class="active"' : '' }}><a href="{{ route('admin.accounts') }}">{{ trans('admin::navbar.admin_account') }}</a></li>
            @endif

            <li><a href="{{ route('admin.logout') }}">{{ trans('admin::navbar.logout') }}</a></li>
        </ul>
        @endif
    </div>
</div>