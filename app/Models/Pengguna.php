<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'nama_pengguna', 'alamat', 'no_hp', 'username', 
        'password', 'level_user'
    ];
    protected $hidden = ['password', 'remember_token'];

    public function reseps()
    {
        return $this->hasMany(Resep::class, 'id_pengguna');
    }
}