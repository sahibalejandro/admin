<?php
/* -------------------------------------------------------------------------
 * Check of admin user
 */
Route::filter('admin-auth', function() {
    if (Auth::admin()->guest()) {
        return Redirect::guest(Config::get('admin::admin.url').'/login');
    }
});

/* -------------------------------------------------------------------------
 * Check if the admin is has super powers
 */
Route::filter('super-admin-auth', function () {
    if (Auth::admin()->get()->super_admin == 0) {
        return Redirect::route('admin')
            ->with('error', 'You are not allowed to edit admin accounts.');
    }
});