<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected  $fillable = [
        'id_user',
        'namapl',
        'namapr',
        'alamat',
        'notelp',
        'email',
    ];

    protected $table = 'client';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function events()
    {
        return $this->hasMany(Events::class, 'id_client');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id');
    }
}
