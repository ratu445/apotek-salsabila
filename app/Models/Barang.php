<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_kategori', 'id_supplier', 'kode_barang', 'nama_barang', 
        'keterangan', 'harga', 'stok', 'expired_date', 'produsen', 
        'komposisi', 'gambar'
    ];

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