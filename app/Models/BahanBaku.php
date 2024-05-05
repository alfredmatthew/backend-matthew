<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tblbahanbaku";
    protected $primaryKey = "id_bahan";

    protected $fillable = [
        'nama_bahan',
        'stok_bahan',
        'satuan',
    ];

    // public function DetailTransaksi(){
    //     return $this->belongsTo(DetailTransaksi::class, ['id_transaksi_bahan', 'id_bahan']);
    // }

    // public function Resep(){
    //     return $this->belongsTo(Produk::class, ['id_produk', 'id_bahan']);
    // }
}
