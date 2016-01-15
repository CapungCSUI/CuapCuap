<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->string('password')->default('$2a$08$NNtXYaDAqjAy7wpDmb7dE.iTGAbHIPsTh5jhdu/xyURxWRfEYRQ/y');
            $table->rememberToken();
            $table->date('birthday')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('exp')->default(0);
            $table->integer('role_id')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('thread_count')->default(0);
            $table->text('voted_threads')->nullable();
            $table->text('voted_replies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}