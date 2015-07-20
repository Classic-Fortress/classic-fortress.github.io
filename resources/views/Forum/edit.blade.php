@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4><a href="{{ route('forum') }}">Forum</a> &raquo; <a href="{{ route('forum', ['forum' => $forum->slug]) }}">{{ $forum->name }}</a> &raquo; Edit forum</h4>
        </div>
    </div>

    <form method="post" action="{{ route('forum.update', ['forum' => $forum->slug])}}">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT">
        <div class="mt10">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $forum->name }}">
        </div>
        <div class="mt10">
            <label for="description">Description:</label>
            <input type="text" name="description" value="{{ $forum->description }}">
        </div>
        <div class="mt10">
            <label for="name">Order:</label>
            <input type="text" name="order" value="{{ $forum->order }}">
        </div>
        <label>Locked:</label>
        <input type="checkbox" name="locked" {{ $forum->locked ? 'checked=checked':'' }}>

        <br/>
        <input type="submit" value="Edit" class="mt10">
    </form>

@stop