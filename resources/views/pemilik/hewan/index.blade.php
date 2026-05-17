@extends('layouts.pemilik')

@section('content')

<div class="d-flex
            justify-content-between
            align-items-center
            mb-4">

    <h1 class="page-title mb-0">

        Data Hewan

    </h1>

    <a href="{{ url('/pemilik/hewan/create') }}"
       class="btn-custom">

        <i class="bi bi-plus-circle"></i>

        Tambah Hewan

    </a>

</div>

<div class="card-custom">

    <h3 class="section-title">

        Data Hewan Peliharaan

    </h3>

    <div class="table-responsive">

        <table class="table table-modern align-middle">

            <thead>

                <tr>

                    <th>Nama Hewan</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Berat Badan (Kg)</th>
                    <th>Warna</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($hewan as $item)

                <tr>

                    <td>

                        <strong>

                            {{ $item->nama_hewan }}

                        </strong>

                    </td>

                    <td>

                        {{ $item->jenis_hewan }}

                    </td>

                    <td>

                        {{ $item->ras }}

                    </td>

                    <td>

                        {{ $item->jenis_kelamin }}

                    </td>

                    <td>

                        {{ $item->umur }} {{ $item->satuan_umur }}

                    </td>

                    <td>

                        {{ $item->berat }}

                    </td>

                    <td>

                        {{ $item->warna }}

                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <a href="{{ url('/pemilik/hewan/'.$item->id.'/edit') }}"
                               class="btn btn-warning btn-sm rounded-pill">

                                Edit

                            </a>

                            <form action="{{ url('/pemilik/hewan/'.$item->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm rounded-pill">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8">

                        <div class="empty-data">

                            <i class="bi bi-heart"
                               style="font-size:50px;"></i>

                            <h5 class="mt-3">

                                Belum Ada Data Hewan

                            </h5>

                            <p>

                                Tambahkan data hewan peliharaan Anda.

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