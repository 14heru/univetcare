<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::latest()->get();

        return view('admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'tanggal' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'kuota' => 'required',
    ]);

    Jadwal::create([
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'kuota' => $request->kuota,
        'status' => 'Tersedia',
    ]);

        return redirect('/admin/jadwal')
        ->with('success', 'Jadwal berhasil ditambahkan');
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
        $jadwal = Jadwal::findOrFail($id);

        return view('admin.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal = Jadwal::findOrFail($id);

    $jadwal->update([
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'kuota' => $request->kuota,
        'status' => $request->status,
    ]);

    return redirect('/admin/jadwal')
        ->with('success', 'Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);

    $jadwal->delete();

    return redirect('/admin/jadwal')
        ->with('success', 'Jadwal berhasil dihapus');
    }
}
