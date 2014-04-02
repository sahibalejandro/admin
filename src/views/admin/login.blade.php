@extends('admin::admin.layout')

@section('content')

<h3>{{ trans('admin::login.welcome', array('admin_panel' => Config::get('admin::admin.name'))) }}</h3>
<p>{{ trans('admin::login.message', array('admin_panel' => Config::get('admin::admin.name'))) }}</p>

<form action="{{ route('admin.login') }}" method="post" class="form-horizontal">
    
    <!-- CSRF Token -->
    {{ Form::token() }}

    <!-- Nombre de usuario -->
    <div class="form-group">
        <label class="control-label col-sm-3">{{ trans('admin::login.username') }}:</label>
        <div class="col-sm-5">
            {{ Form::text('username', null, array('class' => 'form-control', 'autofocus')) }}
        </div>
    </div>

    <!-- Contraseña -->
    <div class="form-group">
        <label class="control-label col-sm-3">{{ trans('admin::login.password') }}:</label>
        <div class="col-sm-5">
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>
    </div>

    <!-- Recuerdame -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('remember') }} {{ trans('admin::login.stay_signed') }}
                </label>
            </div>
        </div>
    </div>

    <!-- Envíar formulario -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-primary" type="submit">{{ trans('admin::login.signin') }}</button>
        </div>
    </div>
</form>

@stop