<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /***
         *  'ps_id',
        'full_name',
        'password',
        'full_address',
        'dob',
        'mobile_number',
         */
        Schema::create('fathers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kindergarten_id');
            $table->string('ps_id');
            $table->string('full_name');
            $table->string('password');
            $table->string('full_address');
            $table->string('dob');
            $table->string('mobile_number');
            $table->string('api_token',60)->nullable();
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
        Schema::dropIfExists('fathers');
    }
}
