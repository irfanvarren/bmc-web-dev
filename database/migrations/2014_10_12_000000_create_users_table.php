<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_akun', function (Blueprint $table) {
            $table->bigIncrements('id_akun');
            $table->string('username',100);
            $table->string('nama_akun',100);
            $table->string('email_akun')->unique();
            $table->string('no_hp',100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status',100)->nullable();
            $table->text('foto')->nullable();
            $table->string('level',1000)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unique('id_akun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_akun');
    }
}
