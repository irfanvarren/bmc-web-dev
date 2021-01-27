<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;
    protected $table = "tb_ekspedisi";
    protected $primaryKey = "id_ekspedisi";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_ekspedisi','nama_ekspedisi','alamat','no_telp'
    ];
}
