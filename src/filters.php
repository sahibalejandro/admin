<?php
Route::filter('admin-auth', function()
{
    if (Auth::guest()) {
        return Redirect::guest(Config::get('admin::admin.url').'/login');
    }
});