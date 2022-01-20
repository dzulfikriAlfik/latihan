-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 04:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '287a2c1d2d8f9ac7c3468119bb64ba32', '2022-01-08 08:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'alfik', 1, '2022-01-08 08:23:28', 0),
(2, '::1', 'alfikperfect@gmail.com', 1, '2022-01-08 08:24:35', 1),
(3, '::1', 'alfikperfect@gmail.com', 1, '2022-01-08 08:27:40', 1),
(4, '::1', 'alfikperfect@gmail.com', 3, '2022-01-08 08:46:40', 1),
(5, '::1', 'alfikperfect@gmail.com', 3, '2022-01-08 08:47:57', 1),
(6, '::1', 'alfikperfect@gmail.com', 3, '2022-01-08 08:48:16', 1),
(7, '::1', 'alfikperfect@gmail.com', 3, '2022-01-08 08:49:46', 1),
(8, '::1', 'alfikperfect@gmail.com', 3, '2022-01-08 08:51:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `komik`
--

CREATE TABLE `komik` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `sampul` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komik`
--

INSERT INTO `komik` (`id`, `judul`, `slug`, `penulis`, `penerbit`, `sampul`, `created_at`, `updated_at`) VALUES
(2, 'Naruto', 'naruto', 'Masashi Kishimoto', 'Shonen Jump', 'naruto.png', '2022-01-08 07:26:53', '2022-01-08 07:26:53'),
(3, 'One Piece', 'one-piece', 'Eichiro Oda', 'Shonen Jump', 'onepiece.jpg', '2022-01-08 07:28:06', '2022-01-08 07:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-01-07-142615', 'App\\Database\\Migrations\\Orang', 'default', 'App', 1641648271, 1),
(2, '2022-01-08-131412', 'App\\Database\\Migrations\\Komik', 'default', 'App', 1641648271, 1),
(3, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1641649710, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orang`
--

CREATE TABLE `orang` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orang`
--

INSERT INTO `orang` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Koko Mansur M.M.', 'Ki. Moch. Toha No. 246, Surabaya 54116, KalTim', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(2, 'Fathonah Rahmawati', 'Jr. Bakhita No. 652, Serang 97901, KalSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(3, 'Janet Utami', 'Psr. Suryo No. 228, Pematangsiantar 64527, SumSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(4, 'Raditya Uwais', 'Gg. Jambu No. 532, Subulussalam 53649, KalBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(5, 'Zelaya Kusmawati', 'Dk. Moch. Ramdan No. 545, Metro 61071, Bengkulu', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(6, 'Panji Gunarto S.Gz', 'Psr. Bakti No. 498, Ternate 88637, SulTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(7, 'Asmuni Lanang Mustofa S.Sos', 'Dk. Baabur Royan No. 783, Payakumbuh 53777, KepR', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(8, 'Eli Padmasari', 'Jr. Tentara Pelajar No. 733, Kupang 66821, Aceh', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(9, 'Lala Kuswandari', 'Ki. Gading No. 836, Tegal 90926, Bali', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(10, 'Kamal Prabowo', 'Jr. K.H. Maskur No. 152, Administrasi Jakarta Barat 97551, Lampung', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(11, 'Among Marpaung S.T.', 'Jr. Bagas Pati No. 864, Serang 91171, KalTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(12, 'Vicky Widiastuti', 'Psr. Peta No. 51, Denpasar 79644, NTB', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(13, 'Sarah Dian Hassanah', 'Jln. Ciwastra No. 16, Jambi 47763, Papua', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(14, 'Titi Tira Permata', 'Ds. Hasanuddin No. 206, Palu 41490, SumUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(15, 'Aurora Zulaika', 'Ki. Muwardi No. 146, Blitar 71195, PapBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(16, 'Gabriella Rahmawati', 'Ki. Lumban Tobing No. 588, Administrasi Jakarta Timur 63166, JaTim', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(17, 'Vera Mulyani', 'Jr. Supomo No. 185, Tomohon 18666, KalTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(18, 'Adika Kuswoyo', 'Jr. Banda No. 118, Dumai 72378, DIY', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(19, 'Ida Umi Anggraini S.IP', 'Jln. Padang No. 786, Pematangsiantar 24838, JaTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(20, 'Damar Mahendra', 'Ds. Sampangan No. 546, Ternate 38279, KalTim', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(21, 'Dono Halim S.Pt', 'Ki. Bacang No. 923, Tebing Tinggi 78039, Riau', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(22, 'Ihsan Hidayat S.Kom', 'Kpg. Flora No. 200, Tebing Tinggi 45197, Jambi', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(23, 'Oman Jaga Simanjuntak S.Farm', 'Psr. Dahlia No. 759, Bogor 51607, Gorontalo', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(24, 'Respati Prabawa Wasita S.Psi', 'Kpg. Bahagia  No. 888, Padang 31207, PapBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(25, 'Cinta Palastri', 'Jr. Flores No. 732, Tidore Kepulauan 50309, PapBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(26, 'Lamar Marbun', 'Ki. Sugiyopranoto No. 838, Banjarbaru 81875, SulTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(27, 'Wahyu Ardianto', 'Ds. Bahagia  No. 650, Bau-Bau 68416, JaBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(28, 'Humaira Yuniar S.Kom', 'Jln. Bah Jaya No. 95, Palopo 69012, SumBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(29, 'Fitriani Sudiati S.Farm', 'Jln. Sumpah Pemuda No. 173, Gunungsitoli 27514, KalUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(30, 'Dacin Budiman', 'Jln. Kebonjati No. 176, Bandung 63897, Riau', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(31, 'Najam Slamet Wibisono', 'Ds. Sampangan No. 397, Semarang 66226, Maluku', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(32, 'Ghaliyati Victoria Handayani', 'Psr. Bambu No. 123, Probolinggo 18429, SulSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(33, 'Vera Uyainah', 'Gg. Bayam No. 436, Administrasi Jakarta Utara 81804, SumSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(34, 'Kardi Rajata S.E.', 'Jln. Baung No. 639, Tasikmalaya 38150, Bengkulu', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(35, 'Empluk Eko Anggriawan S.Sos', 'Dk. Halim No. 822, Sawahlunto 33692, SulBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(36, 'Umi Namaga', 'Jr. Moch. Yamin No. 219, Palu 10245, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(37, 'Salsabila Prastuti', 'Kpg. Imam No. 719, Sibolga 30310, DIY', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(38, 'Salsabila Pratiwi', 'Jln. Basmol Raya No. 954, Bogor 60447, Aceh', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(39, 'Ghaliyati Usada S.Farm', 'Ki. Salak No. 372, Blitar 27968, SulSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(40, 'Maida Ida Yolanda', 'Ds. Untung Suropati No. 639, Pangkal Pinang 51767, Maluku', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(41, 'Ratna Suryatmi', 'Kpg. Basuki No. 42, Palopo 85807, BaBel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(42, 'Bahuraksa Wahyu Ardianto', 'Jr. Jayawijaya No. 284, Pematangsiantar 67781, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(43, 'Aisyah Hassanah', 'Gg. Rumah Sakit No. 180, Pekalongan 58981, NTT', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(44, 'Anastasia Hastuti', 'Jr. Haji No. 82, Samarinda 92688, JaTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(45, 'Gamblang Haryanto', 'Ds. Achmad No. 973, Surabaya 76220, SulUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(46, 'Titin Diah Yuliarti', 'Ds. Babakan No. 34, Mataram 49066, Gorontalo', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(47, 'Yani Lestari', 'Gg. Ters. Buah Batu No. 137, Padangpanjang 24031, KalUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(48, 'Akarsana Karya Manullang', 'Jr. Jend. Sudirman No. 674, Palembang 61669, SulUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(49, 'Jelita Ulva Safitri', 'Ki. Daan No. 761, Tidore Kepulauan 91568, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(50, 'Shakila Lailasari S.I.Kom', 'Jln. Bakau Griya Utama No. 192, Bandar Lampung 93224, KepR', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(51, 'Lasmanto Tarihoran', 'Gg. Bayam No. 922, Mataram 74192, SulSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(52, 'Cahya Firmansyah', 'Ds. Halim No. 297, Samarinda 96110, Papua', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(53, 'Wage Eluh Zulkarnain', 'Ds. Ikan No. 409, Gunungsitoli 19921, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(54, 'Lutfan Mandala', 'Dk. Haji No. 741, Palu 40597, SulTeng', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(55, 'Bakiman Bahuraksa Suwarno S.Sos', 'Ds. Basuki No. 204, Bengkulu 73946, Bengkulu', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(56, 'Ami Oktaviani', 'Kpg. Mahakam No. 316, Banjar 83902, KalBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(57, 'Bambang Prasetyo Mahendra', 'Psr. Ronggowarsito No. 971, Sabang 18365, SumUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(58, 'Harsana Nababan', 'Jln. Abdul No. 9, Batu 91864, KalUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(59, 'Padma Nova Nasyiah S.Ked', 'Psr. Ir. H. Juanda No. 639, Depok 99383, BaBel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(60, 'Patricia Wani Uyainah', 'Gg. Pelajar Pejuang 45 No. 5, Parepare 50499, Jambi', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(61, 'Adiarja Najmudin S.T.', 'Kpg. Supomo No. 647, Sibolga 87339, SulSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(62, 'Dina Utami', 'Ds. Batako No. 771, Palopo 55016, SulBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(63, 'Balijan Siregar', 'Gg. Bara No. 669, Banjarbaru 41832, NTB', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(64, 'Hesti Widiastuti', 'Kpg. Ters. Buah Batu No. 445, Medan 38907, SumBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(65, 'Empluk Nugroho', 'Jln. Nangka No. 345, Singkawang 80878, NTB', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(66, 'Kunthara Maulana', 'Jr. Sutan Syahrir No. 371, Makassar 51005, Maluku', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(67, 'Yulia Diah Mandasari S.IP', 'Gg. Dipatiukur No. 848, Langsa 14252, SumUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(68, 'Kurnia Hutapea', 'Ki. Bhayangkara No. 114, Ternate 43088, SulUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(69, 'Pardi Kurniawan', 'Kpg. Adisumarmo No. 487, Tangerang 15831, KalSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(70, 'Dadi Hakim', 'Dk. Pasirkoja No. 31, Bogor 69350, Gorontalo', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(71, 'Karma Yono Mahendra', 'Ds. Padma No. 712, Gunungsitoli 18259, Bali', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(72, 'Rendy Prasetya', 'Psr. Banda No. 445, Bukittinggi 76559, Bali', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(73, 'Mumpuni Nugroho', 'Jln. Perintis Kemerdekaan No. 367, Samarinda 52473, Gorontalo', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(74, 'Yoga Jamil Budiyanto S.H.', 'Psr. Dipenogoro No. 33, Gunungsitoli 38445, Aceh', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(75, 'Eko Pradipta', 'Jln. Bacang No. 252, Binjai 61062, SulSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(76, 'Maida Oktaviani', 'Jln. Abdullah No. 232, Palu 27710, KalBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(77, 'Ajiman Simbolon', 'Gg. Bara No. 561, Palangka Raya 25137, Aceh', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(78, 'Zelda Anita Usamah', 'Psr. Flores No. 82, Bandar Lampung 58509, SulUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(79, 'Nardi Martaka Kurniawan S.IP', 'Dk. Baladewa No. 306, Medan 29301, SumSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(80, 'Salwa Wulan Wahyuni M.TI.', 'Kpg. Suryo No. 566, Sorong 78143, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(81, 'Empluk Nababan', 'Ds. Yap Tjwan Bing No. 697, Kupang 36736, KalBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(82, 'Ratna Mayasari', 'Jln. Rajawali No. 627, Madiun 61175, KepR', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(83, 'Eka Sihombing S.Sos', 'Psr. Bara No. 776, Samarinda 86612, BaBel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(84, 'Muhammad Siregar', 'Kpg. Sugiyopranoto No. 158, Bengkulu 75424, KepR', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(85, 'Estiawan Pranowo', 'Ki. Imam Bonjol No. 66, Kendari 43128, SulBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(86, 'Gabriella Astuti', 'Gg. Salak No. 101, Prabumulih 43449, SulUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(87, 'Natalia Nasyidah M.Farm', 'Dk. Ekonomi No. 570, Sorong 78494, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(88, 'Kajen Waluyo', 'Psr. Kiaracondong No. 714, Administrasi Jakarta Selatan 60835, PapBar', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(89, 'Siti Umi Nurdiyanti M.Farm', 'Jln. Baranang No. 38, Langsa 33176, BaBel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(90, 'Genta Maryati S.T.', 'Psr. Bara Tambar No. 170, Prabumulih 69537, Banten', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(91, 'Ilsa Uli Susanti', 'Jr. Kebonjati No. 132, Administrasi Jakarta Utara 44889, SulTra', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(92, 'Mulyono Rudi Siregar', 'Jln. Abdul Rahmat No. 22, Gorontalo 28142, Gorontalo', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(93, 'Iriana Uyainah', 'Ki. Basket No. 325, Tangerang 79425, NTT', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(94, 'Novi Mulyani', 'Ds. Padma No. 478, Kotamobagu 97317, KalSel', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(95, 'Eja Saiful Siregar', 'Gg. Bagonwoto  No. 902, Tanjung Pinang 65972, NTB', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(96, 'Puput Tami Permata', 'Jln. Teuku Umar No. 450, Prabumulih 39114, KepR', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(97, 'Yulia Kusmawati', 'Jln. Madrasah No. 943, Salatiga 83303, Aceh', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(98, 'Kania Novitasari', 'Psr. Monginsidi No. 415, Pangkal Pinang 39750, NTB', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(99, 'Tantri Hariyah S.Gz', 'Kpg. Bahagia No. 796, Blitar 64331, MalUt', '2022-01-08 07:24:37', '2022-01-08 07:24:37'),
(100, 'Vivi Zelda Astuti', 'Kpg. Jend. A. Yani No. 273, Depok 87469, JaTim', '2022-01-08 07:24:37', '2022-01-08 07:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'alfikperfect@gmail.com', 'alfik', '$2y$10$Vxs/21IVlz2oiy3UJoCOI.33fGcG5e2ANVkdMnKEmTcjWpPDb2Jtu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-01-08 08:44:50', '2022-01-08 08:46:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `komik`
--
ALTER TABLE `komik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orang`
--
ALTER TABLE `orang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komik`
--
ALTER TABLE `komik`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orang`
--
ALTER TABLE `orang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
