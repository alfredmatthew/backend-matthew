<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBahanBaku extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tbltransaksibahanbaku";
    protected $primaryKey = "id_transaksi_bahan";

    protected $fillable = [
        'tanggal_transaksi',
        'total_transaksi',
    ];

    // public function DetailTransaksi(){
    //     return $this->belongsTo(DetailTransaksi::class, ['id_transaksi_bahan', 'id_bahan']);
    // }
}
