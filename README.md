sahibalejandro/admin
====================

[![Latest Stable Version](https://poser.pugx.org/sahibalejandro/admin/version.png)](https://packagist.org/packages/sahibalejandro/admin) [![Latest Unstable Version](https://poser.pugx.org/sahibalejandro/admin/v/unstable.png)](//packagist.org/packages/sahibalejandro/admin) [![Total Downloads](https://poser.pugx.org/sahibalejandro/admin/downloads.png)](https://packagist.org/packages/sahibalejandro/admin) [![License](https://poser.pugx.org/sahibalejandro/admin/license.png)](https://packagist.org/packages/sahibalejandro/admin)

Description
===========

A basic admin panel login interface, with this you can start building your own
admin panel following the layout this package provides.

**IMPORTANT: This package uses [ollieread/multiauth](https://github.com/ollieread/multiauth),
but you don't need to add that requirement to your `composer.json` file.**

This package was made for a personal project, but I think it may help you too.

Installation
============

Add the package to your `composer.json` file and install it.  
**NOTE: You don't need to add the `ollieread/multiauth` package.**

    ...
    "require": {
        "sahibalejandro/admin": "2.*"
    }
    ...

After installing the new package, add the new *Service Providers* and
disable the default `AuthServiceProvider`.  
To do this open your `app/config/app.php`
file and edit the `providers` array like this:

    ...
    'providers' => array(
        ...

        // Add the new service providers
        'Sahibalejandro\Admin\AdminServiceProvider',
        'Ollieread\Multiauth\MultiauthServiceProvider',

        // Disable default Laravel's Auth Service Provider
        //'Illuminate\Auth\AuthServiceProvider',

        ...
    )
    ...

To properly configure **Ollie Read Multiauth** open `app/config/auth.php` with
its default values:

    return array(
        'driver' => 'eloquent',
        'model' => 'User',
        'table' => 'users',
        ...
    );

Now remove the first three options and replace as follows:

    return array(
        'multi' => array(

            'user' => array(
    			      'driver' => 'eloquent',
    			      'model'  => 'User',
            ),

            'admin' => array(
    		 	     'driver' => 'eloquent',
    			      'model'  => 'Admin',
            ),
        ),
        ...
    );

*Read more about [**Ollie Read's Multiauth**](https://github.com/ollieread/multiauth) on his GitHub repository.*

Now that we have service providers and multiauth configured, it's time to publish
the assets to your project's `public` directory:

    php artisan asset:publish sahibalejandro/admin

Create the `admins` table. By default there is a user named `admin` with the
password `admin`.

    php artisan migrate --package="sahibalejandro/admin"

You can create your own routes using the filter `admin-auth`.

    Route::group(array('before' => 'admin-auth'), function ()
    {
        Route::get('admin', 'AdminController@home');
    });

Now just create your own admin controllers extending the `AdminBaseController`
class.

Customization
=============

To overwrite configuration options execute the next command:

    php artisan config:publish sahibalejandro/admin

When this command is executed, the configuration files for your application
will be copied to `app/config/packages/sahibalejandro/admin` where they can
be safely modified by you.

You can customize the navbar menu on the config file `admin.php`, here is
an example:

    return array(
        // The entire menu
        'menu' => array(
            // A menu item
            array(
                'text' => 'Products', // Text to show
                'url'  => 'products', // URL (will be automatically prefixed)
            ),
            // A menu item
            array(
                'text' => 'Magazines', // Text to show
                'url'  => 'magazines', // URL

                // A submenu for magazines
                'submenu' => array(
                    array(
                        'text' => 'View magazines',
                        'url'  => '', // URL (will be automatically prefixed)
                    ),
                    array(
                        'text' => 'Add magazine',
                        'url'  => 'add', // URL (will be automatically prefixed)
                    ),
                ),
            ),
        ),
    );

If you need to customize package's default views first execute the next
command:

    php artisan view:publish sahibalejandro/admin

This command will copy the package's views into the `app/views/packages`
directory. Once the views have been published, you may tweak them to your
liking! The exported views will automatically take precendence over the
package's own view files.
