<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterOfFinancialInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 'date',
         * 'serial_number',
         * 'amount',
         * 'against',
         * 'student_id',
         * 'kindergarten_id',
         * 'manager_id',
         */
        Schema::create('register_of_financial_installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('value');
            $table->string('description');
            $table->enum('for', [0, 1,2,3])->default(3);
            // 0 => Educational fees
            // 1 => Transportation charges
            // 2 => Entertainment fees
            // 3 => others
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
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
        Schema::dropIfExists('register_of_financial_installments');
    }
}
