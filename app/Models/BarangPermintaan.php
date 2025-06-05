<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangPermintaan extends Model
{
    protected $primaryKey = 'id_bp';
    protected $guarded = [];
    
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'id_permintaan');
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
