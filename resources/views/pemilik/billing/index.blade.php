@extends('layouts.pemilik')

@section('content')

<h3 class="mb-4">

    Data Billing

</h3>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Kode Billing</th>

            <th>Total</th>

            <th>Status</th>

            <th>Aksi</th>

        </tr>

    </thead>

    <tbody>

        @foreach($billing as $item)

        <tr>

            <td>

                {{ $item->kode_billing }}

            </td>

            <td>

                Rp {{ number_format($item->total) }}

            </td>

            <td>

                {{ $item->status }}

            </td>

            <td>

                @if($item->status == 'Belum Dibayar')

                <a href="{{ url('/pemilik/billing/'.$item->id.'/bayar') }}"
                   class="btn btn-success btn-sm">

                    Bayar

                </a>

                @else

                -

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection