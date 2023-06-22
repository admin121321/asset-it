<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LisensiSoftware extends Model
{
    use HasFactory;
    protected $table = 'lisensi_software';
    protected $fillable = [
        'id',
        'sn_lisensi',
        'brand_lisensi',
        'model_lisensi',
        'type_lisensi',
        'tahun_anggaran',
        'masa_aktif',
        'harga_lisensi',
        'key_lisensi',
        'bit_os',
        'stok',
        'sisa_stok',
        'foto_lisensi',
    ];
}
