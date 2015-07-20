<?php

namespace CF\Http\Controllers\Forum;

use Carbon\Carbon;
use CF\ForumCategory;
use CF\ForumMessage;
use CF\ForumVote;
use CF\ForumTopic;
use Illuminate\Http\Request;

use CF\Http\Requests;
use CF\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForumMessageController extends Controller
{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($forumSlug, $topicid, $topic, Requests\StoreReplyRequest $request)
	{
		$forum = ForumCategory::where('slug', $forumSlug)->firstOrFail();
		ForumMessage::create([
			'topic_id'    => $topicid,
			'category_id' => $forum->id,
			'user_id'     => Auth::user()->id,
			'body'        => e($request->body)
		]);

		return redirect()->route('forum.topic', ['forum' => $forum->slug, 'topic' => $topic, 'id' => $topicid]);
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($forumSlug, $topicId, $topicSlug, $messageId)
	{
		$forum = ForumCategory::where('slug', $forumSlug)->firstOrFail();
		$topic = ForumTopic::find($topicId);
		$message = ForumMessage::find($messageId);

		if(\Illuminate\Support\Facades\Request::ajax()) {
			return response()->json(compact('forum', 'topic'));
		}

		return view('forum.topic.edit', compact('forum', 'topic', 'message'));
	}

	/**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($forum, $topicId, $topicSlug, $messageId, Requests\PutMessageRequest $request)
    {
        $message = ForumMessage::find($messageId);
		$message->body = e($request->body);
		$message->edited_at = Carbon::now();
		$message->save();

		if($message->isMainPost())
		{
			$topic = ForumTopic::find($message->topic_id);
			$topic->sticky   = $request->has('sticky');
			$topic->question = $request->has('question');
			$topic->save();
		}

		return redirect()->route('forum.topic', ['forum' => $forum, 'id' => $topicId, 'topic' => $topicSlug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($forum, $id, $topic, $message)
    {
        $message = ForumMessage::find($message);

		if($message->user_id == Auth::user()->id or Auth::user()->isAdmin() or Auth::user()->isModerator())
		{
			if($message->isMainPost()) {
				$topic = ForumTopic::find($message->topic_id);
				$topic->messages()->delete();
				$topic->delete();

				return redirect()->route('forum.category', ['forum' => $forum]);
			}

			$message->delete();

			return redirect()->route('forum.topic', ['forum' => $forum, 'id' => $id, 'topic' => $topic]);
		}
    }

	/**
	 * Rate message
	 */
	public function rate($forum, $id, $topic, Requests\RateMessageRequest $request)
	{
		$message = ForumMessage::find($request->message_id);

		if($rating = ForumVote::where('message_id', $request->message_id)->where('user_id', Auth::user()->id)->first())
		{
			if ($rating->vote == $request->vote)
			{
				$rating->delete();
			}
			else
			{
				$rating->vote = $request->vote;
				$rating->save();
			}
		}
		else
		{
			ForumVote::create([
				'user_id'    => Auth::user()->id,
				'message_id' => $request->message_id,
				'vote'       => $request->vote
			]);
		}

		if(\Illuminate\Support\Facades\Request::ajax()) {
			return response()->json(['rating' => $message->rating()]);
		}

		return redirect()->back();
	}

	public function answer($forum, $id, $topic, $message)
	{
		$message = ForumMessage::find($message);
		$message->answer();

		if(\Illuminate\Support\Facades\Request::ajax()) {
			return response()->json(['status' => 'ok.']);
		}

		return redirect()->back();
	}
}
