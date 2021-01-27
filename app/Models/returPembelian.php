<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returPembelian extends Model
{
    use HasFactory;
    protected $table = "retur_pembelian";
    protected $primaryKey = "id_retur";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_retur','id_pembelian','id_akun','jumlah_produk_retur','tanggal_retur','tanggal_perpanjang'
    ];
}
