<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** 'name',
         * 'ps_id',
         * 'manager_id',
         * 'kindergarten_id',
         * 'mobile_number',
         * 'email',
         * 'password',
         * 'status',
         */
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
//
//            $table->integer('teacher_ps_id');
//
//            $table->integer('manager_ps_id');
//            $table->integer('kindergarten_id');
//            $table->string('name');
//            $table->string('full_address');
//            $table->date('dob');
//            $table->string( 'image');
//            $table->multiLineString('college_certificate');
//            $table->multiLineString('courses_certificates');
//            $table->multiLineString('skills');
//
//
//            $table->string('facebook_url');
//            $table->string('instagram_url');
//            $table->string('phone_number');
//
//            $table->string('email')->unique();
//            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password');
//
//

            $table->string('name');
            $table->string('ps_id');
            $table->integer('manager_id');
            $table->integer('kindergarten_id');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('password');
            $table->integer('status');
//            $table->enum('type',[0,1])->default(0); // 0 => teacher , 1=> foreign language
//            $table->enum('subjects',[0,1,2,3])->default(0); // 0 => all subjects , 1 =>English , 2 =>French , 3=> others
            $table->rememberToken();
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
        Schema::dropIfExists('teachers');
    }
}
