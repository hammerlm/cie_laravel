<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamedaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamedays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notes');
            $table->dateTime('time');
            $table->string('season');
            $table->integer('duration_in_minutes');
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
        Schema::drop('gamedays');
    }
}
