<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBilling extends Model
{
    protected $table = 'detail_billing';

    protected $fillable = [
        'billing_id',
        'nama_item',
        'qty',
        'harga',
        'subtotal'
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}
