@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Data Billing</h3>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Booking</th>
                <th>Hewan</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            @foreach($pemeriksaan as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->pemesanan->kode_booking }}</td>

                <td>{{ $item->pemesanan->hewan->nama_hewan }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <a href="{{ url('/petugas/billing/'.$item->id.'/create') }}"
                    class="btn btn-primary btn-sm">

                        Buat Billing

                    </a>

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection