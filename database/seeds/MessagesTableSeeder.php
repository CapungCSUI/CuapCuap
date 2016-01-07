<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($count = 1; $count <= 10; $count++) {
        	$receiver_id = (rand(0, 1) == 1 ? rand(1, DB::table('users')->count()) : 1);
            
            do {
                $sender_id = rand(1, DB::table('users')->count());
            } 
            while ($sender_id == $receiver_id);

        	DB::table('messages')->insert([
	            'sender_id' => $sender_id,
	            'receiver_id' => $receiver_id,
                'content' => str_random(100),
	        ]);
            
	        DB::table('notifications')->insert([
	            'type' => 0,
	            'user_id' => $receiver_id,
	            'content_id' => $sender_id,
	        ]);

        }
    }
}
