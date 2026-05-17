@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Antrian Pemeriksaan</h3>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Kode Booking</th>
                <th>Pemilik</th>
                <th>Hewan</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            @foreach($pemesanan as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_booking }}</td>

                <td>{{ $item->user->name }}</td>

                <td>{{ $item->hewan->nama_hewan }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    @if($item->status == 'Dikonfirmasi')

                    <a href="{{ url('/petugas/pemeriksaan/'.$item->id.'/create') }}"
                        class="btn btn-primary btn-sm">

                        Input Pemeriksaan

        </a>

            @elseif($item->status == 'Diproses')

            <a href="{{ url('/petugas/pemeriksaan/'.$item->pemeriksaan->id.'/selesai') }}"
                class="btn btn-success btn-sm">

                Selesaikan

        </a>

    @endif


                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection