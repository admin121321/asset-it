<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDivisi extends Model
{
    use HasFactory;
    protected $table = 'users_divisi';
    protected $fillable = [
        'id',
        'nama_divisi',
    ];
}
