@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4>Forum</h4>
        </div>
        @if(checkAuth())
            <div class="col-sm-5 rt">
                <a href="{{ action('Forum\ForumController@create') }}" title="Create new forum"><i class="fa fa-plus-square"></i></a>
            </div>
        @endif
    </div>

    <table class="table table-condensed forum">
        <thead>
        <tr>
            <th>Forum</th>
            <th>Topics / Posts</th>
            <th>Latest post by</th>
        </tr>
        </thead>
        @foreach($categories as $forum)
            <tr>
                <td class="title">
                    <a class="block" href="{{ route('forum.category', ['forum'=>$forum->slug]) }}">{{ $forum->name }}
                        <small>{{ $forum->description }}</small>
                    </a>
                </td>
                <td>
                    Topics: {{ $forum->topics->count() }} <br/>
                    Posts: {{ $forum->messages->count() }}
                </td>
                <td>
                    @if($forum->lastPost())
                        by <a href="{{ route('user', ['user' => $forum->lastPost()->author->slug]) }} ">{{ $forum->lastPost()->author->username }}</a>
                        <br/>
                        {{ $forum->lastPost() ? $forum->lastPost()->updated_at->format('j M y, H:i') : '' }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@stop