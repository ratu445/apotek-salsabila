<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    use HasFactory;

    protected $table = 'analisis';
    protected $primaryKey = 'id_analisis';
    protected $fillable = [
        'id_barang', 'dt_jml_permintaan', 'biaya_pemesanan', 
        'biaya_penyimpanan', 'hari_aktif', 'periode', 'eoq', 
        'rop', 'safety_stok', 'minimal_stok', 'maksimal_stok', 'lead_time'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}