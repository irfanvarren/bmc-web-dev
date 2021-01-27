<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = "tb_pembelian";
    protected $primaryKey = "id_pembelian";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_pembelian','tanggal_order','nama_toko','alamat_toko','id_penerima','no_hp','id_ekspedisi','ongkir','total_harga','potongan_harga','rasio_ongkir','metode_pembayaran','tanggal_terima','username','keterangan','status'
    ];
}
