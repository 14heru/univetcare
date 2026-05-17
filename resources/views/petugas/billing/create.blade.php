@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Buat Billing</h3>

        <hr>

        <form action="{{ url('/petugas/billing/store') }}"
            
        method="POST">

            @csrf

            <input type="hidden"
                    name="pemeriksaan_id"
                    value="{{ $pemeriksaan->id }}">

            <div class="mb-3">

                <label>Nama Item</label>

                <input type="text"
                        name="nama_item[]"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Qty</label>

                <input type="number"
                        name="qty[]"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Harga</label>

                <input type="number"
                        name="harga[]"
                        class="form-control">

            </div>

            <button type="submit"
                    class="btn btn-success">

                Simpan Billing

            </button>

        </form>

    </div>

</div>

@endsection