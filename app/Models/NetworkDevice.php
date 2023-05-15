<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkDevice extends Model
{
    use HasFactory;
    protected $table = 'network_device';
    protected $fillable = [
        'id',
        'sn_network',
        'brand_network',
        'model_network',
        'type_network',
        'port_network',
        'garansi_network',
        'tahun_anggaran',
        'harga_network',
        'stok',
        'foto_network',
    ];
}
