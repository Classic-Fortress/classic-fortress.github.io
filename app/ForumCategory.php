<?php

namespace CF;

use CF\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{

	use Slugable;

	protected $fillable = ['name', 'slug', 'description', 'order', 'locked'];
	protected $slugField = 'name';

	public function topics()
	{
		return $this->hasMany(ForumTopic::class, 'category_id', 'id');
	}

	public function messages()
	{
		return $this->hasMany(ForumMessage::class, 'category_id', 'id');
	}

	public function lastPost()
	{
		return $this->messages()->orderBy('created_at','desc')->first();
	}
}
