@extends('_layouts/master')
@section("activePage")IRC @stop
@section("activeTab")Community @stop
@section('content')

<h1>News</h1>

@include('_parts.news', ['news' => $news])

@stop