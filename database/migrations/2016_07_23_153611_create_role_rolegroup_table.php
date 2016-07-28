<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleRolegroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_rolegroup', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('rolegroup_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('rolegroup_id')->references('id')->on('rolegroups')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_rolegroup');
    }
}
