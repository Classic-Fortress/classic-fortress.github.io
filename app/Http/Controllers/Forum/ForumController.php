<?php

namespace CF\Http\Controllers\Forum;

use CF\ForumCategory;
use Illuminate\Http\Request;

use CF\Http\Requests;
use CF\Http\Controllers\Controller;

class ForumController extends Controller
{

	public function __construct()
	{
		$this->middleware('role.admin', ['only' =>['create','store']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$categories = ForumCategory::with(['topics.author', 'messages'])->get();

        return view('forum.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\StoreCategoryRequest $request)
    {
        $category = ForumCategory::create([
			'name' => $request->name,
			'description' => $request->description,
			'order' => $request->order,
			'locked' => $request->locked
		]);

		return $this->backFlash(['Forum created!'], 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
		try
		{
			$forum = ForumCategory::with(['topics' => function ($q) {
				$q->with(['messages', 'author'])->orderBy('sticky', 'desc')->orderBy('updated_at', 'desc');
			}])->where('slug', $slug)->firstOrFail();

			return view('forum.category', compact('forum'));
		}
		catch(\Exception $e) { abort(404); };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($forum)
    {
        try
		{
			$forum = ForumCategory::where('slug', $forum)->firstOrFail();

			return view('forum.edit', compact('forum'));
		}
		catch(\Exception $e) { abort(404); }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($forum, Requests\PutForumRequest $request)
    {
		try
		{
			$forum = ForumCategory::where('slug', $forum)->firstOrFail();

			$forum->name = $request->name;
			$forum->description = $request->description;
			$forum->order = $request->has('order');
			$forum->locked = $request->has('locked');

			$forum->save();

			return redirect()->route('forum', $forum->slug);
		}
		catch(\Exception $e) { abort(404); }
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
