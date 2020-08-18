<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 'name',
        'level', // [kg1 - kg2,]
        'teacher_id',
        'manager_id',
        'kindergarten_id',
        'status',
         */
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('level');//  1 => kg1 , 2 => kg2
//            $table->integer('teacher_id');
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->integer('status');// fill or not ...
//            $table->unsignedBigInteger('teacher_foreign')->nullable();// fill or not ...
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
        Schema::dropIfExists('class_rooms');
    }
}
