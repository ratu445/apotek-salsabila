<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $primaryKey = 'id_resep';
    protected $guarded = [];
    
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
    
    public function resepItems()
    {
        return $this->hasMany(ResepItem::class, 'id_resep');
    }
    
    public function permintaan()
    {
        return $this->hasOne(Permintaan::class, 'id_resep');
    }
}
