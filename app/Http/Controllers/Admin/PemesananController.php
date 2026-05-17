<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;

use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
    $pemesanan = Pemesanan::latest()->get();

        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function konfirmasi($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->update([
            'status' => 'Dikonfirmasi'
        ]);

        return redirect('/admin/pemesanan')
                ->with('success', 'Booking berhasil dikonfirmasi');
    }

    public function batal($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->update([
            'status' => 'Dibatalkan'
        ]);

        return redirect('/admin/pemesanan')
                ->with('success', 'Booking dibatalkan');
    }
}
