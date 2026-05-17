@extends('layouts.pemilik')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Pembayaran Billing</h3>

        <hr>

        <form action="{{ url('/pemilik/pembayaran/store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <input type="hidden"
                   name="billing_id"
                   value="{{ $billing->id }}">

            <div class="mb-3">

                <label>Total Pembayaran</label>

                <input type="text"
                       class="form-control"
                       value="Rp {{ number_format($billing->total) }}"
                       readonly>

            </div>

            <div class="mb-3">

                <label>Metode Pembayaran</label>

                <select name="metode_pembayaran"
                        class="form-control">

                    <option value="QRIS">QRIS</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                    <option value="E-Wallet">E-Wallet</option>

                </select>

            </div>

            <div class="mb-3">

                <label>Upload Bukti Pembayaran</label>

                <input type="file"
                       name="bukti_pembayaran"
                       class="form-control">

            </div>

            <button type="submit"
                    class="btn btn-primary">

                Kirim Pembayaran

            </button>

        </form>

    </div>

</div>

@endsection