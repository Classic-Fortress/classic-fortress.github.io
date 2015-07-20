@extends('_layouts/master')
@section("activePage") Features @stop
@section("activeTab") Home @stop
@section('content')

    <div class="wiki" markdown>{!! str_replace('Page-Changelog','changelog',file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/Page-Features.md')) !!}</div>

@stop