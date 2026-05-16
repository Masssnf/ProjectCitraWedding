<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paket',
        'kode_invoice',
        'id_client',
        'lokasi_acara',
        'tanggal',
        'tanggal_acara',
        'biaya_tambahan',
        'status',
        'pembayaran',
        'id_user',
        'total_bayar',
    ];

    protected $table = 'transaksi';

    public function paket(){
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }
    public function album(){
        return $this->belongsTo(Album::class, 'id_album', 'id');
    }
    public function makeup(){
        return $this->belongsTo(Makeup::class, 'id_makeup', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function catering(){
        return $this->belongsTo(Catering::class, 'id_catering', 'id');
    }
    public function client(){
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public static function createCode(){
        $latestCode = self::orderBy('kode_invoice','desc')->value('kode_invoice');
        $latestCodeNumber = intval(substr($latestCode,3));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        return 'CWD' . $formattedCodeNumber;
    
    }
}
