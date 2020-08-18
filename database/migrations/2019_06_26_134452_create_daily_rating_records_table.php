<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyRatingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 'student_id',
        'personal_appearance',
        'personal_hygiene',
        'child_behavior',
        'violence',
        'excellence',
        'child_health',
        'level_interaction',
//        'class_room_id',
        'teacher_id',
        'kindergarten_id',
        'manager_id',
        */
        Schema::create('daily_rating_records', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
//            $table->integer('class_room_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
            $table->integer('personal_appearance'); // 0 => bad , 1 => good
            $table->integer('personal_hygiene');// 0 => bad , 1 => good
            $table->integer('child_behavior');// 0 => bad , 1 => good
            $table->integer('violence'); // 0 => bad , 1 => good
            $table->integer('excellence');// 0 => bad , 1 => good
            $table->integer('child_health');// 0 => bad , 1 => good
            $table->integer('interaction_level');// 0 => bad , 1 => good
            $table->integer('learning_level');// 0 => bad , 1 => good

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
        Schema::dropIfExists('daily_rating_records');
    }
}
