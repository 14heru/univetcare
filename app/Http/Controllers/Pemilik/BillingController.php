<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Billing;
use App\Models\Pembayaran;

class BillingController extends Controller
{
    public function index()
    {
        $billing = Billing::latest()->get();

        return view(
            'pemilik.billing.index',
            compact('billing')
        );
    }

    public function bayar($id)
    {
        $billing = Billing::findOrFail($id);

        return view(
            'pemilik.billing.bayar',
            compact('billing')
        );
    }

    public function upload(Request $request, $id)
    {
        $request->validate([

            'metode_pembayaran' => 'required',

            'bukti_pembayaran' => 'required|image'

        ]);

        $billing = Billing::findOrFail($id);

        $file = $request->file(
            'bukti_pembayaran'
        );

        $namaFile = time().'_'.
                    $file->getClientOriginalName();

        $file->move(

            public_path('bukti_pembayaran'),

            $namaFile

        );

        Pembayaran::create([

            'kode_pembayaran' =>
                $pembayaran->kode_pembayaran,

            'billing_id' =>
                $billing->id,

            'jenis_pembayaran' =>
                'Lunas',

            'jumlah_bayar' =>
                $billing->total,

            'metode_pembayaran' =>
                $request->metode_pembayaran,

            'bukti_pembayaran' =>
                $namaFile,

            'status' =>
                'Menunggu Konfirmasi Admin'

        ]);

        $billing->update([

            'status' =>
                'Menunggu Verifikasi'

        ]);

        return redirect('/pemilik/billing')
                ->with(
                    'success',
                    'Pembayaran lunas berhasil diupload'
                );
    }
}