<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'nama_supplier', 'alamat', 'no_telp', 'email', 'npwp', 'keterangan'
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_supplier');
    }
}