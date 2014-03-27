[![Latest Stable Version](https://poser.pugx.org/sahibalejandro/admin/version.png)](https://packagist.org/packages/sahibalejandro/admin) [![Latest Unstable Version](https://poser.pugx.org/sahibalejandro/admin/v/unstable.png)](//packagist.org/packages/sahibalejandro/admin) [![Total Downloads](https://poser.pugx.org/sahibalejandro/admin/downloads.png)](https://packagist.org/packages/sahibalejandro/admin) [![License](https://poser.pugx.org/sahibalejandro/admin/license.png)](https://packagist.org/packages/sahibalejandro/admin)

Description
===========

A basic admin panel login interface, with this you can start building your own
admin panel following the layout this package provides.

This package was made for a personal project, but I think it may help you too.

Installation
============

Add the package to your `composer.json` file and install it.

    ...
    "require": {
        "sahibalejandro/admin": "1.*"
    }
    ...

After installing the new package add the Service Provider to the `providers` array in your `app/config/app.php` file:

    ...
    'providers' => array(
        ...
        'Sahibalejandro\Admin\AdminServiceProvider',
    )
    ...

Publish the assets to your project's `public` directory:

    php artisan asset:publish sahibalejandro/admin

Create the `users` table. By default there is a user named `admin` with the
password `admin`.

    php artisan migrate --package="sahibalejandro/admin"

Create a routes group in your `app/routes.php` file, where to put all your
admin sections:

    Route::group(array('before' => 'admin-auth'), function ()
    {
        Route::get('admin', 'AdminController@home');
    });

At this point you may wish create your own `AdminController` controller.

Customization
=============

In the most cases you will need to modify the package's views, you can easily
export the package views to your own `app/views` directory using the command:

    php artisan view:publish sahibalejandro/admin

This command will copy the package's views into the `app/views/packages`
directory. Once the views have been published, you may tweak them to your
liking! The exported views will automatically take precendence over the
package's own view files.

The Navbar menu is located in the view `admin/navbar.blade.php` and uses
Twitter's Boorstrap layout.