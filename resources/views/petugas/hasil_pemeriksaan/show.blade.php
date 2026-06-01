@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3 class="mb-4">

            Detail Hasil Pemeriksaan

        </h3>

        <table class="table table-bordered">

            <tr>

                <th width="30%">

                    Kode Booking

                </th>

                <td>

                    {{ $pemeriksaan->pemesanan->kode_booking ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>

                    Nama Hewan

                </th>

                <td>

                    {{ $pemeriksaan->pemesanan->hewan->nama_hewan ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>

                    Hasil Pemeriksaan

                </th>

                <td>

                    {{ $pemeriksaan->hasil_pemeriksaan ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>

                    Diagnosa Singkat

                </th>

                <td>

                    {{ $pemeriksaan->diagnosa_singkat ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>

                    Tindakan

                </th>

                <td>

                    {{ $pemeriksaan->tindakan ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>

                    Catatan

                </th>

                <td>

                    {{ $pemeriksaan->catatan ?? '-' }}

                </td>

            </tr>

        </table>

        <a href="{{ url('/petugas/hasil-pemeriksaan') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

@endsection