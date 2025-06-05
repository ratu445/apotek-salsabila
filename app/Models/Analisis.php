<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    protected $primaryKey = 'id_analisis';
    protected $guarded = [];
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
