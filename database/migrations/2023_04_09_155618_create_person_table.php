<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('ci')->unique()->nullable();
            $table->string('extension')->nullable();
            $table->string('nombre');
            $table->string('ap_paterno')->nullable();
            $table->string('ap_materno');
            $table->date('fechanacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->integer('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('correo')->nullable();
            $table->string('nit')->nullable();
            $table->string('telefono_emergencia')->nullable();
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
        Schema::dropIfExists('person');
    }
}
