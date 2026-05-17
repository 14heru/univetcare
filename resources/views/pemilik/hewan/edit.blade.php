@extends('layouts.pemilik')

@section('content')

<h1 class="page-title">

    Edit Data Hewan

</h1>

<div class="card-custom">

    <h3 class="section-title">

        Form Edit Hewan

    </h3>

    <form action="{{ url('/pemilik/hewan/'.$hewan->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="form-label">

                Nama Hewan

            </label>

            <input type="text"
                   name="nama_hewan"
                   value="{{ $hewan->nama_hewan }}"
                   class="form-control"
                   required>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Jenis Hewan

            </label>

            <input type="text"
                   name="jenis_hewan"
                   value="{{ $hewan->jenis_hewan }}"
                   class="form-control"
                   required>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Ras Hewan

            </label>

            <input type="text"
                   name="ras"
                   value="{{ $hewan->ras }}"
                   class="form-control"
                   required>

        </div>

        <div class="mb-4">

    <label class="form-label">

        Jenis Kelamin

    </label>

    <select name="jenis_kelamin"
            class="form-select"
            required>

        <option value="Jantan"
            {{ $hewan->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>

            Jantan

        </option>

        <option value="Betina"
            {{ $hewan->jenis_kelamin == 'Betina' ? 'selected' : '' }}>

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
               value="{{ $hewan->umur }}"
               class="form-control">

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Satuan Umur

        </label>

        <select name="satuan_umur"
                class="form-select">

            <option value="Hari"
                {{ $hewan->satuan_umur == 'Hari' ? 'selected' : '' }}>

                Hari

            </option>

            <option value="Bulan"
                {{ $hewan->satuan_umur == 'Bulan' ? 'selected' : '' }}>

                Bulan

            </option>

            <option value="Tahun"
                {{ $hewan->satuan_umur == 'Tahun' ? 'selected' : '' }}>

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
                        value="{{ $hewan->berat }}"
                        class="form-control"
                        required>

        </div>

        <div class="mb-4">

    <label class="form-label">

        Warna Hewan

    </label>

        <input type="text"
                    name="warna"
                    value="{{ $hewan->warna }}"
                    class="form-control">

</div>



        <button type="submit"
                class="btn-custom">

            <i class="bi bi-save"></i>

            Update Data

        </button>

    </form>

</div>

@endsection