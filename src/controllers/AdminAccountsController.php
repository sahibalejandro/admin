<?php
class AdminAccountsController extends AdminBaseController
{
    public function index()
    {
        return View::make('admin::admin.accounts.index')
               ->with('admins', Admin::orderBy('name')->get());
    }

    public function edit($id = null)
    {
        if ($id == null) {
            $Admin = new Admin;
        } else {
            $Admin = Admin::findOrFail($id);
        }

        return View::make('admin::admin.accounts.edit')
               ->with('Admin', $Admin);   
    }

    public function save($id = null)
    {
        /**
         * Create validation rules and validate input data.
         * Password rule only needed when is new admin.
         */
        $rules = array(
            'password_check' => 'required_with:password|same:password',
            'name'           => 'required',
            'username'       => 'required|min:5|max:20',
        );

        if ($id == null) {
            $rules['password'] = 'required|min:10';
        }

        $Validator = Validator::make(Input::all(), $rules);

        /**
         * If validation fails return to edit form.
         * If validation passes insert/update the admin account and
         * return to accounts list.
         */
        if ($Validator->fails()) {
            return Redirect::back()->withInput()->withErrors($Validator);
        } else {

            if ($id == null) {
                $Admin = new Admin;
            } else {
                $Admin = Admin::findOrFail($id);
            }

            $Admin->name        = Input::get('name');
            $Admin->username    = Input::get('username');
            $Admin->active      = Input::has('active') ? 1 : 0;
            $Admin->super_admin = Input::has('super_admin') ? 1 : 0;
            
            if (Input::get('password') != '') {
                $Admin->password = Hash::make(Input::get('password'));
            }

            if ($Admin->save()) {
                return Redirect::route('admin.accounts')
                       ->with('success', trans('admin::accounts/save.success'));
            } else {
                return Redirect::route('admin.accounts')
                       ->withInput()
                       ->with('error', trans('admin::accounts/save.error'));
            }
        }
    }
}