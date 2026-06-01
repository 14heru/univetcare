<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan;
use App\Models\Billing;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaan';

    protected $fillable = [
        'pemesanan_id',
        'petugas_id',
        'hasil_pemeriksaan',
        'diagnosa_singkat',
        'tindakan',
        'catatan',
        'status'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }


    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }


    public function billing()
    {
        return $this->hasOne(Billing::class);
    }


    

    
}
