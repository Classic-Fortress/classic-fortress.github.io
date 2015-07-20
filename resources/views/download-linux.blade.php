@extends("_layouts/master")
@section("activePage")Downloads for Linux @stop
@section("activeTab")Download @stop
@section("content")
<div markdown>{!! file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/Page-Download-Linux.md') !!}</div>
@stop
