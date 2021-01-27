<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturPenjualan extends Model
{
    use HasFactory;
    protected $table = "dtlretur_penjualan";
    protected $primaryKey = false;
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_retur','id_barang','nama_barang','jumlah_barang','nominal_retur','jenis_retur'
    ];
}
