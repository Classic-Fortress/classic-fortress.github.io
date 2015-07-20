<?php

namespace CF\Traits\User;

use CF\Role;
use Illuminate\Support\Facades\Auth;

trait RoleTrait {

	/**
	 * @return mixed
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}


	/**
	 * Check if user has supplied role.
	 * @param $role
	 * @return bool
	 */
	public function hasRole($role)
	{
		if(is_string($role))
		{
			foreach ($this->roles as $Role)
			{
				if (is_string($role) && $Role->name == $role) return true;
				elseif (is_numeric($role) && $Role->id == $role) return true;
			}
		}
		elseif(is_array($role))
		{
			foreach($role as $rolee)
			{
				foreach ($this->roles as $Role)
				{
					if (is_string($rolee) && $Role->name == $rolee) return true;
					elseif (is_numeric($rolee) && $Role->id == $rolee) return true;
				}
			}
		}
		return false;
	}

	/**
	 * Assign role to user.
	 * @param $role
	 * @return mixed
	 */
	public function assignRole($role)
	{
		if(! $this->hasRole($role))
			return $this->roles()->attach($role);
	}

	/**
	 * Remove role from user.
	 * @param $role
	 * @return mixed
	 */
	public function revokeRole($role)
	{
		return $this->roles()->detach($role);
	}

	/**
	 * List all roles in a string
	 * @param array $t
	 * @return string
	 */
	public function listRoles(array $t = [])
	{
		foreach($this->roles as $Role)
		{
			if($Role->name != 'member')
				$t[] = $Role->name;
		}
		return implode(', ', $t);
	}

	/**
	 * Check if user is an admin
	 * @return bool
	 */
	public function isAdmin()
	{
		if(Auth::check() and $this->hasRole(['administrator','super user']))
			return true;

		return false;
	}

	/**
	 * Check if user is a moderator
	 * @return bool
	 */
	public function isModerator()
	{
		return $this->hasRole(['moderator']) ? true:false;
	}

} 