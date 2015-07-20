<?php

namespace CF\Traits;

use Illuminate\Support\Str;

trait Slugable
{

	protected static function boot()
	{
		parent::boot();

		static::created(function($item){

			if(! isset($item->slugField))
				throw new \Exception('Missing slug field');

			$field =  $item->slugField;
			$slug  =  Str::slug($item->$field);

			if(! isset($item->slug) or $item->slug != $slug)
			{
				$item->slug = $slug;
				$item->save();
			}

		});
	}

}