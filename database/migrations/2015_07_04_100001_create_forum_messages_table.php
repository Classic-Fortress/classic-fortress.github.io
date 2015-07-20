<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_messages', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('topic_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('body');
			$table->boolean('answer');
            $table->timestamps();
			$table->dateTime('edited_at')->nullable();
			$table->softDeletes();

			$table->foreign('topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
			$table->foreign('category_id')->references('id')->on('forum_categories')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_messages');
    }
}
