<?php
Route::filter('admin-auth', function()
{
    if (Auth::guest()) return Redirect::guest('admin/login');
});