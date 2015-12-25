<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($count = 1; $count <= 50; $count++) {
        	DB::table('threads')->insert([
	            'category_id' => rand(1, DB::table('categories')->count()),
	            'author_id' => rand(1, DB::table('users')->count()),
                'content' => str_random(100),
	            'title' => str_random(20),
	            'tags' => str_random(5).', abc, '.str_random(5),
	            'sticky' => rand(0, 1) == 1,
	        ]);
        }
    }
}
