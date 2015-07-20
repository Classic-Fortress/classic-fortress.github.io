@inject('start','CF\Helpers\start')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Classic Fortress - @yield("activePage")</title>
    <meta name="description" content="">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="activeTab" content="@yield('activeTab')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        @if( ! session()->has('browsing'))
        header .class {
            animation: fadeinclass 2s;
        }
        @endif
    </style>
</head>
<body>
<div id="app" class="container-fluid">
    <header class="hidden-xs">
        @include('_parts.logo')
    </header>
    <div class="content-container">


       @include('_parts.navigation')

       @if( ! Auth::check())
           <div class="account hidden">
               @include("_parts.account-login")
           </div>
       @endif

       @include('_parts.flash')

       <div class="content">
           @yield('content')
       </div>

       <footer markdown>{{ file_get_contents('https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/Page-Footer.md') }}</footer>
    </div>

</div>

<script src="/js/bundle.js"></script>
@yield('extrajs')
</body>
</html>