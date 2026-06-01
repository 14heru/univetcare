@extends('layouts.pemilik')

@section('content')

<h1 class="page-title">
    Riwayat Pemeriksaan
</h1>

<div class="table-card">

    <h3>Data Riwayat</h3>

    <table class="table align-middle">

        <thead>

            <tr>

                <th>No</th>
                <th>Kode Booking</th>
                <th>Hewan</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @forelse($riwayat as $item)

            <tr>

                <td>

                    {{ $loop->iteration }}

                </td>

                <td>

                    {{ $item->pemesanan->kode_booking ?? '-' }}

                </td>

                <td>

                    {{ $item->pemesanan->hewan->nama_hewan ?? '-' }}

                </td>

                <td>

                    {{ $item->diagnosa_singkat ?? '-' }}

                </td>

                <td>

                    {{ $item->tindakan ?? '-' }}

                </td>

                <td>

                    <span class="badge bg-success">

                        Selesai

                    </span>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center">

                    Belum ada riwayat pemeriksaan

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection