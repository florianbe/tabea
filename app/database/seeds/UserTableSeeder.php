<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		$user = new User;
		$user->first_name = 'Florian';
		$user->last_name = 'Binöder';
		$user->email = 'florian.binoeder@gmail.com';
		$user->password = 'password';
		$user->is_admin = true;

		$user->save();

	// 	$faker = Faker::create();

	// 	foreach(range(1, 10) as $index)
	// 	{
	// 		CreateUserSeed::create([

	// 		]);
	// 	}
	}

}