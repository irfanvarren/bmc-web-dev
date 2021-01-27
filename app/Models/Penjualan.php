<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = "tb_penjualan";
    protected $primaryKey = "id_penjualan";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_penjualan','tanggal_order','tanggal_kirim','id_toko_pelanggan','alamat_toko_pelanggan','metode_pembayaran',
        'diskon','jatuh_tempo','penanggung_jawab','no_hp','keterangan','total_harga','status'
    ];
}
