@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4><a href="{{ route('forum') }}">Forum</a> &raquo; <a href="{{ route('forum.category', ['forum' => $forum->slug]) }}">{{ $forum->name }}</a> &raquo; Post new topic</h4>
        </div>
        <div class="col-sm-5 rt">

        </div>
    </div>

    <h3>Post new topic</h3>
    <form method="post" action="{{route('forum.topic.post', ['forum' => $forum->slug])}}">
        {!! csrf_field() !!}
        <div class="mt10">
            <label for="title">Title:</label>
            <input type="text" name="title">
        </div>

        @if(checkAdmin() or checkModerator())
            <div class="mt10">
                <label for="sticky" title="Sticky topic">Sticky:</label>
                <input type="checkbox" name="sticky">
            </div>
        @endif

        {{--<div class="mt10">--}}
            {{--<label for="question" title="Question topic">Question:</label>--}}
            {{--<input type="checkbox" name="question">--}}
        {{--</div>--}}

        <div class="module">
            <div class="ontop">
                <textarea name="body" id="body" mdpreview></textarea>
                <button><i class="fa fa-send"></i> Post</button>
                <small>* You may use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a> with <a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub-flavored</a> code blocks.</small>
                <div class="pull-right" title="Preview">
                    <i class="fa fa-eye"></i> <input type="checkbox" name="preview"/>
                </div>
            </div>
        </div>

    </form>

@stop