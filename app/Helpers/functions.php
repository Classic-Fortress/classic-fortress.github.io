<?php

function checkAdmin()
{
	if( ! \Illuminate\Support\Facades\Auth::check()) return false;
	if( ! \Illuminate\Support\Facades\Auth::user()->isAdmin()) return false;

	return true;
}

function checkModerator()
{
	if( ! \Illuminate\Support\Facades\Auth::check()) return false;
	if( ! \Illuminate\Support\Facades\Auth::user()->isModerator()) return false;

	return true;
}

function checkAuth()
{
	if( ! \Illuminate\Support\Facades\Auth::check()) return false;
	return true;
}

function nl2brc($input)
{
	return str_replace("\n","  \n",$input);
}