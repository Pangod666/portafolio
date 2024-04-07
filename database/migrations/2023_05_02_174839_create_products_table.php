<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre_comercial')->nullable();
            $table->string('nombre_generico')->nullable()->default('');
            $table->string('concentracion')->nullable()->default('');
            $table->string('tipo_de_venta')->nullable()->default('');
            $table->integer('cantidad')->unsigned();
            $table->integer('nivel_reorden')->default(10);
            $table->string('forma_farmaceutica')->nullable()->default('');
            $table->date('fecha_registro');
            $table->date('fecha_vencimiento');
            $table->double('precio_adquirido')->unsigned()->nullable();
            $table->double('precio_venta')->unsigned()->nullable();
            $table->string('refrigerado')->default('NO');
            $table->bigInteger('id_proveedor')->unsigned()->nullable();
            $table->integer('id_category')->unsigned();
            $table->string('estado')->default('activo');
            $table->foreign('id_proveedor')->references('id')->on('providers')->nullable()->constrained('providers');
            $table->foreign('id_category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
