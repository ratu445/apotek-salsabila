<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';
    protected $primaryKey = 'id_resep';
    protected $fillable = [
        'id_pengguna', 'nama_pasien', 'diagnosa', 
        'tgl_resep', 'catatan'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function items()
    {
        return $this->hasMany(ResepItem::class, 'id_resep');
    }

    public function permintaan()
    {
        return $this->hasOne(Permintaan::class, 'id_resep');
    }
}