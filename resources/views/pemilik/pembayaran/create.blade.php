@extends('layouts.pemilik')

@section('content')

<div class="d-flex
            justify-content-between
            align-items-center
            mb-4">

    <h1 class="page-title mb-0">

                @if($pembayaran->jenis_pembayaran == 'DP')

                    Pembayaran Administrasi

                @else

                    Pembayaran Pelunasan

                @endif

            </h1>

</div>

<div class="card-custom">

    {{-- <div class="alert alert-warning mb-4">

        <strong>

            Uang Muka (DP)

        </strong>

        sebesar

        <strong>

            Rp 15.000

        </strong>

        wajib dibayarkan untuk melanjutkan booking pemeriksaan.

    </div> --}}
                    @if($pembayaran->jenis_pembayaran == 'DP')

                <div class="alert alert-warning mb-4">

                    <strong>

                        Pembayaran Administrasi

                    </strong>

                    sebesar

                    <strong>

                        Rp {{ number_format($pembayaran->jumlah_bayar) }}

                    </strong>

                    wajib dibayarkan untuk melanjutkan booking pemeriksaan.

                </div>

                @else

                <div class="alert alert-info mb-4">

                    <strong>

                        Pelunasan Tagihan

                    </strong>

                    sebesar

                    <strong>

                        Rp {{ number_format($pembayaran->jumlah_bayar) }}

                    </strong>

                    wajib dibayarkan untuk menyelesaikan pemeriksaan.

                </div>

                @endif

    <form action="{{ url('/pemilik/pembayaran/'.$pembayaran->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- NOMINAL -->

        <div class="mb-4">

            <label class="form-label">

                Nominal Pembayaran

            </label>

            <input type="text"
                   class="form-control"
                   value="Rp {{ number_format($pembayaran->jumlah_bayar) }}"
                   readonly>

        </div>

        <!-- METODE -->

        <div class="mb-4">

            <label class="form-label">

                Metode Pembayaran

            </label>

            <select name="metode_pembayaran"
                    id="metode"
                    class="form-select">

                <option value="QR Code">

                    QR Code

                </option>

                <option value="E-Wallet">

                    E-Wallet

                </option>

                <option value="Transfer">

                    Transfer

                </option>

            </select>

        </div>

        <!-- QR CODE -->

        <div id="qrcode-area"
             class="mb-4">

            <label class="form-label">

                QR Code Pembayaran

            </label>

            <div>

                {!! QrCode::size(250)->generate(

                    'Kode Pembayaran : '.$pembayaran->kode_pembayaran.

                    ' | Nominal : Rp '.$pembayaran->jumlah_bayar

                    ) !!}

            </div>

        </div>

        <!-- UPLOAD -->

        <div class="mb-4">

            <label class="form-label">

                Upload Bukti Pembayaran

            </label>

            <input type="file"
                   name="bukti_pembayaran"
                   class="form-control">

        </div>

        <!-- BUTTON -->

        <div class="d-flex gap-2">

            <button type="submit"
                    class="btn-custom">

                Upload Pembayaran

            </button>

            <button type="reset"
                    class="btn btn-secondary rounded-pill px-4">

                Reset

            </button>

        </div>

    </form>

</div>

<!-- SCRIPT QR -->

<script>

document.getElementById('metode')
.addEventListener('change', function(){

    let metode = this.value;

    let qr = document.getElementById(
        'qrcode-area'
    );

    if(metode == 'QR Code'){

        qr.style.display = 'block';

    }else{

        qr.style.display = 'none';

    }

});

</script>

@endsection