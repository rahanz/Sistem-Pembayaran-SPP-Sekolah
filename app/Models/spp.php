<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    use HasFactory;
    protected $table = 'spp';
    protected $fillable =
    [
        'harga_spp'
    ];

    public function data_pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'product_id');
    }
}
