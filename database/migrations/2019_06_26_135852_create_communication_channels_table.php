<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  'title',
        'message',
        'status',
        'kindergarten_id',
        'manager_id',
        'father_id',
        'student_id',
         */
        Schema::create('communication_channels', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->integer('title');
            $table->text('message');
            $table->integer('status');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
            $table->enum('from_student',[0,1,2])->default(0);
//            $table->integer('father_id');
            $table->unsignedBigInteger('student_id');
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
        Schema::dropIfExists('communication_channels');
    }
}
