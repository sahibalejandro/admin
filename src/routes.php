<?php
/**
 * Filtro CSRF para usuarios no identificados
 */
Route::group(array('before' => 'csrf'), function ()
{
    Route::post('admin/login', 'AdminLoginController@postLogin');
});

/**
 * Filtro para: Solo usuarios identificados
 */
Route::group(array('before' => 'admin-auth'), function ()
{
    Route::get('admin/logout', array(
        'as'   => 'admin.logout',
        'uses' => 'AdminLoginController@logout',
    ));

    Route::get('admin/account', array(
        'as'   => 'admin.account.edit',
        'uses' => 'AdminAccountController@edit',
    ));

    Route::post('admin/account/save', array(
        'before' => 'csrf',
        'as'     => 'admin.account.save',
        'uses'   => 'AdminAccountController@save',
    ));
});

Route::get('admin/login', array(
    'as'   => 'admin.login',
    'uses' => 'AdminLoginController@login',
));