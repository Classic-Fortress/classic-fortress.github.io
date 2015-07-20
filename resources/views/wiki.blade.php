@extends('_layouts/master')
@section("activePage")Wiki: {{ $page }} @stop
@section("activeTab")Wiki @stop
@section('content')

    <div class="wiki">
        <div class="clearfix">
            <h1 class="pull-left">Wiki <small>{{ str_replace('-',' ', $page) }}</small></h1>
            <div class="toggle-wiki-sidebar pull-right" title="Wiki Menu"><i class="fa fa-bars"></i></div>
        </div>
        <div class="wiki-sidebar hidden" markdown>
            {!! str_replace('**[Go to front page](Home)**','',file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/_Sidebar.md')) !!}
        </div>
        <div markdown>{!! $pageContent !!}</div>
    </div>

@stop