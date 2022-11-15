<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancel_orders', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('customer');
            $table->string('id_invoice');
            $table->string('idpo');
            $table->string('id_produk');
            $table->string('id_ware');
            $table->string('id_area');
            $table->string('id_store');
            $table->string('id_reseller')->nullable(true);
            $table->string('produk');
            $table->string('size');
            $table->string('qty');
            $table->string('desc');
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
        Schema::dropIfExists('cancel_orders');
    }
}
