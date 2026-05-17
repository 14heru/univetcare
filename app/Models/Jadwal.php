<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'status'
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
