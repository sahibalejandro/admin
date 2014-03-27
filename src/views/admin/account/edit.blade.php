@extends('admin::admin.layout')

@section('content')

<h4>Edit admin account</h4>

{{
Form::model($Admin, array(
    'route' => array('admin.account'),
    'class' => 'form-horizontal'))
}}

<div class="form-group">
    <label class="control-label col-sm-2">Username:</label>
    <div class="col-sm-3">
        {{ Form::text('username', null, array('class' => 'form-control', 'autofocus')) }}
        @if($errors->has('username'))
        <div class="label label-danger">{{ $errors->first('username') }}</div>
        @endif
    </div>
    <div class="col-sm-7">
        <div class="help-block">Only letters, numbers and dot.</div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2">Password:</label>
    <div class="col-sm-3">
        {{ Form::password('password', array('class' => 'form-control')) }}
        @if($errors->has('password'))
        <div class="label label-danger">{{ $errors->first('password') }}</div>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2">Check password:</label>
    <div class="col-sm-3">
        {{ Form::password('password_check', array('class' => 'form-control')) }}
        @if($errors->has('password_check'))
        <div class="label label-danger">{{ $errors->first('password_check') }}</div>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</div>

{{ Form::close() }}

@stop