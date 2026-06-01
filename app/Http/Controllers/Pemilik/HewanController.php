<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use Illuminate\Http\Request;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hewan = Hewan::where('user_id', auth()->id())->get();
        return view('pemilik.hewan.index', compact('hewan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemilik.hewan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                    $request->validate([

                    'nama_hewan' => 'required',
                    'jenis_hewan' => 'required',
                    'jenis_kelamin' => 'required',
                    'ras' => 'required',
                    'umur' => 'required|integer',
                    'satuan_umur' => 'required',
                    'berat' => 'required|numeric',
                    'warna' => 'required',

                ]);

                Hewan::create([

                    'user_id' => auth()->id(),

                    'nama_hewan' =>
                        $request->nama_hewan,

                    'jenis_hewan' =>
                        $request->jenis_hewan,

                    'ras' =>
                        $request->ras,

                    'jenis_kelamin' =>
                        $request->jenis_kelamin,

                    'umur' =>
                        $request->umur,

                    /**
                     * FIX UTAMA
                     */
                    'satuan_umur' =>
                        $request->satuan_umur,

                    'berat' =>
                        $request->berat,

                    'warna' =>
                        $request->warna,

                    'keluhan' =>
                        $request->keluhan,

                ]);

                return redirect('/pemilik/hewan')
                        ->with(
                            'success',
                            'Hewan berhasil ditambahkan'
                        );
            }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hewan = Hewan::findOrFail($id);

        return view('pemilik.hewan.edit', compact('hewan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hewan = Hewan::findOrFail($id);

        $hewan->update([
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan,
            'ras' => $request->ras,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'warna' => $request->warna,
            'satuan_umur' => $request->satuan_umur,
            
        ]);

        return redirect('/pemilik/hewan')
        ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hewan = Hewan::findOrFail($id);

        $hewan->delete();

        return redirect('/pemilik/hewan')
        ->with('success', 'Data berhasil dihapus');
    }
}
