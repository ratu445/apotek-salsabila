<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepItem extends Model
{
    use HasFactory;

    protected $table = 'resep_item';
    protected $primaryKey = 'id_resep_item';
    protected $fillable = [
        'id_resep', 'id_barang', 'jumlah', 'aturan_pakai'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}