<?php

namespace CF\Http\Controllers;

use CF\User;
use Illuminate\Http\Request;

use CF\Http\Requests;
use CF\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as Req;

class RoleController extends Controller
{

	public function __construct()
	{
		$this->middleware('role.admin');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($user, Request $request)
    {
		if( ! checkAdmin() ) return $this->backFlash(['No!'], 'error');

		$user = User::where('slug', $user)->first();
		$user->assignRole($request->role);

		return $this->backFlash(['Role added!'], 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user)
    {
		$user = User::where('slug', $user)->first();
		$user->revokeRole(Req::get('role'));

		return $this->backFlash(['Role revoked!'], 'success');
    }
}
