<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Uni Vet Care</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        body{
            margin:0;
            padding:0;
            font-family:'Segoe UI', sans-serif;
            background:#f5f7f6;
        }

        .register-container{
            display:flex;
            min-height:100vh;
        }

        .left-panel{
            width:50%;
            background: linear-gradient(
                180deg,
                #f8fffb,
                #dff5e8
            );

            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;

            padding:60px;
        }

        .left-panel img.logo{
            width:140px;
            margin-bottom:20px;
        }

        .left-panel h1{
            font-size:48px;
            color:#146c43;
            font-weight:bold;
            text-align:center;
            margin-bottom:20px;
        }

        .left-panel p{
            font-size:20px;
            text-align:center;
            color:#555;
            line-height:1.8;
            margin-bottom:40px;
        }

        .right-panel{
            width:50%;
            background:white;

            display:flex;
            justify-content:center;
            align-items:center;
        }

        .register-box{
            width:80%;
            max-width:500px;
        }

        .register-box h2{
            font-size:42px;
            color:#146c43;
            font-weight:bold;
            margin-bottom:10px;
        }

        .subtitle{
            color:#666;
            margin-bottom:40px;
            font-size:18px;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group-text{
            background:white;
            border-right:none;
            border-radius:15px 0 0 15px;
        }

        .form-control{
            height:60px;
            border-left:none;
            border-radius:0 15px 15px 0;
            font-size:18px;
        }

        .btn-register{
            width:100%;
            height:60px;
            border:none;
            border-radius:15px;
            background:#146c43;
            color:white;
            font-size:22px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn-register:hover{
            background:#0f5132;
        }

        .login-link{
            text-align:center;
            margin-top:30px;
        }

        .login-link a{
            color:#146c43;
            text-decoration:none;
            font-weight:bold;
        }

        .brand-footer{
            text-align:center;
            margin-top:40px;
            font-size:20px;
            color:#444;
        }

        .brand-footer img{
            width:40px;
            margin-right:10px;
        }

        @media(max-width:992px){

            .left-panel{
                display:none;
            }

            .right-panel{
                width:100%;
            }

        }

    </style>

</head>

<body>

<div class="register-container">

    <div class="left-panel">

        <img src="{{ asset('assets/images/logo.jpg') }}"
             class="logo">

        <h1>
            Kesehatan hewan peliharaan Anda,
            prioritas utama kami
        </h1>

        <p>
            Kami hadir untuk memberikan pelayanan terbaik
            bagi sahabat hewan kesayangan Anda.
        </p>

    </div>

    <div class="right-panel">

        <div class="register-box">

            <h2>Daftar Akun</h2>

            <div class="subtitle">
                Silakan register untuk membuat akun baru
            </div>

            <form method="POST"
                  action="{{ route('register') }}">

                @csrf

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-person"></i>

                    </span>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Nama Lengkap"
                           required>

                </div>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-envelope"></i>

                    </span>

                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Email"
                           required>

                </div>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-lock"></i>

                    </span>

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Password"
                           required>

                </div>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-shield-lock"></i>

                    </span>

                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Konfirmasi Password"
                           required>

                </div>

                <button type="submit"
                        class="btn-register">

                    Register

                </button>

                <div class="login-link">

                    Sudah punya akun?

                    <a href="{{ route('login') }}">
                        Login sekarang
                    </a>

                </div>

                <div class="brand-footer">

                    <img src="{{ asset('assets/images/logo.jpg') }}">

                    Uni Vet Care

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>