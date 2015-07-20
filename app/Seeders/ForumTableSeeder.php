<?php namespace CF\Seeders;

use CF\ForumCategory;
use CF\Role;
use Illuminate\Database\Seeder;

class ForumTableSeeder extends Seeder
{
	public function run()
	{

		$forum = new ForumCategory();
		$forum->name = 'News';
		$forum->description = 'News regarding Classic Fortress';
		$forum->order = 0;
		$forum->locked = 1;

		$this->command->info('Created '. $forum->name.' forum.');

	}
}