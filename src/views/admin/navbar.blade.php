<div class="navbar navbar-default">
    <div class="container">
        <a href="#" class="navbar-brand">Admin panel</a>

        @if (Auth::check())
        <ul class="nav navbar-nav navbar-right">
            <li {{ Request::is('admin/account*') ? 'class="active"' : '' }}><a href="{{ route('admin.account.edit') }}">Admin account</a></li>
            <li><a href="{{ route('admin.logout') }}">Sign out</a></li>
        </ul>
        @endif
    </div>
</div>