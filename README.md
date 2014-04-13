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
        "sahibalejandro/admin": "1.*"
    }
    ...

After installing the new package add the Service Provider to the `providers`
array in your `app/config/app.php` file:

    ...
    'providers' => array(
        ...
        'Sahibalejandro\Admin\AdminServiceProvider',
    )
    ...


**At this point YOU NEED to do a few more easy steps to configure the package
`ollieread/multiauth`, please follow this
[link](https://github.com/ollieread/multiauth#installation) and come back when
you're ready to continue.**


Publish the assets to your project's `public` directory:

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
