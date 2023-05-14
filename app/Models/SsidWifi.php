<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SsidWifi extends Model
{
    use HasFactory;
    protected $table = 'ssid_wifi';
    protected $fillable = [
        'id',
        'ssid_name',
        'ip_segment',
        'provider',
        'lokasi_ssid',
        'user_ssid',
        'password_lama',
        'password_baru'
    ];
}
