-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Mar 2026 pada 20.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kantorpos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `kd_disposisi` varchar(30) NOT NULL,
  `kd_surat_masuk` varchar(40) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status_surat` varchar(30) NOT NULL,
  `tanggapan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`kd_disposisi`, `kd_surat_masuk`, `penerima`, `keterangan`, `status_surat`, `tanggapan`) VALUES
('DP-20260207-004', 'SM-20260207-002', 'Ega', 'sdfsdf', 'Selesai', 'sdfsd'),
('DP-20260225-001', 'SM-20260207-002', 'sultan', 'ffff', 'Selesai', 'fff'),
('DP-20260226-001', 'SM-20260225-001', 'sdefsf', 'sdfdsf', 'Diproses', 'sdfsdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `kd_petugas` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`kd_petugas`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `alamat`) VALUES
('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Rafi', 'L', 'Jl.rawasakti I0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `kd_surat_keluar` varchar(30) NOT NULL,
  `kd_petugas` varchar(11) NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `prihal` varchar(255) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `tanggal_kirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`kd_surat_keluar`, `kd_petugas`, `no_agenda`, `no_surat`, `prihal`, `jenis_surat`, `tujuan`, `alamat_tujuan`, `tanggal_kirim`) VALUES
('SK-20260205', '1', '1', '12', '12u', '213', 'buat org gila', 'ke lingke', '2026-02-11'),
('SK-20260205-001', '1', '2', 'fdsjhakhfash', 'epep', 'penting', 'org gila', 'psngo', '2026-02-22'),
('SK-20260207-001', '1', '3', '123', 'mau main eppep', 'penting', 'buat org', 'pango', '2026-02-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `kd_surat_masuk` varchar(30) NOT NULL,
  `kd_petugas` varchar(11) NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `prihal` varchar(255) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`kd_surat_masuk`, `kd_petugas`, `no_agenda`, `no_surat`, `prihal`, `jenis_surat`, `pengirim`, `tanggal_surat`, `tanggal_terima`) VALUES
('SM-20260207-002', '1', '2', '17171717', 'mau main eppep', 'penting', 'sultan', '2026-02-09', '2026-03-06'),
('SM-20260225-001', '1', '3', '20', 'mau main', 'tidak resmi', 'sultan', '2026-02-25', '2026-02-26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`kd_disposisi`),
  ADD KEY `kd_surat_masuk` (`kd_surat_masuk`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kd_petugas`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`kd_surat_keluar`),
  ADD KEY `kd_petugas` (`kd_petugas`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`kd_surat_masuk`),
  ADD KEY `kd_petugas` (`kd_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
