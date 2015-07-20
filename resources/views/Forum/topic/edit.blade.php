@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4><a href="{{ route('forum') }}">Forum</a> &raquo; <a href="{{ route('forum.category', ['forum' => $forum->slug]) }}">{{ $forum->name }}</a> &raquo; {{ $topic->title }}</h4>
        </div>
        <div class="col-sm-5 rt">
            <form method="post" class="inline" action="{{ route('forum.topic.message.destroy', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug, 'messageId' => $message->id])}}">
                <input type="hidden" name="_method" value="DELETE">
                {!! csrf_field() !!}
                <button class="no-bg p0 autoh" title="{{ $message->isMainPost() ? 'Delete topic':'Delete message' }}" onclick="javascript:return confirm('Are you absolutely sure you want to remove this post?')"><i class="fa fa-times-circle danger"></i></button>
            </form>
        </div>
    </div>

    <h3>Edit message</h3>
    <form method="post" action="{{ route('forum.topic.message.update', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug, 'messageId' => $message->id])}}">
        <input type="hidden" name="_method" value="PUT">
        {!! csrf_field() !!}

        @if($message->isMainPost())
            <div class="mt10">
                <label for="title">Title:</label>
                <input type="text" name="title" value="{{ $topic->title }}">
            </div>

            @if(checkAdmin() or checkModerator())
                <div class="mt10">
                    <label for="sticky" title="Sticky topic">Sticky:</label>
                    <input type="checkbox" name="sticky" {{ $topic->sticky ? 'checked=checked':'' }}>
                </div>
            @endif

            {{--<div class="mt10">--}}
                {{--<label for="question" title="Question topic">Question:</label>--}}
                {{--<input type="checkbox" name="question" {{ $topic->question ? 'checked=checked':'' }}>--}}
            {{--</div>--}}
        @endif

        <div class="module clearfix">
            <div class="ontop">
                <textarea name="body" id="body" mdpreview>{{ $message->body }}</textarea>
                <button><i class="fa fa-send"></i> Reply</button>
                <small>* You may use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a> with <a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub-flavored</a> code blocks.</small>
                <div class="pull-right" title="Preview">
                    Preview <input type="checkbox" name="preview"/>
                </div>
            </div>
        </div>
    </form>
@stop