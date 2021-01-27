<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = "tb_pelanggan";
    protected $primaryKey = "id_toko_pelanggan";
    public $timestamps = false;
    public $incrementing = false;
    public $fillable = [
        'id_toko_pelanggan','nama_toko_pelanggan','penanggung_jawab','alamat_toko_pelanggan','no_telp','pembelian_ke'    
    ];
}
