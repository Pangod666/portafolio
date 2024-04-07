<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_people')->unsigned()->nullable();
            $table->string('estado');
            $table->bigInteger('id_tutor')->unsigned()->nullable();
            $table->bigInteger('id_especialidad')->unsigned()->nullable();

            $table->foreign('id_people')->references('id')->on('people');
            $table->foreign('id_tutor')->references('id')->on('tutors');
            $table->foreign('id_especialidad')->references('id')->on('especialidads');
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
        Schema::dropIfExists('patients');
    }
}
