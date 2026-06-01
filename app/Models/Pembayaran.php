<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Pemesanan;
use App\Models\Billing;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [

        'pemesanan_id',
        'billing_id',
        'kode_pembayaran',
        'jenis_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
        'jumlah_bayar',
        'status',
        'expired_at'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(
            Pemesanan::class,
            'pemesanan_id'
        );
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}