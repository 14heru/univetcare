<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;

use App\Models\Pemeriksaan;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Pemeriksaan::whereHas(
            'pemesanan',
            function($query){

                $query->where(
                    'user_id',
                    auth()->id()
                );

            }

        )->latest()->get();

        return view(
            'pemilik.riwayat.index',
            compact('riwayat')
        );
    }
}