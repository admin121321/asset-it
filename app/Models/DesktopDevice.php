<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesktopDevice extends Model
{
    use HasFactory;
    protected $table = 'desktop_device';
    protected $fillable = [
        'id',
        'sn_desktop',
        'brand_desktop',
        'model_desktop',
        'type_desktop',
        'garansi_desktop',
        'tahun_anggaran',
        'harga_desktop',
        'stok',
        'foto_desktop',
        'ram_desktop',
        'hardisk_desktop',
        'processor_desktop',
        'core_desktop',
    ];
}
