<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
        'page_number',
        'assignment_description',
        'status',
        'class_room_id',
        'teacher_id',
        'kindergarten_id',
        'manager_id',
        'father_id',
         */
        Schema::create('homeworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('page_number');
            $table->string('assignment_description');
            $table->integer('status');
            $table->unsignedBigInteger('class_room_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('subject_id');
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
        Schema::dropIfExists('homeworks');
    }
}
