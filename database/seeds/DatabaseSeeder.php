<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CF\Seeders\UserRoleTableSeeder;
use \CF\Seeders\ForumTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

		$this->call(UserRoleTableSeeder::class);
		$this->call(ForumTableSeeder::class);

        Model::reguard();
    }
}
