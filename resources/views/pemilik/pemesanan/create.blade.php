@extends('layouts.pemilik')

@section('content')

<h1 class="page-title">

    Booking Pemeriksaan

</h1>

<div class="card-custom">

    <h3 class="section-title">

        Form Booking Pemeriksaan

    </h3>

    @if($jadwal->count() == 0)

        <div class="alert alert-warning">

            Belum ada jadwal pemeriksaan tersedia.

        </div>

    @endif

    @if($jadwal->count() > 0 && $jadwal->where('kuota', '>', 0)->count() == 0)

        <div class="alert alert-warning">

            Semua kuota pemeriksaan sudah penuh. Silakan pilih jadwal lain jika tersedia.

        </div>

    @endif

    <form method="POST"
          action="{{ url('/pemilik/pemesanan') }}">

        @csrf

        <div class="mb-4">

            <label class="form-label">

                Pilih Hewan

            </label>

            <select name="hewan_id"
                    class="form-select"
                    required>

                <option value="">

                    -- Pilih Hewan --

                </option>

                @foreach($hewan as $item)

                    <option value="{{ $item->id }}">

                        {{ $item->nama_hewan }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Pilih Jadwal

            </label>

            <select name="jadwal_id"
                    class="form-select"
                    required>

                <option value="">

                    -- Pilih Jadwal --

                </option>

                @foreach($jadwal as $item)

                    <option value="{{ $item->id }}"
                            @if($item->kuota <= 0 || $item->status == 'Penuh') disabled @endif>

                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        |
                        {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                        |
                        Kuota: {{ $item->kuota }}
                        |
                        {{ $item->kuota <= 0 || $item->status == 'Penuh' ? 'Penuh' : 'Tersedia' }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Keluhan

            </label>

            <textarea name="keluhan"
                      class="form-control"
                      rows="5"
                      placeholder="Masukkan keluhan hewan..."
                      required></textarea>

        </div>

        <div class="d-flex gap-3">

            <button type="submit"
                    class="btn-custom"
                    @if($jadwal->where('kuota', '>', 0)->count() == 0) disabled @endif>

                <i class="bi bi-check-circle"></i>

                Simpan Booking

            </button>

            <button type="reset"
                    class="btn btn-secondary rounded-pill px-4">

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </button>

        </div>

    </form>

</div>

@endsection