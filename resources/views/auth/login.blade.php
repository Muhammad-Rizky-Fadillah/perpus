<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Halaman Login">
    <meta name="author" content="">

    <title>SMA Muhammadiyah Kuala Kapuas - Login</title>

    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

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
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .card {
            z-index: 1;
        }

        .login-brand img {
            width: 60px;
        }

        .motivasi {
            font-size: 0.85rem;
            color: #ccc;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">

                        <div class="login-brand text-center mb-4">
                            <img src="{{ asset('img/logo-sma.png') }}" alt="Logo Sekolah">
                            <h5 class="mt-2">SMA Muhammadiyah Kuala Kapuas</h5>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" placeholder="Masukkan Email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" placeholder="Masukkan Password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-center mt-2">
                                    <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
                                </div>
                            @endif

                            <div class="text-center mt-2">
                                <a class="small" href="{{ route('register') }}">Buat Akun Baru!</a>
                            </div>
                        </form>

                        <div class="motivasi">
                            “Membaca adalah jendela dunia, mulai dari perpustakaan kita.”
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
