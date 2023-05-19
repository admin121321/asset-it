<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerSpek extends Model
{
    use HasFactory;
    protected $table = 'server_spek';
    protected $fillable = [
        // 'id',
        'server_id',
        'ram_server',
        'hardisk_server',
        'processor_server',
        'core_server',
        'subdomain_server',
        'port_akses_server',
        'ip_address_server',
        'ip_management_server',
        'deskripsi_server',
    ];
}
