@extends('layouts.pemilik')

@section('content')

<h3 class="mb-4">

    Pembayaran Pelunasan

</h3>

<div class="card p-4">

    <form action="{{ url('/pemilik/billing/'.$billing->id.'/upload') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Total Tagihan</label>

            <input type="text"
                   class="form-control"
                   value="Rp {{ number_format($billing->total) }}"
                   readonly>

        </div>

        <div class="mb-3">

            <label>Metode Pembayaran</label>

            <select name="metode_pembayaran"
                    class="form-control">

                <option value="QR Code">

                    QR Code

                </option>

                <option value="Transfer">

                    Transfer

                </option>

                <option value="E-Wallet">

                    E-Wallet

                </option>

            </select>

        </div>

        <div class="mb-3">

            {!! QrCode::size(250)->generate(

                'Billing : '.$billing->kode_billing.

                ' | Total : '.$billing->total

            ) !!}

        </div>

        <div class="mb-3">

            <label>Upload Bukti</label>

            <input type="file"
                   name="bukti_pembayaran"
                   class="form-control">

        </div>

        <button class="btn btn-success">

            Upload Pembayaran

        </button>

    </form>

</div>

@endsection