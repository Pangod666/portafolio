<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_patients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_patient')->unsigned();
            $table->bigInteger('id_especialidad')->unsigned()->nullable();
            $table->string('action');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_especialidad')->references('id')->on('especialidads');
            $table->datetime('fecha')->default(now());
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
        Schema::dropIfExists('register_patients');
    }
}
