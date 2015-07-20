<?php

namespace CF\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use CF\Http\Requests;
use CF\Http\Controllers\Controller;

class ProfileSettingsController extends Controller
{

	/**
	 * Update the specified resource in storage.
	 * @param $id
	 */
    public function update(Requests\PutProfileSettingsRequest $request)
    {
        $settings = Auth::user()->settings;
		$settings->mail_pings = $request->has('mail_pings');
		$settings->save();

		return redirect()->to('/profile');
    }
}
