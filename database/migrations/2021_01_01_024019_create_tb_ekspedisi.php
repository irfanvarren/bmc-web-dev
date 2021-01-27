<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEkspedisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ekspedisi', function (Blueprint $table) {
            $table->string('id_ekspedisi', 100);
            $table->string('nama_ekspedisi', 100);
            $table->string('alamat',100)->nullable();
            $table->string('no_telepon',100)->nullable();
            $table->timestamps();
            $table->primary('id_ekspedisi');
            $table->unique('id_ekspedisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_ekspedisi');
    }
}
