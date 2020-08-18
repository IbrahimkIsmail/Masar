<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenuesTable extends Migration
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
         * 'value ',
         * 'for',
         * 'student_id',
         * 'kindergarten_id',
         * 'manager_id',
         * 'father_id_number',
         * 'child_id_number',
         */
        Schema::create('revenues', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('date');
            $table->string('serial_number'); // #book-value#page-value
            $table->double('value');
            $table->enum('for', [0, 1, 2, 3, 4])->default(4);
            // 0 => Educational fees
            // 1 => Transportation charges
            // 2 => Entertainment fees
            //3 => External support
            //4 => others
            $table->string('description')->nullable();
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
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
        Schema::dropIfExists('revenues');
    }
}
