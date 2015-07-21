@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4><a href="{{ route('forum') }}">Forum</a> &raquo; {{ $forum->name }}</h4>
        </div>
        @if(checkAuth())
            <div class="col-sm-5 rt">
                <a title="Edit forum" href="{{ route('forum.edit', ['forum' => $forum->slug]) }}"><i class="fa fa-pencil-square"></i></a>
            </div>
        @endif
    </div>

    @if(Auth::check() and $forum->locked != 1 or $forum->locked == 1 and checkAdmin())
        <p class="mt10"><a href="{{ route('forum.topic.create', ['forum' => $forum->slug])}}" class="button newtopic"><i class="fa fa-plus-square"></i> New topic</a></p>
    @endif

    <table class="table table-condensed forum">
        <thead>
        <tr>
            <th>Title</th>
            <th>Replies / Views</th>
            <th>Last post by</th>
        </tr>
        </thead>
        @foreach($forum->topics as $topic)
            <tr>
                <td class="title">
                    @if($topic->sticky)
                        <i class="fa fa-thumb-tack pull-left" title="Sticky"></i>
                    @endif
                    <a class="block" href="{{ route('forum.topic', ['forum'=>$forum->slug, 'topic' => $topic->slug, 'id' => $topic->id]) }}" title="{{{ $topic->body }}}">
                        {{{ $topic->title }}}
                        {!! $topic->isSolved() ? '<i class="fa fa-check-circle green" title="Answered"></i>':'' !!}
                        <small>by {{ $topic->author->username }} {{ $topic->created_at->format('j M y, H:i') }}</small>
                    </a>
                </td>
                <td>
                    Replies: {{ $topic->messages->count()-1 }} <br/>
                    Views: {{ $topic->views }}</td>
                <td>
                    by <a href="{{ route('user', ['user' => $topic->lastPost()->author->slug]) }} ">{{ $topic->lastPost()->author->username }}</a> <br/>
                    {{ $topic->lastPost()->created_at->format('j M y, H:i') }}
                </td>
            </tr>
        @endforeach
    </table>

@stop