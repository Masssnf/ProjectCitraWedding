<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_paket',
        'jenis_paket',
        'nama_paket',
        'id_makeup',
        'id_catering',
        'id_album',
        'id_tenda',
        'id_hiburan',
        'id_dekorasi',
        'id_wardrobe',
        'total_harga'
    ];

    protected $table = 'paket';

    public function transaksi(){
        return $this->hasMany(Transaksi::class,'id');
    }
    public function makeup(){
        return $this->belongsTo(Makeup::class, 'id_makeup', 'id');
    }
    public function catering(){
        return $this->belongsTo(Catering::class, 'id_catering', 'id');
    }
    public function album(){
        return $this->belongsTo(Album::class, 'id_album', 'id');
    }
    public function tenda(){
        return $this->belongsTo(Tenda::class, 'id_tenda', 'id');
    }
    public function hiburan(){
        return $this->belongsTo(Hiburan::class, 'id_hiburan', 'id');
    }
    public function dekorasi(){
        return $this->belongsTo(Dekorasi::class, 'id_dekorasi', 'id');
    }
    public function wardrobe(){
        return $this->belongsTo(Wardrobe::class, 'id_wardrobe', 'id');
    }
    public static function createCode(){
        $latestCode = self::orderBy('kode_paket','desc')->value('kode_paket');
        $latestCodeNumber = intval(substr($latestCode,6));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%03d", $nextCodeNumber);
        return 'PKTCWD' . $formattedCodeNumber;
    }
}
