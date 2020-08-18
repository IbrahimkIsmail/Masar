<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  'student_id',
         * 'child_id_number',
         * 'class_room_id',
         * 'teacher_id',
         * 'kindergarten_id',
         * 'manager_id',
         * 'status',
         */
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->integer('student_id');
            $table->integer('class_room_id');
            $table->integer('teacher_id');
            $table->integer('kindergarten_id');
            $table->integer('manager_id');
            $table->integer('status');
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
        Schema::dropIfExists('student_attendances');
    }
}
