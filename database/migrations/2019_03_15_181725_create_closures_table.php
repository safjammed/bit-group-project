<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closures', function (Blueprint $table) {
            $table->increments('id');
            $table->year("academic_year");

            $table->date("closure")->nullable();
            $table->date("final_closure")->nullable();

            $table->unsignedInteger('faculty_id');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');


            $table->unique(["academic_year","faculty_id"]);

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
        Schema::dropIfExists('closures');
    }
}
