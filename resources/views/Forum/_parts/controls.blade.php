@if(checkAdmin())
    <div class="forum-controls">
        <a href="{{ action('Forum\ForumController@create') }}"><i class="fa fa-plus" title="Create new forum"></i></a>
        @if(isset($topics))
        <a href="{{ action('Forum\ForumController@edit', ['forum' => $forum->slug]) }}"><i class="fa fa-wrench" title="Edit forum"></i></a>
        @endif
    </div>
@endif