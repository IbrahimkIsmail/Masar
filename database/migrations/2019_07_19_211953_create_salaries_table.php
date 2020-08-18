<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('manger_id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('teacher_id');
            $table->enum('type', [0, 1])->default(0); // salary or award 0,1
            $table->double('value');
            $table->string('payment_date')->default(now());
            $table->string('voucher_number')->default("0");
            $table->string('bond_book_serial')->default("0");

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
        Schema::dropIfExists('salaries');
    }
}
