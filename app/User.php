<?php

namespace CF;

use CF\Traits\Slugable;
use CF\Traits\User\ForumTrait;
use CF\Traits\User\RoleTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Slugable, ForumTrait, RoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

	/**
	 * Field to create slug from
	 * @var string
	 */
	protected $slugField = 'username';

	public function info()
	{
		return $this->hasOne(UserInfo::class);
	}

	public function settings()
	{
		return $this->hasOne(UserSetting::class, 'user_id');
	}

	public function checkDefaults()
	{
		if( ! $this->settings()->first()) {
			$this->settings()->create([
				'user_id' => $this->id
			]);
		}

		if( ! $this->info()->first()) {
			$this->info()->create([
				'user_id' => $this->id
			]);
		}
	}
}
