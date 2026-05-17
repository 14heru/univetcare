@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Verifikasi Pembayaran</h3>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Kode Pembayaran</th>
                <th>Metode</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>

            </tr>

            @foreach($pembayaran as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_pembayaran }}</td>

                <td>{{ $item->metode_pembayaran }}</td>

                <td>Rp {{ number_format($item->jumlah_bayar) }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <img src="{{ asset('bukti_pembayaran/'.$item->bukti_pembayaran) }}"
                         width="100">

                </td>

                <td>

                    @if($item->status == 'Menunggu Verifikasi')

                    <a href="{{ url('/admin/pembayaran/'.$item->id.'/verifikasi') }}"
                       class="btn btn-success btn-sm">

                        Verifikasi

                    </a>

                    <a href="{{ url('/admin/pembayaran/'.$item->id.'/gagal') }}"
                       class="btn btn-danger btn-sm">

                        Tolak

                    </a>

                    @endif

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection