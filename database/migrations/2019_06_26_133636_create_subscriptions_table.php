<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  'manager_id',
         * 'kindergarten_id',
         * 'subscription_date',
         * 'expiration_date',
         * 'users_number',
         * 'price_per_user',
         * 'total',
         * ' amount_paid',
         * 'remaining_amount'
         */
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('manager_id')->nullable();
            $table->integer('kindergarten_id')->nullable();
            $table->string('subscription_date')->default(now());
            $table->string('expiration_date')->default(date("Y-m-d",strtotime(now())+ 1814400));
            $table->double('price_per_user')->default(15);
            $table->double('amount')->default(0);
//            $table->double('remaining_amount');
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
        Schema::dropIfExists('subscriptions');
    }
}
