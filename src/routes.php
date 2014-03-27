<?php
/**
 * All routes are prefixed with the URL given in the configuration file.
 */
Route::group(array('prefix' => Config::get('admin::admin.url')), function ()
{
    /**
     * Public routes
     */
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
        /**
         * Admin auth + CSRF filters
         */
        Route::group(array('before' => 'csrf'), function ()
        {
            // Save account data
            Route::post('account', 'AdminAccountController@save');
        });

        // Logout the user
        Route::get('logout', array(
            'as'   => 'admin.logout',
            'uses' => 'AdminLoginController@logout',
        ));

        // Show form to edit admin account
        Route::get('account', array(
            'as'   => 'admin.account',
            'uses' => 'AdminAccountController@edit',
        ));
    });

});
