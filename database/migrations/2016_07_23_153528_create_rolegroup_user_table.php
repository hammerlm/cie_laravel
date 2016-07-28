<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolegroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolegroup_user', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('rolegroup_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('rolegroup_id')->references('id')->on('rolegroups')->onDelete('cascade');
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
        Schema::drop('rolegroup_user');
    }
}
