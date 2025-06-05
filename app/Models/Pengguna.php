<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $primaryKey = 'id_pengguna';
    protected $guarded = [];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function reseps()
    {
        return $this->hasMany(Resep::class, 'id_pengguna');
    }
}
