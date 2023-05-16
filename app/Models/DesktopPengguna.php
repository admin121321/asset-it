<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesktopPengguna extends Model
{
    use HasFactory;
    protected $table = 'desktop_pengguna';
    protected $fillable = [
        'user_id',
        'desktop_id',
        'qty',
    ];
}
