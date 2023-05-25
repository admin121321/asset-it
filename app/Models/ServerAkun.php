<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerAkun extends Model
{
    use HasFactory;
    protected $table = 'server_akun';
    protected $fillable = [
        'server_id',
        'akun_server',
        'password_server',
        'tujuan_akses_server',
    ];
}
