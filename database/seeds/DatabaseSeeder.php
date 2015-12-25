<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
	    $this->call(CategoriesTableSeeder::class);
	    $this->call(UsersTableSeeder::class);
	    $this->call(ThreadsTableSeeder::class);
	    $this->call(RepliesTableSeeder::class);
	    $this->call(MessagesTableSeeder::class);
	    $this->call(AnnouncementsTableSeeder::class);
	}
}
