<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs', function ($table) {
            $table->integer('user_id')->unsigned();
            $table->integer('affecteduser_id')->unsigned();
            $table->integer('logcategory_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('affecteduser_id')->references('id')->on('users');
            $table->foreign('logcategory_id')->references('id')->on('logcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['affecteduser_id']);
            $table->dropForeign(['logcategory_id']);
        });
    }
}
