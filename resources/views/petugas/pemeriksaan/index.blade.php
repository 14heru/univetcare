@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3 class="mb-4">

            Antrian Pemeriksaan

        </h3>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Kode Booking</th>

                    <th>Pemilik</th>

                    <th>Hewan</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pemesanan as $item)

                <tr>

                    <td>

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        {{ $item->kode_booking }}

                    </td>

                    <td>

                        {{ $item->user->name }}

                    </td>

                    <td>

                        {{ $item->hewan->nama_hewan }}

                    </td>

                    <td>

                        {{ $item->status }}

                    </td>

                    <td>

                        <a href="{{ url('/petugas/pemeriksaan/'.$item->id.'/create') }}"
                           class="btn btn-success btn-sm">

                            Periksa

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center">

                        Tidak ada antrian pemeriksaan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection