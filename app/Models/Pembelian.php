<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    public $timestamps = false;
    protected $table = 'tblpembelian';

    protected $fillable = [
        'tanggal_pesan',
        'tanggal_lunas',
        'tanggal_ambil',
        'tipe_pengantaran',
        'alamat_pengantaran',
        'harga_ongkir',
        'total_harga',
        'poin_digunakan',
        'poin_didapat',
        'status_pembelian',
        'keterangan',
        'tip',
        'id_user',
    ];

    // Assuming you want to define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_user', 'id_user');
    }
}