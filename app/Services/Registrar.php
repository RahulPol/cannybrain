<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

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
			'dob'=> 'required|date',
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
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],			
			'password' => bcrypt($data['password']),
			'company_id'=> '1',//get company_id from company name
			'group_name' => isset($data['group_name']) ? $data['group_name'] : null,
			'dob' => isset($data['dob']) ? $data['dob'] : null,
			'mobile_number' => $data['mobile_number']
		]);
	}

}
