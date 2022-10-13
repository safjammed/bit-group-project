<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsAgreedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_agreed', function (Blueprint $table) {
            $table->increments('terms_student_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('terms_id');
            $table->foreign('student_id')->references('student_id')->on('student')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('terms_id')->references('id')->on('terms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms_agreed');
    }
}
