<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Billing;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $billing = Billing::whereHas('pemeriksaan.pemesanan', function($query){

            $query->where('user_id', auth()->id());

        })->latest()->get();

        return view('pemilik.pembayaran.index', compact('billing'));
    }

    public function create($id)
    {
        $billing = Billing::findOrFail($id);

        return view('pemilik.pembayaran.create', compact('billing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image',
        ]);

        $billing = Billing::findOrFail($request->billing_id);

        $file = $request->file('bukti_pembayaran');

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('bukti_pembayaran'), $namaFile);

        Pembayaran::create([

            'billing_id' => $billing->id,

            'kode_pembayaran' => 'PAY-'.time(),

            'metode_pembayaran' => $request->metode_pembayaran,

            'bukti_pembayaran' => $namaFile,

            'jumlah_bayar' => $billing->total,

            'status' => 'Menunggu Verifikasi'

        ]);

        $billing->update([
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect('/pemilik/pembayaran')
                ->with('success', 'Pembayaran berhasil dikirim');
    }
}
