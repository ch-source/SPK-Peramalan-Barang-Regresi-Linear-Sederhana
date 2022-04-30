-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Apr 2022 pada 12.44
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptc_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `nama_barang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `stok` varchar(50) NOT NULL,
  `rak` varchar(50) NOT NULL,
  `harga_beli` varchar(50) NOT NULL,
  `harga_jual` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `barcode`, `nama_barang`, `satuan`, `stok`, `rak`, `harga_beli`, `harga_jual`) VALUES
('KBR001', '531265468', 'Indomie', 'Pcs', '3000', '2', '2500', '3000'),
('KBR002', '35624698', 'Frestea Green Tea', 'Pcs', '2000', '3', '2500', '3000'),
('KBR003', '4546454557', 'Coca-Cola', 'Pcs', '200', '4', '5000', '7000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_grafik`
--

CREATE TABLE `tbl_grafik` (
  `id_grafik` int(11) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `hasil` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_pengguna` varchar(50) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_pengguna`, `nama_pengguna`, `telepon`, `email`, `username`, `password`, `level`) VALUES
('PGN001', 'Acen', '082339368112', 'acen@gmail.com', '1234', '1234', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_peramalan`
--

CREATE TABLE `tbl_peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `kode_barang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `slope` varchar(50) NOT NULL,
  `intercept` varchar(50) CHARACTER SET latin1 NOT NULL,
  `forecast` varchar(50) CHARACTER SET latin1 NOT NULL,
  `rsfe` varchar(50) CHARACTER SET latin1 NOT NULL,
  `error` varchar(50) NOT NULL,
  `mad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_training`
--

CREATE TABLE `tbl_training` (
  `id_training` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `xy` varchar(50) NOT NULL,
  `x2` varchar(50) NOT NULL,
  `forecast` varchar(50) NOT NULL,
  `rsfe` varchar(50) NOT NULL,
  `error` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `tbl_grafik`
--
ALTER TABLE `tbl_grafik`
  ADD PRIMARY KEY (`id_grafik`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tbl_peramalan`
--
ALTER TABLE `tbl_peramalan`
  ADD PRIMARY KEY (`id_peramalan`);

--
-- Indeks untuk tabel `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`id_training`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_grafik`
--
ALTER TABLE `tbl_grafik`
  MODIFY `id_grafik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_peramalan`
--
ALTER TABLE `tbl_peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id_training` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
