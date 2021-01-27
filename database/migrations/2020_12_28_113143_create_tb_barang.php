<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->string('id_barang', 100);
            $table->string('nama_barang', 100);
            $table->bigInteger('stock_barang')->length(100)->default(0);
            $table->string('jenis_barang', 100)->nullable();
            $table->bigInteger('harga_minimal')->length(100)->default(0);
            $table->bigInteger('harga_maximal')->length(100)->default(0);
            $table->bigInteger('pembelian_ke')->length(100)->default(0);
            $table->timestamps();
            $table->primary('id_barang');
            $table->unique('id_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_barang');
    }
}
