<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;
    protected $table = "tb_penerima";
    protected $primaryKey = "id_penerima";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_penerima','nama_penerima','no_hp','alamat','provinsi','kota','kode_pos'
    ];
}
