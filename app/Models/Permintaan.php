<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';
    protected $primaryKey = 'id_permintaan';
    protected $fillable = [
        'tgl', 'total_bayar', 'payment', 'status', 'id_resep'
    ];

    const STATUS_BELUM_DIPROSES = 0;
    const STATUS_DIPROSES = 1;
    const STATUS_DIKIRIM = 2;
    const STATUS_SELESAI = 3;

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

    public function barangPermintaans()
    {
        return $this->hasMany(BarangPermintaan::class, 'id_permintaan');
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            self::STATUS_BELUM_DIPROSES => 'Belum Diproses',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_DIKIRIM => 'Dikirim',
            self::STATUS_SELESAI => 'Selesai'
        ];
        return $statuses[$this->status] ?? 'Unknown';
    }
}