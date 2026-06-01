<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Billing;

class PembayaranController extends Controller
{
    /**
     * HALAMAN PEMBAYARAN
     */
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();

        return view(
            'admin.pembayaran.index',
            compact('pembayaran')
        );
    }

    /**
     * VERIFIKASI PEMBAYARAN
     */
    public function verifikasi($id)
    {
        // $pembayaran = Pembayaran::findOrFail($id);

        // /**
        //  * CEGAH VERIFIKASI ULANG
        //  */

        // if($pembayaran->status == 'Dikonfirmasi'){

        //     return redirect('/admin/pembayaran')
        //             ->with(
        //                 'success',
        //                 'Pembayaran sudah pernah diverifikasi'
        //             );

        // }

        // /**
        //  * UPDATE STATUS PEMBAYARAN
        //  */

        // $pembayaran->update([

        //     'status' => 'Dikonfirmasi'

        // ]);

        // /**
        //  * JIKA PEMBAYARAN DP
        //  */

        // if($pembayaran->jenis_pembayaran == 'DP'){

        //     if($pembayaran->pemesanan){

        //         $pemesanan = $pembayaran->pemesanan;

        //         $pemesanan->update([

        //             'status' => 'Diproses'

        //         ]);

        //         /**
        //          * KUOTA BERKURANG SETELAH DP DIVERIFIKASI ADMIN
        //          */

        //         if(
        //             $pemesanan->jadwal
        //             &&
        //             $pemesanan->jadwal->kuota > 0
        //         ){

        //             $pemesanan->jadwal->decrement(
        //                 'kuota'
        //             );

        //         }

        //         /**
        //          * JIKA KUOTA HABIS, STATUS JADWAL MENJADI PENUH
        //          */

        //         if(
        //             $pemesanan->jadwal
        //             &&
        //             $pemesanan->jadwal->kuota <= 0
        //         ){

        //             $pemesanan->jadwal->update([

        //                 'status' => 'Penuh'

        //             ]);

        //         }

        //     }

        // }

        // /**
        //  * JIKA PEMBAYARAN LUNAS
        //  */

        // if($pembayaran->jenis_pembayaran == 'Lunas'){

        //     /**
        //      * UPDATE STATUS BILLING
        //      */

        //     if($pembayaran->billing){

        //         $pembayaran->billing->update([

        //             'status' => 'Lunas'

        //         ]);

        //     }

        //     /**
        //      * UPDATE STATUS PEMESANAN
        //      */

        //     if(
        //         $pembayaran->billing
        //         &&
        //         $pembayaran->billing->pemeriksaan
        //         &&
        //         $pembayaran->billing->pemeriksaan->pemesanan
        //     ){

        //         $pembayaran
        //             ->billing
        //             ->pemeriksaan
        //             ->pemesanan
        //             ->update([

        //                 'status' => 'Selesai'

        //             ]);

        //     }

        // }

        // return redirect('/admin/pembayaran')
        //         ->with(
        //             'success',
        //             'Pembayaran berhasil diverifikasi'
        //         );

        DB::transaction(function () use ($id) {

        $pembayaran = Pembayaran::lockForUpdate()->findOrFail($id);

        if($pembayaran->status == 'Dikonfirmasi'){
            return;
        }

        $pembayaran->update([
            'status' => 'Dikonfirmasi'
        ]);

        if($pembayaran->jenis_pembayaran == 'DP'){

            $pemesanan = $pembayaran->pemesanan;

            if($pemesanan){

                $jadwal = $pemesanan->jadwal()
                    ->lockForUpdate()
                    ->first();

                if(!$jadwal || $jadwal->kuota <= 0){

                    $pemesanan->update([
                        'status' => 'Dibatalkan'
                    ]);

                    throw new \Exception('Kuota jadwal sudah penuh');
                }

                $pemesanan->update([
                    'status' => 'Diproses'
                ]);

                $jadwal->decrement('kuota');

                $jadwal->refresh();

                if($jadwal->kuota <= 0){

                    $jadwal->update([
                        'status' => 'Penuh'
                    ]);

                }

            }

        }

        if($pembayaran->jenis_pembayaran == 'Lunas'){

            if($pembayaran->billing){

                $pembayaran->billing->update([
                    'status' => 'Lunas'
                ]);

            }

            if(
                $pembayaran->billing &&
                $pembayaran->billing->pemeriksaan &&
                $pembayaran->billing->pemeriksaan->pemesanan
            ){

                $pembayaran->billing->pemeriksaan->pemesanan->update([
                    'status' => 'Selesai'
                ]);

            }

        }

    });

    return redirect('/admin/pembayaran')
        ->with('success', 'Pembayaran berhasil diverifikasi');

    }

    /**
     * TOLAK PEMBAYARAN
     */
    public function gagal($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([

            'status' => 'Dibatalkan'

        ]);

        /**
         * JIKA PEMBAYARAN DP
         */

        if($pembayaran->jenis_pembayaran == 'DP'){

            if($pembayaran->pemesanan){

                $pembayaran->pemesanan->update([

                    'status' => 'Dibatalkan'

                ]);

            }

        }

        /**
         * JIKA PEMBAYARAN LUNAS
         */

        if($pembayaran->jenis_pembayaran == 'Lunas'){

            if($pembayaran->billing){

                $pembayaran->billing->update([

                    'status' => 'Belum Dibayar'

                ]);

            }

        }

        return redirect('/admin/pembayaran')
                ->with(
                    'success',
                    'Pembayaran ditolak'
                );
    }

    /**
     * MEMBUAT TAGIHAN PELUNASAN
     */
    public function buatLunas($id)
    {
        $dp = Pembayaran::findOrFail($id);

        /**
         * AMBIL BILLING BERDASARKAN PEMESANAN
         */

        $billing = Billing::whereHas(
            'pemeriksaan',
            function($query) use ($dp){

                $query->where(
                    'pemesanan_id',
                    $dp->pemesanan_id
                );

            }
        )->latest()->first();

        /**
         * CEK AGAR TIDAK DOUBLE TAGIHAN
         */

        $cek = Pembayaran::where(

                'billing_id',
                $billing->id ?? 0

            )
            ->where(

                'jenis_pembayaran',
                'Lunas'

            )
            ->first();

        if(!$cek && $billing){

            Pembayaran::create([

                'pemesanan_id' =>
                    $dp->pemesanan_id,

                'billing_id' =>
                    $billing->id,

                'kode_pembayaran' =>
                    'PAY-LUNAS-' .
                    str_replace(
                        'PAY-',
                        '',
                        $dp->kode_pembayaran
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

        return redirect('/admin/pembayaran')
                ->with(
                    'success',
                    'Tagihan pelunasan berhasil dibuat'
                );
    }
}

// class PembayaranController extends Controller
// {
//     /**
//      * HALAMAN PEMBAYARAN
//      */
//     public function index()
//     {
//         $pembayaran = Pembayaran::latest()->get();

//         return view(
//             'admin.pembayaran.index',
//             compact('pembayaran')
//         );
//     }

//     /**
//      * VERIFIKASI PEMBAYARAN
//      */
//     public function verifikasi($id)
//     {
//         $pembayaran = Pembayaran::findOrFail($id);

//         /**
//          * UPDATE STATUS PEMBAYARAN
//          */

//         $pembayaran->update([

//             'status' => 'Dikonfirmasi'

//         ]);

//         /**
//          * JIKA PEMBAYARAN DP
//          */

//         if($pembayaran->jenis_pembayaran == 'DP'){

//             if($pembayaran->pemesanan){

//                 $pembayaran->pemesanan->update([

//                     'status' => 'Diproses'

//                 ]);

//             }

//         }

//         /**
//          * JIKA PEMBAYARAN LUNAS
//          */

//         if($pembayaran->jenis_pembayaran == 'Lunas'){

//             /**
//              * UPDATE STATUS BILLING
//              */

//             if($pembayaran->billing){

//                 $pembayaran->billing->update([

//                     'status' => 'Lunas'

//                 ]);

//             }

//             /**
//              * UPDATE STATUS PEMESANAN
//              */

//             if(

//                 $pembayaran->billing

//                 &&

//                 $pembayaran->billing->pemeriksaan

//                 &&

//                 $pembayaran
//                     ->billing
//                     ->pemeriksaan
//                     ->pemesanan

//             ){

//                 $pembayaran
//                     ->billing
//                     ->pemeriksaan
//                     ->pemesanan
//                     ->update([

//                         'status' => 'Selesai'

//                     ]);

//             }

//         }

//         return redirect('/admin/pembayaran')
//                 ->with(
//                     'success',
//                     'Pembayaran berhasil diverifikasi'
//                 );
//     }

//     /**
//      * TOLAK PEMBAYARAN
//      */
//     public function gagal($id)
//     {
//         $pembayaran = Pembayaran::findOrFail($id);

//         $pembayaran->update([

//             'status' => 'Dibatalkan'

//         ]);

//         /**
//          * JIKA PEMBAYARAN DP
//          */

//         if($pembayaran->jenis_pembayaran == 'DP'){

//             if($pembayaran->pemesanan){

//                 $pembayaran->pemesanan->update([

//                     'status' => 'Dibatalkan'

//                 ]);

//             }

//         }

//         /**
//          * JIKA PEMBAYARAN LUNAS
//          */

//         if($pembayaran->jenis_pembayaran == 'Lunas'){

//             if($pembayaran->billing){

//                 $pembayaran->billing->update([

//                     'status' => 'Belum Lunas'

//                 ]);

//             }

//         }

//         return redirect('/admin/pembayaran')
//                 ->with(
//                     'success',
//                     'Pembayaran ditolak'
//                 );
//     }

//     /**
//      * MEMBUAT TAGIHAN PELUNASAN
//      */
//     public function buatLunas($id)
//     {
//         $dp = Pembayaran::findOrFail($id);

//     /**
//      * AMBIL BILLING BERDASARKAN PEMESANAN
//      */

//     $billing = \App\Models\Billing::whereHas(
//         'pemeriksaan',
//         function($query) use ($dp){

//             $query->where(
//                 'pemesanan_id',
//                 $dp->pemesanan_id
//             );

//         }
//     )->latest()->first();

//     /**
//      * CEK AGAR TIDAK DOUBLE TAGIHAN
//      */

//     $cek = Pembayaran::where(

//                 'kode_pembayaran',
//                 $pembayaran->kode_pembayaran

//             )
//             ->where(

//                 'jenis_pembayaran',
//                 'Lunas'

//             )
//             ->first();

//     if(!$cek && $billing){

//         Pembayaran::create([

//             'pemesanan_id' =>
//                 $dp->pemesanan_id,

//             /**
//              * KODE SAMA DENGAN DP
//              */

//             'kode_pembayaran' =>
//                 $pembayaran->kode_pembayaran,

//             'billing_id' =>
//                 $billing->id,

//             'jenis_pembayaran' =>
//                 'Lunas',

//             /**
//              * NOMINAL DARI BILLING
//              */

//             'jumlah_bayar' =>
//                 $billing->total,

//             'metode_pembayaran' =>
//                 '-',

//             'status' =>
//                 'Menunggu Pembayaran',

//             'expired_at' =>
//                 now()->addHours(24)

//         ]);

//     }

//     return redirect('/admin/pembayaran')
//             ->with(
//                 'success',
//                 'Tagihan pelunasan berhasil dibuat'
//                 );
//     }
// }
