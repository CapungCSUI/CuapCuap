<?php

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($count = 0; $count < 5; $count++) {
	        DB::table('announcements')->insert([
	            'title' => str_random(25),
                'content' => str_random(100),
	        ]);
	    }
    }
}
