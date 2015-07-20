<?php

namespace CF\Traits\User;

use CF\ForumMessage;
use CF\ForumTopic;

trait ForumTrait {

	/**
	 * @return mixed
	 */
	public function posts()
	{
		return $this->hasMany(ForumMessage::class, 'user_id');
	}

	/**
	 * @return mixed
	 */
	public function threads()
	{
		return $this->hasMany(ForumTopic::class);
	}


	/**
	 * Count number of posts
	 * @return int
	 */
	public function postCount()
	{
		return $this->posts()->count();
	}

	/**
	 * Calc forum experience
	 * @return int
	 */
	public function experience($exp = 0)
	{
		foreach ($this->posts()->get() as $post)
		{
			$rating = $post->rating();
			if($rating>0) $exp += $rating;
			if($rating<0) $exp -= $rating;
		}

		$exp += $this->postCount();

		return $exp;
	}

	/**
	 * Returns number of answers made by user
	 * @return mixed
	 */
	public function answers()
	{
		return ForumMessage::where('answer',1)->where('user_id', $this->id)->count();
	}

} 