<nav class="clearfix">
    <div class="nav-content">
        <div class="logo pull-left"><span class="classic">classic</span> fortress</div>
        <ul class="top-menu pull-left">
            <li class="active" data-page="home">
                <a href="/">Home</a>
                <div class="sub-menu">
                    <a href="/news">News</a>
                    <hr/>
                    <a href="/features">Features</a>
                    <hr/>
                    <a href="/changelog">Changelog</a>
                </div>
            </li>
            <li data-page="community">
                <a href="{{ route('forum') }}">Community</a>
                <div class="sub-menu">
                    <a href="{{ route('forum') }}">Forum</a>
                    <hr/>
                    <a href="/irc">IRC</a>
                    <hr/>
                    <a href="{{ route('users') }}">Users</a>
                </div>
            </li>
            <li data-page="download">
                <a href="{{ action('HomeController@getDownloadWindows') }}">Download</a>
                <div class="sub-menu">
                    <a href="{{ action('HomeController@getDownloadWindows') }}">Windows</a>
                    <hr/>
                    <a href="{{ action('HomeController@getDownloadLinux') }}">Linux</a>
                </div>
            </li>
            <li data-page="wiki"><a href="/wiki/">Wiki</a></li>

            @if( ! Auth::check())
                <li class="pr norm"><a href="#" class="login">Login</a></li>
            @else
                <li class="pr">
                    <a href="/profile" class="avatar-bg">
                        <img src="{{ Gravatar::get(Auth::user()->email, 'small') }}">
                    </a>
                    <div class="sub-menu">
                        <a href="/profile">Edit profile</a>
                        <hr/>
                        <a href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>