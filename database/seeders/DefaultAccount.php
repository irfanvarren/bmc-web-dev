<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DefaultAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_akun')->insert([
            'nama_akun' => 'Admin',
            'username' => 'admin',
            'email_akun' => 'admin@bmc.com',
            'level' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }
}
