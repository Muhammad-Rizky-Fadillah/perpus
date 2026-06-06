<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .dropdown-menu.notifications-dropdown {
            max-width: 500px;
            width: 700px;
            word-wrap: break-word;
            white-space: normal;
        }

        .dropdown-item.notification-item {
            white-space: normal !important;
            overflow-wrap: break-word;
        }

        .notification-message {
            font-size: 14px;
            line-height: 1.4;
            color: #333;
        }

        .notification-time {
            font-size: 12px;
            color: #888;
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrasi Perpustakaan </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Antarmuka
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog animated--grow-in"></i>
                    <span>Pembuatan Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data :</h6>
                        @if (Auth::User()->is_admin)
                            <a class="collapse-item" href="{{ route('create_inventory') }}">Inventaris</a>
                            <a class="collapse-item" href="{{ route('create_book') }}">Buku</a>
                            <a class="collapse-item" href="{{ route('create_category') }}">Kategori</a>
                            <a class="collapse-item" href="{{ route('create_guest') }}">Pengunjung tamu</a>
                            <a class="collapse-item" href="{{ route('create_teacher') }}">Pengunjung Guru</a>
                            <a class="collapse-item" href="{{ route('create_damaged') }}">Buku Rusak</a>
                        @else
                            <a class="collapse-item" href="{{ route('create_member') }}">Pendaftaran Anggota</a>
                            <a class="collapse-item" href="{{ route('create_visitor') }}">Input Pengunjung Siswa</a>
                            <a class="collapse-item" href="{{ route('create_borrower') }}">Input Peminjaman Buku</a>
                        @endif
                    </div>
                </div>

            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tabel Data</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilihan Data:</h6>
                        @if (Auth::User()->is_admin)
                            <a class="collapse-item" href="{{ route('show_inventory') }}">Data Inventaris</a>
                            <a class="collapse-item" href="{{ route('show_member') }}">Data Anggota</a>
                            <a class="collapse-item" href="{{ route('show_visitor') }}">Data Pengunjung Siswa</a>
                            <a class="collapse-item" href="{{ route('show_guest') }}">Data Pengunjung tamu</a>
                            <a class="collapse-item" href="{{ route('show_teacher') }}">Data Pengunjung Guru</a>
                            <a class="collapse-item" href="{{ route('show_borrower') }}">Data Peminjam Buku</a>
                            <a class="collapse-item" href="{{ route('show_category') }}">Data Kategori</a>
                            <a class="collapse-item" href="{{ route('index_damaged') }}">Data Buku Rusak</a>
                            <a class="collapse-item" href="{{ route('index_rating') }}">Data Rating Pengguna</a>
                            <a class="collapse-item" href="{{ route('index_opname') }}">Data Stock Opname</a>
                            <a class="collapse-item" href="{{ route('users.index') }}">Data Pengguna</a>
           
                            @endif
                        <a class="collapse-item" href="{{ route('show_book') }}">Katalog Buku</a>
                        @if (!Auth::User()->is_admin)
                            <a class="collapse-item" href="{{ route('index_wishlist') }}">Data Wishlist Pengguna</a>
                        @endif
                    </div>
                </div>
            </li>

            @if (Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pilihan Laporan:</h6>
                            <a class="collapse-item" href="{{ route('cetak_inventory') }}">Laporan Inventaris</a>
                            <a class="collapse-item" href="{{ route('cetak_member') }}">Laporan Anggota</a>
                            <a class="collapse-item" href="{{ route('cetak_visitor') }}">Laporan Pengunjung Siswa</a>
                            <a class="collapse-item" href="{{ route('cetak_guest') }}">Laporan Pengunjung tamu</a>
                            <a class="collapse-item" href="{{ route('cetak_teacher') }}">Laporan Pengunjung Guru</a>
                            <a class="collapse-item" href="{{ route('cetak_borrower') }}">Laporan Peminjam Buku</a>
                            <a class="collapse-item" href="{{ route('cetak_book') }}">Laporan Daftar Buku</a>
                            <a class="collapse-item" href="{{ route('cetak_rating') }}">Laporan Daftar Rating
                                Buku</a>
                            <a class="collapse-item" href="{{ route('cetak_damaged') }}">Laporan Daftar Buku
                                Rusak</a>
                            <a class="collapse-item" href="{{ route('cetak_opname') }}">Laporan Data Stok Opname</a>                           
                        </div>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('create_opname') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Stok Opname</span></a>
                </li>
            @endif

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tambahan
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('show_structure') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Struktur Perpustakaan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('regulation') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tata Tertib Pengunjung </span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <div>
                        <img src="{{ asset('img/logo-sma.png') }}" height="70" alt=""><sup>SMA
                            MUHAMMADIYAH KUALAKAPUAS</sup>
                    </div>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>



                        <!-- Nav Item - User Information -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class=" btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-danger" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">
                                @auth
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" id="notificationsDropdown" role="button"
                                            data-toggle="dropdown">
                                            <i class="fas fa-bell"></i>
                                            @if (Auth::user()->unreadNotifications->count())
                                                <span class="badge badge-danger badge-counter">
                                                    {{ Auth::user()->unreadNotifications->count() }}
                                                </span>
                                            @endif
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="notificationsDropdown" style="width: 350px;">
                                            <h6 class="dropdown-header">Notifikasi Anda</h6>

                                            <div class="notification-scroll" style="max-height: 300px; overflow-y: auto;">
                                                @forelse(Auth::user()->unreadNotifications as $notification)
                                                    <a class="dropdown-item d-flex align-items-start notification-item"
                                                        href="#">
                                                        <div class="mr-3">
                                                            <div class="icon-circle bg-primary">
                                                                <i class="fas fa-info text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="notification-message">
                                                                {{ $notification->data['message'] }}</div>
                                                            <div class="notification-time text-muted"
                                                                style="font-size: 12px;">
                                                                {{ $notification->created_at->format('d M Y, H:i') }}
                                                            </div>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <span class="dropdown-item text-center text-muted">Tidak ada notifikasi
                                                        baru</span>
                                                @endforelse
                                            </div>

                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('markAsRead') }}" method="POST" class="text-center">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">Tandai semua telah
                                                    dibaca</button>
                                            </form>
                                        </div>
                                    </li>


                                @endauth
                            </ul>



                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('show_profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('user.verifikasi') }}">
                                            <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Verifikasi User
                                        </a>
                                        <a class="dropdown-item" href="{{ route('member.verifikasi') }}">
                                            <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Verifikasi Member
                                        </a>
                                        <a class="dropdown-item" href="{{ route('confirm_borrower') }}">
                                            <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Verifikasi Peminjaman
                                        </a>
                                        <a class="dropdown-item" href="{{ route('backup.index') }}">
                                            <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Backup Data
                                        </a>
                                    @endif




                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>



                                </div>
                            </li>
                        @endguest
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <main class="py-4">
                    @yield('content')
                    @yield('scripts')
                    @yield('styles')
                </main>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SMA MUHAMMADIYAH KUALAKAPUAS 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Untuk Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" di bawah jika anda siap untuk keluar dari halaman ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="fas fa-sign-out-alt  text-gray-400">
                        @csrf
                        <button type="submit" class="btn btn-primary">logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatModalLabel">Chat Dengan Kami</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe allow="microphone;" width="100%" height="480"
                        src="https://console.dialogflow.com/api-client/demo/embedded/45ed442f-de2e-44e4-b8cc-8c477c44d596">
                    </iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('js/Chart.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
