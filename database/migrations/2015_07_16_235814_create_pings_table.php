<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pings', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('reciever_id')->unsigned();
			$table->integer('pinger_id')->unsigned();
			$table->integer('message_id')->unsigned();
			$table->boolean('seen')->nullable();
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
        Schema::drop('pings');
    }
}
