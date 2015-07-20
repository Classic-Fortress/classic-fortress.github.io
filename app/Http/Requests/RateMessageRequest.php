<?php

namespace CF\Http\Requests;

use CF\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class RateMessageRequest extends Request
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
            'message_id' => 'required|numeric',
			'vote'       => ['required','regex:/(1|-1)/i']
        ];
    }
}
