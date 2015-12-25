<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($count = 1; $count <= 20; $count++) {
    		$thread_id = rand(1, DB::table('threads')->count());

    		DB::table('replies')->insert([
	            'thread_id' => $thread_id,
	            'user_id' => rand(1, DB::table('users')->count()),
                'content' => str_random(100),
	        ]);

       		$author_id = DB::table('threads')->where('id', $thread_id)->first()->author_id;
	        DB::table('notifications')->insert([
	            'type' => 1,
	            'user_id' => $author_id,
	            'content_id' => $count,
	        ]);
    	}

        for ($count = 21; $count <= 200; $count++) {
        	$parent_id = rand(1, DB::table('replies')->count());
        	$parent = DB::table('replies')->where('id', $parent_id)->first();
        	$parent_child_replies = $parent->child_replies;

        	$thread_id = $parent->thread_id;

        	if (empty($parent_child_replies)) {
        		$parent_child_replies = $count;
        	}
        	else {
        		$parent_child_replies = $parent_child_replies . ',' . $count;
        	}

        	DB::table('replies')->where('id', $parent_id)->update([
        		'child_replies' => $parent_child_replies,
        	]);
        	
        	DB::table('replies')->insert([
	            'thread_id' => $thread_id,
	            'user_id' => rand(1, DB::table('users')->count()),
	            'parent_id' => $parent_id,
                'content' => str_random(100),
	        ]);

	        $author_id = DB::table('threads')->where('id', $thread_id)->first()->author_id;
	        DB::table('notifications')->insert([
	            'type' => 1,
	            'user_id' => $author_id,
	            'content_id' => $count,
	        ]);
        }
    }
}
