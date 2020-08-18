<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {


            /***
             *
             * 'name',
             * 'ps_id',
             * 'dob',
             * 'image',
             * 'email',
             * 'mobile_number',
             * 'password',
             * 'full_address'
             */
            $table->bigIncrements('id');
            $table->string('ps_id');// 9 numbers
            $table->string('name');//full name
            $table->string('dob');
            $table->string('image')->nullable();
            $table->string('full_address')->nullable();
            $table->string('mobile_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token')->nullable();
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
        Schema::dropIfExists('managers');
    }
}
