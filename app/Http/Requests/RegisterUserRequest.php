<?php

namespace CF\Http\Requests;

use CF\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if(Auth::check())
        	return false;

		return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'           => 'required|unique:users,email|email|max:255',
			'username'        => 'required|unique:users,username|alpha_num|max:50',
			'password'        => 'required|max:255',
			'repeat-password' => 'required|same:password',
			'my_name'         => 'honeypot',
			'my_time'         => 'required|honeytime:2'
        ];
    }
}
