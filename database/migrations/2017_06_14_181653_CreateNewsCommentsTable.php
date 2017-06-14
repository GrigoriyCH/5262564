<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newscomments', function (Blueprint $table) {
            $table->increments('id');
			
			$table->string('text');
			
			$table->string('name');
			$table->string('email');
			$table->string('site');
			
			$table->integer('parent_id');

			$table->integer('to_user_id');
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('newscomments');
    }
}
