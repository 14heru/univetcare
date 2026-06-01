@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3 class="mb-4">

            Input Pemeriksaan

        </h3>

        @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <form action="{{ url('/petugas/pemeriksaan/store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="pemesanan_id"
                   value="{{ $pemesanan->id }}">

            <!-- HASIL -->

            <div class="mb-3">

                <label class="form-label">

                    Hasil Pemeriksaan

                </label>

                <textarea name="hasil_pemeriksaan"
                          class="form-control"
                          required></textarea>

            </div>

            <!-- DIAGNOSA -->

            <div class="mb-3">

                <label class="form-label">

                    Diagnosa Singkat

                </label>

                <textarea name="diagnosa_singkat"
                          class="form-control"
                          required></textarea>

            </div>

            <!-- TINDAKAN -->

            <div class="mb-3">

                <label class="form-label">

                    Tindakan

                </label>

                <textarea name="tindakan"
                          class="form-control"
                          required>{{ old('diagnosa_singkat') }}</textarea>

            </div>

            <!-- CATATAN -->

            <div class="mb-4">

                <label class="form-label">

                    Catatan

                </label>

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