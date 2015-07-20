<?php

namespace CF\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

	public function backFlash($message, $status)
	{
		session()->flash('flash.message', $message);
		session()->flash('flash.status', $status?:'info');

		return back();
	}
}
