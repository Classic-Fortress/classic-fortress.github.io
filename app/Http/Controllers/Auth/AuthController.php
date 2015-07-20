<?php

namespace CF\Http\Controllers\Auth;

use CF\Http\Requests\LoginUserRequest;
use CF\Http\Requests\RegisterUserRequest;
use CF\Repositories\AuthRepository;
use CF\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Hashing\Hasher;
use CF\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use CF\Events\UserRegistered;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;

class AuthController extends Controller
{
    use ThrottlesLogins;

	private $auth;

    public function __construct(AuthRepository $auth)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

		$this->auth = $auth;
    }

	public function postRegister(RegisterUserRequest $request)
	{
		$user = $this->auth->register($request);

		// Send welcome mail.
		event(new UserRegistered($user));

		return $this->backFlash(['Account created!'],'success');
    }

	public function postLogin(LoginUserRequest $request, User $user)
	{
		try
		{
			$this->auth->login(null, $request);
		}
		catch(\Exception $e)
		{
			return $this->backFlash(['Wrong email/password combo.'],'error');
		}

		return redirect()->back();
	}

	public function redirectToProvider()
	{
		// Set referer url
		session()->flash('register.loginUrl', (string)Request::server('HTTP_REFERER'));

		return Socialite::driver('facebook')->redirect();
	}

	public function handleProviderCallback()
	{
		$socialUser = Socialite::driver('facebook')->user();

		if($user = User::where('email', $socialUser->email)->first())
		{
			$this->auth->login($user);
			return redirect()->to(session('register.loginUrl'));
		}

		session()->flash('register.email', (string) $socialUser->email);

		return redirect()->to(session('register.loginUrl').'#login');

	}

	public function getLogout()
	{
		$this->auth->logout();

		return redirect('/');
	}
}
