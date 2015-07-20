<?php

namespace CF\Http\Controllers;

use CF\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use CF\Http\Requests;
use CF\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(Guard $guard)
    {
		$user = User::with(['settings','info'])->find($guard->user()->id);
        return view('profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function putIndex(Requests\PutProfileRequest $request)
    {
        $user = Auth::user();

		$user->email = $request->email;
		$user->username = $request->username;
		$user->save();

		$user->info->real_name      = $request->real_name;
		$user->info->location       = $request->location;
		$user->info->previous_clans = $request->previous_clans;
		$user->info->information    = $request->information;
		$user->info->save();

		return redirect()->to('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteIndex($id)
    {
        //
    }
}
