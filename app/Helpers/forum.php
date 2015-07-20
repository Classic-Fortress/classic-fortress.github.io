<?php

function checkUsernames($text) {
	preg_match_all('/@([a-zA-Z0-9_]+)/', $text, $usernames);
	return $usernames[1];
}