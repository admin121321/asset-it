<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesorisPengguna extends Model
{
    use HasFactory;
    protected $table = 'aksesoris_pengguna';
    protected $fillable = [
        'desktop_id',
        'aksesoris_id',
        'qty',
    ];
}
