<?php
/**
 * All routes are prefixed with the URL given in the configuration file.
 */
Route::group(array('prefix' => Config::get('admin::admin.url')), function ()
{
    /**
     * Public routes
     */
    Route::get('/', array(
        'as'   => 'admin',
        'uses' => 'AdminController@home',
    ));

    Route::get('login', array(
        'as'   => 'admin.login',
        'uses' => 'AdminLoginController@login',
    ));

    /**
     * CSRF Filter group
     */
    Route::group(array('before' => 'csrf'), function ()
    {
        // Do auth attempt
        Route::post('login', 'AdminLoginController@postLogin');
    });

    /**
     * Admin auth filter
     */
    Route::group(array('before' => 'admin-auth'), function ()
    {
        // Logout the user
        Route::get('logout', array(
            'as'   => 'admin.logout',
            'uses' => 'AdminLoginController@logout',
        ));
    });

    /**
     * Super admin auth filter
     */
    Route::group(array('before' => 'admin-auth|super-admin-auth'), function () {
        /**
         * Super admin auth + CSRF filters
         */
        Route::group(array('before' => 'csrf'), function ()
        {
            // Save account data
            Route::post('accounts/save/{admin?}', array(
                'as'   => 'admin.accounts.save',
                'uses' => 'AdminAccountsController@save'
            ));
        });

        // Show list of admin accounts
        Route::get('accounts', array(
            'as'   => 'admin.accounts',
            'uses' => 'AdminAccountsController@index',
        ));

        // Show form to edit an admin account
        Route::get('accounts/edit/{admin?}', array(
            'as'   => 'admin.accounts.edit',
            'uses' => 'AdminAccountsController@edit',
        ));
    });

});
