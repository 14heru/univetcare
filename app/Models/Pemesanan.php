<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pemeriksaan;
// use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Hewan;
use App\Models\Jadwal;



// class Pemesanan extends Model
// {
//     protected $table = 'pemesanan';

//     protected $fillable = [

//         'user_id',
//         'pemilik_hewan_id',
//         'hewan_id',
//         'jadwal_id',
//         'kode_booking',
//         'tanggal_booking',
//         'keluhan',
//         'status',
//         'expired_at'
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }


//     public function hewan()
//     {
//         return $this->belongsTo(Hewan::class);
//     }


//     public function jadwal()
//     {
//         return $this->belongsTo(Jadwal::class);
//     }


//     public function pemeriksaan()
//     {
//         return $this->hasOne(Pemeriksaan::class);
//     }


//     // public function pemesanan()
//     // {
//     //     return $this->belongsTo(
//     //         Pemesanan::class
//     //     );
//     // }


//     public function pemilik()
//     {
//         return $this->belongsTo(
//             PemilikHewan::class,
//             'pemilik_hewan_id'
//         );
//     }
// }
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

        //     public function user()
        //     {
        //         return $this->belongsTo(User::class);
        //     }

        //     public function hewan()
        //     {
        //         return $this->belongsTo(Hewan::class);
        //     }

        //     public function jadwal()
        //     {
        //         return $this->belongsTo(Jadwal::class);
        //     }

        //     public function pemeriksaan()
        //     {
        //         return $this->hasOne(
        //             Pemeriksaan::class
        //         );
        //     }

        //     public function pemilik()
        //     {
        //         return $this->belongsTo(
        //             User::class,
        //             'user_id'
        //         );
        //     }
        // }


                    public function user()
                {
                    return $this->belongsTo(
                        User::class,
                        'user_id'
                    );
                }

                public function pemilik()
                {
                    return $this->belongsTo(
                        User::class,
                        'user_id'
                    );
                }

                public function hewan()
                {
                    return $this->belongsTo(
                        Hewan::class,
                        'hewan_id'
                    );
                }

                public function jadwal()
                {
                    return $this->belongsTo(
                        Jadwal::class,
                        'jadwal_id'
                    );
                }

                public function pemeriksaan()
                {
                    return $this->hasOne(
                        Pemeriksaan::class,
                        'pemesanan_id'
                    );
                }
            }