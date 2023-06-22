<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesorisDevice extends Model
{
    use HasFactory;
    protected $table = 'aksesoris_device';
    protected $fillable = [
        'id',
        'sn_aksesoris',
        'brand_aksesoris',
        'model_aksesoris',
        'type_aksesoris',
        'garansi_aksesoris',
        'tahun_anggaran',
        'harga_aksesoris',
        'stok',
        'sisa_stok',
        'foto_aksesoris',
    ];
}
