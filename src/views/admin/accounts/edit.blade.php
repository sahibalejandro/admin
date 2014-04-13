@extends('admin::admin.layout')

@section('content')

<h4>
    @if ($Admin->exists)
        {{ trans('admin::accounts/edit.title_edit') }}
    @else
        {{ trans('admin::accounts/edit.title_add') }}
    @endif
</h4>

{{
Form::model($Admin, array(
    'route' => array('admin.accounts.save', $Admin->id),
    'class' => 'form-horizontal'))
}}

<div class="form-group">
    <label class="control-label col-sm-2">{{ trans('admin::accounts/edit.name') }}</label>
    <div class="col-sm-3">
        {{ Form::text('name', null, array('class' => 'form-control', 'autofocus')) }}
        @if($errors->has('name'))
        <div class="label label-danger">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2">{{ trans('admin::accounts/edit.username') }}</label>
    <div class="col-sm-3">
        {{ Form::text('username', null, array('class' => 'form-control')) }}
        @if($errors->has('username'))
        <div class="label label-danger">{{ $errors->first('username') }}</div>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2">{{ trans('admin::accounts/edit.password') }}</label>
    <div class="col-sm-3">
        {{ Form::password('password', array('class' => 'form-control')) }}
        @if($errors->has('password'))
        <div class="label label-danger">{{ $errors->first('password') }}</div>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2">{{ trans('admin::accounts/edit.check_password') }}</label>
    <div class="col-sm-3">
        {{ Form::password('password_check', array('class' => 'form-control')) }}
        @if($errors->has('password_check'))
        <div class="label label-danger">{{ $errors->first('password_check') }}</div>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-2">{{ trans('admin::accounts/edit.status') }}</label>
    <div class="col-sm-3">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('active') }}
                {{ trans('admin::accounts/edit.checkbox_status') }}
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-2">{{ trans('admin::accounts/edit.super_admin') }}</label>
    <div class="col-sm-3">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('super_admin') }}
                {{ trans('admin::accounts/edit.checkbox_super_admin') }}
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" value="{{ trans('admin::accounts/edit.submit') }}" class="btn btn-primary">
    </div>
</div>

{{ Form::close() }}

@stop