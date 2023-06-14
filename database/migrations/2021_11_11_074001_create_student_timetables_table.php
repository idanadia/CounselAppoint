<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_timetables', function (Blueprint $table) {
            $table->increments ('student_timetable_id');
            $table->unsignedInteger ('user_id')->nullable();
            $table->unsignedInteger ('subject_id')->nullable();
            $table->unsignedInteger ('day_id')->nullable();
            $table->unsignedInteger ('lecture_hall_id')->nullable();
            $table->unsignedInteger ('lecturer_group_id')->nullable();
            $table->string ('time_from')->nullable();
            $table->string ('time_to')->nullable();
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
        Schema::dropIfExists('student_timetables');
    }
}
