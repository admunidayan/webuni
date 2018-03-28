-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Mar 2018 pada 12.02
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL,
  `nm_bulan` varchar(20) DEFAULT NULL,
  `kode_bulan` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nm_bulan`, `kode_bulan`) VALUES
(1, 'Januari', '01'),
(2, 'Februari', '02'),
(3, 'Maret', '03'),
(4, 'April', '04'),
(5, 'Mei', '05'),
(6, 'Juni', '06'),
(7, 'Juli', '07'),
(8, 'Agustus', '08'),
(9, 'September', '09'),
(10, 'Oktober', '10'),
(11, 'November', '11'),
(12, 'Desember', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'pegawai bagian pelayanan'),
(3, 'pelanggan', 'pelanggan teregistrasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_pt`
--

CREATE TABLE `info_pt` (
  `id_info_pt` int(11) NOT NULL,
  `nama_info_pt` varchar(114) DEFAULT NULL,
  `kode_pt` varchar(114) DEFAULT NULL,
  `kontak_1` varchar(114) DEFAULT NULL,
  `kontak_2` varchar(114) DEFAULT NULL,
  `kontak_3` varchar(114) DEFAULT NULL,
  `kontak_4` varchar(114) DEFAULT NULL,
  `header_pt` varchar(114) NOT NULL,
  `footer_pt` text,
  `alamat_pt` varchar(114) DEFAULT NULL,
  `slogan` varchar(114) DEFAULT NULL,
  `logo_pt` varchar(114) DEFAULT NULL,
  `logo_kecil_pt` varchar(114) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_pt`
--

INSERT INTO `info_pt` (`id_info_pt`, `nama_info_pt`, `kode_pt`, `kontak_1`, `kontak_2`, `kontak_3`, `kontak_4`, `header_pt`, `footer_pt`, `alamat_pt`, `slogan`, `logo_pt`, `logo_kecil_pt`) VALUES
(1, 'Green Skin Care', '123123123123', '0823456765', '0823456764', '0823456762', '08234567643', '', 'Terima kasih atas kunjungan anda, silahkan mampir lagi nanti :)', 'Jalan Sultan Hasanuddin No 26. Baubau', 'Green Skin Care', 'logo-green-skin-care-20180226-1519645545.png', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(114) NOT NULL,
  `kode_kategori` varchar(114) NOT NULL,
  `ket_kategori` varchar(114) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kode_kategori`, `ket_kategori`) VALUES
(1, 'tabir surya ( sunblock )', 'obatbebas', '-'),
(2, 'Obat bebas terbatas', 'obatbebasterbatas', '-'),
(3, 'Obat keras', 'obatkeras', '-'),
(4, 'Obat narkotika', 'obatnarkotika', '-'),
(5, 'Obat Psikotropika', 'obatpsikotropika', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laku_per_hari`
--

CREATE TABLE `laku_per_hari` (
  `id_laku_per_hari` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `tgl_laku` date NOT NULL,
  `jml_laku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laku_per_hari`
--

INSERT INTO `laku_per_hari` (`id_laku_per_hari`, `id_menu`, `tgl_laku`, `jml_laku`) VALUES
(1, 6, '2018-02-28', 3),
(2, 7, '2018-02-28', 3),
(3, 8, '2018-02-28', 1),
(4, 13, '2018-02-28', 1),
(5, 12, '2018-02-28', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(114) NOT NULL,
  `tgl_lahir_member` varchar(50) NOT NULL,
  `tmpt_lahir_member` varchar(50) NOT NULL,
  `kode_member` varchar(8) NOT NULL,
  `hp_member` varchar(15) NOT NULL,
  `nik_member` varchar(114) NOT NULL,
  `tgl_create` varchar(20) NOT NULL,
  `alamat_member` varchar(114) NOT NULL,
  `status_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nm_member`, `tgl_lahir_member`, `tmpt_lahir_member`, `kode_member`, `hp_member`, `nik_member`, `tgl_create`, `alamat_member`, `status_member`) VALUES
(1, 'Reza Rafiq MZ', '1993-12-24', 'BAUBAU', '00000001', '082395606666', '1234543132456', '2018-02-26', 'Jalan Sultan Hasanuddin 26 Baubau, Batulo', 1),
(2, 'Krisnilda', '1993-05-07', 'Lombok', '00000002', '082395606666', '343242392394293', '2018-02-26', 'Jalan Gadjha Madda, Pimpi Atas', 1),
(3, 'Yusrin Razikun', '1004-03-03', 'BAUBAU', '00000003', '082395601234', '432342436646778', '2018-03-01', 'jalan burasa tongka', 1),
(4, 'Putri Ayu Lestari', '1994-05-13', 'BAUBAU', '00000004', '082395601234', '1234543132456', '2018-03-01', 'Jalan Perintis', 1),
(5, 'Putri Agus Cahyawati', '1994-04-12', 'BAUBAU', '00000005', '082395601234', '1234543132456', '2018-03-01', 'jalan perintis', 1),
(6, 'Sam Sahri Saharuddin', '1994-11-04', 'BAUBAU', '00000006', '082395601234', '1234543132456', '2018-03-01', 'BTN Medibrata blok B no 20', 1),
(7, 'Chusnul Qhotimah', '1994-02-10', 'WANCI', '00000007', '082395601234', '1234543132456', '2018-03-01', 'jalan perintis', 1),
(8, 'La Ode Azhar Annas', '1994-04-23', 'BAUBAU', '00000008', '082395601234', '759811231212', '2018-03-01', 'Bure', 1),
(9, 'Ilham Gafur Aego', '1995-12-28', 'BAUBAU', '00000009', '082395601234', '78347234273472', '2018-03-01', 'Keraton atas', 1),
(10, 'Annisyah', '1994-02-02', 'BAUBAU', '00000010', '082395601234', '7685844894859', '2018-03-01', 'jalan laode boha', 1),
(11, 'Sitti Sarifa Rahma', '1994-09-11', 'BAUBAU', '00000011', '082395601234', '7685844894859', '2018-03-01', 'lamangga atas', 1),
(12, 'Halim Putra Setiawan', '1994-04-04', 'BAUBAU', '00000012', '082395601234', '1234543132456', '2018-03-01', 'Pancarasa Baubau', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(114) NOT NULL,
  `kode_menu` varchar(114) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `harga_member` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `ket_menu` varchar(114) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `kode_menu`, `id_kategori`, `stok`, `harga_satuan`, `harga_member`, `diskon`, `ket_menu`) VALUES
(1, 'Parasetamol', '123123', 1, 28, 4000, 4000, 0, 'obat'),
(2, 'Livron B Plex', '5345345', 1, 85, 10000, 9000, 0, 'obat'),
(3, 'Asam Ursodeoksikolat', '2345345', 3, 46, 5000, 5000, 0, '-'),
(4, 'Isosorbide Dinitrate', '564634536', 2, 45, 10000, 9000, 0, '-'),
(6, 'ACARBOSE 100MG DX', '2134232', 1, 46, 21000, 19000, 3, '-'),
(7, 'ALLOHEX TAB', '123123', 2, 71, 36000, 32000, 0, '-'),
(8, 'ALOFAR 300', '12341234', 3, 45, 3700, 3700, 0, '-'),
(9, 'AMOXICILIN 500 PHARMA', '343242', 1, 588, 4000, 4000, 0, '-'),
(10, 'AMOXICILLIN 500 MG MERSI', '1231234', 1, 774, 4000, 4000, 0, '-'),
(11, 'AMOXICILLIN DS 125MG/5ML 60 ML', '234234', 1, 786, 4000, 4000, 0, '-'),
(12, 'AZITHROMYCIN', '12312414', 1, 541, 176000, 150000, 0, '-'),
(13, 'SBW', '123456234', 1, 4, 125000, 100000, 50, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_to_nota`
--

CREATE TABLE `menu_to_nota` (
  `id_menu_to_nota` int(11) NOT NULL,
  `id_nota` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jml_menu` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_to_nota`
--

INSERT INTO `menu_to_nota` (`id_menu_to_nota`, `id_nota`, `id_menu`, `jml_menu`, `tgl_bayar`, `total_bayar`, `id_status`) VALUES
(1, 3, 1, 2, '2018-02-17', 8000, 1),
(2, 3, 2, 2, '2018-02-17', 20000, 1),
(3, 3, 2, 1, '2018-02-17', 10000, 1),
(4, 4, 1, 1, '2018-02-17', 4000, 1),
(5, 4, 2, 1, '2018-02-17', 10000, 1),
(7, 5, 3, 1, '2018-02-18', 5000, 1),
(10, 6, 2, 1, '2018-02-18', 10000, 2),
(11, 6, 1, 1, '2018-02-18', 4000, 2),
(12, 6, 3, 1, '2018-02-18', 5000, 2),
(13, 5, 3, 1, '2018-02-18', 5000, 1),
(14, 5, 2, 1, '2018-02-18', 10000, 1),
(15, 5, 1, 1, '2018-02-18', 4000, 1),
(16, 5, 4, 1, '2018-02-18', 10000, 1),
(17, 16, 1, 1, '2018-02-18', 4000, 2),
(18, 16, 2, 1, '2018-02-18', 10000, 2),
(19, 16, 3, 1, '2018-02-18', 5000, 2),
(20, 16, 4, 1, '2018-02-18', 10000, 2),
(21, 16, 1, 1, '2018-02-18', 4000, 2),
(22, 15, 1, 10, '2018-02-18', 40000, 2),
(23, 15, 3, 1, '2018-02-18', 5000, 2),
(24, 15, 2, 1, '2018-02-18', 10000, 2),
(25, 15, 4, 1, '2018-02-18', 10000, 2),
(26, 17, 3, 1, '2018-02-18', 5000, 2),
(27, 17, 2, 1, '2018-02-18', 10000, 2),
(28, 17, 1, 1, '2018-02-18', 4000, 2),
(29, 17, 4, 1, '2018-02-18', 10000, 2),
(30, 14, 6, 1, '2018-02-18', 21000, 2),
(31, 13, 8, 1, '2018-02-18', 3700, 2),
(32, 13, 9, 1, '2018-02-18', 4000, 2),
(33, 13, 10, 1, '2018-02-18', 4000, 2),
(34, 12, 2, 1, '2018-02-18', 10000, 2),
(35, 12, 10, 1, '2018-02-18', 4000, 2),
(36, 12, 11, 1, '2018-02-18', 4000, 2),
(37, 11, 8, 1, '2018-02-18', 3700, 2),
(38, 11, 9, 10, '2018-02-18', 40000, 2),
(39, 10, 8, 1, '2018-02-18', 3700, 2),
(40, 10, 10, 1, '2018-02-18', 4000, 2),
(41, 10, 11, 1, '2018-02-18', 4000, 2),
(42, 9, 12, 1, '2018-02-18', 176000, 2),
(43, 8, 12, 2, '2018-02-18', 352000, 2),
(44, 7, 2, 1, '2018-02-18', 10000, 2),
(45, 7, 4, 1, '2018-02-18', 10000, 2),
(46, 6, 3, 1, '2018-02-18', 5000, 2),
(47, 18, 12, 1, '2018-02-18', 176000, 2),
(48, 18, 1, 1, '2018-02-18', 4000, 2),
(49, 18, 6, 1, '2018-02-18', 21000, 2),
(50, 19, 6, 1, '2018-02-19', 21000, 2),
(51, 19, 7, 1, '2018-02-19', 36000, 2),
(52, 19, 8, 2, '2018-02-19', 7400, 2),
(53, 20, 13, 1, '2018-02-19', 120000, 2),
(54, 21, 6, 1, '2018-02-25', 21000, 2),
(55, 21, 7, 1, '2018-02-25', 36000, 2),
(56, 21, 8, 1, '2018-02-25', 3700, 2),
(57, 21, 9, 1, '2018-02-25', 4000, 2),
(61, 21, 13, 1, '2018-02-25', 62500, 2),
(67, 24, 12, 1, '2018-02-26', 150000, 2),
(68, 24, 6, 1, '2018-02-26', 19000, 2),
(69, 24, 13, 1, '2018-02-26', 50000, 2),
(74, 26, 6, 1, '2018-02-26', 21000, 2),
(75, 26, 7, 1, '2018-02-26', 36000, 2),
(76, 26, 8, 1, '2018-02-26', 3700, 2),
(77, 26, 13, 1, '2018-02-26', 62500, 2),
(78, 27, 6, 1, '2018-02-28', 21000, 2),
(79, 27, 13, 1, '2018-02-28', 62500, 2),
(80, 28, 6, 1, '2018-02-28', 20370, 2),
(81, 28, 7, 1, '2018-02-28', 36000, 2),
(82, 28, 8, 1, '2018-02-28', 3700, 2),
(83, 29, 6, 1, '2018-02-28', 20370, 2),
(84, 29, 7, 1, '2018-02-28', 36000, 2),
(85, 30, 6, 1, '2018-02-28', 20370, 2),
(86, 31, 6, 1, '2018-02-28', 18430, 2),
(87, 31, 7, 2, '2018-02-28', 64000, 2),
(88, 31, 13, 1, '2018-02-28', 50000, 2),
(89, 32, 12, 3, '2018-02-28', 450000, 2),
(90, 33, 12, 3, '2018-02-28', 450000, 2),
(91, 35, 7, 1, '2018-03-01', 32000, 1),
(92, 35, 8, 1, '2018-03-01', 3700, 1),
(93, 35, 12, 4, '2018-03-01', 600000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_member` int(11) NOT NULL DEFAULT '0',
  `tgl_nota` date DEFAULT NULL,
  `jam_nota` time NOT NULL,
  `total_bayar_nota` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `ket_nota` varchar(114) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_user`, `id_member`, `tgl_nota`, `jam_nota`, `total_bayar_nota`, `jumlah_bayar`, `kembalian`, `ket_nota`, `id_status`) VALUES
(1, 1, 0, '2018-02-16', '00:00:00', 0, 0, 0, NULL, 1),
(2, 1, 0, '2018-02-16', '00:00:00', 0, 0, 0, NULL, 1),
(3, 1, 0, '2018-02-17', '00:00:00', 0, 0, 0, NULL, 1),
(4, 1, 0, '2018-02-17', '00:00:00', 0, 0, 0, NULL, 1),
(5, 1, 0, '2018-02-18', '00:00:00', 15000, 15000, 0, NULL, 2),
(6, 1, 0, '2018-02-18', '00:00:00', 24000, 24000, 0, NULL, 2),
(7, 1, 0, '2018-02-18', '01:01:40', 20000, 20000, 0, NULL, 2),
(8, 1, 0, '2018-02-18', '01:47:47', 352000, 352000, 0, NULL, 2),
(9, 1, 0, '2018-02-18', '01:47:52', 176000, 176000, 0, NULL, 2),
(10, 1, 0, '2018-02-18', '01:47:54', 11700, 11700, 0, NULL, 2),
(11, 1, 0, '2018-02-18', '01:47:56', 43700, 43700, 0, NULL, 2),
(12, 1, 0, '2018-02-18', '01:48:02', 18000, 18000, 0, NULL, 2),
(13, 1, 0, '2018-02-18', '01:48:04', 11700, 11700, 0, NULL, 2),
(14, 1, 0, '2018-02-18', '01:48:06', 21000, 21000, 0, NULL, 2),
(15, 1, 0, '2018-02-18', '01:48:08', 65000, 65000, 0, NULL, 2),
(16, 1, 0, '2018-02-18', '01:48:11', 33000, 33000, 0, NULL, 2),
(17, 1, 0, '2018-02-18', '10:27:39', 29000, 29000, 0, NULL, 2),
(18, 1, 0, '2018-02-18', '19:38:43', 201000, 210000, 9000, NULL, 2),
(19, 1, 0, '2018-02-19', '11:00:46', 64400, 64400, 0, NULL, 2),
(20, 1, 0, '2018-02-19', '22:06:21', 120000, 120000, 0, NULL, 2),
(21, 1, 0, '2018-02-25', '16:59:18', 127200, 127200, 0, NULL, 2),
(22, 1, 0, '2018-02-25', '23:24:50', 0, 0, 0, NULL, 1),
(24, 1, 2, '2018-02-26', '13:34:28', 219000, 300000, 81000, NULL, 2),
(26, 1, 0, '2018-02-26', '19:10:47', 123200, 123200, 0, NULL, 2),
(27, 1, 0, '2018-02-28', '12:58:34', 83500, 83500, 0, NULL, 2),
(28, 1, 0, '2018-02-28', '17:06:19', 60070, 60070, 0, NULL, 2),
(29, 1, 0, '2018-02-28', '17:30:34', 56370, 56370, 0, NULL, 2),
(30, 1, 0, '2018-02-28', '17:31:37', 20370, 20370, 0, NULL, 2),
(31, 1, 2, '2018-02-28', '19:37:34', 132430, 132430, 0, NULL, 2),
(32, 1, 2, '2018-02-28', '20:27:23', 450000, 450000, 0, NULL, 2),
(33, 2, 1, '2018-02-28', '23:15:02', 450000, 450000, 0, NULL, 2),
(34, 1, 0, '2018-02-28', '23:42:50', 0, 0, 0, NULL, 1),
(35, 1, 12, '2018-03-01', '08:17:08', 0, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `psikolog`
--

CREATE TABLE `psikolog` (
  `id_spikolog` int(11) NOT NULL,
  `nama` varchar(114) DEFAULT NULL,
  `hp` varchar(114) DEFAULT NULL,
  `email` varchar(114) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `biografi` varchar(114) DEFAULT NULL,
  `profil` varchar(114) DEFAULT NULL,
  `alamat_kantor` varchar(114) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `online` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `psikolog`
--

INSERT INTO `psikolog` (`id_spikolog`, `nama`, `hp`, `email`, `gender`, `biografi`, `profil`, `alamat_kantor`, `status`, `online`) VALUES
(1, 'Dr. Yulisna Leman', '0812345566788', 'email@email.com', 'l', 'seorang ahli kesehatan atau dokter ahli bedah Indonesia. Ia dikenal sebagai pendiri rumah sakit apung', 'avatar.png', 'tidak diisi', 1, 1),
(2, 'dr. Lie Agustinus Dharmawan, Ph.D, Sp.B, Sp.BTKV', '098274757354', 'email@email.com', 'l', 'Membantu membantu orang itu tidak boleh membeda-bedakan. Semuanya harus dilakukan dengan ikhlas', 'avatar.png', 'kantor', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(50) DEFAULT NULL,
  `ket_status` varchar(114) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `nm_status`, `ket_status`) VALUES
(1, 'Belum selesai', 'Proses belum diselesaikan'),
(2, 'Selesai', 'Proses telahdiselesaikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(11) NOT NULL,
  `kode_tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `kode_tahun`) VALUES
(1, 2018);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggal`
--

CREATE TABLE `tanggal` (
  `id_tanggal` int(11) NOT NULL,
  `kode` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanggal`
--

INSERT INTO `tanggal` (`id_tanggal`, `kode`, `total`) VALUES
(1, '2018-02-16', 0),
(2, '2018-02-17', 0),
(3, '2018-02-18', 1021100),
(4, '2018-02-19', 184400),
(5, '2018-02-25', 127200),
(6, '2018-02-26', 342200),
(7, '2018-02-28', 1300740),
(8, '2018-03-01', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_keluar`
--

CREATE TABLE `uang_keluar` (
  `id_uang_keluar` int(11) NOT NULL,
  `tgl_uang_keluar` varchar(11) NOT NULL,
  `keterangan` varchar(114) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_keluar`
--

INSERT INTO `uang_keluar` (`id_uang_keluar`, `tgl_uang_keluar`, `keterangan`, `jumlah`) VALUES
(1, '2018-02-28', 'beli galon', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_masuk`
--

CREATE TABLE `uang_masuk` (
  `id_uang_masuk` int(11) NOT NULL,
  `tgl_uang_masuk` varchar(11) NOT NULL,
  `keterangan` varchar(114) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_masuk`
--

INSERT INTO `uang_masuk` (`id_uang_masuk`, `tgl_uang_masuk`, `keterangan`, `jumlah`) VALUES
(1, '2018-02-28', 'uang kasir', 50000),
(2, '2018-02-28', 'kembalian bahan', 5000),
(3, '2018-03-01', 'uang kasir', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `repassword` varchar(114) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile` varchar(114) NOT NULL DEFAULT 'avatar.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `repassword`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `profile`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$LIBnsH4/BHMG694qev808.u3E8/kttNM1pnVDIKwseN.5UQyGIz/2', 'password', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1519901680, 1, 'Admin', 'istrator', 'ADMIN', '0', 'avatar.jpg'),
(2, '::1', 'ejhayoe', '$2y$08$WTg62wM1uPBqDpkLAlel7uIwUkuBlGFRzMO0gBfBjhNzMe5leLhEq', 'ejhayoe', NULL, 'ejhayoe@gmail.com', NULL, NULL, NULL, NULL, 1519035265, 1519866065, 1, 'Reza', 'Rafiq', 'Apotek', '123456789', 'avatar.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(15, 1, 1),
(13, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_pt`
--
ALTER TABLE `info_pt`
  ADD PRIMARY KEY (`id_info_pt`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laku_per_hari`
--
ALTER TABLE `laku_per_hari`
  ADD PRIMARY KEY (`id_laku_per_hari`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_to_nota`
--
ALTER TABLE `menu_to_nota`
  ADD PRIMARY KEY (`id_menu_to_nota`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `psikolog`
--
ALTER TABLE `psikolog`
  ADD PRIMARY KEY (`id_spikolog`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `tanggal`
--
ALTER TABLE `tanggal`
  ADD PRIMARY KEY (`id_tanggal`);

--
-- Indexes for table `uang_keluar`
--
ALTER TABLE `uang_keluar`
  ADD PRIMARY KEY (`id_uang_keluar`);

--
-- Indexes for table `uang_masuk`
--
ALTER TABLE `uang_masuk`
  ADD PRIMARY KEY (`id_uang_masuk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `info_pt`
--
ALTER TABLE `info_pt`
  MODIFY `id_info_pt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `laku_per_hari`
--
ALTER TABLE `laku_per_hari`
  MODIFY `id_laku_per_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `menu_to_nota`
--
ALTER TABLE `menu_to_nota`
  MODIFY `id_menu_to_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `psikolog`
--
ALTER TABLE `psikolog`
  MODIFY `id_spikolog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tanggal`
--
ALTER TABLE `tanggal`
  MODIFY `id_tanggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `uang_keluar`
--
ALTER TABLE `uang_keluar`
  MODIFY `id_uang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `uang_masuk`
--
ALTER TABLE `uang_masuk`
  MODIFY `id_uang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
