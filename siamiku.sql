-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 24 Des 2021 pada 04.56
-- Versi server: 5.7.32
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siamiku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_auditor`
--

CREATE TABLE `anggota_auditor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `audit_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggota_auditor`
--

INSERT INTO `anggota_auditor` (`id`, `audit_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dr. Ahmad Dahlan', '2021-12-23 20:21:35', NULL),
(2, 2, 'Dr. Pambudi', '2021-12-23 20:21:35', NULL),
(3, 2, 'Dr. Nur', '2021-12-23 20:21:35', NULL),
(4, 3, 'Dr. Nur', '2021-12-23 20:44:04', NULL),
(5, 3, 'Dr. Pambudi', '2021-12-23 20:44:04', NULL),
(6, 3, 'Dr. Ahmad Dahlan', '2021-12-23 20:44:04', NULL),
(7, 4, 'Dr. Ahmad Dahlan', '2021-12-23 20:46:19', NULL),
(8, 4, 'Dr. Ahmad Dahlan II', '2021-12-23 20:46:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_token`
--

CREATE TABLE `app_token` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL,
  `ip` varchar(50) NOT NULL,
  `users_agent` varchar(155) NOT NULL,
  `token` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit`
--

CREATE TABLE `audit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audit_date` datetime DEFAULT NULL,
  `audit_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audit_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audit_leader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siklus_number` int(11) DEFAULT NULL,
  `siklus_year` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_publish` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `audit`
--

INSERT INTO `audit` (`id`, `name`, `purpose`, `audit_date`, `audit_area`, `audit_by`, `audit_leader`, `siklus_number`, `siklus_year`, `status`, `created_at`, `updated_at`, `fakultas_id`, `unit`, `code`, `template_code`, `status_publish`, `deleted_at`) VALUES
(2, 'Laporan Audit Mutu Internal (2019-II)', 'Konfirmasi kelengkapan dokumen 9 kriteria APS 4.0', '2021-12-24 00:00:00', '9 kriteria APS 4.0', '5', '4', 1, 2021, 'On Progres', '2021-12-23 20:21:35', NULL, 1, 'Fakultas', NULL, NULL, 'Published', NULL),
(3, 'Laporan Audit Mutu Internal (2019-II)', 'Konfirmasi kelengkapan dokumen 9 kriteria APS 4.0', '2021-12-24 00:00:00', '9 kriteria APS 4.0', '5', '4', 1, 2021, 'On Progres', '2021-12-23 20:44:04', NULL, 1, NULL, 'PLK0123901823', NULL, NULL, '2021-12-24 03:45:32'),
(4, 'Laporan Audit Mutu Internal (2019-III)', 'Konfirmasi kelengkapan dokumen 9 kriteria APS 4.0', '2021-12-31 00:00:00', '9 kriteria APS 4.0', '5', '4', 2, 2021, 'On Progres', '2021-12-23 20:46:19', NULL, 1, 'Progdi', 'CT9000414812', NULL, 'Published', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cms_menus`
--

CREATE TABLE `cms_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sorting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cms_menus`
--

INSERT INTO `cms_menus` (`id`, `created_at`, `updated_at`, `name`, `icon`, `path`, `parent_id`, `sorting`) VALUES
(41, '2021-12-10 02:19:20', '2021-12-10 10:27:39', 'Dashboard', 'icon-home4', 'dashboard', 0, 1),
(42, '2021-12-10 03:15:51', '2021-12-10 10:51:17', 'Pelaksanaan', 'icon-list', 'pelaksanaan', 0, 2),
(43, '2021-12-10 03:47:51', '2021-12-24 03:48:53', 'Riwayat', 'icon-files-empty2', 'riwayat', 0, 4),
(44, '2021-12-10 03:50:07', '2021-12-24 04:56:00', 'My Account', 'icon-user', 'akun', 0, 7),
(45, '2021-12-19 11:04:28', '2021-12-22 08:37:22', 'Fakultas', 'icon-cube3', 'fakultas', 50, 1),
(46, '2021-12-20 11:25:29', '2021-12-24 04:56:00', 'User Management', 'icon-users', '#', 0, 5),
(47, '2021-12-20 11:25:47', '2021-12-20 18:26:19', 'Auditor', 'fa fa-users', 'auditor', 46, 1),
(48, '2021-12-20 11:26:01', '2021-12-20 18:26:29', 'Auditee', 'icon-user', 'auditee', 46, 2),
(49, '2021-12-20 11:26:13', '2021-12-20 18:26:41', 'Visitor', 'icon-users', 'visitor', 46, 3),
(50, '2021-12-22 01:36:45', '2021-12-24 04:56:00', 'Master', 'icon-cube3', 'javascript:;', 0, 6),
(51, '2021-12-22 01:37:16', '2021-12-22 08:37:26', 'Program Study', 'icon-cube3', 'progdi', 50, 2),
(52, '2021-12-22 08:06:30', '2021-12-22 15:07:08', 'Lembaga', 'icon-cube3', 'lembaga', 50, 3),
(53, '2021-12-22 08:06:41', '2021-12-22 15:07:12', 'Biro', 'icon-cube3', 'biro', 50, 4),
(54, '2021-12-22 08:06:51', '2021-12-22 15:07:20', 'UPT', 'icon-cube3', 'upt', 50, 5),
(55, '2021-12-22 08:07:02', '2021-12-22 15:07:22', 'Lab', 'icon-cube3', 'lab', 50, 6),
(56, '2021-12-23 20:48:39', '2021-12-24 03:48:53', 'Penjadwalan', 'icon-calendar', 'penjadwalan', 0, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cms_privileges`
--

CREATE TABLE `cms_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_superadmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cms_privileges`
--

INSERT INTO `cms_privileges` (`id`, `created_at`, `updated_at`, `name`, `is_superadmin`) VALUES
(1, '2021-07-01 00:32:10', '2021-07-01 06:02:18', 'Superadmin', 1),
(2, '2021-12-21 09:50:42', '2021-12-21 09:50:42', 'Auditor', 0),
(3, '2021-12-21 09:50:42', '2021-12-21 09:50:42', 'Auditee', 0),
(4, '2021-12-21 09:50:50', '2021-12-21 09:50:50', 'Visitor', 0),
(6, '2021-12-23 19:45:18', '2021-12-24 02:45:18', 'LPM', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cms_privileges_roles`
--

CREATE TABLE `cms_privileges_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_cms_privileges` bigint(20) UNSIGNED NOT NULL,
  `id_cms_menus` bigint(20) UNSIGNED NOT NULL,
  `can_view` int(11) NOT NULL,
  `can_add` int(11) NOT NULL,
  `can_edit` int(11) NOT NULL,
  `can_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cms_privileges_roles`
--

INSERT INTO `cms_privileges_roles` (`id`, `created_at`, `updated_at`, `id_cms_privileges`, `id_cms_menus`, `can_view`, `can_add`, `can_edit`, `can_delete`) VALUES
(16, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 41, 1, 1, 1, 1),
(17, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 45, 1, 1, 1, 1),
(18, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 47, 1, 1, 1, 1),
(19, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 42, 1, 1, 1, 1),
(20, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 48, 1, 1, 1, 1),
(21, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 51, 1, 1, 1, 1),
(22, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 49, 1, 1, 1, 1),
(23, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 52, 1, 1, 1, 1),
(24, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 56, 1, 1, 1, 1),
(25, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 43, 1, 1, 1, 1),
(26, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 53, 1, 1, 1, 1),
(27, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 44, 1, 1, 1, 1),
(28, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 54, 1, 1, 1, 1),
(29, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 46, 1, 1, 1, 1),
(30, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 55, 1, 1, 1, 1),
(31, '2021-12-23 21:40:01', '2021-12-24 04:40:01', 6, 50, 1, 1, 1, 1),
(32, '2021-12-23 21:40:13', '2021-12-24 04:40:13', 4, 42, 1, 1, 1, 1),
(33, '2021-12-23 21:40:13', '2021-12-24 04:40:13', 4, 44, 1, 1, 1, 1),
(34, '2021-12-23 21:40:25', '2021-12-24 04:40:25', 3, 42, 1, 1, 1, 1),
(35, '2021-12-23 21:40:25', '2021-12-24 04:40:25', 3, 44, 1, 1, 1, 1),
(38, '2021-12-23 21:40:39', '2021-12-24 04:40:39', 2, 42, 1, 1, 1, 1),
(39, '2021-12-23 21:40:39', '2021-12-24 04:40:39', 2, 44, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cms_users`
--

CREATE TABLE `cms_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cms_users`
--

INSERT INTO `cms_users` (`id`, `created_at`, `updated_at`, `name`, `email`, `foto`, `password`, `username`, `id_cms_privileges`, `status`, `photo`, `signature`, `position`, `unit`) VALUES
(1, '2021-07-01 03:10:09', '2021-12-22 19:55:12', 'Crocodic Studi', 'superadmin@crocodic.com', 'uploads/2021-12/80864.jpg', '$2y$10$Y7QN.lXdQ9.C2HBO5EcXzeEMiV2EGaFYewCcim88NIE8XYfB2gUci', NULL, 1, 'Active', NULL, NULL, NULL, NULL),
(2, '2021-12-21 09:39:10', '2021-12-21 16:39:10', 'Adam Projo Setiyo Budi', 'adam@crocodic.com', 'uploads/2021-12/80864.jpg', '$2y$10$rD.iwJEzgYde1cvEdmDrxezMImrzUpqtjCW5BOqEi3VJC/y/B21bO', 'auditor002', 2, 'Active', NULL, 'uploads/2021-12/63877.jpg', NULL, NULL),
(4, '2021-12-22 04:24:25', '2021-12-24 03:04:28', 'Dr. Adam Projo Setiyo Budi', 'adam12@crocodic.com', 'uploads/2021-12/33835.jpg', '$2y$10$qnjwv0yzRyoNPFQlXVhnw.z29cA17pOCFi9nqZ/Sda.kS9qRPWrdy', 'aud012391', 2, 'Active', NULL, 'uploads/2021-12/34567.jpg', NULL, NULL),
(5, '2021-12-22 04:25:19', '2021-12-22 11:26:15', 'Adam Auditee', 'ada@coroc.dom', 'uploads/2021-12/18419.jpg', '$2y$10$ehjpsYOWOmpURqhg95zkbOAWuXUuwdB1a1DQVwYKea1FrxPSO/tvu', 'audti23123', 3, 'Active', NULL, 'uploads/2021-12/82550.jpg', NULL, 'Fakultas'),
(6, '2021-12-22 06:28:14', '2021-12-22 13:28:14', 'Adam Guru Baru', 'newadamtest@gmail.com', 'uploads/2021-12/88976.jpg', '$2y$10$nXEEAjOCt2MYd1.Ch8Ld6.nyiHi/0hwwXxPtnwtF7lrBS0gtadXdm', 'Ig7X6', 4, 'Active', NULL, NULL, NULL, 'Fakultas'),
(9, '2021-12-23 19:46:28', '2021-12-24 02:46:28', 'Admin LPM', 'admin@siami.com', 'uploads/2021-12/55691.jpg', '$2y$10$o4sRqKuHpVfwq4Ej05Foue7kAXT8cwH9jJ8MlLR0bo32qml5p/xLe', NULL, 6, 'Active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_biro`
--

CREATE TABLE `master_biro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_biro`
--

INSERT INTO `master_biro` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Biru keungan (BIKU)', '2021-12-22 10:03:53', NULL),
(2, 'Biro admisi dan promosi', '2021-12-22 10:04:03', NULL),
(3, 'Biro kemahasiswaan (BIMA)', '2021-12-22 10:04:11', NULL),
(4, 'LPM', '2021-12-23 19:40:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_fakultas`
--

CREATE TABLE `master_fakultas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_fakultas`
--

INSERT INTO `master_fakultas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ilmu komputer', '2021-12-19 11:47:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_lab`
--

CREATE TABLE `master_lab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_lab`
--

INSERT INTO `master_lab` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lab 1', '2021-12-22 11:41:08', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_lembaga`
--

CREATE TABLE `master_lembaga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_lembaga`
--

INSERT INTO `master_lembaga` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lembaga Update', '2021-12-22 09:22:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_progdi`
--

CREATE TABLE `master_progdi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_progdi`
--

INSERT INTO `master_progdi` (`id`, `fakultas_id`, `name`, `created_at`, `updated_at`, `jenjang`) VALUES
(1, 1, 'SBMPTN 2018', '2021-12-22 01:49:19', NULL, 'Sarjana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_upt`
--

CREATE TABLE `master_upt` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_upt`
--

INSERT INTO `master_upt` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'UPT layanan karir dan alumni', '2021-12-22 10:24:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_19_165452_audit', 1),
(6, '2021_12_19_173414_add_field_audit', 2),
(7, '2021_12_19_173555_master_fakultas', 2),
(8, '2021_12_19_173700_master_progdi', 2),
(9, '2021_12_20_181301_users_add_field', 3),
(10, '2021_12_21_162640_cms_users_add_field', 4),
(11, '2021_12_22_134359_master_progdi_add_field', 5),
(12, '2021_12_22_143439_master_lembaga', 6),
(13, '2021_12_22_143555_master_biro', 6),
(14, '2021_12_22_143624_master_upt', 6),
(15, '2021_12_22_143640_master_lab', 6),
(16, '2021_12_22_193016_audit_add_field', 7),
(17, '2021_12_24_030511_create_anggota_auditor', 7);

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `username`, `remember_token`, `created_at`, `updated_at`, `photo`, `signature`, `position`, `unit`) VALUES
(1, 'Adam Projo Setiyo Budi', 'adam@crocodic.com', NULL, '$2y$10$GNRKiwbN0fUOg1N.6IxIv.NQpbXSDyAMUS7UmaZoUsjkyeTWDIVGW', 'adamBro', NULL, '2021-12-20 12:12:11', NULL, 'uploads/2021-12/96922.jpg', 'uploads/2021-12/97121.jpg', 'Auditor', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_auditor`
--
ALTER TABLE `anggota_auditor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_token`
--
ALTER TABLE `app_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cms_menus`
--
ALTER TABLE `cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cms_privileges`
--
ALTER TABLE `cms_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_privileges_roles_id_cms_privileges_foreign` (`id_cms_privileges`),
  ADD KEY `cms_privileges_roles_id_cms_menus_foreign` (`id_cms_menus`);

--
-- Indeks untuk tabel `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_users_id_cms_privileges_foreign` (`id_cms_privileges`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `master_biro`
--
ALTER TABLE `master_biro`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_fakultas`
--
ALTER TABLE `master_fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_lab`
--
ALTER TABLE `master_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_lembaga`
--
ALTER TABLE `master_lembaga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_progdi`
--
ALTER TABLE `master_progdi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_upt`
--
ALTER TABLE `master_upt`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_auditor`
--
ALTER TABLE `anggota_auditor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `app_token`
--
ALTER TABLE `app_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `audit`
--
ALTER TABLE `audit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cms_menus`
--
ALTER TABLE `cms_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `cms_privileges`
--
ALTER TABLE `cms_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_biro`
--
ALTER TABLE `master_biro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_fakultas`
--
ALTER TABLE `master_fakultas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_lab`
--
ALTER TABLE `master_lab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_lembaga`
--
ALTER TABLE `master_lembaga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_progdi`
--
ALTER TABLE `master_progdi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_upt`
--
ALTER TABLE `master_upt`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  ADD CONSTRAINT `cms_privileges_roles_id_cms_menus_foreign` FOREIGN KEY (`id_cms_menus`) REFERENCES `cms_menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_privileges_roles_id_cms_privileges_foreign` FOREIGN KEY (`id_cms_privileges`) REFERENCES `cms_privileges` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cms_users`
--
ALTER TABLE `cms_users`
  ADD CONSTRAINT `cms_users_id_cms_privileges_foreign` FOREIGN KEY (`id_cms_privileges`) REFERENCES `cms_privileges` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
