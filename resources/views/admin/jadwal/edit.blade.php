@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Edit Jadwal Pemeriksaan</h3>

        <hr>

        <form action="{{ url('/admin/jadwal/'.$jadwal->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                    <label>Tanggal</label>

                    <input type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ $jadwal->tanggal }}">

            </div>

            <div class="mb-3">

                    <label>Jam Mulai</label>

                    <input type="time"
                        name="jam_mulai"
                        class="form-control"
                        value="{{ $jadwal->jam_mulai }}">

            </div>

            <div class="mb-3">

                    <label>Jam Selesai</label>

                    <input type="time"
                        name="jam_selesai"
                        class="form-control"
                        value="{{ $jadwal->jam_selesai }}">

            </div>

            <div class="mb-3">

                    <label>Kuota</label>

                    <input type="number"
                        name="kuota"
                        class="form-control"
                        value="{{ $jadwal->kuota }}">

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="Tersedia"
                        {{ $jadwal->status == 'Tersedia' ? 'selected' : '' }}>

                        Tersedia

                    </option>

                    <option value="Penuh"
                        {{ $jadwal->status == 'Penuh' ? 'selected' : '' }}>

                        Penuh

                    </option>

                    <option value="Nonaktif"
                        {{ $jadwal->status == 'Nonaktif' ? 'selected' : '' }}>

                        Nonaktif

                    </option>

                </select>

            </div>

            <button type="submit"
                    class="btn btn-success">

                Update

            </button>

        </form>

    </div>

</div>

@endsection