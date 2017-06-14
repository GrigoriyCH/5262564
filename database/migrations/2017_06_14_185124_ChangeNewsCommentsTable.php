<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNewsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('newscomments', function (Blueprint $table) {
            //
			$table->integer('news_id')->unsigned()->default(1);
			$table->foreign('news_id')->references('id')->on('sitenews');
			
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newscomments', function (Blueprint $table) {
            //
        });
    }
}
