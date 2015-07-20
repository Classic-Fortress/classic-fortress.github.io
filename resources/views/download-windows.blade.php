@extends("_layouts/master")
@section("activePage")Downloads for Windows @stop
@section("activeTab")Download @stop
@section("content")
<div markdown>{!! file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/Page-Download-Windows.md') !!}</div>
@stop
