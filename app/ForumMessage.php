<?php

namespace CF;

use CF\Traits\Pingable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ForumMessage extends Model
{

	use SoftDeletes, Pingable;

	/**
	 * @var array
	 */
	protected $fillable = ['topic_id', 'category_id', 'user_id', 'body'];
	/**
	 * @var array
	 */
	protected $dates    = ['deleted_at', 'edited_at'];
	/**
	 * @var array
	 */
//	protected $touches  = ['category', 'topic'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(ForumCategory::class, 'category_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function topic()
	{
		return $this->belongsTo(ForumTopic::class, 'topic_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * @return mixed
	 */
	public function rating()
	{
		return $this->hasMany(ForumVote::class, 'message_id')->sum('vote');
	}

	/**
	 * Checks if message is editable
	 * @return bool
	 */
	public function isEditable()
	{
		if(Auth::check())
		{
			if(Auth::user()->id == $this->author_id)
			{
				if ($this->created_at->diffInMinutes(Carbon::now()) < 30)
				{
					return true;
				}
			}

			if(Auth::user()->hasRole(['moderator', 'administrator', 'super user'])) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Checks is message is the main message of the thread.
	 */
	public function isMainPost()
	{
		$topic = ForumTopic::with(['messages' => function($q) {
			$q->orderBy('created_at','asc');
		}])->find($this->topic_id);

		if($topic->messages[0]->id == $this->id) return true;

		return false;

	}

	public function parse()
	{
		foreach (checkUsernames($this->body) as $username)
		{
			if($user = User::where('username', $username)->first()) {
				$this->body = preg_replace('/@('.$username.')/', '<a href="/user/$1">@$1</a>', $this->body);
			}
		}
		return $this;
	}

	public function answer()
	{
		if($oldAnswer = ForumMessage::where('topic_id', $this->topic_id)->where('answer', 1)->first()) {
			$oldAnswer->answer = 0;
			$oldAnswer->save();
		}

		$this->answer = 1;
		$this->save();

	}

}
