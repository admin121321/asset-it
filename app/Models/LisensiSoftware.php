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
        'harga_lisensi',
        'key_lisensi',
        'core_os',
        'stok',
        'foto_lisensi',
    ];
}
