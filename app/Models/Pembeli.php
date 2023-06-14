<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';

    protected $fillable = [
        'nama_pembeli',
        'id_barang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'id_pembeli');
    }

}

