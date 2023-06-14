<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnInStudentTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_timetables', function (Blueprint $table) {
            $table->foreign('subject_id') ->references('id')-> on ('subjects');
            $table->foreign('day_id') ->references('id')-> on ('days');
            $table->foreign('lecture_hall_id') ->references('id')-> on ('lecture_halls');
            $table->foreign('user_id') ->references('id')-> on ('users');
            $table->foreign('lecturer_group_id') ->references('id')-> on ('lecturer_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_timetables', function (Blueprint $table) {
            //
        });
    }
}
