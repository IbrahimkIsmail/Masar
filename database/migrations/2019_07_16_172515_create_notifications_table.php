<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kindergarten_id');
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('father_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('from_father',[0,1])->default(1); // 1 from father
            $table->enum('notification_type',[0,1,2,3,4,5])->default(5)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            // 0 'complaint',// شكوى
            //        1'inquiry',//ااستفسار
            //        2'apology',//اعتذار
            //        3'invitation',//دعوة
            //        4'payment_notification'//اخطار دفع
            // 5 others
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
