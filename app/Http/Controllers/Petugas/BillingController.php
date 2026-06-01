<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Pemeriksaan;
use App\Models\Billing;
use App\Models\DetailBilling;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pembayaran;

class BillingController extends Controller
{
            public function index()
        {
            $pemeriksaan = Pemeriksaan::with([

                'pemesanan.hewan',
                'pemesanan.pemilik'

            ])->latest()->get();

            return view(
                'petugas.billing.index',
                compact('pemeriksaan')
            );
        }

    public function create($id)
    {
                $pemeriksaan = Pemeriksaan::findOrFail($id);

                return view(
                    'petugas.billing.create',
                    compact('pemeriksaan')
                );
            }

    public function store(Request $request)
    {
                $request->validate([

                    'pemeriksaan_id' => 'required',
                    'nama_item' => 'required',
                    'qty' => 'required',
                    'harga' => 'required'

                ]);

                /**
                 * HITUNG SUBTOTAL
                 */

                $subtotal = 0;

                foreach($request->qty as $key => $qty){

                    $harga = str_replace(
                        '.',
                        '',
                        $request->harga[$key]
                    );

                    $subtotal +=
                        $qty * $harga;

                }

                /**
                 * AMBIL / BUAT BILLING
                 */

                $billing = Billing::firstOrCreate(

                    [
                        'pemeriksaan_id' =>
                            $request->pemeriksaan_id
                    ],

                    [
                        'kode_billing' =>
                            'BILL-'.time(),

                        'subtotal' => 0,

                        'total' => 0,

                        'status' => 'Belum Dibayar'
                    ]

                );

                /**
                 * UPDATE TOTAL BILLING
                 */

                $billing->update([

                    'subtotal' => $subtotal,

                    'total' => $subtotal

                ]);

                /**
                 * HAPUS DETAIL LAMA
                 */

                DetailBilling::where(
                    'billing_id',
                    $billing->id
                )->delete();

                /**
                 * SIMPAN DETAIL BARU
                 */

                foreach($request->qty as $key => $qty){

                    $harga = str_replace(
                        '.',
                        '',
                        $request->harga[$key]
                    );

                    DetailBilling::create([

                        'billing_id' =>
                            $billing->id,

                        'nama_item' =>
                            $request->nama_item[$key],

                        'qty' =>
                            $qty,

                        'harga' =>
                            $harga,

                        'subtotal' =>
                            $qty * $harga

                    ]);

                }

                /**
                 * AMBIL DATA PEMERIKSAAN
                 */

                $pemeriksaan = Pemeriksaan::findOrFail(
                    $request->pemeriksaan_id
                );

                /**
                 * AMBIL DATA PEMESANAN
                 */

                $pemesanan = $pemeriksaan->pemesanan;

                /**
                 * CARI PEMBAYARAN DP
                 */

                $pembayaranDP = Pembayaran::where(

                        'pemesanan_id',
                        $pemesanan->id

                    )
                    ->where(

                        'jenis_pembayaran',
                        'DP'

                    )
                    ->first();

                /**
                 * CEK AGAR TIDAK DOUBLE PELUNASAN
                 */

                $cekPelunasan = Pembayaran::where(

                        'billing_id',
                        $billing->id

                    )
                    ->where(

                        'jenis_pembayaran',
                        'Lunas'

                    )
                    ->first();

                /**
                 * BUAT TAGIHAN PELUNASAN
                 */

                if(!$cekPelunasan && $pembayaranDP){

                    Pembayaran::create([

                        'pemesanan_id' =>
                            $pemesanan->id,

                        'billing_id' =>
                            $billing->id,

                        'kode_pembayaran' =>
                            'PAY-LUNAS-' .
                            str_replace(
                                'PAY-',
                                '',
                                $pembayaranDP->kode_pembayaran
                            ),

                        'jenis_pembayaran' =>
                            'Lunas',

                        'jumlah_bayar' =>
                            $billing->total,

                        'metode_pembayaran' =>
                            '-',

                        'status' =>
                            'Menunggu Pembayaran',

                        'expired_at' =>
                            now()->addHours(24)

                    ]);

                }

                return redirect('/petugas/billing')
                        ->with(
                            'success',
                            'Billing berhasil dibuat'
                        );
            }
                    // {
                    //     $request->validate([

                    //         'pemeriksaan_id' => 'required',

                    //         'nama_item' => 'required',

                    //         'qty' => 'required',

                    //         'harga' => 'required'

                    //     ]);

                    //     /**
                    //     * HITUNG SUBTOTAL
                    //     */

                    //     $subtotal = 0;

                    //     foreach($request->qty as $key => $qty){

                    //         $subtotal +=
                    //             $qty * $request->harga[$key];

                    //     }

                    //     /**
                    //     * AMBIL / BUAT BILLING
                    //     */

                    //     $billing = Billing::firstOrCreate(

                    //         [
                    //             'pemeriksaan_id' =>
                    //                 $request->pemeriksaan_id
                    //         ],

                    //         [
                    //             'kode_billing' =>
                    //                 'BILL-'.time(),

                    //             'subtotal' => 0,

                    //             'total' => 0,

                    //             'status' => 'Belum Dibayar'
                    //         ]

                    //     );

                    //     /**
                    //     * UPDATE TOTAL
                    //     */

                    //     $billing->update([

                    //         'subtotal' => $subtotal,

                    //         'total' => $subtotal

                    //     ]);
                    //     /**
                    //          * AMBIL DATA PEMERIKSAAN
                    //          */

                    //         $pemeriksaan = Pemeriksaan::findOrFail(
                    //             $request->pemeriksaan_id
                    //         );

                    //         /**
                    //          * AMBIL DATA PEMESANAN
                    //          */

                    //         $pemesanan = $pemeriksaan->pemesanan;

                    //         /**
                    //          * CARI PEMBAYARAN DP
                    //          */

                    //         $pembayaranDP = Pembayaran::where(

                    //                 'pemesanan_id',
                    //                 $pemesanan->id

                    //             )
                    //             ->where(

                    //                 'jenis_pembayaran',
                    //                 'DP'

                    //             )
                    //             ->first();

                    //         /**
                    //          * CEK AGAR TIDAK DOUBLE PELUNASAN
                    //          */

                    //         $cekPelunasan = Pembayaran::where(

                    //                 'billing_id',
                    //                 $billing->id

                    //             )
                    //             ->where(

                    //                 'jenis_pembayaran',
                    //                 'Lunas'

                    //             )
                    //             ->first();

                    //         /**
                    //          * BUAT TAGIHAN PELUNASAN
                    //          */

                    //         if(!$cekPelunasan && $pembayaranDP){

                    //             Pembayaran::create([

                    //                 'pemesanan_id' =>
                    //                     $pemesanan->id,

                    //                 'billing_id' =>
                    //                     $billing->id,

                    //                 /**
                    //                  * KODE SAMA DENGAN DP
                    //                  */

                    //                 'kode_pembayaran' =>
                    //                     // $pembayaranDP->kode_pembayaran,
                    //                     'PAY-LUNAS-' .

                    //                         str_replace(
                    //                             'PAY-',
                    //                             '',
                    //                             $pembayaranDP->kode_pembayaran
                    //                         ),

                    //                 'jenis_pembayaran' =>
                    //                     'Lunas',

                    //                 'jumlah_bayar' =>
                    //                     $billing->total,

                    //                 'metode_pembayaran' =>
                    //                     '-',

                    //                 'status' =>
                    //                     'Menunggu Pembayaran',

                    //                 'expired_at' =>
                    //                     now()->addHours(24)

                    //             ]);

                    //         }

                    //     /**
                    //     * HAPUS DETAIL LAMA
                    //     */

                    //     DetailBilling::where(
                    //         'billing_id',
                    //         $billing->id
                    //     )->delete();

                    //     /**
                    //     * SIMPAN DETAIL BARU
                    //     */

                    //     foreach($request->qty as $key => $qty){

                    //         DetailBilling::create([

                    //             'billing_id' => $billing->id,

                    //             'nama_item' =>
                    //                 $request->nama_item[$key],

                    //             'qty' => $qty,

                    //             'harga' =>
                    //                 $request->harga[$key],

                    //             'subtotal' =>
                    //                 $qty * $request->harga[$key]

                    //         ]);

                    //     }

                    //     return redirect('/petugas/billing')
                    //             ->with(
                    //                 'success',
                    //                 'Billing berhasil dibuat'
                    //             );
                    // }


            public function show($id)
            {
               $billing = Billing::with([
                    'pemeriksaan.pemesanan.hewan',
                    'detailBilling'
                ])->findOrFail($id);

                return view(
                    'petugas.billing.show',
                    compact('billing')
                );
            }


            public function edit($id)
                    {
                        $billing = Billing::with(
                            'detailBilling'
                        )->findOrFail($id);

                        return view(
                            'petugas.billing.edit',
                            compact('billing')
                        );
                    }


            public function update(Request $request, $id)
                    {
                        $billing = Billing::findOrFail($id);

                                    $subtotal = 0;

                                    DetailBilling::where(
                                        'billing_id',
                                        $billing->id
                                    )->delete();

                                    foreach($request->qty as $key => $qty){

                                        $harga = str_replace(
                                            '.',
                                            '',
                                            $request->harga[$key]
                                        );

                                        $subtotal += $qty * $harga;

                                        DetailBilling::create([

                                            'billing_id' =>
                                                $billing->id,

                                            'nama_item' =>
                                                $request->nama_item[$key],

                                            'qty' =>
                                                $qty,

                                            'harga' =>
                                                $harga,

                                            'subtotal' =>
                                                $qty * $harga

                                        ]);

                                    }

                                    $billing->update([

                                        'subtotal' => $subtotal,

                                        'total' => $subtotal

                                    ]);

                                    /**
                                     * UPDATE NOMINAL PEMBAYARAN LUNAS
                                     */

                                    Pembayaran::where(
                                        'billing_id',
                                        $billing->id
                                    )
                                    ->where(
                                        'jenis_pembayaran',
                                        'Lunas'
                                    )
                                    ->update([

                                        'jumlah_bayar' => $subtotal

                                    ]);

                                    return redirect('/petugas/billing')
                                            ->with(
                                                'success',
                                                'Billing berhasil diupdate'
                                            );
                                }


            public function destroy($id)
                    {
                        $billing = Billing::findOrFail($id);

                        /**
                         * HAPUS DETAIL BILLING
                         */

                        DetailBilling::where(
                            'billing_id',
                            $billing->id
                        )->delete();

                        /**
                         * HAPUS BILLING
                         */

                        $billing->delete();

                        return redirect('/petugas/billing')
                                ->with(
                                    'success',
                                    'Billing berhasil dihapus'
                                );
                    }
}
