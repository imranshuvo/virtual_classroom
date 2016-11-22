<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyInCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->integer('category_id')->unsigned()->change();
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('category_id')->references('id')->on('category');
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
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->dropForeign(['category_id','user_id']);
        });
    }
}
