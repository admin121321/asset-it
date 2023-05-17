<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerDevice extends Model
{
    use HasFactory;
    protected $table = 'server_device';
    protected $fillable = [
        'sn_server',
        'brand_server',
        'model_server',
        'type_server',
        'garansi_server',
        'support_server',
        'tahun_anggaran',
        'harga_server',
        'stok',
        'foto_server',
    ];
}
