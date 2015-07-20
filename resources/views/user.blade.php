@extends("_layouts/master")
@section("activePage")User: {{ $user->username }} @stop
@section("activeTab")Community @stop
@section("content")

<h3>{{ $user->username }}</h3>
<img src="{{ Gravatar::get($user->email, 'medium') }}">
{!! $user->listRoles() ? '<br/>'.$user->listRoles():'' !!}
<p>Post count: {{ $user->postCount() }}</p>
<hr class="clearfix"/>
<p>Real name: {{{ $user->info->real_name or '' }}}</p>
<p>Location: {{{ $user->info->location or '' }}}</p>
<p>Previous clans: {{{ $user->info->previous_clans or '' }}}</p>
<p>Info: {{{ $user->info->information or '' }}}</p>

@if(checkAdmin())
    <hr/>
    <h2>Roles</h2>
    <h3>Add role</h3>
    {!! Form::open(['action' => ['RoleController@store', $user->slug], 'method' => 'post']) !!}
    {!! Form::select('role', $roles) !!}
    <br/>
    <br/>
    {!! Form::submit() !!}
    {!! Form::close() !!}
    <br/>
    <h3>Remove role</h3>
    {!! Form::open(['action' => ['RoleController@destroy', $user->slug, null], 'method' => 'delete']) !!}
    {!! Form::select('role', $user->roles->lists('name', 'id')) !!}
    <br/>
    <br/>
    {!! Form::submit() !!}
    {!! Form::close() !!}
@endif

@stop