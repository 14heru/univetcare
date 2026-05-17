@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Input Pemeriksaan</h3>

        <hr>

        <form action="{{ url('/petugas/pemeriksaan/store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="pemesanan_id"
                   value="{{ $pemesanan->id }}">

            <div class="mb-3">

                <label>Hasil Pemeriksaan</label>

                <textarea name="hasil_pemeriksaan"
                          class="form-control"></textarea>

            </div>

            <div class="mb-3">

                <label>Diagnosa Singkat</label>

                <textarea name="diagnosa_singkat"
                          class="form-control"></textarea>

            </div>

            <div class="mb-3">

                <label>Tindakan</label>

                <textarea name="tindakan"
                          class="form-control"></textarea>

            </div>

            <div class="mb-3">

                <label>Catatan</label>

                <textarea name="catatan"
                          class="form-control"></textarea>

            </div>

            <button type="submit"
                    class="btn btn-success">

                Simpan Pemeriksaan

            </button>

        </form>

    </div>

</div>

@endsection