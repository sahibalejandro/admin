<?php
class AdminAccountController extends Controller
{
    public function edit($id = 0)
    {
        $Admin = User::first();

        return View::make('admin::admin.account.edit')
               ->with('Admin', $Admin);   
    }

    public function save()
    {
        /**
         * Create validation rules and validate input data.
         * Password rule only needed when is new admin.
         */
        $rules = array(
            'password_check' => 'required_with:password|same:password',
            'username'       => 'required'
                .'|min:5'
                .'|max:20'
                .'|regex:/^[a-z0-9\.]+$/i',

        );

        $Validator = Validator::make(Input::all(), $rules);

        /**
         * If validation fails return to edit form.
         * If validation passes insert/update the admin account and
         * return to accounts list.
         */
        if ($Validator->fails()) {
            return Redirect::route('admin.account.edit')
                   ->withInput()
                   ->withErrors($Validator);
        } else {
            
            $Admin = User::first();

            $Admin->username = Input::get('username');
            
            if (Input::get('password') != '') {
                $Admin->password = Hash::make(Input::get('password'));
            }

            if ($Admin->save()) {
                return Redirect::route('admin.account.edit')
                       ->with('success', 'Account data saved.');
            } else {
                return Redirect::route('admin.account.edit')
                       ->withInput()
                       ->with('error', "Can't save data, try again.");
            }
        }
    }
}