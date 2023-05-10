<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterPengguna extends Model
{
    use HasFactory;
    protected $table='printer_pengguna';
    protected $fillable = [
        'user_id',
        'printer_id',
        'qty',
    ];
}
