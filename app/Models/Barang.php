<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $primaryKey = 'id_barang';
    protected $guarded = [];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
    
    public function resepItems()
    {
        return $this->hasMany(ResepItem::class, 'id_barang');
    }
    
    public function barangPermintaans()
    {
        return $this->hasMany(BarangPermintaan::class, 'id_barang');
    }
    
    public function analisis()
    {
        return $this->hasOne(Analisis::class, 'id_barang');
    }
}
