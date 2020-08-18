<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 'ps_id',
         * 'name',
         * 'dob',
         * 'father_id',
         * 'class_room_id',
         * 'teacher_id',
         * 'kindergarten_id',
         * 'manager_id',
         */
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ps_id');
            $table->string('name');
            $table->string('dob');
            $table->integer('father_id');
            $table->integer('class_room_id');
            $table->integer('kindergarten_id');
            $table->integer('manager_id');

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
        Schema::dropIfExists('students');
    }
}
