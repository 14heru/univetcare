@extends('layouts.pemilik')

@section('content')

<div class="d-flex
            justify-content-between
            align-items-center
            mb-4">

    <h1 class="page-title mb-0">

        Data Pembayaran

    </h1>

    <a href="{{ url('/pemilik/pembayaran/cetak') }}"
       class="btn-custom">

        Cetak PDF

    </a>

</div>

<div class="card-custom">

    <div class="table-responsive">

        <table class="table table-modern align-middle">

            <thead>

                <tr>

                    <th>Kode Pembayaran</th>
                    <th>Jenis</th>
                    <th>Uang Muka (DP)</th>
                    <th>Lunas</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pembayaran as $item)

                <tr>

                    <!-- KODE -->

                    <td>

                        {{ $item->kode_pembayaran }}

                    </td>

                    <!-- JENIS -->

                    <td>

                        {{ $item->jenis_pembayaran }}

                    </td>

                    <!-- DP -->

                    <td>

                        @if($item->jenis_pembayaran == 'DP')

                            Rp {{ number_format($item->jumlah_bayar) }}

                        @else

                            -

                        @endif

                    </td>

                    <!-- LUNAS -->

                    <td>

                        @if($item->jenis_pembayaran == 'Lunas')

                            Rp {{ number_format($item->jumlah_bayar) }}

                        @else

                            -

                        @endif

                    </td>

                    <!-- METODE -->

                    <td>

                        {{ $item->metode_pembayaran }}

                    </td>

                    <!-- STATUS -->

                    <td>

                        @if($item->status == 'Menunggu Pembayaran')

                            <span class="badge bg-warning">

                                Menunggu Upload

                            </span>

                        @elseif($item->status == 'Menunggu Konfirmasi Admin')

                            <span class="badge bg-info">

                                Menunggu Konfirmasi

                            </span>

                        @elseif($item->status == 'Dikonfirmasi')

                            <span class="badge bg-success">

                                Dikonfirmasi

                            </span>

                        @elseif($item->status == 'Dibatalkan')

                            <span class="badge bg-danger">

                                Ditolak

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                -

                            </span>

                        @endif

                    </td>

                    <!-- BUKTI -->

                    <td>

                        @if($item->bukti_pembayaran)

                            <a href="{{ asset('bukti_pembayaran/'.$item->bukti_pembayaran) }}"
                               target="_blank"
                               class="btn btn-primary btn-sm rounded-pill">

                                Lihat

                            </a>

                        @else

                            -

                        @endif

                    </td>

                    <!-- AKSI -->

                    <td>

                        @if($item->status == 'Menunggu Pembayaran')

                            <a href="{{ url('/pemilik/pembayaran/'.$item->id.'/create') }}"
                               class="btn btn-success btn-sm">

                                Bayar

                            </a>

                        @else

                            -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8">

                        <div class="text-center py-5">

                            <h5>

                                Belum Ada Data Pembayaran

                            </h5>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection