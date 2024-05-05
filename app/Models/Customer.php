<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pembelian;

class Customer extends Model
{
    public $timestamps = false;
    protected $table = "tblcustomer";

    protected $fillable = [
        'id_user',
        'nama_customer',
        'poin_customer',
        'tanggal_lahir_customer',
        'saldo',
    ];

    // public function Akun(){
    //     return $this->belongsTo(Akun::class, 'id_produk');
    // }
    public function Pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_produk');
    }
}
