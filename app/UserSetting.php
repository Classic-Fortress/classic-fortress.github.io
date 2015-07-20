<?php

namespace CF;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = ['user_id', 'mail_pings'];

	public $timestamps = false;
	public $primaryKey = "user_id";
}
