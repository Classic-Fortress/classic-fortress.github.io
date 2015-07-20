@extends('_layouts/master')
@section("activePage")Changelog @stop
@section("activeTab")Home @stop
@section('content')

    <div class="wiki" markdown>{!! file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/Page-Changelog.md') !!}</div>

@stop