<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembelian', function (Blueprint $table) {
            $table->string('id_pembelian', 100);
            $table->date('tanggal_order');
            $table->string('nama_toko',100);
            $table->string('alamat_toko', 100)->nullable();
            $table->bigInteger('id_penerima')->length(100);
            $table->string('no_hp',100)->nullable();
            $table->bigInteger('id_ekspedisi')->length(100);
            $table->bigInteger('ongkir')->length(100);
            $table->bigInteger('total_harga')->length(100);
            $table->bigInteger('potongan_harga')->length(100)->nullable()->default(0);
            $table->double('rasio_ongkir',10,10)->nullable()->default(0);
            $table->string('metode_pembayaran',100);
            $table->dateTime('tanggal_terima');
            $table->string('username',100);
            $table->string('keterangan',250);
            $table->timestamps();
            $table->primary('id_pembelian');
            $table->unique('id_pembelian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pembelian');
    }
}
