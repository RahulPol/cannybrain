<?php namespace App\Services;

use App\User;
use App\Role;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role'=> 'required|in:user,admin',
            'mobile_number' => 'required|digits_between:10,11',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        $role = Role::where('name', '=', $data['role'])->firstOrFail();
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'company_id'=> isset($data['company_id']) ? $data['company_id'] : 1,
            'group_name' => isset($data['group_name']) ? $data['group_name'] : null,
            'dob' => isset($data['dob']) ? $data['dob'] : null,
            'mobile_number' => $data['mobile_number'],
            'role_id'=> $role->id
        ]);
    }
}
