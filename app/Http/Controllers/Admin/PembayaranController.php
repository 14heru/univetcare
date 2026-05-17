<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'Lunas'
        ]);

        $pembayaran->billing->update([
            'status' => 'Lunas'
        ]);

        return redirect('/admin/pembayaran')
                ->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function gagal($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'Gagal'
        ]);

        $pembayaran->billing->update([
            'status' => 'Belum Dibayar'
        ]);

        return redirect('/admin/pembayaran')
                ->with('success', 'Pembayaran ditolak');
    }
}
