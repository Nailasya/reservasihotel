<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable =[
        'nama_kamar','fasilitas_kamar','harga_kamar','kuantitas_kamar'
    ];
}
