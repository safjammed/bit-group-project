<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiedCoordinatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notified_coordinator', function (Blueprint $table) {
            $table->increments('notified_coordinator');
            $table->integer('faculty_member_id');
            $table->unsignedInteger('notification_id');
            $table->foreign('notification_id')->references('notification_id')->on('email_notification')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notified_coordinator');
    }
}
