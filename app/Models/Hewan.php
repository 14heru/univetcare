<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $table ='hewan';

    protected $fillable = [
        'user_id',
        'nama_hewan',
        'jenis_hewan',
        'ras',
        'jenis_kelamin',
        'umur',
        'berat',
        'warna',
        'keluhan',
        'satuan_umur'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
