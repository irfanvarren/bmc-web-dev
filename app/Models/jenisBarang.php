<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisBarang extends Model
{
    use HasFactory;
    protected $table = "tb_jenis_barang";
    protected $primaryKey = "id_jenis";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_jenis','jenis_barang' 
    ];
}
