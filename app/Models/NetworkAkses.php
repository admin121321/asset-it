<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkAkses extends Model
{
    use HasFactory;
    protected $table = 'network_akses';
    protected $fillable = [
        'network_id',
        'ip_akses',
        'akun_akses',
        'password_akses',
    ];
}
