@extends('_layouts/master')
@section("activePage")Wiki: {{ $page }} @stop
@section("activeTab")Wiki @stop
@section('content')

    <div class="wiki">
        <div class="clearfix">
            <h1 class="pull-left">Wiki <small>{{ str_replace('-',' ', $page) }}</small></h1>
            <div class="pull-right">
                @if(checkAdmin() or checkModerator())
                    <a href="https://github.com/Classic-Fortress/server-qwprogs/wiki/{{ $page }}/_edit" title="Edit this page"><i class="fa fa-pencil-square"></i></a>
                @endif
                <a class="toggle-wiki-sidebar" title="Wiki Menu"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="wiki-sidebar hidden" markdown-html>
            {!! str_replace('**[Go to front page](Home)**','',file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/_Sidebar.md')) !!}
        </div>
        <div markdown>{!! $pageContent !!}</div>
    </div>

@stop