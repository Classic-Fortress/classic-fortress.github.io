<?php

namespace CF\Http\Requests;

use CF\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class PutProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if(! Auth::check())
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
			'email'          => 'required|unique:users,email,'.Auth::user()->id.'|email|max:255',
            'username'       => 'required|unique:users,username,'.Auth::user()->id.'|max:50',
			'real_name'      => 'max:255',
			'location'       => 'max:255',
			'previous_clans' => 'max:255',
			'information'    => ''
        ];
    }
}
