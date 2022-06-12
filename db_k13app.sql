-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2019 at 05:58 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_k13app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_ab`
--

CREATE TABLE `tb_ab` (
  `id_ab` int(11) NOT NULL,
  `nm_bulan` varchar(30) NOT NULL,
  `smt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ab`
--

INSERT INTO `tb_ab` (`id_ab`, `nm_bulan`, `smt`) VALUES
(1, 'Januari', 1),
(2, 'Februari', 1),
(3, 'Maret', 1),
(4, 'April', 1),
(5, 'Mei', 1),
(6, 'Juni', 1),
(7, 'Juli', 2),
(8, 'Agustus', 2),
(9, 'September', 2),
(10, 'Oktober', 2),
(11, 'November', 2),
(12, 'Desember', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_abguru`
--

CREATE TABLE `tb_abguru` (
  `id_abguru` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ab` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `smt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_abguru`
--

INSERT INTO `tb_abguru` (`id_abguru`, `sakit`, `izin`, `alpha`, `jumlah`, `ab`, `guru`, `ta`, `smt`) VALUES
(1, 3, 6, 1, 9, 1, 1, 1, 1),
(2, 4, 3, 7, 5, 2, 1, 1, 1),
(13, 1, 2, 2, 5, 3, 1, 1, 1),
(14, 2, 2, 2, 6, 1, 2, 1, 1),
(15, 1, 2, 8, 11, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_absiswa`
--

CREATE TABLE `tb_absiswa` (
  `id_absiswa` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ab` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `smt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absiswa`
--

INSERT INTO `tb_absiswa` (`id_absiswa`, `sakit`, `izin`, `alpha`, `jumlah`, `ab`, `siswa`, `ta`, `smt`) VALUES
(5, 2, 1, 1, 4, 1, 1, 1, 1),
(6, 3, 3, 3, 9, 2, 1, 1, 1),
(7, 6, 2, 2, 10, 3, 1, 1, 1),
(8, 2, 3, 3, 8, 1, 8, 1, 1),
(9, 4, 0, 2, 6, 2, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`, `level`) VALUES
(1, 'admin', '$2y$12$EeN4WLTA/UqwFafRdKRkPO2xob9TfsEa77vLn1Lm5U4ufAmvU3G.a', 1),
(2, 'guru', '$2y$11$pNv82KGGU97.DAMw./qRCeOCEukuXY41HdDsxknNyAe68..rkxh0.', 2),
(3, 'kepsek', '$2y$11$ST2NVDM3fwKnKH3ZdLfiX.MEAZpp8sTMs30bqGnvNN1llUGBDZEpW', 2),
(4, 'guru2', '$2y$12$HL7PmuG6PqtHp8lAD2Ttb.QfzKf/i4y1Q6TXwFaIFKfe8ZNkL/XrC', 2),
(9, 'juna', '$2y$11$pbbpeGZt.SCsdUQC1r9EbuIG6D3vQOiNUX6Rbh77ITIMPABIKi3zG', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_desk_ki3`
--

CREATE TABLE `tb_desk_ki3` (
  `id_desk_ki3` int(11) NOT NULL,
  `desk_ki3` text NOT NULL,
  `mapel` int(11) NOT NULL,
  `smt` int(11) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_desk_ki3`
--

INSERT INTO `tb_desk_ki3` (`id_desk_ki3`, `desk_ki3`, `mapel`, `smt`, `kelas`) VALUES
(6, 'memahami makna Q.S. at-T?n dan Q.S. al-Ma’un', 15, 1, 1),
(7, 'memahami makna Asmaul Husna: Al-Mumit, Al-Hayy, Al- Qayyum, dan Al-Ahad', 15, 1, 1),
(8, 'memahami nama-nama Rasul Allah dan Rasul Ulul ‘Azmi', 15, 1, 1),
(9, 'memahami makna perilaku jujur dalam kehidupan sehari-hari', 15, 1, 1),
(12, 'mengidentifikasi nilai-nilai Pancasila', 16, 1, 1),
(13, 'memahami hak, kewajiban dan tanggung jawab sebagai warga masyarakat', 16, 1, 1),
(14, 'menggali manfaat persatuan dan kesatuan untuk membangun kerukunan hidup', 16, 1, 1),
(18, 'menentukan pokok pikiran dalam teks lisan dan tulis', 17, 1, 1),
(19, 'mengklasifikasi informasi dalam aspek: apa, di mana, kapan, siapa, mengapa, dan bagaimana ', 17, 1, 1),
(20, 'menganalisis informasi yang disampaikan paparan iklan dari media cetak atau elektronik ', 17, 1, 1),
(21, 'menggali isi dan amanat pantun yang disajikan secara lisan dan tulis', 17, 1, 1),
(22, 'menguraikan konsep-konsep yang saling berkaitan pada teks nonfiksi', 17, 1, 1),
(23, 'menggali pengetahuan baru pada teks non fiksi', 17, 1, 1),
(24, 'membandingkan hal yang sudah diketahui dengan hal yang baru diketahui dari teks non fiksi', 17, 1, 1),
(25, 'menjelaskan pecahan-pecahan senilai dengan gambar dan model konkrit', 18, 1, 1),
(26, 'menjelaskan berbagai bentuk pecahan dan hubungan diantaranya', 18, 1, 1),
(27, 'menjelaskan dan melakukan penaksiran dari jumlah selisih, hasil kali dan hasil bagi dua bilangan cacah maupun pecahan dan desimal', 18, 1, 1),
(28, 'menjelaskan faktor dan kelipatan suatu bilangan', 18, 1, 1),
(29, 'menjelaskan bilangan prima', 18, 1, 1),
(30, 'menjelaskan dan menentukan faktor persekutuan, FPB, kelipatan persekutuan, dan KPK dari dua bilangan berkaitan dengan kehidupan sehari-hari', 18, 1, 1),
(31, 'menjelaskan dan melakukan pembulatan hasil pengukuran panjang dan berat kesatuan terdekat', 18, 1, 1),
(32, 'menjelaskan alat gerak dan fungsinya', 19, 1, 1),
(33, 'menganalisis hubungan antar komponen ekosistem dan jaring-jaring makanan', 19, 1, 1),
(34, 'menrapkan sifat-sifat bunyi dan keterkaitannya', 19, 1, 1),
(35, 'menerapkan sifat-sifat cahaya dan keterkaitannya dengan indra penglihatan', 19, 1, 1),
(36, 'menjelaskan pentingnya upaya keseimbangan dan pelestarian sumber daya alam dilingkungannya', 19, 1, 0),
(37, 'mengidentifikasi karakteristik geografis Indonesia', 20, 1, 1),
(38, 'menganalisis bentuk bentuk interaksi manusia dengan lingkungan', 20, 1, 1),
(39, 'menganalisis peran ekonomi dalam upaya menyejahterakan kehidupan masyarakat', 20, 1, 1),
(40, 'mengidentifikasi Kerajaan Hindu/Budha dan Islam di lingkungan daerah setempat,serta pengaruhnya pada kehidupan masyarakat masa kini ', 20, 1, 1),
(41, 'memahami gambar cerita', 21, 1, 1),
(42, 'memahami tangga nada', 21, 1, 1),
(43, 'memahami pola lantai dalam tari kreasi daerah', 21, 1, 1),
(44, 'memahami karya seni rupa daerah', 21, 1, 1),
(45, 'memahami kombinasi gerak lokomotor, non-lokomotor, dan manipulatif dalam permainan bola besar', 22, 1, 1),
(46, 'memahami kombinasi gerak lokomotor, non-lokomotor, dan manipulatif dalam permainan bola kecil', 22, 1, 1),
(47, 'memahami kombinasi gerak dasar jalan, lari, lompat, dan lempar melalui permainan', 22, 1, 1),
(48, 'menerapkan variasi gerak dasar lokomotor dan non lokomotor untuk membentuk gerak dasar seni beladiri', 22, 1, 1),
(49, 'memahami aktivitas latihan daya tahan jantung untuk pengembangan kebugaran jasmani', 22, 1, 1),
(50, 'mengidentifikasi kegiatan mendulang intan', 23, 1, 1),
(51, 'menyebutkan tokoh pahlawan ', 23, 1, 1),
(52, 'mengidentifikasi musik panting', 23, 1, 1),
(53, 'mengidentifikasi kegiatan mendulang intan', 24, 1, 1),
(54, 'menyebutkan tokoh pahlawan ', 24, 1, 1),
(55, 'mengidentifikasi musik panting', 24, 1, 1),
(56, 'cekhh', 15, 1, 2),
(57, 'text', 15, 2, 1),
(58, 'text2', 15, 2, 1),
(59, 'adfdd', 16, 2, 1),
(61, 'ssss', 15, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_desk_ki4`
--

CREATE TABLE `tb_desk_ki4` (
  `id_desk_ki4` int(11) NOT NULL,
  `desk_ki4` text NOT NULL,
  `mapel` int(11) NOT NULL,
  `smt` int(11) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_desk_ki4`
--

INSERT INTO `tb_desk_ki4` (`id_desk_ki4`, `desk_ki4`, `mapel`, `smt`, `kelas`) VALUES
(1, 'membaca, menulis dan menghafal Q.S. at-T?n dan Q.S. al-Ma’un', 15, 1, 1),
(3, 'membaca Asmaul Husna: Al-Mumit, Al-Hayy, Al- Qayyum, dan Al-Ahad', 15, 1, 1),
(8, 'mencontoh sifat-sifat Rasul Allah dan Rasul Ulul ‘Azmi', 15, 1, 1),
(9, 'menunjukkan makna diturunkannya kitab-kitab suci ', 15, 1, 1),
(10, 'menunjukkan perilaku jujur dalam kehidupan sehai-hari', 15, 1, 1),
(11, 'menyajikan hasil identifikasi nilai-nilai Pancasila', 16, 1, 1),
(12, 'menjalankan hak, kewajiban, dan tanggung jawab sebagai warga masyarakat', 16, 1, 1),
(13, 'menyelenggarakan kegiatan yang mendukung keragaman sosial budaya masyarakat', 16, 1, 1),
(14, 'menyajikan hasil penggalian tentang manfaat persatuan dan kesatuan', 16, 1, 1),
(15, 'menyajikan hasil identifikasi pokok pikiran dalam teks tulis dan lisan', 17, 1, 1),
(16, 'menyajikan hasil klasifikasi informasi dalam aspek: apa, di mana, kapan, siapa, mengapa, dan bagaimana', 17, 1, 1),
(17, 'memeragakan kembali informasi yang disampaikan paparan iklan dari media cetak atau elektronik', 17, 1, 1),
(18, 'melisankan pantun hasil karya pribadi dengan lafal, intonasi, dan ekspresi yang tepat', 17, 1, 1),
(19, 'menyajikan konsep-konsep yang saling berkaitan pada teks nonfiksi ke dalam tulisan', 17, 1, 1),
(20, 'menyelesaikan masalah yang berkaitan dengan penjumlahan dan pengurangan dua pecahan', 18, 1, 1),
(21, 'menyelesaikan masalah yang berkaitan dengan perkalian dan pembagian pecahan dan desimal', 18, 1, 1),
(22, 'menyelesaikan masalah yang berkaitan dengan perbandingan dua besaran yang berbeda (kecepatan, debit)', 18, 1, 1),
(23, 'menyelesaikan masalah yang berkaitan dengan skala pada denah', 18, 1, 1),
(24, 'membuat model sederhana alat gerak manusia dan hewan', 19, 1, 1),
(25, 'membuat model sederhana organ pernapasan manusia', 19, 1, 1),
(26, 'menyajikan karya tentang konsep organ dan fungsi pencernaan pada hewan atau manusia ', 19, 1, 1),
(27, 'menyajikan karya tentang organ peredaran darah pada manusia', 19, 1, 1),
(28, 'membuat karya tentang konsep jaring-jaring makanan dalam suatu ekosistem', 19, 1, 1),
(29, 'menyajikan hasil identifikasi karakteristik geografis Indonesia ', 20, 1, 1),
(30, 'menyajikan hasil analisis tentang interaksi manusia dengan lingkungan', 20, 1, 1),
(31, 'menyajikan hasil analisis tentang peran ekonomi dalam upaya menyejahterakan kehidupan masyarakat', 20, 1, 1),
(32, 'membuat gambar cerita', 21, 1, 1),
(33, 'menyanyikan lagu-lagu dalam berbagai tangga nada dengan iringan musik', 21, 1, 1),
(34, 'mempraktikkan pola lantai pada gerak tari kreasi daerah', 21, 1, 1),
(35, 'membuat karya seni rupa daerah', 21, 1, 1),
(36, 'mempraktikkan kombinasi gerak lokomotor, non-lokomotor, dan manipulatif dalam permainan bola besar', 22, 1, 1),
(37, 'mempraktikkan kombinasi gerak lokomotor, non-lokomotor, dan manipulatif dalam permainan bola kecil', 22, 1, 1),
(38, 'mempraktikkan kombinasi gerak dasar jalan, lari, lompat, dan lempar melalui permainan', 22, 1, 1),
(39, 'mempraktikkan variasi gerak dasar lokomotor dan non lokomotor untuk membentuk gerak dasar seni beladiri', 22, 1, 1),
(40, 'mempraktikkan aktivitas latihan daya tahan jantung untuk pengembangan kebugaran jasmani', 22, 1, 1),
(41, 'menyelesaikan masalah yang berkaitan dengan kegiatan mendulang intan', 24, 1, 1),
(42, 'menyebutkan tokoh pahlawan ', 24, 1, 1),
(43, 'menyebutkan alat musik panting', 24, 1, 1),
(46, 'Desk Sem 2 Pendidikan Agama 1', 15, 2, 1),
(47, 'Desk Sem 2 Pendidikan Agama 2', 15, 2, 1),
(48, 'Deskkk', 15, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekskul`
--

CREATE TABLE `tb_ekskul` (
  `id_ekskul` int(11) NOT NULL,
  `eks` int(11) NOT NULL,
  `ket` text NOT NULL,
  `siswa` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ekskul`
--

INSERT INTO `tb_ekskul` (`id_ekskul`, `eks`, `ket`, `siswa`, `ta`) VALUES
(6, 4, 'Sepak Bola', 1, 1),
(7, 7, 'Badminton', 1, 2),
(8, 6, 'basket', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekskul_siswa`
--

CREATE TABLE `tb_ekskul_siswa` (
  `id_ekskul_siswa` int(11) NOT NULL,
  `nm_ekskul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ekskul_siswa`
--

INSERT INTO `tb_ekskul_siswa` (`id_ekskul_siswa`, `nm_ekskul`) VALUES
(3, 'Pramuka'),
(4, 'Sepak Bola'),
(5, 'Bola Voli'),
(6, 'Basket'),
(7, 'Badminton'),
(8, 'Tenis Meja');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fisik`
--

CREATE TABLE `tb_fisik` (
  `id_fisik` int(11) NOT NULL,
  `tb_1` int(11) NOT NULL,
  `bb_1` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fisik`
--

INSERT INTO `tb_fisik` (`id_fisik`, `tb_1`, `bb_1`, `siswa`, `ta`) VALUES
(5, 20, 40, 1, 1),
(6, 50, 55, 1, 2),
(7, 55, 50, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nm_guru` varchar(30) NOT NULL,
  `nip` varchar(40) NOT NULL,
  `nuptk` varchar(40) NOT NULL,
  `npsp` varchar(40) NOT NULL,
  `gol` varchar(70) NOT NULL,
  `sk_pertama` varchar(20) NOT NULL,
  `sk_uk` varchar(20) NOT NULL,
  `kelas` int(11) NOT NULL,
  `wali_kelas` int(11) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `th_jbkepsek` varchar(20) NOT NULL,
  `stfk_guru` varchar(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `stt_guru` varchar(10) NOT NULL,
  `foto_guru` text NOT NULL,
  `akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nm_guru`, `nip`, `nuptk`, `npsp`, `gol`, `sk_pertama`, `sk_uk`, `kelas`, `wali_kelas`, `jabatan`, `th_jbkepsek`, `stfk_guru`, `no_telp`, `stt_guru`, `foto_guru`, `akun`) VALUES
(1, 'Inah Jariah, S.Pd SD', '19601225 197909 2 001', '3557738639300013', '11156002710163', 'Pembina Tingkat 1 /IV B', '1979-09-01', '2012-07-12', 1, 1, 2, '', 'YA', '0812 5382 8761', 'PNS', 'ci.PNG', 2),
(2, 'Hj. Hasnah, S.Pd', '19620805 198503 2 013', '7137740641300030', '12156022010183', 'Pembina Tingkat 1 /IV B', '1985-03-01', '2014-01-23', 0, 0, 1, '2014-01-23', 'YA', '0852 4840 2630', 'PNS', 'admin.png', 3),
(3, 'Tahmidillah, S.Pd', '19651223 198608 1 003', '1555743647200013', '12156022010082', 'Pembina Tingkat 1 /IV B', '1986-08-01', '2002-05-15', 7, 0, 22, '', 'YA', '0813 4812 6109', 'PNS', 'admin.png', 4),
(4, 'Admin', '', '', '', '', '', '', 7, 0, 2, '', '', '', '', '', 1),
(5, 'Jun', '3646', '767', '6', '', '', '', 4, 0, 18, '', 'TIDAK', '', 'HONOR', 'app.png', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hari`
--

CREATE TABLE `tb_hari` (
  `id_hari` int(11) NOT NULL,
  `nm_hari` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hari`
--

INSERT INTO `tb_hari` (`id_hari`, `nm_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jum\'at'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `hari` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `jam_mulai`, `jam_selesai`, `hari`, `mapel`, `kelas`, `guru`, `ta`) VALUES
(8, '10:00:00', '10:37:00', 2, 21, 2, 1, 1),
(10, '12:00:00', '13:00:00', 3, 19, 1, 1, 1),
(11, '18:00:00', '19:40:00', 3, 19, 4, 1, 1),
(13, '13:00:00', '15:00:00', 7, 17, 3, 1, 1),
(14, '12:00:00', '13:25:00', 6, 18, 2, 3, 1),
(15, '12:00:00', '13:00:00', 5, 22, 7, 3, 1),
(19, '12:00:00', '10:00:00', 2, 16, 2, 1, 1),
(25, '11:00:00', '11:00:00', 6, 15, 1, 1, 1),
(50, '00:00:00', '12:00:00', 1, 18, 3, 1, 2),
(51, '00:00:00', '00:00:00', 1, 18, 2, 1, 2),
(52, '20:00:00', '21:00:00', 1, 16, 1, 1, 1),
(53, '09:00:00', '10:00:00', 2, 17, 3, 1, 1),
(54, '10:00:00', '10:48:00', 5, 16, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nm_kelas` varchar(20) NOT NULL,
  `huruf_kl` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nm_kelas`, `huruf_kl`) VALUES
(1, 'I', '(Satu)'),
(2, 'II', '(Dua)'),
(3, 'III', '(Tiga)'),
(4, 'IV', '(Empat)'),
(5, 'V', '(Lima)'),
(6, 'VI', '(Enam)'),
(7, 'Semua Kelas', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kesehatan`
--

CREATE TABLE `tb_kesehatan` (
  `id_kesehatan` int(11) NOT NULL,
  `pendengaran` int(11) NOT NULL,
  `penglihatan` int(11) NOT NULL,
  `gigi` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kesehatan`
--

INSERT INTO `tb_kesehatan` (`id_kesehatan`, `pendengaran`, `penglihatan`, `gigi`, `siswa`, `ta`) VALUES
(5, 2, 3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kondisi`
--

CREATE TABLE `tb_kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `nm_kondisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kondisi`
--

INSERT INTO `tb_kondisi` (`id_kondisi`, `nm_kondisi`) VALUES
(1, 'Sangat Baik'),
(2, 'Baik'),
(3, 'Kurang Baik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kr_ki3`
--

CREATE TABLE `tb_kr_ki3` (
  `id_kr_ki3` int(11) NOT NULL,
  `nm_kriteria` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kr_ki3`
--

INSERT INTO `tb_kr_ki3` (`id_kr_ki3`, `nm_kriteria`) VALUES
(1, 'Ketaatan Beribadah'),
(2, 'Berperilaku Syukur'),
(3, 'Berdoa Dalam Kegiatan'),
(4, 'Toleransi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kr_ki4`
--

CREATE TABLE `tb_kr_ki4` (
  `id_kr_ki4` int(11) NOT NULL,
  `nm_kriteria` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kr_ki4`
--

INSERT INTO `tb_kr_ki4` (`id_kr_ki4`, `nm_kriteria`) VALUES
(1, 'Jujur'),
(2, 'Disiplin'),
(3, 'Tanggung Jawab'),
(4, 'Percaya Diri'),
(5, 'Kerja Sama'),
(6, 'Santun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(11) NOT NULL,
  `nm_mapel` varchar(120) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `ki_3` int(11) NOT NULL,
  `ki_4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `nm_mapel`, `kode_mapel`, `ki_3`, `ki_4`) VALUES
(1, 'Kepala Sekolah', '1', 1, 1),
(2, 'Semua Mata Pelajaran', '1', 1, 1),
(15, 'Pendidikan Agama dan Budi Pekerti', 'PA', 70, 70),
(16, 'Pend. Pancasila dan Kewarganegaraan', 'PPKn', 70, 70),
(17, 'Bahasa Indonesia', 'BI', 70, 70),
(18, 'Matematika', 'MTK', 60, 60),
(19, 'Ilmu Pengetahuan Alam', 'IPA', 65, 65),
(20, 'Ilmu Pengetahuan Sosial', 'IPS', 65, 65),
(21, 'Seni Budaya dan Prakarya', 'SBdP', 70, 70),
(22, 'Pend. Jasmani, Olah Raga, dan Kesehatan', 'PJOK', 75, 75),
(23, 'BTA', 'BTA', 70, 70),
(24, 'Bahasa Banjar', 'MULOK', 75, 75);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_ki3`
--

CREATE TABLE `tb_nilai_ki3` (
  `id_nilai_ki3` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `total_na` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_ki3`
--

INSERT INTO `tb_nilai_ki3` (`id_nilai_ki3`, `deskripsi`, `total_na`, `siswa`, `kelas`, `ta`, `mapel`) VALUES
(33, '', 55, 1, 1, 2, 15),
(34, '', 57, 8, 1, 2, 15),
(35, '', 59, 12, 1, 2, 15),
(38, '', 33, 1, 1, 2, 16),
(39, '', 55, 8, 1, 2, 16),
(45, '', 66, 13, 1, 2, 15),
(46, '', 73, 14, 1, 2, 15),
(47, '', 57, 1, 1, 2, 15),
(48, '', 0, 8, 1, 2, 15),
(49, '', 0, 12, 1, 2, 15),
(50, '', 0, 13, 1, 2, 15),
(51, '', 0, 14, 1, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_ki4`
--

CREATE TABLE `tb_nilai_ki4` (
  `id_nilai_ki4` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `total_na` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_ki4`
--

INSERT INTO `tb_nilai_ki4` (`id_nilai_ki4`, `deskripsi`, `total_na`, `siswa`, `kelas`, `ta`, `mapel`) VALUES
(13, '', 40, 1, 1, 2, 15),
(14, '', 37, 8, 1, 2, 15),
(15, '', 0, 12, 1, 2, 15),
(16, '', 0, 13, 1, 2, 15),
(18, '', 46, 14, 1, 2, 15),
(19, '', 49, 1, 1, 2, 15),
(20, '', 57, 8, 1, 2, 15),
(21, '', 57, 12, 1, 2, 15),
(22, '', 57, 13, 1, 2, 15),
(23, '', 0, 14, 1, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nki1`
--

CREATE TABLE `tb_nki1` (
  `id_nki1` int(11) NOT NULL,
  `kriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nki1`
--

INSERT INTO `tb_nki1` (`id_nki1`, `kriteria`, `nilai`, `siswa`, `kelas`, `ta`) VALUES
(117, 1, 4, 1, 1, 1),
(118, 2, 4, 1, 1, 1),
(119, 3, 4, 1, 1, 1),
(120, 4, 4, 1, 1, 1),
(121, 1, 2, 8, 1, 1),
(122, 2, 2, 8, 1, 1),
(123, 3, 2, 8, 1, 1),
(124, 4, 2, 8, 1, 1),
(125, 1, 1, 12, 1, 1),
(126, 2, 1, 12, 1, 1),
(127, 3, 3, 12, 1, 1),
(128, 4, 3, 12, 1, 1),
(137, 1, 4, 13, 1, 1),
(138, 2, 3, 13, 1, 1),
(139, 3, 3, 13, 1, 1),
(140, 4, 3, 13, 1, 1),
(149, 1, 1, 14, 1, 1),
(150, 2, 1, 14, 1, 1),
(151, 3, 1, 14, 1, 1),
(152, 4, 1, 14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nki2`
--

CREATE TABLE `tb_nki2` (
  `id_nki2` int(11) NOT NULL,
  `kriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nki2`
--

INSERT INTO `tb_nki2` (`id_nki2`, `kriteria`, `nilai`, `siswa`, `kelas`, `ta`) VALUES
(45, 1, 4, 1, 1, 1),
(46, 2, 3, 1, 1, 1),
(47, 3, 3, 1, 1, 1),
(48, 4, 3, 1, 1, 1),
(49, 5, 3, 1, 1, 1),
(50, 6, 3, 1, 1, 1),
(51, 1, 1, 8, 1, 1),
(52, 2, 1, 8, 1, 1),
(53, 3, 1, 8, 1, 1),
(54, 4, 1, 8, 1, 1),
(55, 5, 1, 8, 1, 1),
(56, 6, 1, 8, 1, 1),
(57, 1, 2, 12, 1, 1),
(58, 2, 2, 12, 1, 1),
(59, 3, 2, 12, 1, 1),
(60, 4, 2, 12, 1, 1),
(61, 5, 2, 12, 1, 1),
(62, 6, 2, 12, 1, 1),
(75, 1, 2, 13, 1, 1),
(76, 2, 2, 13, 1, 1),
(77, 3, 2, 13, 1, 1),
(78, 4, 2, 13, 1, 1),
(79, 5, 2, 13, 1, 1),
(80, 6, 2, 13, 1, 1),
(93, 1, 2, 14, 1, 1),
(94, 2, 2, 14, 1, 1),
(95, 3, 2, 14, 1, 1),
(96, 4, 2, 14, 1, 1),
(97, 5, 2, 14, 1, 1),
(98, 6, 2, 14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nki3`
--

CREATE TABLE `tb_nki3` (
  `id_nki3` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `ph` int(11) NOT NULL,
  `npts` int(11) NOT NULL,
  `npas` int(11) NOT NULL,
  `na_kd` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nki3`
--

INSERT INTO `tb_nki3` (`id_nki3`, `mapel`, `kode`, `ph`, `npts`, `npas`, `na_kd`, `siswa`, `kelas`, `ta`) VALUES
(81, 15, 57, 66, 66, 66, 66, 1, 1, 2),
(82, 15, 58, 44, 44, 44, 44, 1, 1, 2),
(83, 15, 57, 77, 66, 55, 69, 8, 1, 2),
(84, 15, 58, 44, 55, 44, 47, 8, 1, 2),
(85, 15, 57, 76, 56, 44, 63, 12, 1, 2),
(86, 15, 58, 44, 56, 76, 55, 12, 1, 2),
(91, 16, 59, 33, 33, 33, 33, 1, 1, 2),
(92, 16, 59, 55, 55, 55, 55, 8, 1, 2),
(100, 15, 57, 67, 65, 55, 64, 13, 1, 2),
(101, 15, 58, 77, 66, 55, 69, 13, 1, 2),
(102, 15, 57, 78, 76, 55, 72, 14, 1, 2),
(103, 15, 58, 78, 77, 66, 75, 14, 1, 2),
(104, 15, 57, 66, 55, 44, 58, 1, 1, 2),
(105, 15, 57, 0, 0, 0, 0, 8, 1, 2),
(106, 15, 57, 0, 0, 0, 0, 12, 1, 2),
(107, 15, 57, 0, 0, 0, 0, 13, 1, 2),
(108, 15, 57, 0, 0, 0, 0, 14, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nki4`
--

CREATE TABLE `tb_nki4` (
  `id_nki4` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `ph` int(11) NOT NULL,
  `npts` int(11) NOT NULL,
  `npas` int(11) NOT NULL,
  `na_kd` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nki4`
--

INSERT INTO `tb_nki4` (`id_nki4`, `mapel`, `kode`, `ph`, `npts`, `npas`, `na_kd`, `siswa`, `kelas`, `ta`) VALUES
(53, 15, 46, 33, 22, 23, 28, 1, 1, 2),
(54, 15, 47, 44, 55, 66, 52, 1, 1, 2),
(55, 15, 46, 44, 55, 44, 47, 8, 1, 2),
(56, 15, 47, 22, 33, 33, 28, 8, 1, 2),
(57, 15, 46, 0, 0, 0, 0, 12, 1, 2),
(58, 15, 47, 0, 0, 0, 0, 12, 1, 2),
(59, 15, 46, 0, 0, 0, 0, 13, 1, 2),
(60, 15, 47, 0, 0, 0, 0, 13, 1, 2),
(63, 15, 46, 55, 66, 55, 58, 14, 1, 2),
(64, 15, 47, 22, 22, 77, 36, 14, 1, 2),
(65, 15, 46, 44, 55, 55, 50, 1, 1, 2),
(66, 15, 46, 66, 55, 44, 58, 8, 1, 2),
(67, 15, 46, 66, 55, 44, 58, 12, 1, 2),
(68, 15, 46, 66, 55, 44, 58, 13, 1, 2),
(69, 15, 46, 0, 0, 0, 0, 14, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ortu`
--

CREATE TABLE `tb_ortu` (
  `id_ortu` int(11) NOT NULL,
  `nm_ayah` varchar(100) NOT NULL,
  `pdd_ayah` varchar(100) NOT NULL,
  `pj_ayah` varchar(100) NOT NULL,
  `nik_ayah` varchar(40) NOT NULL,
  `nm_ibu` varchar(100) NOT NULL,
  `pdd_ibu` varchar(100) NOT NULL,
  `pj_ibu` varchar(100) NOT NULL,
  `nik_ibu` varchar(40) NOT NULL,
  `nm_wali` varchar(100) NOT NULL,
  `pdd_wali` varchar(100) NOT NULL,
  `pj_wali` varchar(100) NOT NULL,
  `nik_wali` varchar(40) NOT NULL,
  `siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ortu`
--

INSERT INTO `tb_ortu` (`id_ortu`, `nm_ayah`, `pdd_ayah`, `pj_ayah`, `nik_ayah`, `nm_ibu`, `pdd_ibu`, `pj_ibu`, `nik_ibu`, `nm_wali`, `pdd_wali`, `pj_wali`, `nik_wali`, `siswa`) VALUES
(25, 'Ayah', '3', 'PNS', '75353536', 'Ibu', '5', 'PNS', '7636354634', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendidikan`
--

CREATE TABLE `tb_pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `nm_pendidikan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendidikan`
--

INSERT INTO `tb_pendidikan` (`id_pendidikan`, `nm_pendidikan`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA'),
(4, 'D3'),
(5, 'S1'),
(6, 'S2'),
(7, 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prestasi`
--

CREATE TABLE `tb_prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `jp` varchar(60) NOT NULL,
  `pres` varchar(90) NOT NULL,
  `siswa` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prestasi`
--

INSERT INTO `tb_prestasi` (`id_prestasi`, `jp`, `pres`, `siswa`, `ta`) VALUES
(1, 'Pekan Olahraga', 'Juara 1 Lomba Voli Putera', 1, 1),
(2, 'Cerdas Cermat', 'Juara 1 Lomba Cerdas Cermat Antar SD', 1, 1),
(3, 'Pekan Olahraga', 'Juara 1 Lomba Lari 100m', 1, 2),
(4, 'Pekan Olahraga', 'Juara 2 Lomba Futsal', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sekolah`
--

CREATE TABLE `tb_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sklh` varchar(30) NOT NULL,
  `ns_sklh` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `kode_pos` varchar(11) NOT NULL,
  `kelurahan` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kabupaten` varchar(30) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `website` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `akreditasi` varchar(2) NOT NULL,
  `kepsek` int(11) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id_sekolah`, `nama_sklh`, `ns_sklh`, `alamat`, `telp`, `kode_pos`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `website`, `email`, `akreditasi`, `kepsek`, `logo`) VALUES
(1, 'SDN PASAR LAMA 6', '1.01156E+12', 'Jl.Akaba Gg. Ibu No. 22C RT. 13', '(021) 63542671', '70115', 'Pasar Lama', 'Banjarmasin Tengah', 'Banjarmasin', 'Kalimantan Selatan', '', 'sdnpasarlama6@gmail.com', 'A', 2, 'logo-kalsel1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sikap_ki1`
--

CREATE TABLE `tb_sikap_ki1` (
  `id_sikap_ki1` int(11) NOT NULL,
  `predikat` varchar(5) NOT NULL,
  `desk` text NOT NULL,
  `ta` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sikap_ki1`
--

INSERT INTO `tb_sikap_ki1` (`id_sikap_ki1`, `predikat`, `desk`, `ta`, `siswa`, `kelas`) VALUES
(33, 'SB', '', 1, 1, 1),
(34, 'B', '', 1, 8, 1),
(35, 'B', '', 1, 12, 1),
(38, 'SB', '', 1, 13, 1),
(41, 'K', '', 1, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sikap_ki2`
--

CREATE TABLE `tb_sikap_ki2` (
  `id_sikap_ki2` int(11) NOT NULL,
  `predikat` varchar(5) NOT NULL,
  `desk` text NOT NULL,
  `ta` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sikap_ki2`
--

INSERT INTO `tb_sikap_ki2` (`id_sikap_ki2`, `predikat`, `desk`, `ta`, `siswa`, `kelas`) VALUES
(7, 'B', '', 1, 1, 1),
(8, 'K', '', 1, 8, 1),
(9, 'B', '', 1, 12, 1),
(12, 'B', '', 1, 13, 1),
(15, 'B', '', 1, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(40) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nm_siswa` varchar(30) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jalan` text NOT NULL,
  `kel` text NOT NULL,
  `kec` text NOT NULL,
  `kab` text NOT NULL,
  `prov` text NOT NULL,
  `pdd_sb` varchar(30) NOT NULL,
  `kelas` int(11) NOT NULL,
  `foto_siswa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nisn`, `nm_siswa`, `jk`, `agama`, `tempat`, `tanggal_lahir`, `jalan`, `kel`, `kec`, `kab`, `prov`, `pdd_sb`, `kelas`, `foto_siswa`) VALUES
(1, '1603', '83140064', 'Alif Rahman', 'L', 'Islam', 'Banjarmasin', '2008-05-21', 'Jl. Antasan Kecil Barat Gg. Ibu No.24A RT. 13', 'Pasar Lama', 'Banjarmasin Barat', 'Banjarmasin', 'Kalimantan Selatan', 'Ya', 1, 'CSS.png'),
(8, '1609', '0063476615', 'Imam Aulia', 'L', 'Islam', 'Banjarmasin', '2008-05-21', 'Jl. S. Parman 1 RT. 19 No. 18', 'Antasan Besar', 'Banjarmasin Barat', 'Banjarmasin', 'Kalimantan Selatan', 'Tidak', 1, ''),
(9, '2354623546', '5454654', 'Rifki Abdillah', 'L', 'ISLAM', 'Banjarmasin', '1997-02-02', 'Sungai Miai', 'Sungai Miai', 'Banjarmasin Utara', 'Banjarmasin', 'Kalsel', 'Ya', 2, ''),
(11, '53264', '554', 'Jun', 'L', '', '', '0000-00-00', '', '', '', '', '', '', 5, ''),
(12, '1616', '0071338890', 'Nuraziza Anatsya Fadillah', 'P', 'Islam', 'Banjarmasin', '2007-05-15', 'Jl. Antasan Kecil BaratGg. Ibu No.24A RT. 13', 'Pasar Lama', 'Banjarmasin Barat', 'Banjarmasin', 'Kalimantan Selatan', '', 1, ''),
(13, '1632', '0072130375', 'Natasya Nabila', 'P', 'Islam', 'Banjarmasin', '2007-05-28', 'Jl. Sulawesi RT. 12 No.28', 'Pasar Lama', 'Banjarmasin Barat', 'Banjarmasin', 'Kalimantan Selatan', '', 1, ''),
(14, '1640', '0083802217', 'Andhika Nugraha', 'L', 'Islam', 'Banjarmasin', '2008-06-15', 'Jl. Antasan Kecil Timur No.93 RT.15', 'Antasan Kecil Timur', 'Banjarmasin Utara', 'Banjarmasin ', 'Kalimantan Selatan', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_smt`
--

CREATE TABLE `tb_smt` (
  `id_smt` int(11) NOT NULL,
  `nm_smt` int(11) NOT NULL,
  `stt_smt` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_smt`
--

INSERT INTO `tb_smt` (`id_smt`, `nm_smt`, `stt_smt`) VALUES
(1, 1, 'Y'),
(2, 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahunajaran`
--

CREATE TABLE `tb_tahunajaran` (
  `id_tahunajaran` int(11) NOT NULL,
  `nm_tahunajaran` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `smt` int(11) NOT NULL,
  `stt_tahunajaran` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tahunajaran`
--

INSERT INTO `tb_tahunajaran` (`id_tahunajaran`, `nm_tahunajaran`, `tahun`, `smt`, `stt_tahunajaran`) VALUES
(1, '2019/2020 - Ganjil', 2019, 1, 'Y'),
(2, '2019/2020 - Genap', 2020, 2, 'N'),
(3, '2020/2021 - Ganjil', 2020, 1, 'N'),
(4, '2020/2021 - Genap', 2021, 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tb_walikelas`
--

CREATE TABLE `tb_walikelas` (
  `id_wk` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `tahun_pj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_ab`
--
ALTER TABLE `tb_ab`
  ADD PRIMARY KEY (`id_ab`);

--
-- Indexes for table `tb_abguru`
--
ALTER TABLE `tb_abguru`
  ADD PRIMARY KEY (`id_abguru`),
  ADD KEY `ab` (`ab`),
  ADD KEY `guru` (`guru`),
  ADD KEY `ta` (`ta`),
  ADD KEY `smt` (`smt`);

--
-- Indexes for table `tb_absiswa`
--
ALTER TABLE `tb_absiswa`
  ADD PRIMARY KEY (`id_absiswa`),
  ADD KEY `ab` (`ab`),
  ADD KEY `siswa` (`siswa`),
  ADD KEY `ta` (`ta`);

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_desk_ki3`
--
ALTER TABLE `tb_desk_ki3`
  ADD PRIMARY KEY (`id_desk_ki3`);

--
-- Indexes for table `tb_desk_ki4`
--
ALTER TABLE `tb_desk_ki4`
  ADD PRIMARY KEY (`id_desk_ki4`);

--
-- Indexes for table `tb_ekskul`
--
ALTER TABLE `tb_ekskul`
  ADD PRIMARY KEY (`id_ekskul`),
  ADD KEY `siswa` (`siswa`),
  ADD KEY `ta` (`ta`);

--
-- Indexes for table `tb_ekskul_siswa`
--
ALTER TABLE `tb_ekskul_siswa`
  ADD PRIMARY KEY (`id_ekskul_siswa`);

--
-- Indexes for table `tb_fisik`
--
ALTER TABLE `tb_fisik`
  ADD PRIMARY KEY (`id_fisik`),
  ADD KEY `siswa` (`siswa`),
  ADD KEY `ta` (`ta`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_hari`
--
ALTER TABLE `tb_hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `hari` (`hari`),
  ADD KEY `mape;` (`mapel`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `guru` (`guru`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_kesehatan`
--
ALTER TABLE `tb_kesehatan`
  ADD PRIMARY KEY (`id_kesehatan`);

--
-- Indexes for table `tb_kondisi`
--
ALTER TABLE `tb_kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `tb_kr_ki3`
--
ALTER TABLE `tb_kr_ki3`
  ADD PRIMARY KEY (`id_kr_ki3`);

--
-- Indexes for table `tb_kr_ki4`
--
ALTER TABLE `tb_kr_ki4`
  ADD PRIMARY KEY (`id_kr_ki4`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_nilai_ki3`
--
ALTER TABLE `tb_nilai_ki3`
  ADD PRIMARY KEY (`id_nilai_ki3`);

--
-- Indexes for table `tb_nilai_ki4`
--
ALTER TABLE `tb_nilai_ki4`
  ADD PRIMARY KEY (`id_nilai_ki4`);

--
-- Indexes for table `tb_nki1`
--
ALTER TABLE `tb_nki1`
  ADD PRIMARY KEY (`id_nki1`);

--
-- Indexes for table `tb_nki2`
--
ALTER TABLE `tb_nki2`
  ADD PRIMARY KEY (`id_nki2`);

--
-- Indexes for table `tb_nki3`
--
ALTER TABLE `tb_nki3`
  ADD PRIMARY KEY (`id_nki3`);

--
-- Indexes for table `tb_nki4`
--
ALTER TABLE `tb_nki4`
  ADD PRIMARY KEY (`id_nki4`);

--
-- Indexes for table `tb_ortu`
--
ALTER TABLE `tb_ortu`
  ADD PRIMARY KEY (`id_ortu`),
  ADD KEY `siswa` (`siswa`);

--
-- Indexes for table `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `siswa` (`siswa`),
  ADD KEY `ta` (`ta`);

--
-- Indexes for table `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD PRIMARY KEY (`id_sekolah`),
  ADD KEY `kepsek` (`kepsek`);

--
-- Indexes for table `tb_sikap_ki1`
--
ALTER TABLE `tb_sikap_ki1`
  ADD PRIMARY KEY (`id_sikap_ki1`),
  ADD KEY `ta` (`ta`),
  ADD KEY `siswa` (`siswa`);

--
-- Indexes for table `tb_sikap_ki2`
--
ALTER TABLE `tb_sikap_ki2`
  ADD PRIMARY KEY (`id_sikap_ki2`),
  ADD KEY `ta` (`ta`),
  ADD KEY `siswa` (`siswa`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_smt`
--
ALTER TABLE `tb_smt`
  ADD PRIMARY KEY (`id_smt`);

--
-- Indexes for table `tb_tahunajaran`
--
ALTER TABLE `tb_tahunajaran`
  ADD PRIMARY KEY (`id_tahunajaran`);

--
-- Indexes for table `tb_walikelas`
--
ALTER TABLE `tb_walikelas`
  ADD PRIMARY KEY (`id_wk`),
  ADD KEY `guru` (`guru`),
  ADD KEY `kelas` (`kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_ab`
--
ALTER TABLE `tb_ab`
  MODIFY `id_ab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_abguru`
--
ALTER TABLE `tb_abguru`
  MODIFY `id_abguru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_absiswa`
--
ALTER TABLE `tb_absiswa`
  MODIFY `id_absiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_desk_ki3`
--
ALTER TABLE `tb_desk_ki3`
  MODIFY `id_desk_ki3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tb_desk_ki4`
--
ALTER TABLE `tb_desk_ki4`
  MODIFY `id_desk_ki4` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_ekskul`
--
ALTER TABLE `tb_ekskul`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_ekskul_siswa`
--
ALTER TABLE `tb_ekskul_siswa`
  MODIFY `id_ekskul_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_fisik`
--
ALTER TABLE `tb_fisik`
  MODIFY `id_fisik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_hari`
--
ALTER TABLE `tb_hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kesehatan`
--
ALTER TABLE `tb_kesehatan`
  MODIFY `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kondisi`
--
ALTER TABLE `tb_kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kr_ki3`
--
ALTER TABLE `tb_kr_ki3`
  MODIFY `id_kr_ki3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kr_ki4`
--
ALTER TABLE `tb_kr_ki4`
  MODIFY `id_kr_ki4` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_nilai_ki3`
--
ALTER TABLE `tb_nilai_ki3`
  MODIFY `id_nilai_ki3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tb_nilai_ki4`
--
ALTER TABLE `tb_nilai_ki4`
  MODIFY `id_nilai_ki4` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_nki1`
--
ALTER TABLE `tb_nki1`
  MODIFY `id_nki1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tb_nki2`
--
ALTER TABLE `tb_nki2`
  MODIFY `id_nki2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tb_nki3`
--
ALTER TABLE `tb_nki3`
  MODIFY `id_nki3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tb_nki4`
--
ALTER TABLE `tb_nki4`
  MODIFY `id_nki4` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tb_ortu`
--
ALTER TABLE `tb_ortu`
  MODIFY `id_ortu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_sikap_ki1`
--
ALTER TABLE `tb_sikap_ki1`
  MODIFY `id_sikap_ki1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_sikap_ki2`
--
ALTER TABLE `tb_sikap_ki2`
  MODIFY `id_sikap_ki2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_smt`
--
ALTER TABLE `tb_smt`
  MODIFY `id_smt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tahunajaran`
--
ALTER TABLE `tb_tahunajaran`
  MODIFY `id_tahunajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_walikelas`
--
ALTER TABLE `tb_walikelas`
  MODIFY `id_wk` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_abguru`
--
ALTER TABLE `tb_abguru`
  ADD CONSTRAINT `tb_abguru_ibfk_1` FOREIGN KEY (`ab`) REFERENCES `tb_ab` (`id_ab`),
  ADD CONSTRAINT `tb_abguru_ibfk_2` FOREIGN KEY (`guru`) REFERENCES `tb_abguru` (`id_abguru`);

--
-- Constraints for table `tb_absiswa`
--
ALTER TABLE `tb_absiswa`
  ADD CONSTRAINT `tb_absiswa_ibfk_1` FOREIGN KEY (`ab`) REFERENCES `tb_ab` (`id_ab`),
  ADD CONSTRAINT `tb_absiswa_ibfk_2` FOREIGN KEY (`siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_ekskul`
--
ALTER TABLE `tb_ekskul`
  ADD CONSTRAINT `tb_ekskul_ibfk_1` FOREIGN KEY (`siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_fisik`
--
ALTER TABLE `tb_fisik`
  ADD CONSTRAINT `tb_fisik_ibfk_1` FOREIGN KEY (`siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`hari`) REFERENCES `tb_hari` (`id_hari`),
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`mapel`) REFERENCES `tb_mapel` (`id_mapel`),
  ADD CONSTRAINT `tb_jadwal_ibfk_3` FOREIGN KEY (`kelas`) REFERENCES `tb_kelas` (`id_kelas`),
  ADD CONSTRAINT `tb_jadwal_ibfk_4` FOREIGN KEY (`guru`) REFERENCES `tb_guru` (`id_guru`);

--
-- Constraints for table `tb_ortu`
--
ALTER TABLE `tb_ortu`
  ADD CONSTRAINT `tb_ortu_ibfk_1` FOREIGN KEY (`siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD CONSTRAINT `tb_sekolah_ibfk_1` FOREIGN KEY (`kepsek`) REFERENCES `tb_guru` (`id_guru`);

--
-- Constraints for table `tb_sikap_ki1`
--
ALTER TABLE `tb_sikap_ki1`
  ADD CONSTRAINT `tb_sikap_ki1_ibfk_4` FOREIGN KEY (`siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_sikap_ki2`
--
ALTER TABLE `tb_sikap_ki2`
  ADD CONSTRAINT `tb_sikap_ki2_ibfk_4` FOREIGN KEY (`siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_walikelas`
--
ALTER TABLE `tb_walikelas`
  ADD CONSTRAINT `tb_walikelas_ibfk_1` FOREIGN KEY (`guru`) REFERENCES `tb_guru` (`id_guru`),
  ADD CONSTRAINT `tb_walikelas_ibfk_2` FOREIGN KEY (`kelas`) REFERENCES `tb_kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
