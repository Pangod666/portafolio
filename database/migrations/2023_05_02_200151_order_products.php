<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderProducts', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->integer('cantidad');
            $table->string('estado');
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
        Schema::dropIfExists('orderProducts');
    }
}
