<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("type")->default("document");
            $table->timestamp("commented_at")->nullable();
            $table->boolean("selected")->default(false);

            $table->unsignedInteger('user_id')->nullable(); //contains student ID
            $table->unsignedInteger('closure_id');
            $table->unsignedInteger('faculty_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('closure_id')->references('id')->on('closures')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('submissions');
    }
}
