<?php

namespace CF\Helpers;

class start
{
	public function __construct()
	{
		session(['browsing' => 1]);
	}
}