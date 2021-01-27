<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempDtlPenjualan extends Model
{
    use HasFactory;
    protected $table = "temp_dtl_penjualan";
    protected $primaryKey = false;
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_penjualan','id_barang','nama_barang','jumlah_barang','harga_barang','diskon','jenis_barang','satuan'
    ];
}
