@extends('_layouts/master')
@section("activePage")Forum @stop
@section("activeTab")Community @stop
@section('content')

    <div class="row">
        <div class="col-sm-7">
            <h4><a href="{{ route('forum') }}">Forum</a> &raquo; Create forum</h4>
        </div>
        <div class="col-sm-5 rt forum-controls">
            <a href="{{ action('Forum\ForumController@create') }}" title="Create new forum"><i class="fa fa-plus-square"></i></a>
        </div>
    </div>

<h3>Create new forum</h3>
<form method="post" action="{{action('Forum\ForumController@store')}}">
    {!! csrf_field() !!}
    <div class="mt10">
        <label for="name">Name:</label>
        <input type="text" name="name">
    </div>
    <div class="mt10">
        <label for="description">Description:</label>
        <input type="text" name="description">
    </div>
    <div class="mt10">
        <label for="name">Order:</label>
        <input type="text" name="order" value="1">
    </div>
    <label>Locked:</label>
    <input type="checkbox" name="locked">

    <br/>
    <input type="submit" value="Create" class="mt10">
</form>

@stop