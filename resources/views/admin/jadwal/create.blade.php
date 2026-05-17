@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Tambah Jadwal Pemeriksaan</h3>

        <hr>

        <form action="{{ url('/admin/jadwal') }}"
                method="POST">

            @csrf

            <div class="mb-3">

                <label>Tanggal</label>

                <input type="date"
                        name="tanggal"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Jam Mulai</label>

                <input type="time"
                        name="jam_mulai"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Jam Selesai</label>

                <input type="time"
                        name="jam_selesai"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Kuota</label>

                <input type="number"
                        name="kuota"
                        class="form-control">

            </div>

            <button type="submit"
                    class="btn btn-success">

                Simpan

            </button>

        </form>

    </div>

</div>

@endsection