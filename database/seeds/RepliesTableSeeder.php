<?php

use Illuminate\Database\Seeder;
use App\Helpers\Helper;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($count = 1; $count <= 10; $count++) {
    		$thread_id = rand(1, DB::table('threads')->count());
            $position = Helper::appendZero($count, 5);
            $user_id = rand(1, DB::table('users')->count());

    		DB::table('replies')->insert([
	            'thread_id' => $thread_id,
	            'user_id' => $user_id,
                'content' => str_random(100),
                'position' => $position.',',
                'depth' => 0,
	        ]);

            DB::table('threads')->where('id', $thread_id)->increment('comment_count');
            DB::table('users')->where('id', $user_id)->increment('comment_count');

       		$author_id = DB::table('threads')->where('id', $thread_id)->first()->author_id;
	        DB::table('notifications')->insert([
	            'type' => 1,
	            'user_id' => $author_id,
	            'content_id' => $count,
	        ]);
    	}

        for ($count = 11; $count <= 30; $count++) {
        	$parent_id = rand(1, DB::table('replies')->count());
        	$parent = DB::table('replies')->where('id', $parent_id)->first();
        	$position = $parent->position.Helper::appendZero($count, 5).',';

        	$thread_id = $parent->thread_id;
            $user_id = rand(1, DB::table('users')->count());
        	
        	DB::table('replies')->insert([
	            'thread_id' => $thread_id,
	            'user_id' => $user_id,
                'content' => str_random(100),
                'parent_id' => $parent_id,
                'depth' => $parent->depth + 1,
                'position' => $position,
	        ]);

            DB::table('threads')->where('id', $thread_id)->increment('comment_count');
            DB::table('users')->where('id', $user_id)->increment('comment_count');

	        $author_id = DB::table('threads')->where('id', $thread_id)->first()->author_id;
	        DB::table('notifications')->insert([
	            'type' => 1,
	            'user_id' => $author_id,
	            'content_id' => $count,
	        ]);
        }
    }
}
