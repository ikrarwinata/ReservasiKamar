-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 05 Jul 2021 pada 08.48
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aktifitasakun`
--

INSERT INTO `aktifitasakun` (`id`, `token`, `idakun`, `datavalue`, `displaytext`, `controller`, `action`, `tanggal`, `jam`) VALUES
(1, '3220200712210259', 32, '14', 'A003', 'Reservasi', 'reservasi', '12-07-2020', '21:02'),
(2, '3220200712212910', 32, '14', 'A003', 'Reservasi', 'reservasi', '12-07-2020', '21:29'),
(3, '3220200712213108', 32, '14', 'A003', 'Reservasi', 'reservasi', '12-07-2020', '21:31'),
(4, '3320200714213828', 33, '14', 'A003', 'Reservasi', 'reservasi', '14-07-2020', '21:38'),
(5, '914072020214620', 9, '14', 'A003', 'Kamar', 'delete', '14-07-2020', '21:46'),
(6, '3220200715184353', 32, '23', 'user1', 'pelanggan', 'update', '15-07-2020', '18:43'),
(7, '920200715184850', 9, '15', 'A003', 'kamar', 'create', '15-07-2020', '18:48'),
(8, '920200715184922', 9, '15', 'A003', 'kamar', 'update', '15-07-2020', '18:49'),
(9, '920200715185033', 9, '16', 'A006', 'kamar', 'create', '15-07-2020', '18:50'),
(10, '3220200715202155', 32, '16', 'A006', 'Reservasi', 'reservasi', '15-07-2020', '20:21'),
(11, '920200715205518', 9, '233215072020202154', 'user1', 'Reservasi', 'konfirmasi', '15-07-2020', '20:55'),
(12, '115072020214159', 1, '24', 'user2', 'Pelanggan', 'delete', '15-07-2020', '21:41'),
(13, '115072020214200', 1, '23', 'user1', 'Pelanggan', 'delete', '15-07-2020', '21:42'),
(14, '3420200716014046', 34, '34', 'user1', 'pelanggan', 'register', '16-07-2020', '01:40'),
(15, '3420200716014206', 34, '16', 'A006', 'Reservasi', 'reservasi', '16-07-2020', '01:42'),
(16, '920200716015028', 9, '253416072020014206', 'user1', 'Reservasi', 'konfirmasi', '16-07-2020', '01:50'),
(17, '3420210703181607', 34, '16', 'A006', 'Reservasi', 'reservasi', '03-07-2021', '18:16'),
(18, '120210705083832', 1, '253416072020014206', 'user1', 'Reservasi', 'tolak', '05-07-2021', '08:38'),
(19, '120210705083834', 1, '253403072021181606', 'user1', 'Reservasi', 'tolak', '05-07-2021', '08:38'),
(20, '120210705153904', 1, '1516072020015428', 'A006', 'riwayattamu', 'delete', '05-07-2021', '15:39'),
(21, '120210705153916', 1, '16', 'A006', 'kamar', 'update', '05-07-2021', '15:39'),
(22, '120210705153950', 1, '15', 'A003', 'kamar', 'update', '05-07-2021', '15:39'),
(23, '120210705154025', 1, '16', 'A006', 'kamar', 'update', '05-07-2021', '15:40'),
(24, '120210705154101', 1, '17', 'A005', 'kamar', 'create', '05-07-2021', '15:41'),
(25, '120210705154145', 1, '18', 'A004', 'kamar', 'create', '05-07-2021', '15:41'),
(26, '120210705154212', 1, '19', 'A007', 'kamar', 'create', '05-07-2021', '15:42'),
(27, '120210705154237', 1, '20', 'A001', 'kamar', 'create', '05-07-2021', '15:42'),
(28, '120210705154239', 1, '19', 'A007', 'kamar', 'update', '05-07-2021', '15:42'),
(29, '120210705154250', 1, '16', 'A006', 'kamar', 'update', '05-07-2021', '15:42'),
(30, '120210705154300', 1, '15', 'A003', 'kamar', 'update', '05-07-2021', '15:43'),
(31, '120210705154331', 1, '21', 'A002', 'kamar', 'create', '05-07-2021', '15:43'),
(32, '120210705154356', 1, '22', 'A008', 'kamar', 'create', '05-07-2021', '15:43'),
(33, '120210705154405', 1, '5', 'admin', 'petugas', 'update', '05-07-2021', '15:44'),
(34, '120210705154413', 1, '1', 'Drs. M. Tarmizi. MM', 'petugas', 'update', '05-07-2021', '15:44'),
(35, '120210705154437', 1, '4', 'Ir. Bambang Wijayanto', 'petugas', 'update', '05-07-2021', '15:44'),
(36, '120210705154451', 1, '3', 'M. Hendri. A.Md', 'petugas', 'update', '05-07-2021', '15:44'),
(37, '120210705154503', 1, '1', 'Drs. Saifuddin. MM', 'petugas', 'update', '05-07-2021', '15:45');

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
(34, 'user1', 'user1', '1'),
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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota_inap`
--

INSERT INTO `anggota_inap` (`id`, `idreservasi`, `ktp`) VALUES
(23, '253416072020014206', 'uploads/pelanggan/ktp/1634160720200142060.'),
(24, '253403072021181606', 'uploads/pelanggan/ktp/1634030720211816060.');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`idkamar`, `nomorkamar`, `tarif`, `digunakan`, `fotokamar`, `foto2`, `foto3`, `deskripsi`) VALUES
(15, 'A003', 600000, 0, 'uploads/kamar/A00305072021154015.jpg', 'uploads/kamar/A003205072021154015.jpg', 'uploads/kamar/A003305072021154015.jpg', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 2 tempat tidur\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(16, 'A006', 600000, 0, 'uploads/kamar/A00605072021153947.jpg', 'uploads/kamar/A006205072021153947.jpg', 'uploads/kamar/A006305072021153947.jpg', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 1 tempat tidur ukuran besar\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(17, 'A005', 500000, 0, 'uploads/kamar/A00505072021154101.jpg', 'uploads/kamar/A005205072021154101.jpg', 'uploads/kamar/kamarnoimage.png', 'Kamar ukuran sedang, kapasitas 1 orang\r\n\r\n- 1 tempat tidur\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(18, 'A004', 550000, 0, 'uploads/kamar/A00405072021154145.jpg', 'uploads/kamar/A004205072021154145.jpg', 'uploads/kamar/kamarnoimage.png', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 1 tempat tidur ukuran besar\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(19, 'A007', 500000, 0, 'uploads/kamar/A00705072021154212.jpg', 'uploads/kamar/kamarnoimage.png', 'uploads/kamar/kamarnoimage.png', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 1 tempat tidur ukuran besar\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(20, 'A001', 500000, 0, 'uploads/kamar/A00105072021154237.jpg', 'uploads/kamar/A001205072021154237.jpg', 'uploads/kamar/kamarnoimage.png', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 1 tempat tidur ukuran besar\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(21, 'A002', 500000, 0, 'uploads/kamar/A00205072021154331.jpg', 'uploads/kamar/A002205072021154331.jpg', 'uploads/kamar/kamarnoimage.png', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 1 tempat tidur ukuran besar\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi'),
(22, 'A008', 42000, 0, 'uploads/kamar/A00805072021154356.jpg', 'uploads/kamar/A008205072021154356.jpg', 'uploads/kamar/kamarnoimage.png', 'Kamar ukuran sedang, kapasitas 2 orang\r\n\r\n- 1 tempat tidur ukuran besar\r\n- 1 televisi\r\n- 1 lemari\r\n- 1 AC\r\n- 1 Kamar mandi');

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `jeniskelamin`, `tgllahir`, `telepon`, `email`, `fotoktp`, `fotoprofil`, `idakun`) VALUES
(25, 'user1', 'Pria', '14-02-1996', '+(62) 895-3162-362', 'mail@mail.com', 'uploads/pelanggan/ktp/user116072020014046.jpeg', 'uploads/pelanggan/profile/usernoimage.png', 34);

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
(1, 'Drs. Derri Kamal. MM', '12-04-1997', 'jambi', '+(62) 831-3131-313', 'petugas@mail.com', 'uploads/petugas/usernoimage.png', 1),
(5, 'admin', '13-06-1989', 'j', '+(62) 895-3162-362', 'mail@mail.com', 'uploads/petugas/usernoimage.png', 19),
(3, 'M. Malya. A.Md', '06-02-1990', 'jambi', '+(62) 831-3131-313', 'mail@mail.com', 'uploads/petugas/usernoimage.png', 9),
(4, 'Ir. Agus Sucipto', '19-06-1985', 'jambi', NULL, 'mail@mail.com', 'uploads/petugas/usernoimage.png', 10);

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

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`idreservasi`, `idpelanggan`, `idkamar`, `tglreservasi`, `tglcheckin`, `lamainap`, `status`, `messages`, `kodebank`, `buktipembayaran`, `timestamps`) VALUES
('253416072020014206', 25, 16, '16-07-2020', '2020-07-17', 1, '0', NULL, 4, 'uploads/buktipembayaran/25341607202001420616072020014258.jpg', '1594838526'),
('253403072021181606', 25, 16, '03-07-2021', '2021-07-03', 7, '0', NULL, 3, NULL, '1625310966');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
