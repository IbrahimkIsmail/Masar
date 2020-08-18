<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 'serial_number',
         * 'date',
         * 'amount ',
         * 'issue',
         * 'kindergarten_id',
         * 'manager_id',
         * 'father_id', // to get father ps id and more data
         * 'student_id',//to get student ps id and more data
         */
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('serial_number');
            $table->string('date');
            $table->double('value');
            $table->string('issue');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('father_id');
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
        Schema::dropIfExists('payment_histories');
    }
}
