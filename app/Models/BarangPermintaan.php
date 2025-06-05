<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPermintaan extends Model
{
    use HasFactory;

    protected $table = 'barang_permintaan';
    protected $primaryKey = 'id_bp';
    protected $fillable = [
        'id_permintaan', 'id_barang', 'jumlah', 'harga_satuan'
    ];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'id_permintaan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}