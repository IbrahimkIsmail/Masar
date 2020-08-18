<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *
         * 'date', // date of document need
         * 'serial_number',
         * 'amount ',
         * 'issue',
         * 'kindergarten_id',
         * 'manager_id',
         */
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial_number');// #book-value#page-value
            $table->double('value');// the price of the expenses
            $table->enum('issue', [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->default(10);
            //0 => Entertainment allowance
            //1 => Purchase allowance
            //2 => Rent allowance
            //3 => license
            //4 => Equivalents
            //5 => Salaries
            //6 => Electricity
            //7 => Water
            //8 => Sanitation
            //9 => maintenance
            //10 => others
            $table->string('description')->nullable();

            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
            $table->string('date');

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
        Schema::dropIfExists('expenses');
    }
}
