@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">

            <h3>Verifikasi Pembayaran</h3>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Kode</th>

                    <th>Jenis</th>

                    <th>Total</th>

                    <th>Metode</th>

                    <th>Status</th>

                    <th>Bukti</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pembayaran as $item)

                <tr>

                    <td>

                        {{ $item->kode_pembayaran }}

                    </td>

                    <td>

                        {{ $item->jenis_pembayaran }}

                    </td>

                    <td>

                        Rp {{ number_format($item->jumlah_bayar) }}

                    </td>

                    <td>

                        {{ $item->metode_pembayaran }}

                    </td>

                    <td>

                        {{ $item->status }}

                    </td>

                    <td>

                        @if($item->bukti_pembayaran)

                        <a href="{{ asset('bukti_pembayaran/'.$item->bukti_pembayaran) }}"
                           target="_blank"
                           class="btn btn-sm btn-primary">

                            Lihat

                        </a>

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        @if(

                            $item->status == 'Menunggu Konfirmasi Admin'

                            ||

                            $item->status == 'Menunggu Pembayaran'
                            )

                            <a href="{{ url('/admin/pembayaran/'.$item->id.'/verifikasi') }}"
                            class="btn btn-success btn-sm">

                                Verifikasi

                            </a>

                            <a href="{{ url('/admin/pembayaran/'.$item->id.'/gagal') }}"
                            class="btn btn-danger btn-sm">

                                Tolak

                            </a>

                        @else

                            -

                        @endif


                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center">

                        Tidak ada pembayaran

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection