@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3 class="mb-4">

            Edit Pemeriksaan

        </h3>

        <form
            action="{{ url('/petugas/hasil-pemeriksaan/'.$pemeriksaan->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>

                    Hasil Pemeriksaan

                </label>

                <textarea
                    name="hasil_pemeriksaan"
                    class="form-control"
                    required>{{ $pemeriksaan->hasil_pemeriksaan }}</textarea>

            </div>

            <div class="mb-3">

                <label>

                    Diagnosa Singkat

                </label>

                <textarea
                    name="diagnosa_singkat"
                    class="form-control"
                    required>{{ $pemeriksaan->diagnosa_singkat }}</textarea>

            </div>

            <div class="mb-3">

                <label>

                    Tindakan

                </label>

                <textarea
                    name="tindakan"
                    class="form-control"
                    required>{{ $pemeriksaan->tindakan }}</textarea>

            </div>

            <div class="mb-3">

                <label>

                    Catatan

                </label>

                <textarea
                    name="catatan"
                    class="form-control"
                    required>{{ $pemeriksaan->catatan }}</textarea>

            </div>

            <button
                type="submit"
                class="btn btn-success">

                Update Pemeriksaan

            </button>

            <a href="{{ url('/petugas/hasil-pemeriksaan') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection