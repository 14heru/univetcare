@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Detail Billing</h3>

        <hr>

        <p>
            <strong>Kode Booking :</strong>
            {{ $billing->pemeriksaan->pemesanan->kode_booking ?? '-' }}
        </p>

        <p>
            <strong>Hewan :</strong>
            {{ $billing->pemeriksaan->pemesanan->hewan->nama_hewan ?? '-' }}
        </p>

        <p>
            <strong>Status :</strong>
            {{ $billing->status }}
        </p>

        <hr>

        <h5>Rincian Item Billing</h5>

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>

            </thead>

            <tbody>

                @forelse($billing->detailBilling as $detail)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->nama_item }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada detail item billing
                    </td>
                </tr>

                @endforelse

            </tbody>

            <tfoot>

                <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th>Rp {{ number_format($billing->total, 0, ',', '.') }}</th>
                </tr>

            </tfoot>

        </table>

        <a href="{{ url('/petugas/billing') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

@endsection