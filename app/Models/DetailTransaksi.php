<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tbldetailtransaksibahan";
    protected $primaryKey = ["id_transaksi_bahan", "id_bahan"];

    protected $fillable = [
        'jumlah_beli',
        'harga_beli',
    ];

    // public function TransaksiBahanBaku(){
    //     return $this->belongsTo(TransaksiBahanBaku::class, 'id_transaksi_bahan');
    // }

    // public function BahanBaku(){
    //     return $this->belongsTo(BahanBaku::class, 'id_bahan');
    // }
}
