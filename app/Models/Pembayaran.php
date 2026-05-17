<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'billing_id',
        'kode_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
        'jumlah_bayar',
        'status'
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}