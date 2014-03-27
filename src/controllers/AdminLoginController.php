<?php
class AdminLoginController extends Controller
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
        Auth::logout();
        return Redirect::route('admin.login')
               ->with('message', 'You are logged out.');
    }

    /**
     * Make the Auth::attempt() and redirects to Admin's home
     * or "admin-login" if fails.
     */
    public function postLogin()
    {
        $auth = Auth::attempt(array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ), Input::has('remember'));

        if ($auth) {
            return Redirect::intended('admin')
                   ->with('message', 'You are logged in.');
        } else {
            return Redirect::route('admin.login')
                   ->with('error', 'Incorrect access data, try again.')
                   ->withInput();
        }
    }
}