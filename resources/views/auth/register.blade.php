<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SMA MUHAMMADIYAH KUALAKAPUAS - Register</title>

    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: url('{{ asset('img/bg-library.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .card {
            z-index: 1;
        }

        .login-brand img {
            width: 60px;
        }

        .motivasi {
            font-size: 0.9rem;
            color: #ccc;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">

                        <div class="login-brand text-center mb-4">
                            <img src="{{ asset('img/logo-sma.png') }}" alt="Logo Sekolah">
                            <h5 class="mt-2">SMA Muhammadiyah Kuala Kapuas</h5>
                        </div>

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <input id="name" type="text" placeholder="Nama Lengkap"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="nis" type="text" placeholder="NIS"
                                    class="form-control @error('nis') is-invalid @enderror" name="nis"
                                    value="{{ old('nis') }}" required>
                                @error('nis')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" id="tahun_ajaran" name="tahun_ajaran"
                                    class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                    placeholder="Tahun Ajaran Masuk"
                                    value="{{ old('tahun_ajaran', isset($user) ? $user->tahun_ajaran : '') }}"
                                    required>

                                @error('tahun_ajaran')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="email" type="email" placeholder="Email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" placeholder="Konfirmasi Password"
                                    class="form-control" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftar
                            </button>

                            <div class="text-center mt-2">
                                <a class="small" href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
                            </div>
                        </form>

                        <div class="motivasi">
                            “Bergabunglah dan temukan buku terbaikmu di perpustakaan kami.”
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
