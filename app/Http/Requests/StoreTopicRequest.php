<?php

namespace CF\Http\Requests;

use CF\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class StoreTopicRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if(Auth::check()) {
			return true;
		}
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
			'body'  => 'required'
        ];
    }
}
