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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('customattribute1')->nullable();
            $table->integer('customattribute2')->nullable();
            $table->integer('customattribute3')->nullable();
            $table->integer('customattribute4')->nullable();
            $table->integer('customattribute5')->nullable();
            $table->integer('customattribute6')->nullable();
            $table->integer('customattribute7')->nullable();
            $table->integer('customattribute8')->nullable();
            $table->integer('customattribute9')->nullable();
            $table->integer('customattribute10')->nullable();
            $table->boolean('showplayercard');
            $table->binary('picture');
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
