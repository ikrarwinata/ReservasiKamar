-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02 Agu 2020 pada 19.00
-- Versi Server: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasikamar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktifitasakun`
--

DROP TABLE IF EXISTS `aktifitasakun`;
CREATE TABLE IF NOT EXISTS `aktifitasakun` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `token` varchar(250) NOT NULL,
  `idakun` int(15) NOT NULL,
  `datavalue` varchar(2500) NOT NULL,
  `displaytext` varchar(2500) DEFAULT NULL,
  `controller` varchar(250) NOT NULL,
  `action` varchar(50) NOT NULL,
  `tanggal` varchar(18) NOT NULL,
  `jam` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` enum('0','1','2','3','4','5') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `level`) VALUES
(1, 'superadmin', 'superadmin', '5'),
(9, 'admin2', 'admin', '3'),
(10, 'bambang', 'bambang', '4'),
(19, 'admin', 'admin', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_inap`
--

DROP TABLE IF EXISTS `anggota_inap`;
CREATE TABLE IF NOT EXISTS `anggota_inap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idreservasi` varchar(200) NOT NULL,
  `ktp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `idbank` int(11) NOT NULL AUTO_INCREMENT,
  `namanasabah` varchar(50) DEFAULT NULL,
  `namabank` varchar(35) NOT NULL,
  `rekening` varchar(60) NOT NULL,
  `gambar` text NOT NULL,
  PRIMARY KEY (`idbank`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`idbank`, `namanasabah`, `namabank`, `rekening`, `gambar`) VALUES
(3, 'Tarmizi', 'BCA', '09876543333333', 'uploads/bank/tg1501078655.png'),
(4, 'Tarmizi', 'Mandiri', '08068965674564', 'uploads/bank/tg1501154838.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

DROP TABLE IF EXISTS `kamar`;
CREATE TABLE IF NOT EXISTS `kamar` (
  `idkamar` int(15) NOT NULL AUTO_INCREMENT,
  `nomorkamar` varchar(25) NOT NULL,
  `tarif` int(15) NOT NULL,
  `digunakan` tinyint(1) DEFAULT '0',
  `fotokamar` text,
  `foto2` text,
  `foto3` text,
  `deskripsi` text,
  PRIMARY KEY (`idkamar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `idpelanggan` int(15) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `jeniskelamin` enum('Pria','Wanita') NOT NULL,
  `tgllahir` varchar(15) NOT NULL,
  `telepon` varchar(18) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `fotoktp` text,
  `fotoprofil` varchar(2500) DEFAULT 'uploads/pelanggan/profile/usernoimage.png',
  `idakun` int(15) NOT NULL,
  PRIMARY KEY (`idpelanggan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `idpengeluaran` int(15) NOT NULL AUTO_INCREMENT,
  `deskripsi` text NOT NULL,
  `pengeluaran` int(15) NOT NULL,
  `tgl` varchar(18) NOT NULL,
  `idakun` int(15) NOT NULL,
  PRIMARY KEY (`idpengeluaran`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`idpengeluaran`, `deskripsi`, `pengeluaran`, `tgl`, `idakun`) VALUES
(6, 'Perbaiki AC', 300000, '01-10-2019', 1),
(5, 'Beli Kunci', 100000, '01-10-2019', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `idpetugas` int(15) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `tgllahir` varchar(15) NOT NULL,
  `alamat` text,
  `telepon` varchar(18) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `fotoprofil` varchar(2500) DEFAULT 'uploads/petugas/usernoimage.png',
  `idakun` int(15) NOT NULL,
  PRIMARY KEY (`idpetugas`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `tgllahir`, `alamat`, `telepon`, `email`, `fotoprofil`, `idakun`) VALUES
(1, 'Drs. M. Tarmizi. MM', '12-04-1997', 'jambi', '+(62) 831-3131-313', 'petugas@mail.com', 'uploads/petugas/usernoimage.png', 1),
(5, 'admin', '13-06-1989', 'j', '+(62) 895-3162-362', 'mail@mail.com', 'uploads/petugas/usernoimage.png', 19),
(3, 'M. Hendri. A.Md', '06-02-1990', 'jambi', '+(62) 831-3131-313', 'mail@mail.com', 'uploads/petugas/usernoimage.png', 9),
(4, 'Ir. Bambang Wijayanto', '19-06-1985', 'jambi', '', 'mail@mail.com', 'uploads/petugas/usernoimage.png', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

DROP TABLE IF EXISTS `reservasi`;
CREATE TABLE IF NOT EXISTS `reservasi` (
  `idreservasi` varchar(200) NOT NULL,
  `idpelanggan` int(15) NOT NULL,
  `idkamar` int(15) NOT NULL,
  `tglreservasi` varchar(15) NOT NULL,
  `tglcheckin` varchar(15) NOT NULL,
  `lamainap` int(2) NOT NULL,
  `status` enum('0','1','2','3','4') NOT NULL DEFAULT '1',
  `messages` varchar(2500) DEFAULT NULL,
  `kodebank` int(11) DEFAULT NULL,
  `buktipembayaran` text,
  `timestamps` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idreservasi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayattamu`
--

DROP TABLE IF EXISTS `riwayattamu`;
CREATE TABLE IF NOT EXISTS `riwayattamu` (
  `id` varchar(50) NOT NULL,
  `idpetugas` varchar(25) DEFAULT NULL,
  `idpelanggan` varchar(25) NOT NULL,
  `idkamar` int(15) NOT NULL,
  `tglmasuk` varchar(18) NOT NULL,
  `harimasuk` varchar(15) NOT NULL,
  `tglkeluar` varchar(18) DEFAULT NULL,
  `harikeluar` varchar(15) DEFAULT NULL,
  `pembayaran` varchar(35) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

DROP TABLE IF EXISTS `tamu`;
CREATE TABLE IF NOT EXISTS `tamu` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `idpetugas` int(15) DEFAULT NULL,
  `idpelanggan` int(15) NOT NULL,
  `idkamar` int(15) NOT NULL,
  `tglmasuk` varchar(18) NOT NULL,
  `harimasuk` varchar(15) NOT NULL,
  `tglkeluar` varchar(18) DEFAULT NULL,
  `harikeluar` varchar(15) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
