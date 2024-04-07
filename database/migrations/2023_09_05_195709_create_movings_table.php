<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->integer('quantity')->unsigned()->nullable();
            $table->string('moving');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_product')->references('id')->on('products');
            $table->datetime('fecha')->nullable();

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
        Schema::dropIfExists('movings');
    }
}
