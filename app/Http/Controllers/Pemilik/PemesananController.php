<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;

use App\Models\Pemesanan;
use App\Models\Hewan;
use App\Models\Jadwal;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Pemesanan::where('status', 'Menunggu Konfirmasi')
        ->where('expired_at', '<', now())
        ->update([
            'status' => 'Dibatalkan'
        ]);

        $pemesanan = Pemesanan::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('pemilik.pemesanan.index', compact('pemesanan')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $hewan = Hewan::where('user_id', auth()->id())->get();

            $jadwal = Jadwal::where('status', 'Tersedia')->get();

            return view('pemilik.pemesanan.create', compact('hewan', 'jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'hewan_id' => 'required',
        'jadwal_id' => 'required',
    ]);

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        if($jadwal->status != 'Tersedia'){
        return back()->with('error', 'Jadwal tidak tersedia');
    }

        $kodeBooking = 'BOOK-'.time();

        Pemesanan::create([

        'user_id' => auth()->id(),

        'hewan_id' => $request->hewan_id,

        'jadwal_id' => $request->jadwal_id,

        'kode_booking' => $kodeBooking,

        'tanggal_booking' => $jadwal->tanggal,

        'keluhan' => $request->keluhan,

        'status' => 'Menunggu Konfirmasi',

        'expired_at' => now()->addMinutes(30),

    ]);

        return redirect('/pemilik/pemesanan')
            ->with('success', 'Booking berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $pemesanan = Pemesanan::findOrFail($id);

                $hewan = Hewan::where(
                    'user_id',
                    auth()->id()
                )->get();

                $jadwal = Jadwal::all();

                return view(
                    'pemilik.pemesanan.edit',
                    compact(
                        'pemesanan',
                        'hewan',
                        'jadwal'
                        )
                    );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $pemesanan = Pemesanan::findOrFail($id);

            $pemesanan->update([

                    'hewan_id' => $request->hewan_id,

                    'jadwal_id' => $request->jadwal_id,

                    'keluhan' => $request->keluhan

            ]);

            return redirect('/pemilik/pemesanan')
                ->with(
                'success',
                'Booking berhasil diupdate'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
