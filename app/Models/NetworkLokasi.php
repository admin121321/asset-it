<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkLokasi extends Model
{
    use HasFactory;
    protected $table = 'network_lokasi';
    protected $fillable = [
        'network_id',
        'lokasi',
        'qty',
    ];
}
