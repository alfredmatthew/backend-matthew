<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranLain extends Model
{
    use HasFactory;

    protected $table = 'tblPengeluaranLain';
    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_pengeluaran',
        'kategori_pengeluaran',
        'biaya',
        'detail_pengeluaran'
    ];
}
