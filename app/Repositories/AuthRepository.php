<?php

namespace CF\Repositories;

use CF\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{

	private $hasher;
	private $guard;

	public function __construct(Hasher $hasher, Guard $guard)
	{
		$this->hasher = $hasher;
		$this->guard  = $guard;
	}

	public function register($details)
	{
		$user = new User();
		$user->username = $details->username;
		$user->email    = $details->email;
		$user->password = $this->hasher->make($details->password);
		$user->save();

		$user->assignRole(1);

		$user->settings()->create([
			'user_id' => $user->id4
		]);

		$this->login($user);

		return $user;
	}

	public function login(User $user = null, $input = null)
	{
		if( ! empty($input) and $this->guard->attempt(['email' => $input->email, 'password' => $input->password], $input->has('remember')))
		{
			$this->guard->user()->checkDefaults();
			return true;
		}
		elseif( ! empty($input))
			throw new \Exception('Invalid email/password combo');

		$user->checkDefaults();
		$this->guard->login($user);
	}

	public function logout()
	{
		$this->guard->logout();
	}

}
