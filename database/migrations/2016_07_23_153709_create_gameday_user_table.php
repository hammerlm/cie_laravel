<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamedayUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameday_user', function(Blueprint $table)
        {
            $table->integer('user_id');
            $table->integer('gameday_id');

            $table->foreign('user_id')->references('id')->on('user_id')->onDelete('cascade');
            $table->foreign('gameday_id')->references('id')->on('gamedays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gameday_user');
    }
}
