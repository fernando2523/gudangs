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
            $table->string('id_produk');
            $table->string('id_ware');
            $table->string('id_brand');
            $table->string('tanggal');
            $table->string('produk');
            $table->string('desc')->nullable(true);
            $table->string('category');
            $table->string('quality');
            $table->string('n_price')->nullable(true);
            $table->string('r_price')->nullable(true);
            $table->string('g_price')->nullable(true);
            $table->string('m_price')->nullable(true);
            $table->string('img')->nullable(true);
            $table->string('users');
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
        Schema::dropIfExists('products');
    }
}
