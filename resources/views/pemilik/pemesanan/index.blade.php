@extends('layouts.pemilik')

@section('content')

<div class="d-flex
            justify-content-between
            align-items-center
            mb-4">

    <h1 class="page-title mb-0">

        Booking Pemeriksaan

    </h1>

    <a href="{{ url('/pemilik/pemesanan/create') }}"
       class="btn-custom">

        <i class="bi bi-plus-circle"></i>

        Booking Baru

    </a>

</div>

<div class="card-custom">

    <h3 class="section-title">

        Data Booking Pemeriksaan

    </h3>

    <div class="table-responsive">

        <table class="table table-modern align-middle">

            <thead>

                <tr>

                    <th>Kode Booking</th>
                    <th>Hewan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pemesanan as $item)

                <tr>

                    <td>

                        <strong>

                            {{ $item->kode_booking }}

                        </strong>

                    </td>

                    <td>

                        {{ $item->hewan->nama_hewan }}

                    </td>

                    <td>

                        {{\Carbon\Carbon::parse( $item->tanggal_booking )->format('d M Y')}}

                    </td>

                    <td>

                        {{-- {{ $item->jadwal->jam_mulai ?? '-' }} --}}

                        @if($item->jadwal)
                        {{ \Carbon\Carbon::parse($item->jadwal->jam_mulai)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($item->jadwal->jam_selesai)->format('H:i') }}

                        @endif

                    </td>


                    <td style="max-width:200px;">

                            {{ Str::limit($item->keluhan, 50) }}

                    </td>

                    <td>

                        @if($item->status == 'Menunggu Konfirmasi')

                            <span class="badge-menunggu">

                                {{ $item->status }}

                            </span>

                        @elseif($item->status == 'Diproses')

                            <span class="badge-proses">

                                {{ $item->status }}

                            </span>

                        @elseif($item->status == 'Selesai')

                            <span class="badge-selesai">

                                {{ $item->status }}

                            </span>

                        @else

                            <span class="badge-batal">

                                {{ $item->status }}

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ url('/pemilik/pemesanan/'.$item->id.'/edit') }}"
                            class="btn btn-warning btn-sm rounded-pill">

                                Edit Booking

</a>

                        {{-- <a href="#"
                           class="btn-detail">

                            Detail

                        </a> --}}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        <div class="empty-data">

                            <i class="bi bi-calendar-x"
                               style="font-size:50px;"></i>

                            <h5 class="mt-3">

                                Belum Ada Booking

                            </h5>

                            <p>

                                Silakan lakukan booking pemeriksaan hewan.

                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection