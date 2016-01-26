<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('users')->insert([
            'username' => 'aldi.fahrezi',
            'email' => 'aldi.fahrezi@gmail.com',
            'birthday' => '1997-09-08',
            'role_id' => 2,
            'voted_threads' => "|",
            'voted_replies' => "|",
        ]);

    	for ($count = 0; $count < 5; $count++) {
        	DB::table('users')->insert([
	            'username' => str_random(10).$count,
	            'email' => str_random(10).'@gmail.com',
	            'birthday' => rand(1611, 2014).'-'.rand(10, 12).'-'.rand(10, 30),
                'voted_threads' => "|",
                'voted_replies' => "|",
	        ]);
        }

        for ($count = 1; $count <= 50; $count++) {
        	Storage::makeDirectory('users/'.$count);
        }
    }
}
