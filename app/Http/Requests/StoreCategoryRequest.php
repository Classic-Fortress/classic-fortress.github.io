<?php

namespace CF\Http\Requests;

use CF\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if( ! checkAdmin()) {
			return false;
		}

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
            'name' => 'required|max:255',
			'description' => 'required'
        ];
    }
}
