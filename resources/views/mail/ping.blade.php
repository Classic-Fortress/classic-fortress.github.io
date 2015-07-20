<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>You have been mentioned on Classic Fortress</h2>
		<div>
			{{ $event->pinger->username }} mentioned you in a thread named {{ $event->post->topic->title }}.

            Click <a href="{{ $event->link }}">here</a> to view it.
		</div>
	</body>
</html>