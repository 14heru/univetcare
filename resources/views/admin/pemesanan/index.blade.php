@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Data Booking Pemeriksaan</h3>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Kode Booking</th>
                <th>Pemilik</th>
                <th>Hewan</th>
                <th>Status</th>
                <th>Expired</th>
                <th>Aksi</th>

            </tr>

            @foreach($pemesanan as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_booking }}</td>

                <td>{{ $item->user->name }}</td>

                <td>{{ $item->hewan->nama_hewan }}</td>

                <td>{{ $item->status }}</td>

                <td>{{ $item->expired_at }}</td>

                <td>

                    @if($item->status == 'Menunggu Konfirmasi')

                    <a href="{{ url('/admin/pemesanan/'.$item->id.'/konfirmasi') }}"
                       class="btn btn-success btn-sm">

                        Konfirmasi

                    </a>

                    <a href="{{ url('/admin/pemesanan/'.$item->id.'/batal') }}"
                       class="btn btn-danger btn-sm">

                        Batalkan

                    </a>

                    @endif

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection