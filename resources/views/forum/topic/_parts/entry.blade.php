<div class="entry{{$message->answer==1?' answer':''}}">

    <div class="rating">
        <a href="{{ route('forum.topic.message.rate', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug]) }}" data-data='{"message_id": {{$message->id}}, "vote":1}' asyncpost><i class="fa fa-caret-up"></i></a>
<span class="number">{{ $message->rating() }}</span>
        <a href="{{ route('forum.topic.message.rate', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug]) }}" data-data='{"message_id": {{$message->id}}, "vote":-1}' asyncpost><i class="fa fa-caret-down"></i></a>
        @if( ! $message->isMainPost() and Auth::check() and $topic->user_id == Auth::user()->id)
            <a href="{{ route('forum.topic.message.answer', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug, 'message' => $message->id]) }}" class="markAnswer answer__answered" title="Mark this reply as best answer"><i class="fa fa-check"></i></a>
        @endif
    </div>
    <div class="post-container">
        <div class="top">
            By <a href="{{ action('UserController@show', ['slug' => $message->author->slug]) }}">{{ $message->author->username }}</a> {{ $message->created_at->diffForHumans() }}
            @if($message->isEditable())
                | <a href="{{ route('forum.topic.message.edit', ['forum' => $forum->slug, 'id' => $topic->id, 'topic' => $topic->slug, 'messageId' => $message->id]) }}">
                    edit
                </a>
            @endif

            @if(isset($message->edited_at))
                | edited {{ $message->edited_at->diffForHumans() }}
            @endif
        </div>
        <div class="body clearfix">
            <div class="wiki" markdown>{!! $message->parse()->body !!}</div>
        </div>
    </div>

    <div class="user-container">
        <div class="user">
            <img src="{{ Gravatar::get($message->author->email, 'forum') }}" alt=""/> <br/>
            <a href="{{ action('UserController@show', ['slug' => $message->author->slug]) }}">{{ $message->author->username }}</a> <br/>
            {{ $message->author->listRoles() }} <br/>
            <span title="Experience" class="blue"><i class="fa fa-asterisk"></i> {{ $message->author->experience() }}</span>
            <span title="Best answer awards" class="green"><i class="fa fa-trophy"></i> {{ $message->author->answers() }}</span>
        </div>
    </div>

</div>