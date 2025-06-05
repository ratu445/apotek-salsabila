<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'id_supplier';
    protected $guarded = [];
    
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_supplier');
    }
}
