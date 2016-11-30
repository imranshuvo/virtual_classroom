<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyInCourseEnrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_enrolled', function (Blueprint $table) {
            //
            $table->integer('course_id')->unsigned()->change();
            $table->integer('student_id')->unsigned()->change();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('student_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_enrolled', function (Blueprint $table) {
            //
            $table->dropForeign(['course_id','student_id']);
        });
    }
}