<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = "tbdtl_pembelian";
    protected $primaryKey = false;
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_pembelian','id_barang','nama_barang','jumlah_barang','harga_barang','jenis_barang','satuan','kondisi'
    ];
}
