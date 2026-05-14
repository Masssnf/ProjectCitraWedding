<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dekorasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_dekorasi',
        'deskripsi',
        'harga',
        'gambar',
    ];

    protected $table = 'dekorasi';

    public function paket(){
        return $this->hasMany(Paket::class, 'id');
    }
}
