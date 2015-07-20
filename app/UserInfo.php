<?php

namespace CF;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

	public $timestamps = false;
	public $primaryKey = "user_id";
	protected $fillable = ['user_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
