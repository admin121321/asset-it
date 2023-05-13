<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LisensiSoftwarePengguna extends Model
{
    use HasFactory;
    protected $table = 'lisensi_pengguna';
    protected $fillable = [
        'desktop_id',
        'lisensi_id',
        'qty',
    ];
}
