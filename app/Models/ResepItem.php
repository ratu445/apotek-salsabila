<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepItem extends Model
{
    protected $primaryKey = 'id_resep_item';
    protected $guarded = [];
    
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
