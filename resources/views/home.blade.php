@extends('_layouts/master')
@section("activePage")Home @stop
@section("activeTab")Home @stop
@section('content')

    <div markdown>{!! file_get_contents("https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/Page-Home.md") !!}</div>

    <hr/>

    <h2>Recent news</h2>

    @include('_parts.news', ['news' => $news])

@stop