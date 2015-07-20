<div class="module mb10 replyform">
    <form method="post" class="ontop" action="{{ route('forum.topic.message.post', ['forum' => $forum->slug,'id' => $topic->id, 'topic' => $topic->slug])}}">
        {!! csrf_field() !!}
        <textarea name="body" id="body" mdpreview></textarea>
        <button><i class="fa fa-send"></i> Reply</button>
        <small>* You may use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a> with <a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub-flavored</a> code blocks.</small>
        <div class="pull-right" title="Preview">
            <i class="fa fa-eye"></i> <input type="checkbox" name="preview"/>
        </div>
    </form>
</div>