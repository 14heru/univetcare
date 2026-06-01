{{-- @extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Buat Billing</h3>

        <hr>

        <form action="{{ url('/petugas/billing/store') }}"
            
        method="POST">

            @csrf

            <input type="hidden"
                    name="pemeriksaan_id"
                    value="{{ $pemeriksaan->id }}"

            <div class="mb-3">

                <label>Nama Item</label>

                <input type="text"
                        name="nama_item[]"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Qty</label>

                <input type="number"
                        name="qty[]"
                        class="form-control">

            </div>

            <div class="mb-3">

                <label>Harga</label>

                <input type="number"
                        name="harga[]"
                        class="form-control">

            </div>

            <button type="submit"
                    class="btn btn-success">

                Simpan Billing

            </button>

        </form>

    </div>

</div>

@endsection --}}



@extends('layouts.petugas')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3>Buat Billing</h3>

        <hr>

        <form action="{{ url('/petugas/billing/store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="pemeriksaan_id"
                   value="{{ $pemeriksaan->id }}">

            <div id="item-wrapper">

                <div class="item-billing mb-3 border rounded p-3">

                    <div class="mb-3">

                        <label>Nama Item</label>

                        <input type="text"
                               name="nama_item[]"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-3">

                        <label>Qty</label>

                        <input type="number"
                               name="qty[]"
                               class="form-control"
                               min="1"
                               required>

                    </div>

                    <div class="mb-3">

                        <label>Harga</label>

                        <input type="text"
                               name="harga[]"
                               class="form-control harga-input"
                               required>

                    </div>

                </div>

            </div>

            <button type="button"
                    class="btn btn-primary mb-3"
                    onclick="tambahItem()">

                + Tambah Item

            </button>

            <button type="submit"
                    class="btn btn-success w-100">

                Simpan Billing

            </button>

        </form>

    </div>

</div>

<script>

function formatRupiah(angka)
{
    angka = angka.replace(/\D/g, '');

    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function aktifkanFormatHarga()
{
    document.querySelectorAll('.harga-input').forEach(function(input){

        input.addEventListener('input', function(){

            this.value = formatRupiah(this.value);

        });

    });
}

function tambahItem()
{
    let wrapper = document.getElementById('item-wrapper');

    let item = document.createElement('div');

    item.classList.add(
        'item-billing',
        'mb-3',
        'border',
        'rounded',
        'p-3'
    );

    item.innerHTML = `

        <div class="mb-3">

            <label>Nama Item</label>

            <input type="text"
                   name="nama_item[]"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Qty</label>

            <input type="number"
                   name="qty[]"
                   class="form-control"
                   min="1"
                   required>

        </div>

        <div class="mb-3">

            <label>Harga</label>

            <input type="text"
                   name="harga[]"
                   class="form-control harga-input"
                   required>

        </div>

        <button type="button"
                class="btn btn-danger btn-sm"
                onclick="this.parentElement.remove()">

            Hapus Item

        </button>

    `;

    wrapper.appendChild(item);

    aktifkanFormatHarga();
}

aktifkanFormatHarga();

</script>

@endsection