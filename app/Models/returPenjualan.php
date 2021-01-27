<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returPenjualan extends Model
{
    use HasFactory;
    protected $table = "retur_penjualan";
    protected $primaryKey = "id_retur";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_retur','id_penjualan','jumlah_produk_retur','tanggal_retur','id_toko_pelanggan'
    ];
}

