@extends('_layouts/master')
@section("activePage")Profile @stop
@section("activeTab")Profile @stop
@section('content')

    <h3>Edit profile</h3>

        <div class="mt10">
            <img src="{{ Gravatar::get($user->email, 'medium') }}">
            <p>Avatars are grabbed from <a href="http://gravatar.com">Gravatar.</a> Use the same email if you want one.</p>
        </div>

        <hr/>

        <h3>Settings</h3>

        <form action="{{ route('profile.settings.update') }}" method="post">
            <input type="hidden" name="_method" value="put"/>
            {!! csrf_field() !!}
            <div>
                <label for="email_pings">Email when pinged:</label>
                <input type="checkbox" name="mail_pings" {{ $user->settings->mail_pings ? 'checked=checked':'' }}/>
            </div>
            <button><i class="fa fa-gear"></i> Update</button>
        </form>
        <hr/>

        <form method="post" action="{{action('ProfileController@putIndex')}}">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="put"/>
        <div class="row">
            <div class="col-sm-6">
                <h3>Info</h3>

                <div class="mt10">
                    <label for="username">Nick:</label>
                    <input type="text" name="username" value="{{ $user->username }}">
                </div>

                <div class="mt10">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="{{ $user->email }}">
                </div>

                <div class="mt10">
                    <label for="real_name">Real name:</label>
                    <input type="text" name="real_name" value="{{ $user->info->real_name or '' }}">
                </div>

                <div class="mt10">
                    <label for="location">Location:</label>
                    <input type="text" name="location" value="{{ $user->info->location or '' }}">
                </div>

                <div class="mt10">
                    <label for="previous_clans">Previous clans:</label>
                    <input type="text" name="previous_clans" value="{{ $user->info->previous_clans or '' }}">
                </div>
            </div>
        </div>


        <div class="mt10">
            <label for="information">Information:</label>
            <textarea name="information" cols="30" rows="10">{{ $user->info->information or '' }}</textarea>
        </div>


        <input type="submit" value="Update" class="mt10 pull-left">

    </form>
    {{--{!! Form::open(array('action' => ['ProfileController@deleteIndex'], 'method' => 'delete')) !!}--}}
    {{--{!! csrf_field() !!}--}}
    {{--{!! Form::submit('Delete account', ['class' => 'pull-right mt10 warning-btn', 'onclick' => 'javascript:return confirm(\'Are you absolutely sure you want to delete your account?!\')']) !!}--}}
    {{--{!! Form::close() !!}--}}
    <br/>
    <br/>
    <hr class="clearfix"/>

@stop