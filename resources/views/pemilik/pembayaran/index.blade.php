@extends('layouts.pemilik')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Data Billing & Pembayaran</h3>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Kode Billing</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            @foreach($billing as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_billing }}</td>

                <td>Rp {{ number_format($item->total) }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    @if($item->status == 'Belum Dibayar')

                    <a href="{{ url('/pemilik/pembayaran/'.$item->id.'/create') }}"
                       class="btn btn-success btn-sm">

                        Bayar

                    </a>

                    @endif

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection