<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    use HasFactory;
    protected $table = 'spp'; // nama tabel di database

    protected $fillable = ['biaya']; // kolom yang bisa diisi
}
