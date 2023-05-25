<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPenggunaan extends Model
{
    use HasFactory;
    protected $table = 'server_penggunaan';
    protected $fillable = [
        'id',
        // 'server_id',
        'hostname_server',
        'url_server',
        'port_akses_server',
        'ip_address_server',
        'ip_management_server',
        'web_server',
        'php_server',
        'db_server',
        'application_server',
        'deskripsi_server',
    ];
}
