<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Billing;
use App\Models\Pembayaran;
use App\Models\Pemesanan;

use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    /**
     * HALAMAN DATA PEMBAYARAN
     */
    public function index()
    {

        // AUTO CANCEL PEMBAYARAN

        $expired = Pembayaran::where(

            'status',
            'Menunggu Pembayaran'

        )
        ->where(
            'expired_at',
            '<',
            now()
        )
        ->get();

        foreach($expired as $item){

            $item->update([

                'status' => 'Dibatalkan'

            ]);

            // UPDATE BOOKING

            if($item->pemesanan){

                $item->pemesanan->update([

                    'status' => 'Dibatalkan'

                ]);

            }

        }

        // AUTO CANCEL KONFIRMASI ADMIN

        $expiredAdmin = Pembayaran::where(

            'status',
            'Menunggu Konfirmasi Admin'

        )
        ->where(
            'expired_at',
            '<',
            now()
        )
        ->get();

        foreach($expiredAdmin as $item){

            $item->update([

                'status' => 'Dibatalkan'

            ]);

            if($item->pemesanan){

                $item->pemesanan->update([

                    'status' => 'Dibatalkan'

                ]);

            }

        }

        $pembayaran = Pembayaran::latest()->get();

        return view(
            'pemilik.pembayaran.index',
            compact('pembayaran')
        );
    }

    /**
     * HALAMAN PEMBAYARAN
     */
    public function create($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // if(request()->is('admin/*')){

        //         return view(
        //         'admin.pembayaran.index',
        //         compact('pembayaran')
        //     );

        //     }

                    return view(
                        'pemilik.pembayaran.create',
                        compact('pembayaran')
            );
    }

    /**
     * UPLOAD PEMBAYARAN
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'metode_pembayaran' => 'required',

            'bukti_pembayaran' => 'required|image'

        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $file = $request->file('bukti_pembayaran');

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(

            public_path('bukti_pembayaran'),

            $namaFile

        );

        $pembayaran->update([

            'metode_pembayaran' =>
                $request->metode_pembayaran,

            'bukti_pembayaran' =>
                $namaFile,

            'status' =>
                'Menunggu Konfirmasi Admin'

        ]);

        return redirect('/pemilik/pembayaran')
                ->with(
                    'success',
                    'Bukti pembayaran berhasil diupload'
                );
    }

    /**
     * VERIFIKASI PEMBAYARAN
     */
    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([

            'status' => 'Dikonfirmasi'

        ]);

        // UPDATE STATUS BOOKING

        $pemesanan = Pemesanan::findOrFail(
            $pembayaran->pemesanan_id
        );

        $pemesanan->update([

            'status' => 'Diproses'

        ]);

        return redirect('/admin/pembayaran')
                ->with(
                    'success',
                    'Pembayaran berhasil dikonfirmasi'
                );
    }

    /**
     * CETAK PDF
     */
    public function cetakPdf()
    {
        $pembayaran = Pembayaran::latest()->get();

        $pdf = Pdf::loadView(

            'pemilik.pembayaran.pdf',

            compact('pembayaran')

        );

        return $pdf->download(
            'laporan-pembayaran.pdf'
        );
    }
}