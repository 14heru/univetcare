<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Petugas Panel - Uni Vet Care</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet"
      href="{{ asset('assets/css/style.css') }}">

    <style>

        body{
            margin:0;
            padding:0;
            font-family:'Segoe UI', sans-serif;
            background:#f4f7f6;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:280px;
            background:white;
            border-right:1px solid #ddd;
            padding:30px;
        }

        .brand{
            display:flex;
            align-items:center;
            margin-bottom:50px;
        }

        .brand img{
            width:60px;
            height:60px;
            border-radius:50%;
            object-fit:cover;
            margin-right:15px;
        }

        .brand h3{
            font-size:28px;
            font-weight:bold;
            color:#198754;
            margin:0;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:12px;

            text-decoration:none;
            color:#333;

            padding:14px 18px;
            border-radius:14px;

            margin-bottom:15px;

            transition:0.3s;
            font-size:18px;
        }

        .sidebar a:hover{
            background:#198754;
            color:white;
        }

        .sidebar a.active{
            background:#198754;
            color:white;
        }

        .content{
            flex:1;
            padding:40px;
        }

        .page-title{
            font-size:38px;
            font-weight:bold;
            margin-bottom:40px;
            color:#222;
        }

        .section-title{
            font-size:30px;
            font-weight:bold;
            margin-bottom:25px;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:25px;
            margin-bottom:40px;
        }

        .stat-card{
            background:white;
            border-radius:25px;
            padding:25px;

            display:flex;
            align-items:center;
            justify-content:space-between;

            box-shadow:0 4px 12px rgba(0,0,0,0.05);
        }

        .stat-icon{
            width:70px;
            height:70px;
            border-radius:20px;

            background:#dff5e8;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:32px;
            color:#198754;
        }

        .stat-info{
            text-align:right;
        }

        .stat-info h4{
            margin:0;
            font-size:18px;
            color:#666;
        }

        .stat-info h2{
            margin:0;
            font-size:38px;
            font-weight:bold;
            color:#198754;
        }

        .table-card{
            background:white;
            border-radius:35px;
            padding:30px;

            box-shadow:0 4px 12px rgba(0,0,0,0.05);
        }

        .table-card h3{
            font-size:32px;
            font-weight:bold;
            margin-bottom:25px;
        }

        .table th{
            background:#f8f9fa;
        }

        .btn-custom{
            background:#198754;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:12px;
        }

        .btn-custom:hover{
            background:#146c43;
        }

        @media(max-width:992px){

            .wrapper{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
            }

            .stats-grid{
                grid-template-columns:1fr;
            }

        }

    </style>

</head>

<body>

<div class="wrapper">

    <div class="sidebar">

        <div class="brand">

            <img src="{{ asset('assets/images/logo.jpg') }}">

            <h3>UNI VET CARE</h3>

        </div>

        <a href="{{ url('/petugas/dashboard') }}"
           class="active">

            <i class="bi bi-grid-fill"></i>

            Dashboard

        </a>

        <a href="{{ url('/petugas/pemeriksaan') }}">

            <i class="bi bi-heart-pulse"></i>

            Antrian Pemeriksaan

        </a>

        <li class="nav-item">

                    <a href="{{ url('/petugas/hasil-pemeriksaan') }}"
                    class="nav-link">

                        <i class="bi bi-clipboard2-pulse"></i>

                        Hasil Pemeriksaan

                    </a>

                </li>

        <a href="{{ url('/petugas/billing') }}">

            <i class="bi bi-receipt"></i>

            Billing

        </a>

        <hr>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">

            <i class="bi bi-box-arrow-left"></i>

            Logout

        </a>

        <form id="logout-form"
              action="{{ route('logout') }}"
              method="POST"
              class="d-none">

            @csrf

        </form>

    </div>

    <div class="content">

        @yield('content')

    </div>

</div>

</body>
</html>