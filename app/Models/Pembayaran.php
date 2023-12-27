<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'data_pembayaran';

    protected $fillable = [
        'user_id',
        'bulan_tagihan',
        'tahun_ajaran',
        'harga_spp',
        'status',
        'tanggal_pembayaran',
        'snap_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
