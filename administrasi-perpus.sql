-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Jan 2026 pada 04.35
-- Versi server: 8.0.30
-- Versi PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `administrasi-perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `pengarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `rak_buku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `judul`, `category_id`, `pengarang`, `stock`, `rak_buku`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Perahu Kertas', 2, 'Dee Lestari', 3, 'A1', 'covers/1755917381.jpg', '2025-08-22 08:54:31', '2025-08-30 03:55:12'),
(2, 'Pergi', 2, 'Tere Liye', 1, 'A2', 'covers/1755917390.jpg', '2025-08-22 08:54:31', '2025-08-26 09:56:36'),
(3, 'Aku Mengenal Hewan', 11, 'Olivia Wilson', 10, 'B1', 'covers/1755917396.jpg', '2025-08-22 08:54:31', '2025-08-27 08:36:31'),
(4, 'Kala Senja Menyapa', 13, 'Rosa Maria Aquado', 5, 'B2', 'covers/1755917410.jpg', '2025-08-22 08:54:31', '2025-08-30 03:55:12'),
(5, 'Sang Penerbang di Taman Puisi', 13, 'Brigitte Schwartz', 6, 'C1', 'covers/1755917418.jpg', '2025-08-22 08:54:31', '2025-08-23 02:50:18'),
(6, 'Pilih Untuk Pulih', 1, 'Sepiaheru', 10, 'C1', 'covers/1755917434.jpg', '2025-08-22 08:54:31', '2025-08-23 02:50:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_borrower`
--

CREATE TABLE `book_borrower` (
  `id` bigint UNSIGNED NOT NULL,
  `borrower_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `book_borrower`
--

INSERT INTO `book_borrower` (`id`, `borrower_id`, `book_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 3, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 6, 2, NULL, NULL),
(8, 7, 3, NULL, NULL),
(9, 8, 1, NULL, NULL),
(10, 8, 3, NULL, NULL),
(11, 9, 1, NULL, NULL),
(12, 9, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowers`
--

CREATE TABLE `borrowers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_kembali_confirm` date DEFAULT NULL,
  `is_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `fine` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `borrowers`
--

INSERT INTO `borrowers` (`id`, `user_id`, `tgl_pinjam`, `tgl_kembali`, `tgl_kembali_confirm`, `is_confirm`, `fine`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-08-22', '2025-08-29', NULL, 1, NULL, '2025-08-22 10:24:26', '2025-08-23 03:06:02'),
(2, 2, '2025-08-22', '2025-08-29', NULL, 1, NULL, '2025-08-22 10:24:48', '2025-08-26 09:56:36'),
(3, 2, '2025-08-11', '2025-08-18', '2025-08-23', 1, NULL, '2025-08-22 10:25:09', '2025-08-23 04:06:20'),
(4, 6, '2025-08-23', '2025-08-30', NULL, 1, NULL, '2025-08-23 03:04:11', '2025-08-26 10:11:54'),
(5, 5, '2025-08-23', '2025-08-30', NULL, 1, NULL, '2025-08-23 03:04:33', '2025-08-23 03:06:20'),
(6, 2, '2025-08-26', '2025-09-02', NULL, 1, NULL, '2025-08-26 04:53:53', '2025-08-26 04:54:22'),
(7, 2, '2025-08-26', '2025-09-02', NULL, 1, NULL, '2025-08-26 10:12:20', '2025-08-26 10:12:28'),
(8, 2, '2025-08-27', '2025-09-03', NULL, 1, NULL, '2025-08-27 08:36:08', '2025-08-27 08:36:31'),
(9, 2, '2025-08-30', '2025-09-06', NULL, 1, NULL, '2025-08-30 03:54:52', '2025-08-30 03:55:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrow_transactions`
--

CREATE TABLE `borrow_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `is_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(2, 'Fiksi', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(3, 'Non-Fiksi', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(4, 'Biografi', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(5, 'Ensiklopedia', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(6, 'Komik', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(7, 'Majalah', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(8, 'Jurnal', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(9, 'Kamus', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(10, 'Pelajaran', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(11, 'Matematika', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(12, 'Bahasa Inggris', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(13, 'Bahasa Indonesia', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(14, 'IPA', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(15, 'IPS', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(16, 'Seni Budaya', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(17, 'Olahraga', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(18, 'Agama', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(19, 'Teknologi', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(20, 'Sejarah', '2025-08-22 08:54:31', '2025-08-22 08:54:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `damaged_books`
--

CREATE TABLE `damaged_books` (
  `id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `damaged_books`
--

INSERT INTO `damaged_books` (`id`, `book_id`, `jumlah`, `keterangan`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Kerusakan ringan pada sampul.', '2025-07-29', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(2, 2, 2, 'Kerusakan ringan pada sampul.', '2025-08-04', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(3, 3, 2, 'Kerusakan ringan pada sampul.', '2025-08-11', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(4, 4, 2, 'Kerusakan ringan pada sampul.', '2025-07-30', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(5, 5, 1, 'Kerusakan ringan pada sampul.', '2025-08-17', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(6, 6, 2, 'Kerusakan ringan pada sampul.', '2025-08-05', '2025-08-22 08:54:31', '2025-08-22 08:54:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guests`
--

CREATE TABLE `guests` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanda_tangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guests`
--

INSERT INTO `guests` (`id`, `tanggal`, `nama`, `alamat`, `jabatan`, `pesan`, `tanda_tangan`, `created_at`, `updated_at`) VALUES
(1, '2025-07-01', 'Ahmad Fauzi', 'Jl. Merdeka No.1', 'Guru', 'Perpustakaan sangat nyaman.', 'signatures/68a92b5b7fb6b.png', '2025-08-22 08:54:31', '2025-08-23 02:45:48'),
(2, '2025-07-01', 'Siti Rahmawati', 'Jl. Kenanga No.10', 'Orang Tua', 'Anak saya betah membaca di sini.', 'signatures/68a92b61d2d2b.png', '2025-08-22 08:54:31', '2025-08-23 02:45:53'),
(3, '2025-07-01', 'Budi Santoso', 'Jl. Ahmad Yani No.25', 'Kepala Sekolah', 'Fasilitas perlu terus ditingkatkan.', 'signatures/68a92b6786d9b.png', '2025-08-22 08:54:31', '2025-08-23 02:45:59'),
(4, '2025-07-01', 'Rina Agustina', 'Jl. Flamboyan No.3', 'Mahasiswa', 'Tempat yang cocok untuk riset.', 'signatures/68a92b6ce70dd.png', '2025-08-22 08:54:31', '2025-08-23 02:46:04'),
(5, '2025-07-01', 'Dewi Lestari', 'Jl. Mawar No.17', 'Pustakawan', 'Koleksi buku sudah baik.', 'signatures/68a92b7548014.png', '2025-08-22 08:54:31', '2025-08-23 02:46:13'),
(6, '2025-07-01', 'Fajar Nugroho', 'Jl. Melati No.9', 'Tamu', 'Pelayanan sangat ramah.', 'signatures/68a92b7bbd4ad.png', '2025-08-22 08:54:31', '2025-08-23 02:46:19'),
(7, '2025-07-01', 'Sri Wahyuni', 'Jl. Anggrek No.5', 'Guru Tamu', 'Senang melihat anak rajin membaca.', 'signatures/68a92b80e1287.png', '2025-08-22 08:54:31', '2025-08-23 02:46:24'),
(8, '2025-07-01', 'Hendra Saputra', 'Jl. Dahlia No.8', 'Alumni', 'Bangga dengan perpustakaan sekolah.', 'signatures/68a92b8b1178c.png', '2025-08-22 08:54:31', '2025-08-23 02:46:35'),
(9, '2025-07-01', 'Linda Permata', 'Jl. Sawo No.14', 'Orang Tua', 'Sangat membantu anak belajar.', 'signatures/68a92b92b218a.png', '2025-08-22 08:54:31', '2025-08-23 02:46:42'),
(10, '2025-07-01', 'Rizky Hidayat', 'Jl. Rambutan No.22', 'Tamu', 'Tempat yang asri dan nyaman.', 'signatures/68a92b979b852.png', '2025-08-22 08:54:31', '2025-08-23 02:46:47'),
(11, '2025-08-11', 'Ahmad Fauzi', 'kapuas', 'Tamu', 'Baik', 'signatures/68a83de786b7b.png', '2025-08-22 09:52:39', '2025-08-22 09:52:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keadaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `inventories`
--

INSERT INTO `inventories` (`id`, `nama`, `merk`, `tahun`, `jumlah`, `harga`, `keadaan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Meja Perpustakaan', 'Olympic', 2020, 10, '350000', 'Baik', 'Meja baca siswa', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(3, 'Rak Buku Besi', 'Informa', 2019, 5, '750000', 'Baik', 'Rak buku pelajaran', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(4, 'Komputer Perpustakaan', 'Lenovo', 2022, 2, '5500000', 'Baik', 'Untuk input data', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(5, 'Printer', 'Epson L3110', 2022, 1, '2000000', 'Baik', 'Cetak kartu anggota', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(6, 'Lemari Arsip', 'Lion Star', 2018, 3, '900000', 'Baik', 'Menyimpan dokumen', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(7, 'Karpet Ruang Baca', 'Royal', 2020, 1, '800000', 'Baik', 'Karpet ruang baca', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(8, 'Dispenser Air', 'Miyako', 2019, 1, '600000', 'Rusak Ringan', 'Perlu diganti heater', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(9, 'Proyektor', 'Epson', 2020, 1, '3500000', 'Baik', 'Untuk presentasi', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(10, 'Speaker Aktif', 'Polytron', 2020, 2, '800000', 'Baik', 'Speaker ruang baca', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(11, 'Kipas Angin', 'Maspion', 2018, 3, '250000', 'Baik', 'Sirkulasi udara', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(12, 'Stop Kontak', 'Broco', 2019, 10, '35000', 'Baik', 'Listrik tambahan', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(13, 'Lemari Buku Kayu', 'Olympic', 2019, 4, '950000', 'Baik', 'Rak koleksi fiksi', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(14, 'Jam Dinding', 'Seiko', 2018, 2, '150000', 'Baik', 'Jam ruang baca', '2025-08-22 08:54:31', '2025-08-22 08:54:31'),
(15, 'Alat Pel', 'Scotch Brite', 2022, 2, '50000', 'Baik', 'Kebersihan lantai', '2025-08-22 08:54:31', '2025-08-22 08:54:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `user_id`, `kode`, `foto`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telepon`, `status`, `expire`, `created_at`, `updated_at`) VALUES
(3, 4, 'AG0003', 'member/1fEa7HJBkACcaUpKmg4r6AAM0ABSegnDKYuOzewT.jpg', 'kapuas', '2004-02-10', 'kanoko', '8998778', 'Aktif', '2028-06-30', '2025-08-23 03:00:27', '2025-08-23 03:05:56'),
(4, 7, 'AG0004', 'member/qCu4irV8jIgJYf6CGxdQMfDuOvoYoQdtcLvcGxgJ.jpg', 'kapuas', '2004-02-10', 'banjar', '8998778', 'Aktif', '2028-06-30', '2025-08-23 03:03:04', '2025-08-23 03:05:57'),
(5, 6, 'AG0005', 'member/NU6fvKeozbGvBW27QunpzrJGVYSMdsmUEhRlCzOB.jpg', 'anjir', '2004-02-10', 'banjarmasin', '8998778', 'Aktif', '2028-06-30', '2025-08-23 03:04:01', '2025-08-23 03:05:58'),
(6, 5, 'AG0006', 'member/x4JKybnxAUK58wP4bf3zDhskSajU0rYP2AUYGQnu.png', 'anjir', '2004-02-10', 'banjarmasin', '8998778', 'Aktif', '2028-06-30', '2025-08-23 03:05:07', '2025-08-23 03:12:08'),
(7, 2, 'AG0007', 'member/HO6iwjXaNOHz2M2QqOeAy98a4T2Z2YaR1vaJP4j3.jpg', 'anjir', '2004-02-10', 'banjarmasin', '8998778', 'Tidak Aktif', '2023-06-30', '2025-08-23 03:13:21', '2025-08-23 03:44:38'),
(8, 8, 'AG0008', 'member/bUqUssKjJP56bn8ofckhpFNS9BbM3vFtBbBQLUMd.jpg', 'anjir', '2004-02-10', 'banjarmasin', '8998778', 'Aktif', '2028-06-30', '2025-08-23 03:14:31', '2025-08-23 03:14:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_15_000321_create_categories_table', 1),
(6, '2024_09_11_024422_create_books_table', 1),
(7, '2024_09_26_002537_create_inventories_table', 1),
(8, '2024_09_26_012711_create_members_table', 1),
(9, '2024_09_26_022433_create_visitors_table', 1),
(10, '2024_09_30_013524_create_guests_table', 1),
(11, '2024_09_30_060619_create_teachers_table', 1),
(12, '2025_05_22_015238_create_borrow_transactions_table', 1),
(13, '2025_05_22_015353_create_borrowers_table', 1),
(14, '2025_05_22_073947_create_book_borrower_table', 1),
(15, '2025_06_09_054612_create_damaged_books_table', 1),
(16, '2025_06_09_062650_create_ratings_table', 1),
(17, '2025_06_10_055138_create_wishlists_table', 1),
(18, '2025_06_10_073010_create_stock_opnames_table', 1),
(19, '2025_07_10_060544_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0d096dde-4c79-445e-be1b-0cf2f78577f1', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":6,\"user_name\":\"rizky\"}', '2025-08-30 03:53:44', '2025-08-26 04:53:55', '2025-08-30 03:53:44'),
('156c26c7-7a96-4d54-bf9d-d62a03598fb2', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: fadil\",\"user_id\":8}', '2025-08-30 03:53:44', '2025-08-23 03:13:52', '2025-08-30 03:53:44'),
('4075c2b8-0eda-4268-a6f6-56d6c22789e1', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":1,\"user_name\":\"rizky\"}', '2025-08-23 02:59:15', '2025-08-22 10:24:27', '2025-08-23 02:59:15'),
('5db7d70f-ca39-41be-bb84-0aac1c9d26d6', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":5,\"user_name\":\"opi\"}', '2025-08-30 03:53:44', '2025-08-23 03:04:33', '2025-08-30 03:53:44'),
('6203945c-dfed-4375-926a-96fef43d028e', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: erik\",\"member_id\":4,\"kode\":\"AG0004\"}', '2025-08-30 03:53:44', '2025-08-23 03:03:04', '2025-08-30 03:53:44'),
('6c2817a6-251b-48fb-945a-688306fffed2', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":9,\"user_name\":\"rizky\"}', NULL, '2025-08-30 03:54:57', '2025-08-30 03:54:57'),
('78e3580a-1fb9-471a-b5ff-594b9e0b3dce', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":4,\"user_name\":\"rizal\"}', '2025-08-30 03:53:44', '2025-08-23 03:04:11', '2025-08-30 03:53:44'),
('7d2eef84-3de8-4fb3-b01c-11ec15c4c8be', 'App\\Notifications\\BorrowerApproved', 'App\\Models\\User', 2, '{\"message\":\"Peminjaman Anda telah dikonfirmasi. Silakan ambil buku berikut di perpustakaan: Pergi\",\"borrower_id\":2,\"books\":[\"Pergi\"]}', NULL, '2025-08-26 09:56:36', '2025-08-26 09:56:36'),
('806a0931-527b-47c5-b559-98e1a3cf8c11', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: rizky\",\"member_id\":1,\"kode\":\"AG0001\"}', '2025-08-23 02:59:15', '2025-08-22 09:20:07', '2025-08-23 02:59:15'),
('813aabc2-7c76-46f6-a41e-7f7d389ae889', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: fadillah\",\"user_id\":3}', '2025-08-23 02:59:15', '2025-08-22 09:40:12', '2025-08-23 02:59:15'),
('8ff8a05f-7d3b-4f01-9a01-9981dea4858f', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: opi\",\"member_id\":6,\"kode\":\"AG0006\"}', '2025-08-30 03:53:44', '2025-08-23 03:05:07', '2025-08-30 03:53:44'),
('9bddd162-f9ed-4d9a-b251-ea9a2be85441', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: rizal\",\"member_id\":5,\"kode\":\"AG0005\"}', '2025-08-30 03:53:44', '2025-08-23 03:04:01', '2025-08-30 03:53:44'),
('a7064dd7-1d31-44f4-9142-246ce8898b1f', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: anton\",\"user_id\":4}', '2025-08-23 02:59:15', '2025-08-23 02:57:46', '2025-08-23 02:59:15'),
('a7e6a25f-2af1-4fbd-97f7-3062310780ca', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: fadil\",\"member_id\":8,\"kode\":\"AG0008\"}', '2025-08-30 03:53:44', '2025-08-23 03:14:31', '2025-08-30 03:53:44'),
('a835a07f-6c74-425c-a417-46d29f8890dc', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: anton\",\"member_id\":3,\"kode\":\"AG0003\"}', '2025-08-30 03:53:44', '2025-08-23 03:00:27', '2025-08-30 03:53:44'),
('afc11d3b-0b32-423e-8dd0-940d836babc9', 'App\\Notifications\\BorrowerApproved', 'App\\Models\\User', 2, '{\"message\":\"Peminjaman Anda telah dikonfirmasi. Silakan ambil buku berikut di perpustakaan: Aku Mengenal Hewan\",\"borrower_id\":3,\"books\":[\"Aku Mengenal Hewan\"]}', NULL, '2025-08-23 04:05:07', '2025-08-23 04:05:07'),
('b9fa314f-bd0d-43f3-8f5e-e5a10d1f8745', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":8,\"user_name\":\"rizky\"}', '2025-08-30 03:53:44', '2025-08-27 08:36:13', '2025-08-30 03:53:44'),
('c49e5e2c-44b6-4a20-9906-4b366cb9550c', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: fadillah\",\"member_id\":2,\"kode\":\"AG0002\"}', '2025-08-23 02:59:15', '2025-08-22 09:40:52', '2025-08-23 02:59:15'),
('c6815c14-7ab8-48ae-89bc-25c3f51e19b3', 'App\\Notifications\\BorrowerApproved', 'App\\Models\\User', 2, '{\"message\":\"Peminjaman Anda telah dikonfirmasi. Silakan ambil buku berikut di perpustakaan: Perahu Kertas, Pergi\",\"borrower_id\":6,\"books\":[\"Perahu Kertas\",\"Pergi\"]}', NULL, '2025-08-26 04:54:22', '2025-08-26 04:54:22'),
('cb54898b-3c19-477a-91b0-ccd476d00130', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":3,\"user_name\":\"rizky\"}', '2025-08-23 02:59:15', '2025-08-22 10:25:09', '2025-08-23 02:59:15'),
('cfd879f9-8eb3-491e-b398-5cb95691cb4f', 'App\\Notifications\\BorrowerApproved', 'App\\Models\\User', 5, '{\"message\":\"Peminjaman Anda telah dikonfirmasi. Silakan ambil buku berikut di perpustakaan: Perahu Kertas\",\"borrower_id\":5,\"books\":[\"Perahu Kertas\"]}', NULL, '2025-08-23 03:06:20', '2025-08-23 03:06:20'),
('d8fd4d5d-bf3b-411c-9336-8b7eb6e68c47', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: rizky\",\"user_id\":2}', '2025-08-23 02:59:15', '2025-08-22 09:06:50', '2025-08-23 02:59:15'),
('e6b85e3f-2eb7-4353-9fcb-195c4a0a4279', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":2,\"user_name\":\"rizky\"}', '2025-08-23 02:59:15', '2025-08-22 10:24:48', '2025-08-23 02:59:15'),
('eb0abef7-27cb-4c4a-aa4c-addaf83f14a1', 'App\\Notifications\\BorrowerApproved', 'App\\Models\\User', 2, '{\"message\":\"Peminjaman Anda telah dikonfirmasi. Silakan ambil buku berikut di perpustakaan: Perahu Kertas\",\"borrower_id\":1,\"books\":[\"Perahu Kertas\"]}', NULL, '2025-08-23 03:06:02', '2025-08-23 03:06:02'),
('ec15d549-31ab-476b-8e54-dacb2a398c8f', 'App\\Notifications\\NewMemberRegistered', 'App\\Models\\User', 1, '{\"message\":\"Pendaftaran anggota baru: rizky\",\"member_id\":7,\"kode\":\"AG0007\"}', '2025-08-30 03:53:44', '2025-08-23 03:13:21', '2025-08-30 03:53:44'),
('ee16365b-c5de-4069-8619-52cac8aab79f', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: erik\",\"user_id\":7}', '2025-08-23 02:59:15', '2025-08-23 02:59:05', '2025-08-23 02:59:15'),
('f1441ed5-57c5-49cd-82e6-3e9f57f968c5', 'App\\Notifications\\NewBorrowerRequest', 'App\\Models\\User', 1, '{\"message\":\"Ada peminjaman buku baru yang perlu dikonfirmasi.\",\"borrower_id\":7,\"user_name\":\"rizky\"}', '2025-08-30 03:53:44', '2025-08-26 10:12:20', '2025-08-30 03:53:44'),
('fc9e190d-81c0-415a-bf4c-b923398a8659', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: opi\",\"user_id\":5}', '2025-08-23 02:59:15', '2025-08-23 02:58:18', '2025-08-23 02:59:15'),
('fff37ca4-a134-4056-8d13-eb5d94430f41', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"User baru telah mendaftar: rizal\",\"user_id\":6}', '2025-08-23 02:59:15', '2025-08-23 02:58:42', '2025-08-23 02:59:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `book_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 4, 'bagus', '2025-08-23 03:05:26', '2025-08-23 03:05:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opnames`
--

CREATE TABLE `stock_opnames` (
  `id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `actual_stock` int UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_opnames`
--

INSERT INTO `stock_opnames` (`id`, `book_id`, `actual_stock`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, NULL, 1, '2025-08-23 02:49:01', '2025-08-23 02:49:01'),
(2, 2, 10, NULL, 1, '2025-08-23 02:49:01', '2025-08-23 02:49:01'),
(3, 3, 10, NULL, 1, '2025-08-23 02:49:01', '2025-08-23 02:49:01'),
(4, 4, 10, NULL, 1, '2025-08-23 02:49:01', '2025-08-23 02:49:01'),
(5, 5, 10, NULL, 1, '2025-08-23 02:49:01', '2025-08-23 02:49:01'),
(6, 6, 10, NULL, 1, '2025-08-23 02:49:01', '2025-08-23 02:49:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanda_tangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `teachers`
--

INSERT INTO `teachers` (`id`, `nama`, `jabatan`, `tujuan`, `tanda_tangan`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Fauzi', 'Guru Matematika', 'Mengembalikan buku pelajaran', 'signatures/68a92ba0f0ac1.png', '2025-08-22 08:54:31', '2025-08-23 02:46:56'),
(2, 'Siti Rahmawati', 'Guru Bahasa Indonesia', 'Meminjam novel referensi', 'signatures/68a92ba69beea.png', '2025-08-22 08:54:31', '2025-08-23 02:47:02'),
(3, 'Budi Santoso', 'Guru Fisika', 'Mengajar kelas XII IPA 1', 'signatures/68a92bb1a05f5.png', '2025-08-22 08:54:31', '2025-08-23 02:47:13'),
(4, 'Dewi Kartika', 'Guru Biologi', 'Praktikum Biologi kelas XI', 'signatures/68a92bb753349.png', '2025-08-22 08:54:31', '2025-08-23 02:47:19'),
(5, 'Rizky Hidayat', 'Guru Kimia', 'Mengajar materi larutan', 'signatures/68a92bbdbb946.png', '2025-08-22 08:54:31', '2025-08-23 02:47:25'),
(6, 'Nurlaila Hasanah', 'Guru Sejarah', 'Menyiapkan materi sejarah', 'signatures/68a92bc722ada.png', '2025-08-22 08:54:31', '2025-08-23 02:47:35'),
(7, 'Taufik Hidayat', 'Guru Penjas', 'Koordinasi jadwal senam', 'signatures/68a92bcf38ec4.png', '2025-08-22 08:54:31', '2025-08-23 02:47:43'),
(8, 'Linda Rosdiana', 'Guru Ekonomi', 'Meminjam buku akuntansi', 'signatures/68a92bd661e27.png', '2025-08-22 08:54:31', '2025-08-23 02:47:50'),
(9, 'Agus Susanto', 'Guru Geografi', 'Membuat soal ujian', 'signatures/68a92bdc0b2cb.png', '2025-08-22 08:54:31', '2025-08-23 02:47:56'),
(10, 'Maya Sari', 'Guru Sosiologi', 'Rapat guru BK', 'signatures/68a92be26a28a.png', '2025-08-22 08:54:31', '2025-08-23 02:48:02'),
(11, 'rizky', 'Orang Tua', 'baik', 'signatures/68a84b45a7863.png', '2025-08-22 10:49:41', '2025-08-22 10:49:41'),
(12, 'Ani Palastri', 'Orang Tua', 'Membaca', 'signatures/68a92871db9ba.png', '2025-08-23 02:33:21', '2025-08-23 02:33:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `nis`, `tahun_ajaran`, `email`, `email_verified_at`, `password`, `remember_token`, `is_admin`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '-', '-', 'admin@admin.com', NULL, '$2y$10$5CFvZXBN2TkA7BF6CFH5lOKA16QheDFBYt0HVSENDSZ/bVlPiwBOK', NULL, 1, 1, NULL, NULL),
(2, 'rizky', '3226546787', '2020', 'rizky@gmail.com', NULL, '$2y$10$t2F.fmetcYfTCX14VbvV8.Q6EfvuRX47CvkhpVZaszuadD824t7jq', NULL, 0, 1, '2025-08-22 09:06:50', '2025-08-22 09:07:01'),
(3, 'fadillah', '3226546787', '2025', 'fadillah@gmail.com', NULL, '$2y$10$xcgefMOr5Oy5NNHqyPiWB.eIs8WGq02maG62O29HDq4I4fx.EhoNi', NULL, 0, 1, '2025-08-22 09:40:12', '2025-08-22 09:40:23'),
(4, 'anton', '3226546787', '2025', 'anton@gmail.com', NULL, '$2y$10$nuYJStRFPc0bJuCHKGHO7ubrD9QOtoQvgVHkfyW9qXvVLkyFhYoWe', NULL, 0, 1, '2025-08-23 02:57:45', '2025-08-23 02:59:18'),
(5, 'opi', '3226546787', '2025', 'opi@gmail.com', NULL, '$2y$10$5lC84m7rNnsmZgAP6g5Y6.VWEhSIRjZjrkpri6CwHha0i7j431wPS', NULL, 0, 1, '2025-08-23 02:58:18', '2025-08-23 02:59:19'),
(6, 'rizal', '3226546787', '2025', 'rizal@gmail.com', NULL, '$2y$10$cCfgsnVNMQH0TXlpdGU68.IGewTUrsGws3Zo9q67SGQ18OCDnUeX2', NULL, 0, 1, '2025-08-23 02:58:42', '2025-08-23 02:59:20'),
(7, 'erik', '3226546787', '2025', 'erik@gmail.com', NULL, '$2y$10$MU0NApz4WY8apTIMYA/8ruCfL8AD9.59eJIa5MUcwtNy.L.bPiNO2', NULL, 0, 1, '2025-08-23 02:59:05', '2025-08-23 02:59:21'),
(8, 'fadil', '3226546787', '2025', 'fadil@gmail.com', NULL, '$2y$10$ySk.zh2/5RiKL3ViyJO82eO81JCXaHeSG0WRUCs6YmXNi3RaRPFWO', NULL, 0, 1, '2025-08-23 03:13:52', '2025-08-23 03:13:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanda_tangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `visitors`
--

INSERT INTO `visitors` (`id`, `nama`, `tahun_ajaran`, `tujuan`, `tanda_tangan`, `created_at`, `updated_at`) VALUES
(1, 'fadillah', '2025', 'Membaca', 'signatures/ttd_68a83c40e24d5.png', '2025-08-22 09:45:36', '2025-08-22 09:45:36'),
(2, 'rizky', '2020', 'Mengerjakan Tugas', 'signatures/ttd_68a83c61d455e.png', '2025-08-22 09:46:09', '2025-08-22 09:46:09'),
(3, 'anton', '2025', 'Membaca', 'signatures/ttd_68a92ea735714.png', '2025-08-23 02:59:51', '2025-08-23 02:59:51'),
(4, 'erik', '2025', 'Meminjam Buku', 'signatures/ttd_68a92efe24e20.png', '2025-08-23 03:01:18', '2025-08-23 03:01:18'),
(5, 'rizal', '2025', 'Meminjam Buku', 'signatures/ttd_68a92f89357ff.png', '2025-08-23 03:03:37', '2025-08-23 03:03:37'),
(6, 'opi', '2025', 'Meminjam Buku', 'signatures/ttd_68a92fd670290.png', '2025-08-23 03:04:54', '2025-08-23 03:04:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `book_borrower`
--
ALTER TABLE `book_borrower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_borrower_borrower_id_foreign` (`borrower_id`),
  ADD KEY `book_borrower_book_id_foreign` (`book_id`);

--
-- Indeks untuk tabel `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowers_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `borrow_transactions`
--
ALTER TABLE `borrow_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrow_transactions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `damaged_books`
--
ALTER TABLE `damaged_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `damaged_books_book_id_foreign` (`book_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_kode_unique` (`kode`),
  ADD KEY `members_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ratings_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `ratings_book_id_foreign` (`book_id`);

--
-- Indeks untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_opnames_book_id_foreign` (`book_id`),
  ADD KEY `stock_opnames_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `wishlists_book_id_foreign` (`book_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `book_borrower`
--
ALTER TABLE `book_borrower`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `borrow_transactions`
--
ALTER TABLE `borrow_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `damaged_books`
--
ALTER TABLE `damaged_books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_borrower`
--
ALTER TABLE `book_borrower`
  ADD CONSTRAINT `book_borrower_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_borrower_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `borrow_transactions`
--
ALTER TABLE `borrow_transactions`
  ADD CONSTRAINT `borrow_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `damaged_books`
--
ALTER TABLE `damaged_books`
  ADD CONSTRAINT `damaged_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD CONSTRAINT `stock_opnames_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_opnames_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
