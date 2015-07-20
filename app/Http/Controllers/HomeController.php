<?php

namespace CF\Http\Controllers;

use CF\User;
use Illuminate\Http\Request;
use CF\ForumTopic;
use CF\Http\Requests;
use CF\Http\Controllers\Controller;

class HomeController extends Controller
{

	public function getIndex()
	{
		$news = ForumTopic::with(['messages'])->where('category_id', 1)->orderBy('created_at', 'desc')->take(10)->get();
		return view('home', compact('news'));
	}

	public function getNews()
	{
		$news = ForumTopic::with(['messages'])->where('category_id', 1)->orderBy('created_at', 'desc')->take(10)->get();
		return view('news', compact('news'));
	}

	public function getFeatures()
	{
		return view('features');
	}

	public function getChangelog()
	{
		return view('changelog');
	}

	public function getIrc()
	{
		return view('irc');
	}

	public function getDownload()
	{
		return view('download-windows');
	}

	public function getDownloadWindows()
	{
		return view('download-windows');
	}

	public function getDownloadLinux()
	{
		return view('download-linux');
	}

	public function getWiki($page='Home')
	{
		$pageContent = file_get_contents("https://raw.githubusercontent.com/wiki/Classic-Fortress/server-qwprogs/{$page}.md");
		return view('wiki', compact('pageContent', 'page'));
	}


}
