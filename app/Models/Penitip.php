<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tblpenitip";
    protected $primaryKey = "id_penitip";

    protected $fillable = [
        'nama_penitip',
        'no_telp_penitip',
        'alamat_penitip',
    ];

    // public function Produk(){
    //     return $this->belongsTo(Produk::class, 'id_produk');
    // }
}