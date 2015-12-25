<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($count = 0; $count < 10; $count++) {
	        DB::table('categories')->insert([
	            'name' => str_random(10),
	        ]);
	    }
    }
}
