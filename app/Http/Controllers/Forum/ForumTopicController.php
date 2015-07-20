<?php

namespace CF\Http\Controllers\Forum;

use CF\ForumCategory;
use CF\ForumMessage;
use CF\ForumTopic;
use Illuminate\Http\Request;

use CF\Http\Requests;
use CF\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForumTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($slug)
    {
        $forum = ForumCategory::where('slug', $slug)->firstOrFail();

		return view('forum.topic.create', compact('forum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($slug, Requests\StoreTopicRequest $request)
    {
        $forum = ForumCategory::where('slug', $slug)->firstOrFail();

		$topic = ForumTopic::create([
			'category_id' => $forum->id,
			'user_id'     => Auth::user()->id,
			'title'       => e($request->title),
			'sticky'      => $request->has('sticky'),
			'question'    => $request->has('question')
		]);

		ForumMessage::create([
			'topic_id'    => $topic->id,
			'category_id' => $forum->id,
			'user_id'     => Auth::user()->id,
			'body'        => e($request->body)
		]);

		return redirect()->route('forum.topic', ['forum' => $forum->slug, 'topic' => $topic->slug, 'id' => $topic->id]);

    }


    public function show($forumSlug, $topicId, $topicSlug)
    {
		$forum = ForumCategory::where('slug', $forumSlug)->firstOrFail();
		$topic = ForumTopic::with(['messages.author','messages' => function($q) {
			$q->orderBy('answer','desc')->orderBy('created_at', 'asc');
		}])->find($topicId);

		$topic->views += 1;
		$topic->save();

		if(\Illuminate\Support\Facades\Request::ajax()) {
			return response()->json(compact('forum', 'topic'));
		}

		return view('forum.topic.show', compact('forum', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}