@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Data Billing</h3>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Booking</th>
                <th>Hewan</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            {{-- @forelse($pemeriksaan as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->pemesanan->kode_booking }}</td>

                <td>{{ $item->pemesanan->hewan->nama_hewan }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <a href="{{ url('/petugas/billing/'.$item->id.'/create') }}"
                    class="btn btn-primary btn-sm">

                        Buat Billing

                    </a>

                </td>

            </tr>

            @endforeach --}}

            @forelse($pemeriksaan as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->pemesanan->kode_booking }}
                            </td>

                            <td>
                                {{ $item->pemesanan->hewan->nama_hewan }}
                            </td>

                            <td>

                                @if($item->billing)

                                    {{ $item->billing->status }}

                                @else

                                    Belum Dibuat

                                @endif

                            </td>

                            {{-- <td>

                                <a href="{{ url('/petugas/billing/'.$item->id.'/create') }}"
                                class="btn btn-primary btn-sm">

                                    Buat Billing

                                </a>

                            </td> --}}

                            <td>

                                    @if($item->billing)

                                        <!-- LIHAT -->

                                        <a href="{{ url('/petugas/billing/'.$item->billing->id) }}"
                                        class="btn btn-info btn-sm">

                                            Lihat

                                        </a>

                                        <!-- EDIT -->

                                        <a href="{{ url('/petugas/billing/'.$item->billing->id.'/edit') }}"
                                        class="btn btn-warning btn-sm">

                                            Edit

                                        </a>

                                        <!-- HAPUS -->

                                        <form action="{{ url('/petugas/billing/'.$item->billing->id) }}"
                                            method="POST"
                                            style="display:inline-block;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus billing?')">

                                                Hapus

                                            </button>

                                        </form>

                                    @else

                                        <!-- JIKA BELUM ADA BILLING -->

                                        <a href="{{ url('/petugas/billing/'.$item->id.'/create') }}"
                                        class="btn btn-primary btn-sm">

                                            Buat Billing

                                        </a>

                                    @endif

                                </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5"
                                class="text-center">

                                Tidak ada data billing

                            </td>

                        </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection