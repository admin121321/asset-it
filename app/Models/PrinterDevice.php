<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterDevice extends Model
{
    use HasFactory;
    protected $table = 'printer_devices';
    protected $fillable = [
        'id',
        'serial_number',
        'brand_printer',
        'model_printer',
        'type_printer',
        'tahun_anggaran',
        'harga_printer',
        'stok',
        'foto_printer',
    ];
}
