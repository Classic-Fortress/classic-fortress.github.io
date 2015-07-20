<?php

namespace CF\Http\Controllers;

use Illuminate\Http\Request;

use CF\Http\Requests;
use CF\User;
use CF\Role;
use CF\Http\Controllers\Controller;

class UserController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$users = User::all();

		return view('users', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
		try
		{
			$user = User::where('slug', $slug)->firstOrFail();
			$roles = Role::where('name','!=','member')->orderBy('id')->lists('name', 'id');

			return view('user', compact('user', 'roles'));
		}
		catch(\Exception $e) {
			abort(404, 'User not found');
		}
    }
}
