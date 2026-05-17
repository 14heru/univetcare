<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';

    protected $fillable = [
        'pemeriksaan_id',
        'kode_billing',
        'subtotal',
        'total',
        'status'
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }

    public function detailBilling()
    {
        return $this->hasMany(DetailBilling::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
