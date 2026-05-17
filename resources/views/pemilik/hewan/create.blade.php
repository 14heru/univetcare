@extends('layouts.pemilik')

@section('content')

<h1 class="page-title">

    Tambah Data Hewan

</h1>

<div class="card-custom">

    <h3 class="section-title">

        Form Data Hewan

    </h3>

    <form action="{{ url('/pemilik/hewan') }}"
      method="POST">

    @csrf

    <div class="mb-4">

        <label class="form-label">

            Nama Hewan

        </label>

        <input type="text"
               name="nama_hewan"
               class="form-control"
               required>

    </div>

    <div class="mb-4">

        <label class="form-label">

            Jenis Hewan

        </label>

        <input type="text"
               name="jenis_hewan"
               class="form-control"
               required>

    </div>

    <div class="mb-4">

        <label class="form-label">

            Ras Hewan

        </label>

        <input type="text"
               name="ras"
               class="form-control">

    </div>

    <div class="mb-4">

        <label class="form-label">

            Jenis Kelamin

        </label>

        <select name="jenis_kelamin"
                class="form-select"
                required>

            <option value="">

                -- Pilih --

            </option>

            <option value="Jantan">

                Jantan

            </option>

            <option value="Betina">

                Betina

            </option>

        </select>

    </div>

    <div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Umur Hewan

        </label>

        <input type="number"
               name="umur"
               class="form-control">

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Satuan Umur

        </label>

        <select name="satuan_umur"
                class="form-select">

            <option value="Hari">

                Hari

            </option>

            <option value="Bulan">

                Bulan

            </option>

            <option value="Tahun">

                Tahun

            </option>

        </select>

    </div>

</div>

    <div class="mb-4">

        <label class="form-label">

            Berat Badan (Kg)

        </label>

        <input type="number"
               step="0.1"
               name="berat"
               class="form-control">

    </div>

    <div class="mb-4">

        <label class="form-label">

            Warna Hewan

        </label>

        <input type="text"
               name="warna"
               class="form-control">

    </div>

    <button type="submit"
            class="btn-custom">

        <i class="bi bi-check-circle"></i>

        Simpan Data

    </button>

</form>

</div>

@endsection