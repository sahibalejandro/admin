@extends('admin::admin.layout')

@section('content')
    <h4>{{ trans('admin::accounts/index.title') }}</h4>

    <a href="{{ route('admin.accounts.edit') }}" class="btn btn-info">{{ trans('admin::accounts/index.add_account') }}</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ trans('admin::accounts/index.name') }}</th>
                <th>{{ trans('admin::accounts/index.username') }}</th>
                <th>{{ trans('admin::accounts/index.status') }}</th>
                <th>{{ trans('admin::accounts/index.super_admin') }}</th>
                <th>{{ trans('admin::accounts/index.created_at') }}</th>
                <th>{{ trans('admin::accounts/index.updated_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $Admin)
            <tr>
                <td>{{ link_to_route('admin.accounts.edit', $Admin->name, array($Admin->id)) }}</td>
                <td>{{{ $Admin->username }}}</td>
                <td>
                    @if ($Admin->active)
                    <div class="label label-success">{{ trans('admin::accounts/index.label_active') }}</div>
                    @else
                    <div class="label label-danger">{{ trans('admin::accounts/index.label_inactive') }}</div>
                    @endif
                </td>
                <td>
                    @if ($Admin->super_admin)
                    <div class="label label-info">{{ trans('admin::accounts/index.label_super_admin') }}</div>
                    @endif
                </td>
                <td>{{{ $Admin->created_at }}}</td>
                <td>{{{ $Admin->updated_at }}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop