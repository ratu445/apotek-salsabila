<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $primaryKey = 'id_permintaan';
    protected $guarded = [];
    
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }
    
    public function barangPermintaans()
    {
        return $this->hasMany(BarangPermintaan::class, 'id_permintaan');
    }
}
