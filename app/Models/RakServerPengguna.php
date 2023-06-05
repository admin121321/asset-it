<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RakServerPengguna extends Model
{
    use HasFactory;
    protected $table='rak_server_pengguna';
    protected $fillable = [
        'server_id',
        'rak_id',
        'penggunaan_u',
    ];
}
