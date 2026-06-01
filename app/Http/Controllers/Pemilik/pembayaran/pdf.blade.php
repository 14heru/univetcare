<!DOCTYPE html>
<html>
<head>

    <title>

        Laporan Pembayaran

    </title>

    <style>

        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:10px;
            text-align:center;
        }

    </style>

</head>
<body>

    <h2 align="center">

        Laporan Pembayaran Uni Vet Care

    </h2>

    <table>

        <thead>

            <tr>

                <th>Kode</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @foreach($pembayaran as $item)

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

            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>