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
    	for ($count = 1; $count <= 5; $count++) {
            $author_id = rand(1, DB::table('users')->count());
        	DB::table('threads')->insert([
	            'category_id' => rand(1, DB::table('categories')->count()),
	            'author_id' => $author_id,
                'content' => str_random(100),
	            'title' => str_random(20),
	            'tags' => str_random(5).', abc, '.str_random(5),
	            'sticky' => rand(0, 1) == 1,
	        ]);

            DB::table('users')->where('id', $author_id)->increment('thread_count');
        }
    }
}
