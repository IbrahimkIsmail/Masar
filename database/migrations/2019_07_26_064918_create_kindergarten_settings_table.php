<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKindergartenSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kindergarten_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->double('total_attendance_days')->default(208);
            $table->double('teacher_salary')->default(300);
            $table->double('education_fees')->default(1300);
            $table->double('transportation_charges')->default(30);
            $table->double('entertainment_fees')->default(10);
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
        Schema::dropIfExists('kindergarten_settings');
    }
}
