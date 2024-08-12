-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2024 pada 05.14
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sik_ps2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagan`
--

CREATE TABLE `bagan` (
  `id_bagan` int(11) NOT NULL,
  `id_pendaftaran` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kejuaraan` int(11) DEFAULT NULL,
  `babak` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(8) NOT NULL,
  `skor` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` int(11) NOT NULL,
  `id_riwayat` int(11) NOT NULL,
  `babak` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `skor` bigint(20) DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kejuaraan`
--

CREATE TABLE `kejuaraan` (
  `id_kejuaraan` int(11) NOT NULL,
  `nama_kejuaraan` varchar(255) NOT NULL,
  `seni1_putra1` int(11) DEFAULT NULL,
  `seni1_putra2` int(11) DEFAULT NULL,
  `seni1_putra3` int(11) DEFAULT NULL,
  `seni1_putri1` int(11) DEFAULT NULL,
  `seni1_putri2` int(11) DEFAULT NULL,
  `seni1_putri3` int(11) DEFAULT NULL,
  `seni2_putra1` int(11) DEFAULT NULL,
  `seni2_putra2` int(11) DEFAULT NULL,
  `seni2_putra3` int(11) DEFAULT NULL,
  `seni2_putri1` int(11) DEFAULT NULL,
  `seni2_putri2` int(11) DEFAULT NULL,
  `seni2_putri3` int(11) DEFAULT NULL,
  `seni3_putra1` int(11) DEFAULT NULL,
  `seni3_putra2` int(11) DEFAULT NULL,
  `seni3_putra3` int(11) DEFAULT NULL,
  `seni3_putri1` int(11) DEFAULT NULL,
  `seni3_putri2` int(11) DEFAULT NULL,
  `seni3_putri3` int(11) DEFAULT NULL,
  `tanding_putra1` int(11) DEFAULT NULL,
  `tanding_putra2` int(11) DEFAULT NULL,
  `tanding_putra3` int(11) DEFAULT NULL,
  `tanding_putri1` int(11) DEFAULT NULL,
  `tanding_putri2` int(11) DEFAULT NULL,
  `tanding_putri3` int(11) DEFAULT NULL,
  `waktu_awal` bigint(20) NOT NULL,
  `waktu_akhir` bigint(20) NOT NULL,
  `warna` varchar(12) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kejuaraan`
--

INSERT INTO `kejuaraan` (`id_kejuaraan`, `nama_kejuaraan`, `seni1_putra1`, `seni1_putra2`, `seni1_putra3`, `seni1_putri1`, `seni1_putri2`, `seni1_putri3`, `seni2_putra1`, `seni2_putra2`, `seni2_putra3`, `seni2_putri1`, `seni2_putri2`, `seni2_putri3`, `seni3_putra1`, `seni3_putra2`, `seni3_putra3`, `seni3_putri1`, `seni3_putri2`, `seni3_putri3`, `tanding_putra1`, `tanding_putra2`, `tanding_putra3`, `tanding_putri1`, `tanding_putri2`, `tanding_putri3`, `waktu_awal`, `waktu_akhir`, `warna`, `active`) VALUES
(1, 'Kejuaraan Pertama', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1723222800, 1723309200, '#ff5733', 0),
(2, 'Kejuaraan Kedua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1643734800, 1646067540, '#5D8AA8', 0),
(3, 'Kejuaraan Ketiga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1677776400, 1680281940, '#C70039', 0),
(4, 'Kejuaraan Keempat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1712163600, 1714496340, '#85C1A1', 0),
(5, 'Kejuaraan Kelima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1746378000, 1748710740, '#F4D35E', 0),
(6, 'UNUSIA PENCAK SILAT CHAMPIONSHIP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1723222800, 1723309200, '#077000', 1),
(7, 'UMJ OPEN V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1524762000, 1524934800, '#000000', 1),
(8, 'PESTA PENCAK SILAT UNINDRA 2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1725469200, 1725728400, '#b89000', 1),
(9, 'UIKA CHAMPIONSHIP 2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1729789200, 1729962000, '#108a00', 1),
(10, 'UMS NATIONAL CHAMPIONSHIP 2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1725210000, 1725555600, '#060cc1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kejuaraan` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `kategori` enum('Seni','Tanding') NOT NULL,
  `kelas` varchar(8) NOT NULL,
  `skor_seni` bigint(20) DEFAULT 0,
  `waktu` bigint(20) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_user`, `id_kejuaraan`, `nama`, `jenis_kelamin`, `berat_badan`, `kategori`, `kelas`, `skor_seni`, `waktu`, `approve`, `active`) VALUES
(1, 14, 6, 'Apri', 'Laki-laki', 49, 'Tanding', 'A', 0, 1723382439, 1, 1),
(2, 15, 6, 'Rully', 'Laki-laki', 48, 'Tanding', 'A', 0, 1723383309, 1, 1),
(3, 16, 6, 'Dimas', 'Laki-laki', 48, 'Tanding', 'A', 0, 1723383447, 1, 1),
(4, 17, 6, 'Adnan', 'Laki-laki', 47, 'Tanding', 'A', 0, 1723383550, 1, 1),
(5, 18, 6, 'Dangki', 'Laki-laki', 0, 'Seni', 'Tunggal', 0, 1723432098, 0, 1),
(6, 19, 6, 'Paul', 'Laki-laki', 0, 'Seni', 'Tunggal', 0, 1723432164, 0, 1),
(7, 20, 6, 'Bagas', 'Laki-laki', 0, 'Seni', 'Tunggal', 0, 1723432231, 0, 1),
(8, 21, 6, 'Bagus', 'Laki-laki', 0, 'Seni', 'Tunggal', 0, 1723432290, 0, 1),
(9, 22, 6, 'Heru', 'Laki-laki', 0, 'Seni', 'Tunggal', 0, 1723432363, 0, 1),
(10, 23, 6, 'Heri', 'Laki-laki', 0, 'Seni', 'Tunggal', 0, 1723432433, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(128) DEFAULT NULL,
  `nama_kejuaraan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(8) NOT NULL,
  `waktu_awal` varchar(12) NOT NULL,
  `waktu_akhir` varchar(12) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_kejuaraan` int(11) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 5,
  `approve` tinyint(4) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_kejuaraan`, `username`, `password`, `nama_user`, `jenis_kelamin`, `berat_badan`, `role`, `approve`, `active`) VALUES
(1, NULL, 'admin', '$2y$10$eUqGJp.0U7IIpbGJuTBy1.p7zrHLVLbbGsz1ClJU7zH3N69mCdWzG', 'Admin', NULL, NULL, 1, NULL, 1),
(2, 1, 'manager', '$2y$10$BQ1cf2nmXHZoTCmbIP5WaexOq72rHMIc/C6GdRLoh0MysteVtAvVK', 'Manager', NULL, NULL, 2, NULL, 0),
(3, 1, 'panitia1', '$2y$10$XyRXSDslykuXOvz5Ntmy1eu6NqCGdRwTrAgwBr8.b5c./DQBc11l6', 'Panitia 1', NULL, NULL, 3, 1, 0),
(4, 2, 'panitia2', '$2y$10$75C5rmfkiEtr8uoPYp8i0.1mVrPyJrfLpfraHLsg7mWOCVNaARN9m', 'Panitia 2', NULL, NULL, 3, 1, 0),
(5, 3, 'panitia3', '$2y$10$me/mCEeN/41shZtcMyLqpekEcY3k7RVvkvajp8eAV8pkPLGFELka6', 'Panitia 3', NULL, NULL, 3, 1, 0),
(6, 4, 'panitia4', '$2y$10$/1sDE6/zq4276ZKvg9sWx.yvfYtX2E36AkCS0gpdI0tTN2087IOh.', 'Panitia 4', NULL, NULL, 3, NULL, 0),
(7, 5, 'panitia5', '$2y$10$gpNTrj6LOGm3O9w0hxdZV.iAN5E7j9k.8vSyOECSIM7iv4eb2j9PO', 'Panitia 5', NULL, NULL, 3, NULL, 0),
(8, NULL, 'juri', '$2y$10$vSfAszqvy2S0mCypAjHvL.340kIrXhQ/Zprzs6OtL/pCpdphsm5JK', 'Juri', NULL, NULL, 4, NULL, 1),
(9, NULL, 'peserta1', '$2y$10$3./59O74K2EQsL7falOMKe35XMJqJde9xgEjwTCiUzBOBIrv2ZKqu', 'Peserta 1', 'Laki-laki', 63, 5, NULL, 0),
(10, NULL, 'peserta2', '$2y$10$77MYY6KaGWlnwQhBxJj3cuLKScQtKDJkog2ldf9HqaOmax/tPOZ8O', 'Peserta 2', NULL, NULL, 5, NULL, 0),
(11, NULL, 'mahakarya', '$2y$10$Tp906HdAEtLgLY1PZPz/CeCY3rcwxTCOcd67FCwvYa86XMjs.3CBu', 'Mahakarya Cakar Nusantara', NULL, NULL, 1, NULL, 1),
(12, NULL, 'bendahara', '$2y$10$nGvwNVV/N5TcBFzSLLP0muCMXhSRiCweRH4jIFf966IaP4dRowwEq', 'Bendahara', NULL, NULL, 2, NULL, 1),
(13, 6, 'panitiaunusia', '$2y$10$yu4dfIVxisdT/sAkAquM9uDOdLkEHosZnhVMVrrfOnFJpYfNgpLm6', 'Panitia UNUSIA', NULL, NULL, 3, 1, 1),
(14, NULL, 'apri', '$2y$10$V6lBPoaNTemufIS.rAF/6uk6TMDiEDdIUhZKCJJC8P0ZTyKXdF4rC', 'Apri', 'Laki-laki', 49, 5, NULL, 1),
(15, NULL, 'ruli', '$2y$10$sk.sZh9QBIY9MX.y6YCo1Oj8oygtSTNLQVJndrhK5qM6A10qlfqIK', 'Rully', 'Laki-laki', 48, 5, NULL, 1),
(16, NULL, 'dimas', '$2y$10$2nzuyhrGw/e/xKEq/wyFDe3zoP9JOKZCNMRm325/SCiL.Y58ZzJHq', 'Dimas', 'Laki-laki', 48, 5, NULL, 1),
(17, NULL, 'adnan', '$2y$10$baCldiGl6sow.F.YLf4VEOl1NdusVYnsEq7VmxJt68ePF3uIxcQ7q', 'Adnan', 'Laki-laki', 47, 5, NULL, 1),
(18, NULL, 'dangki', '$2y$10$x72jICWvvuzegqCb49hogOo51y0YOUOajm3CCJc6u6/Kjc7Xi1AY.', 'Dangki', 'Laki-laki', NULL, 5, NULL, 1),
(19, NULL, 'paul', '$2y$10$aV1XOIvkpJiKMx6v9XO7hOAVAPvwgfRhcJhm4zunkJFAwcIewwJw.', 'Paul', 'Laki-laki', NULL, 5, NULL, 1),
(20, NULL, 'bagas', '$2y$10$tD.tJK85OejI4M7rE5jPh.KmMrcNVQwYvjGXHMAu2YnirLpeNlcrW', 'Bagas', 'Laki-laki', NULL, 5, NULL, 1),
(21, NULL, 'bagus', '$2y$10$V0u.X4sVfZ9A0pTDZElzL.W0glKqhm/rnbTj./fL9gIW9Pt48PjB.', 'Bagus', 'Laki-laki', NULL, 5, NULL, 1),
(22, NULL, 'heru', '$2y$10$nPqhiSF10WK4JlhZy4iTL.zs.qf5vU5yKILKGgYQFMMfSSQyLi4Au', 'Heru', 'Laki-laki', NULL, 5, NULL, 1),
(23, NULL, 'heri', '$2y$10$e7sDKYe1ipD4TlvLdzqGkOeFQ.eaWUuFExGzvnTwqHTzShe6eDO5K', 'Heri', 'Laki-laki', NULL, 5, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bagan`
--
ALTER TABLE `bagan`
  ADD PRIMARY KEY (`id_bagan`);

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indeks untuk tabel `kejuaraan`
--
ALTER TABLE `kejuaraan`
  ADD PRIMARY KEY (`id_kejuaraan`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bagan`
--
ALTER TABLE `bagan`
  MODIFY `id_bagan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kejuaraan`
--
ALTER TABLE `kejuaraan`
  MODIFY `id_kejuaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
