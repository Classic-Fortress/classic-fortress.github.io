<?php

namespace CF;

use CF\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumTopic extends Model
{

	use SoftDeletes, Slugable;

	protected $fillable  = ['category_id', 'user_id', 'title', 'body', 'sticky', 'question'];
	protected $dates     = ['deleted_at'];
	protected $touches   = ['category'];
	protected $slugField = 'title';

	public function category()
	{
		return $this->belongsTo(ForumCategory::class, 'category_id');
	}

	public function messages()
	{
		return $this->hasMany(ForumMessage::class, 'topic_id');
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * Check if topic has an answer
	 * @return bool
	 */
	public function isSolved()
	{
		$answer = ForumMessage::where('topic_id', $this->id)->where('answer', 1)->first();

		return $answer ? true:false;
	}

	public function firstPost()
	{
		return ($this->messages[0]->answer==1?$this->messages[1]:$this->messages[0]);
	}

	public function lastPost()
	{
		return $this->messages->sortBy('created_at')[count($this->messages)-1];
	}

}
