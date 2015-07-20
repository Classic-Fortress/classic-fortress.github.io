@extends("_layouts/master")
@section("activePage")Users @stop
@section("activeTab")Community @stop

@section("content")
<h1>Users</h1>

@foreach($users as $user)
<div>
    <img src="{{ Gravatar::get($user->email, 'small') }}" alt=""/>
    <a href="{{ action('UserController@show', ['slug' => $user->slug]) }}">{{ $user->username }}</a> {{ $user->listRoles() ? '('.$user->listRoles().')':'' }}
 </div>
@endforeach
@stop
