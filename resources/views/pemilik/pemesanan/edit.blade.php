@extends('layouts.pemilik')

@section('content')

<h1 class="page-title mb-4">

    Edit Booking Pemeriksaan

</h1>

<div class="card-custom">

    <h3 class="section-title">

        Form Edit Booking

    </h3>

    <form action="{{ url('/pemilik/pemesanan/'.$pemesanan->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="form-label">

                Pilih Hewan

            </label>

            <select name="hewan_id"
                    class="form-select">

                @foreach($hewan as $item)

                <option value="{{ $item->id }}"
                    {{ $pemesanan->hewan_id == $item->id ? 'selected' : '' }}>

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
                    class="form-select">

                @foreach($jadwal as $item)

                <option value="{{ $item->id }}"
                    {{ $pemesanan->jadwal_id == $item->id ? 'selected' : '' }}>

                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                    |
                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}

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
                      rows="4">{{ $pemesanan->keluhan }}</textarea>

        </div>

        <div class="d-flex gap-3">

            <button type="submit"
                    class="btn-custom">

                Update Booking

            </button>

            <a href="{{ url('/pemilik/pemesanan') }}"
               class="btn btn-secondary rounded-pill px-4">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection