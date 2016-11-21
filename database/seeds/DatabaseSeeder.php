<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('RoleTableSeeder');
		$this->command->info('Role table seeded!');

		//Model::unguard();
	}

}


class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        Role::create(['name' => 'admin']);
		Role::create(['name' => 'user']);
    }

}
