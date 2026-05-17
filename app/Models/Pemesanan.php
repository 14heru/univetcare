<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pemeriksaan;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id',
        'hewan_id',
        'jadwal_id',
        'kode_booking',
        'tanggal_booking',
        'keluhan',
        'status',
        'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class);
    }
}
