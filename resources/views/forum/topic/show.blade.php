@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4><a href="{{ route('forum') }}">Forum</a> &raquo; <a href="{{ route('forum.category', ['forum' => $forum->slug]) }}">{{ $forum->name }}</a> &raquo; {{ $topic->title }}</h4>
        </div>
        <div class="col-sm-5 rt">
            @if(checkAuth())
                <span><i class="fa fa-newspaper-o"></i></span>
                <a title="Edit topic" href="{{ route('forum.topic.message.edit', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug, 'messageId' => $topic->firstPost()]) }}">
                    <i class="fa fa-pencil-square"></i>
                </a>

                @if(checkAdmin() or checkModerator())
                <form method="post" class="inline" action="{{ route('forum.topic.message.destroy', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug, 'messageId' => $topic->firstPost()->id])}}">
                    <input type="hidden" name="_method" value="DELETE">
                    {!! csrf_field() !!}
                    <button class="no-bg p0 autoh" title="Delete topic"  onclick="javascript:return confirm('Are you absolutely sure you want to remove this post?')"><i class="fa fa-times-circle danger"></i></button>
                </form>
                @endif
            @endif
        </div>
    </div>

    <h1>{{{ $topic->title }}} {!! $topic->isSolved() ? '<i class="fa fa-check-circle green" title="Answered"></i>':'' !!}</h1>

    @include('forum.topic._parts.entry', ['message' => $topic->firstPost()])

    @if(Auth::check())
        @include('forum.topic._parts.reply')
    @endif

    @foreach(($topic->messages[0]->answer==1?$topic->messages->forget(1):$topic->messages->forget(0)) as $message)
        @include('forum.topic._parts.entry', ['message' => $message])
    @endforeach
@stop