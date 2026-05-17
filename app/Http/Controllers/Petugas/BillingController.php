<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Pemeriksaan;
use App\Models\Billing;
use App\Models\DetailBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $pemeriksaan = Pemeriksaan::where('status', 'Selesai')
                            ->latest()
                            ->get();

        return view('petugas.billing.index', compact('pemeriksaan'));
    }

    public function create($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);

        return view('petugas.billing.create', compact('pemeriksaan'));
    }

    public function store(Request $request)
    {
        $kodeBilling = 'BILL-'.time();

        $billing = Billing::create([

            'pemeriksaan_id' => $request->pemeriksaan_id,

            'kode_billing' => $kodeBilling,

            'subtotal' => 0,

            'total' => 0,

            'status' => 'Belum Dibayar'

        ]);

        $total = 0;

        foreach($request->nama_item as $key => $value){

            $subtotal = $request->qty[$key] * $request->harga[$key];

            DetailBilling::create([

                'billing_id' => $billing->id,

                'nama_item' => $request->nama_item[$key],

                'qty' => $request->qty[$key],

                'harga' => $request->harga[$key],

                'subtotal' => $subtotal,

            ]);

            $total += $subtotal;
        }

        $billing->update([
            'subtotal' => $total,
            'total' => $total
        ]);

        return redirect('/petugas/billing')
                ->with('success', 'Billing berhasil dibuat');
    }
}
