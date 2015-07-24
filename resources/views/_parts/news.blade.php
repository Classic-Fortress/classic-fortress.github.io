@foreach($news as $entry)
    <article>
        <h3>
            <a href="{{ route('forum.topic',['forum'=>'news', 'id' => $entry->id, 'topic' => $entry->slug]) }}">
                {{ $entry->title }}
            </a>
            <small>{{$entry->created_at->format('j M y, H:i')}} by <a href="{{ route('user', ['user' => $entry->author->slug]) }}">{{ $entry->author->username }}</a> |
                (<a href="{{ route('forum.topic',['forum'=>'news', 'id' => $entry->id, 'topic' => $entry->slug]) }}">{{ $entry->messages->count()-1 }} {{ str_plural('comment', ($entry->messages->count()-1)) }}</a>)</small>
        </h3>
        <p markdown>{!! $entry->messages[0]->parse()->body !!}</p>
    </article>
@endforeach