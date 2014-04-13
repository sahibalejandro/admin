<?php
class AdminLoginController extends AdminBaseController
{
    /**
     * Show sign in interface
     */
    public function login()
    {
        return View::make('admin::admin.login');
    }

    /**
     * Log out the user and redirect to "admin-login"
     */
    public function logout()
    {
        Auth::admin()->logout();
        return Redirect::route('admin.login')
               ->with('message', trans('admin::login.logout'));
    }

    /**
     * Make the Auth::attempt() and redirects to Admin's home
     * or "admin-login" if fails.
     */
    public function postLogin()
    {
        $auth = Auth::admin()->attempt(array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'active'   => 1,
        ), Input::has('remember'));

        if ($auth) {
            return Redirect::intended(Config::get('admin::admin.url'))
                   ->with('message', trans('admin::login.login'));
        } else {
            return Redirect::route('admin.login')
                   ->with('error', trans('admin::login.fail'))
                   ->withInput();
        }
    }
}