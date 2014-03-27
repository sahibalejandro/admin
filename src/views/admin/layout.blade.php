<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{{ Config::get('admin::admin.name') }}}</title>
    {{ HTML::style('packages/sahibalejandro/admin/bootstrap/css/bootstrap.min.css') }}
</head>
<body>

    @include('admin::admin.navbar')

    <div class="container">

        {{-- Mostrar alerta de exito --}}
        @if (Session::has('success'))
        <div class="alert alert-success">{{{ Session::get('success') }}}</div>
        @endif

        {{-- Mostrar alerta de información --}}
        @if (Session::has('message'))
        <div class="alert alert-info">{{{ Session::get('message') }}}</div>
        @endif

        {{-- Mostrar alerta de error --}}
        @if (Session::has('error'))
        <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @yield('content')
    </div>
    
    {{ HTML::script('packages/sahibalejandro/admin/js/jquery.js') }}
    {{ HTML::script('packages/sahibalejandro/admin/bootstrap/js/bootstrap.min.js') }}
</body>
</html>