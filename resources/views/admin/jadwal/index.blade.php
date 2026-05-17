@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Data Jadwal Pemeriksaan</h3>

        <a href="{{ url('/admin/jadwal/create') }}"
           class="btn btn-primary mb-3">

            Tambah Jadwal

        </a>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Kuota</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            @foreach($jadwal as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->tanggal }}</td>

                <td>{{ $item->jam_mulai }}</td>

                <td>{{ $item->jam_selesai }}</td>

                <td>{{ $item->kuota }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <a href="{{ url('/admin/jadwal/'.$item->id.'/edit') }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ url('/admin/jadwal/'.$item->id) }}"
                          method="POST"
                          style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus jadwal?')">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection