-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2023 pada 13.25
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19907892_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_dosen`
--


CREATE TABLE `m_dosen` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `m_dosen`
--

INSERT INTO `m_dosen` (`id`, `id_dosen`, `nama_dosen`) VALUES
(1, 427087803, 'Agus Ramdhani, MT.'),
(2, 412029001, 'Nanang Durahman, M.Kom'),
(3, 418096501, 'Budi Djatmiko, PhD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_mahasiswa`
--

CREATE TABLE `m_mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` int(10) NOT NULL,
  `nm_mhs` varchar(255) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `m_mahasiswa`
--

INSERT INTO `m_mahasiswa` (`id`, `nim`, `nm_mhs`, `jk`, `alamat`) VALUES
(1, 11210001, 'Adi Nurul', 'L', 'Jl Merdeka No 22 Tasikmalaya'),
(2, 11210002, 'Budi Setiawan', 'L', 'Jl Mangkubumi No 4 Tasikmalaya'),
(3, 11210003, 'Cepi Ridwan', 'L', 'Jl Ahmad Yani No 9 Ciamis'),
(4, 32210001, 'Dadang Sutisan', 'L', 'Jl Singaparna Km 4'),
(5, 32210001, 'Erwin Maulana', 'L', 'Jl Tasik - Ciamis No 6 Ciamis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_matakuliah`
--

CREATE TABLE `m_matakuliah` (
  `id` int(11) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(3) NOT NULL,
  `sem` int(3) NOT NULL,
  `id_dosen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `m_matakuliah`
--

INSERT INTO `m_matakuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `sem`, `id_dosen`) VALUES
(1, 'TI-1101', 'PANCASILA', 2, 1, '0427087803'),
(2, 'TI-1102', 'AGAMA', 2, 1, '0412029001'),
(3, 'TI-1103', 'KALKULUS 1', 3, 1, '0418096501');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pengguna`
--

CREATE TABLE `m_pengguna` (
  `id` int(11) NOT NULL,
  `kode_op` varchar(10) NOT NULL,
  `nama_op` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `m_pengguna`
--

INSERT INTO `m_pengguna` (`id`, `kode_op`, `nama_op`, `pass`, `level`) VALUES
(1, 'OP-01', 'Jurusan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Operator'),
(2, 'admin', 'Administrator', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nim` int(10) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `nilai` varchar(1) NOT NULL,
  `thn_akademik` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `nim`, `kode_mk`, `nilai`, `thn_akademik`) VALUES
(1, 11210002, 'TI-1101', 'A', '2022/2023'),
(2, 11210002, 'TI-1102', 'B', '2022/2023'),
(3, 11210001, 'TI-1101', 't', '2022/2024'),
(4, 11210001, 'TI-1103', 'c', '2022/2026'),
(5, 11210003, 'TI-1101', 'C', '2022/2023'),
(11, 11210001, 'TI-1103', 'W', '2024'),
(12, 11210003, 'TI-1103', 'Z', '2024');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `m_dosen`
--
ALTER TABLE `m_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_matakuliah`
--
ALTER TABLE `m_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_pengguna`
--
ALTER TABLE `m_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_op` (`kode_op`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `m_dosen`
--
ALTER TABLE `m_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `m_matakuliah`
--
ALTER TABLE `m_matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_pengguna`
--
ALTER TABLE `m_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
