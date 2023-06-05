<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerSpek extends Model
{
    use HasFactory;
    protected $table = 'server_spek';
    protected $fillable = [
        'id',
        // 'server_id',
        'ram_server',
        'hardisk_server',
        'processor_server',
        'core_server',
        'os_server',
    ];
}
