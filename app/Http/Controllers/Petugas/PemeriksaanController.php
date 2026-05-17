<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemesanan;
use App\Models\Pemeriksaan;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::whereIn('status', [
                        'Dikonfirmasi',
                        'Diproses'
                    ])
                    ->latest()
                    ->get();

        return view('petugas.pemeriksaan.index', compact('pemesanan'));
    }

    public function create($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        return view('petugas.pemeriksaan.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        Pemeriksaan::create([

            'pemesanan_id' => $request->pemesanan_id,

            'petugas_id' => auth()->id(),

            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,

            'diagnosa_singkat' => $request->diagnosa_singkat,

            'tindakan' => $request->tindakan,

            'catatan' => $request->catatan,

            'status' => 'Diproses',

        ]);

        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);

        $pemesanan->update([
            'status' => 'Diproses'
        ]);

        return redirect('/petugas/pemeriksaan')
                ->with('success', 'Pemeriksaan berhasil diinput');
    }

    public function selesai($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);

        $pemeriksaan->update([
            'status' => 'Selesai'
        ]);

        $pemeriksaan->pemesanan->update([
            'status' => 'Selesai'
        ]);

        return redirect('/petugas/pemeriksaan')
                ->with('success', 'Pemeriksaan selesai');
    }
}
