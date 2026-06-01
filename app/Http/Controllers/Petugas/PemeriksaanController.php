<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemesanan;
use App\Models\Pemeriksaan;
use App\Models\Pembayaran;
use App\Models\Billing;

class PemeriksaanController extends Controller
{
    /**
     * HALAMAN ANTRIAN PEMERIKSAAN
     */
    public function index()
    {
        $pemesanan = Pemesanan::whereIn(
            'status',
            [
                'Diproses',
                'Dikonfirmasi',
                'Menunggu Pemeriksaan'
            ]
        )
        ->latest()
        ->get();

        return view(
            'petugas.pemeriksaan.index',
            compact('pemesanan')
        );
    }

                    /**
                 * DETAIL HASIL PEMERIKSAAN
                 */
                public function show($id)
                {
                    $pemeriksaan = Pemeriksaan::findOrFail($id);

                    return view(
                        'petugas.hasil_pemeriksaan.show',
                        compact('pemeriksaan')
                    );
                }


                /**
                 * FORM EDIT PEMERIKSAAN
                 */
                public function edit($id)
                {
                    $pemeriksaan = Pemeriksaan::findOrFail($id);

                    return view(
                        'petugas.hasil_pemeriksaan.edit',
                        compact('pemeriksaan')
                    );
                }


                /**
                 * UPDATE PEMERIKSAAN
                 */
                public function update(Request $request, $id)
                {
                    $request->validate([

                        'hasil_pemeriksaan' => 'required',
                        'diagnosa_singkat' => 'required',
                        'tindakan' => 'required',
                        'catatan' => 'required',

                    ]);

                    $pemeriksaan = Pemeriksaan::findOrFail($id);

                    $pemeriksaan->update([

                        'hasil_pemeriksaan' =>
                            $request->hasil_pemeriksaan,

                        'diagnosa_singkat' =>
                            $request->diagnosa_singkat,

                        'tindakan' =>
                            $request->tindakan,

                        'catatan' =>
                            $request->catatan,

                    ]);

                    return redirect('/petugas/hasil-pemeriksaan')
                            ->with(
                                'success',
                                'Pemeriksaan berhasil diupdate'
                            );
                }


                /**
                 * HAPUS PEMERIKSAAN
                 */
                public function destroy($id)
                {
                    $pemeriksaan = Pemeriksaan::findOrFail($id);

                    $pemeriksaan->delete();

                    return redirect('/petugas/hasil-pemeriksaan')
                            ->with(
                                'success',
                                'Pemeriksaan berhasil dihapus'
                            );
                }


                

    /**
     * FORM PEMERIKSAAN
     */
    public function create($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        return view(
            'petugas.pemeriksaan.create',
            compact('pemesanan')
        );
    }

    /**
     * SIMPAN PEMERIKSAAN
     */
    // public function store(Request $request)
    // {
    //     $request->validate([

    //         'pemesanan_id' => 'required',

    //         'hasil_pemeriksaan' => 'required',

    //         'diagnosa' => 'required',

    //         'tindakan' => 'required',

    //         'catatan' => 'nullable'

    //     ]);

    //     // Pemeriksaan::create([
    //     $pemeriksaan = Pemeriksaan::create([

    //         'pemesanan_id' =>
    //         $request->pemesanan_id,

    //         'petugas_id' =>
    //             auth()->id(),

    //         'hasil_pemeriksaan' =>
    //             $request->hasil_pemeriksaan,

    //         'diagnosa' =>
    //             $request->diagnosa,

    //         'tindakan' =>
    //             $request->tindakan,

    //         'catatan' =>
    //             $request->catatan

    //     ]);

    //     /**
    //      * UPDATE STATUS PEMESANAN
    //      */

    //     $pemesanan = Pemesanan::findOrFail(
    //         $request->pemesanan_id
    //     );

    //     $pemesanan->update([

    //         'status' => 'Selesai Pemeriksaan'

    //     ]);

    //     /**
    //      * BUAT BILLING
    //      */

    //     Billing::create([

    //         'kode_billing' =>
    //         'BILL-'.time(),

    //         'pemeriksaan_id' =>
    //                 $pemeriksaan->id,

    //         'pemesanan_id' =>
    //                 $pemesanan->id,

    //         'total_bayar' => 100000,

    //         'status' => 'Belum Lunas'

    //     ]);

    //     /**
    //      * BUAT TAGIHAN PELUNASAN
    //      */

    //     Pembayaran::create([

    //         'pemesanan_id' =>
    //             $pemesanan->id,

    //         'kode_pembayaran' =>
    //            $pembayaran->kode_pembayaran,

    //         'jenis_pembayaran' =>
    //             'Lunas',

    //         'jumlah_bayar' => 85000,

    //         'metode_pembayaran' => '-',

    //         'status' =>
    //             'Menunggu Pembayaran',

    //         'expired_at' =>
    //             now()->addMinutes(15)

    //     ]);

    //     return redirect('/petugas/pemeriksaan')
    //             ->with(
    //                 'success',
    //                 'Pemeriksaan berhasil disimpan'
    //             );
    // }

            public function store(Request $request)
        {
            $request->validate([

                    'pemesanan_id' => 'required',
                    'hasil_pemeriksaan' => 'required',
                    'diagnosa_singkat' => 'required',
                    'tindakan' => 'required',
                    'catatan' => 'nullable'

                ]);

                $pemeriksaan = Pemeriksaan::create([

                    'pemesanan_id' =>
                        $request->pemesanan_id,

                    'petugas_id' =>
                        auth()->id(),

                    'hasil_pemeriksaan' =>
                        $request->hasil_pemeriksaan,

                    'diagnosa_singkat' =>
                        $request->diagnosa_singkat,

                    'tindakan' =>
                        $request->tindakan,

                    'catatan' =>
                        $request->catatan,

                    'status' =>
                        'Selesai'

                ]);

                $pemesanan = Pemesanan::findOrFail(
                    $request->pemesanan_id
                );

                $pemesanan->update([

                    'status' => 'Selesai Pemeriksaan'

                ]);

                Billing::firstOrCreate(
                    [
                        'pemeriksaan_id' => $pemeriksaan->id
                    ],
                    [
                        'kode_billing' => 'BILL-'.time(),
                        'subtotal' => 0,
                        'total' => 0,
                        'status' => 'Belum Dibayar'
                    ]
                );

                return redirect('/petugas/hasil-pemeriksaan')
                        ->with(
                            'success',
                            'Pemeriksaan berhasil disimpan'
                        );
            }

    /**
     * SELESAI
     */
    public function selesai($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->update([

            'status' => 'Selesai'

        ]);

        return redirect('/petugas/pemeriksaan')
                ->with(
                    'success',
                    'Pemeriksaan selesai'
                );
    }

    public function hasil()
    {
        $pemeriksaan = Pemeriksaan::with(
            'pemesanan.hewan'
        )->latest()->get();

        return view(
            'petugas.hasil_pemeriksaan.index',
            compact('pemeriksaan')
        );
    }
}