<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RakServerLokasi extends Model
{
    use HasFactory;
    protected $table='rak_server_lokasi';
    protected $fillable = [
        'rak_id',
        'nama_lokasi_rak',
    ];
}
