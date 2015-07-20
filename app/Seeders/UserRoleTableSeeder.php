<?php namespace CF\Seeders;

use CF\Role;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
	public function run()
	{

		$roles = \Config::get('cf.roles');

		foreach($roles as $role)
		{
			$Role = new Role;
			$Role->name = $role;
			$Role->save();

			$this->command->info('Added '. $Role->name.' role.');
		}

	}
}