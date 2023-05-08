<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterDevice extends Model
{
    use HasFactory;
    protected $table = 'printer-devices';
    protected $fillable = [
        'serial_number',
        'brand_printer',
        'model_printer',
        'type_printer',
        'tahun_anggaran',
        'harga_printer',
        'foto_printer',
    ];
}
