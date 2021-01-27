<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = "tb_barang";
    public $incrementing = false;
    public $primaryKey = "id_barang";
    public $fillable = [
        'id_barang','nama_barang','stock_barang','jenis_barang','harga_minimal','harga_maximal','pembelian_ke','satuan'
    ];
}
