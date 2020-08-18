<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherProfilesTable extends Migration
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
         *'teacher_id',
         * 'full_address',
         * 'university_name',
         * 'specialty',
         * 'university_rate',
         * 'year_of_graduation,',
         * 'dob',
         * 'image',
         * 'social_status',
         * 'courses',
         * 'skills',
         * 'languages'
         */
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id');
            $table->string('full_address');
            $table->string('university_name')->nullable();
            $table->string('specialty')->nullable();
            $table->float('university_rate')->nullable();
            $table->integer('year_of_graduation')->nullable();
            $table->string('dob')->nullable();
            $table->string('image')->nullable();
            $table->integer('social_status')->nullable();
            $table->string('courses')->nullable();
            $table->string('skills')->nullable();
            $table->string('languages')->nullable();

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
        Schema::dropIfExists('teacher_profiles');
    }
}
