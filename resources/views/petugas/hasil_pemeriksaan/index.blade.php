@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3 class="mb-4">

            Hasil Pemeriksaan

        </h3>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>Hewan</th>
                    <th>Diagnosa</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($pemeriksaan as $item)

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

                    <span class="badge bg-success">

                        Selesai Pemeriksaan

                    </span>

                </td>

                <td>

                    <a href="{{ url('/petugas/hasil-pemeriksaan/'.$item->id) }}"
                    class="btn btn-info btn-sm">

                        Lihat

                    </a>

                    <a href="{{ url('/petugas/hasil-pemeriksaan/'.$item->id.'/edit') }}"
                    class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form
                        action="{{ url('/petugas/hasil-pemeriksaan/'.$item->id) }}"
                        method="POST"
                        style="display:inline-block;">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm">

                            Hapus

                        </button>

                    </form>

                    <a href="{{ url('/petugas/billing/'.$item->id.'/create') }}"
                    class="btn btn-success btn-sm">

                        Buat Billing

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6"
                    class="text-center">

                    Belum ada hasil pemeriksaan

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection