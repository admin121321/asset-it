<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RakServer extends Model
{
    use HasFactory;
    protected $table='rak_server';
    protected $fillable = [
        'sn_rak',
        'brand_rak',
        'type_rak',
        'kode_rak',
        'dimensi_rak',
        'ukuran_u_rak',
        'sisa_u',
        'tahun_anggaran',
        'harga_rak',
        'deskripsi',
        'foto_rak',
        
    ];
}
