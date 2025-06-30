-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 01:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libs`
--

-- --------------------------------------------------------

--
-- Table structure for table `authers`
--

CREATE TABLE `authers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authers`
--

INSERT INTO `authers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Micah Kuphal', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(6, 'Ms. Nora Volkman', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(7, 'Miss Angela Koch V', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(8, 'Prof. Cornelius Prosacco', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(9, 'Dr. Domingo Stracke III', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(10, 'Ceasar Bogisich', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(14, 'Tere Liye', '2025-01-22 00:40:33', '2025-01-22 00:40:33'),
(15, 'Bonggas L. Tobing', '2025-02-05 03:52:53', '2025-02-05 03:52:53'),
(16, 'Enid Blyton', '2025-02-05 05:45:36', '2025-02-05 05:45:36'),
(17, 'Andrea Hirata', '2025-02-25 14:05:11', '2025-02-25 14:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `auther_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `sinopsis` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `category_id`, `auther_id`, `publisher_id`, `status`, `created_at`, `updated_at`, `product_code`, `cover_image`, `sinopsis`) VALUES
(19, 'Mein Kampfh', 14, 8, 3, 'Y', '2025-01-13 09:41:44', '2025-03-13 16:03:25', '34611431', 'images/6796575157740.webp', 'Mein Kampf (terj. har. Perjuanganku) adalah buku otobiografi dan manifesto buatan Adolf Hitler dari 1924 sampai 1925. Buku ini berisi proses di mana Hitler mulai bersifat antisemit dan menguraikan ideologi politiknya dan rencana masa depan untuk Jerman. Volume 1 Mein Kampf diterbitkan pada 1925 dan Volume 2 pada 1926.[1] Buku ini pertama kali diedit Emil Maurice, kemudian oleh asisten Hitler Rudolf Hess.[2][3]\r\n\r\nHitler mulai menulis Mein Kampf saat ia dipenjara setelah kudetanya gagal di Munich pada November 1923 dan peradilan atas Makar pada Februari 1924, dimana ia diberi hukuman lima tahun. Meskipun pada awalnya dia menerima banyak pengunjung, dia segera mengabdikan dirinya sepenuhnya untuk buku itu. Saat ia melanjutkan, ia menyadari bahwa itu harus menjadi karya dua jilid, dengan jilid pertama dijadwalkan untuk dirilis pada awal 1925. Gubernur Landsberg mencatat pada saat itu bahwa \"dia [Hitler] berharap bukunya akan diterbitkan dalam banyak edisi, sehingga memungkinkan dia untuk memenuhi kewajiban keuangannya dan untuk membayar biaya yang dikeluarkan pada saat persidangannya.\"[4][5] Setelah penjualan awal yang lambat, bukunya kemudian menjadi buku terlaris di Jerman setelah Hitler mulai berkuasa pada 1933.[6]\r\n\r\nSetelah kematian Hitler pada 1945, Hak cipta Mein Kampf diberikan kepada pemerintah negara bagian Bavaria, yang melarang penyalinan atau pencetakan buku tersebut di Jerman. Pada Januari 2016, hak cipta buku ini berakhir menjadi domain publik setelah 70 tahun kematian penulis. Ini memicu kembali perdebatan publik tentang apakah buku tersebut pantas diterbitkan ulang.'),
(20, 'Pulang Pergi', 15, 14, 14, 'N', '2025-01-22 00:43:26', '2025-03-16 18:26:59', '17827691', 'images/6790a19ee87bd.jpeg', 'Bercerita tentang Bujang yang kembali harus berpetualang setelah pergi dan pulang. Saat Bujang sedang berada di pusara mamak dan bapaknya, Bujang mendapatkan sebuah pesan dari Krestiny Otets, pemimpin brotherhood Bratva.\r\n\r\nIsi pesan tersebut adalah perintah untuk Bujang dalam dua hari kedepan untuk bertunangan dengan Maria, putri Otets. Jika Bujang tidak hadir dalam acara pertunangan tersebut, berarti Bujang telah membuat malu dan menyakiti hati Maria. Sebagai balasannya, jika Bujang mengingkari pertunangannya, pusara kedua orangtuanya akan Otets ratakan.\r\n\r\nBujang yang tidak mau membuat masalah dengan Otets, pada akhirnya memilih untuk pergi dan terbang ke Rusia. Namun, Bujang tidak sendiri, ia ditemani oleh Salonga dan murid menembaknya, Junior.\r\n\r\nKehadiran Salonga diharapkan dapat menunda perjodohan antara Bujang dan Maria. Salonga siap untuk bernegosiasi dengan Otets agar dapat membantu Bujang menunda perjodohan atau bahkan membatalkannya.\r\n\r\nPadahal Salonga sendiri ingin jika Bujang dapat bertunangan dengan Maria, tapi apa boleh dikata, jika Bujang keberatan dengan perjodohan ini, Salonga hanya bisa mendukungnya.\r\n\r\nSaat tiba di Rusia, tak disangka Bujang malah bertemu dengan Thomas, seorang ahli keuangan yang memiliki keahlian dalam pertarungan jarak dekat. Thomas hadir karena Otets memerlukan masukan perihal keuangan.\r\n\r\nNamun, acara pertunangan tersebut malah berubah menjadi sebuah acara pernikahan. Bujang yang merasa tidak siap sukses dibuat kesal dan kecewa. Apalagi Bujang tidak dapat kabur atau menolak perjodohan tersebut, karena ia tidak mau membuat masalah dengan penguasa shadow economy paling kuat di Rusia tersebut.\r\n\r\nBujang hanya bisa berharap ada keajaiban yang bisa menghentikan atau membatalkan acara pernikahan dirinya dengan Maria. Ajaibnya, mukjizat itu datang dalam serbuan puluhan tukang pukul yang disebut dengan Black Widow. \r\n\r\nBlack Widow sendiri merupakan kelompok yang dibentuk dan dikembangkan oleh Natascha, pemimpin tukang pukul kepercayaan Otets. Natascha sendiri sebenarnya sudah dianggap sebagai bibi sendiri bagi Maria, tapi apa mau dikata dia ternyata pengkhianat.\r\n\r\nAcara pernikahan tersebut berubah menjadi pertumpahan darah, di mana Natascha berhasil mengambil nyawa Otets. Dalam pertarungan tersebut, Bujang, Salonga, Matia, Junior, dan Thomas berhasil keluar dari serangan Black Widow. Akhirnya Natascha bisa menguasai Bratva yang dipimpin oleh Otets.\r\n\r\nNamun, Natascha belum dapat secara resmi menjadi pemimpin Bratva jika Maria, Bujang, Salonga, Junior, dan Thomas belum dapat ia singkirkan. Natascha pun mulai memburu mereka agar dapat mewujudkan keinginannya. Bahkan Natascha rela mengeluarkan uang yang tidak sedikit untuk mencari mereka lewat tangan pembunuh bayaran.\r\n\r\nKini di tengah pelarian, Maria, Bujang, Salonga, Junior, dan Thomas harus menghadapi berbagai kelompok pembunuh bayaran yang mengincar mereka. Bujang harus meminta bantuan kepada orang-orang yang tepat agar mampu keluar dari pengejaran yang dilakukan oleh Natascha.\r\n\r\nDalam pelariannya Bujang berusaha untuk menyusun rencana melawan balik Natascha, tapi di tengah perjalanan, ia malah bertemu dengan sosok yang tak terduga.'),
(21, 'The Star Diaries', 16, 1, 2, 'Y', '2025-01-30 05:19:35', '2025-02-25 13:01:08', '66269606', 'images/679b6e57674b6.jfif', 'Buku ini mengisahkan petualangan dari penjelajah luar angkasa asal bumi, Ijon Tichy yang ditugaskan untuk menjelajahi galaksi sebagai delegasi Perserikatan Planet-Planet. Dalam penjelajahannya, Tichy dihadapkan dengan berbagai kondisi planet yang berbeda dengan planet miliknya. Petualangan Tichy terangkum dalam buku The Star Diaries. Dia mulai dari menyelinap ke dalam planet robot gila, mencoba menduplikasikan dirinya sendiri dalam operasi penyelamatan sejarah umat manusia, hingga masuk ke planet rahasia yang segala sesuatu di dalam diri manusia dapat diprogram adalah pengalaman yang dirasakan oleh tokoh utama buku tersebut. \r\nKebenaran Sejarah G-30-S dari 4 Buku Semua petualangan gila Tichy tersebut ingin mengajak pembaca menyelami pertanyaan besar tentang wujud rasionalitas, kehendak bebas, keyakinan, dan kesucian. Dengan menampilkan cerita dan karakter yang satir dan lucu, The Star Diaries telah dikemas oleh Stanis?aw Lem untuk dinikmati para penikmat filsafat dengan balutan komedi satir yang segar.'),
(22, 'Dasar Teknik Pengujian Tegangan Tinggi', 18, 15, 15, 'Y', '2025-02-05 05:39:35', '2025-03-13 16:04:00', '39638385', 'images/67a35c075e74a.jpg', 'Buku \"Dasar-dasar Teknik Pengujian Tegangan Tinggi\" karya Ir. Bonggas L. Tobing membahas pentingnya pengujian tegangan tinggi dalam memastikan keandalan sistem tenaga listrik. Keandalan sistem tersebut sangat bergantung pada kualitas komponen-komponennya. Oleh karena itu, pengujian terhadap komponen-komponen sistem—baik sebelum pemasangan, sesudah pemasangan, maupun setelah beroperasi dalam periode tertentu—merupakan hal yang krusial. Salah satu jenis pengujian yang harus dilakukan adalah pengujian tegangan tinggi. Selain itu, pengujian tegangan tinggi juga dibutuhkan dalam rangka perancangan isolasi suatu peralatan listrik dan untuk meneliti sifat-sifat listrik suatu bahan isolasi. \r\nDalam buku ini, penulis memaparkan berbagai jenis pengujian tegangan tinggi yang perlu dilakukan terhadap peralatan listrik, peralatan yang dibutuhkan untuk pengujian tersebut, serta prosedur pengujian peralatan listrik dengan tegangan tinggi. Buku ini disusun sebagai acuan bagi mahasiswa teknik elektro yang sedang mengikuti kuliah teknik tegangan tinggi, terutama yang sedang mengikuti praktikum teknik tegangan tinggi. Buku ini juga bermanfaat bagi mahasiswa dan sarjana fisika yang melakukan penelitian tentang sifat-sifat listrik material dielektrik. Para teknisi industri juga perlu mempelajari buku ini untuk digunakan sebagai acuan dalam melaksanakan pengujian tegangan tinggi terhadap peralatan listrik yang diproduksi, sebagai acuan dalam pengujian peralatan pasangan baru, maupun sebagai acuan dalam pemeliharaan rutin peralatan listrik yang sudah beroperasi.'),
(23, 'Pulang', 19, 14, 16, 'N', '2025-02-05 05:44:29', '2025-02-18 11:43:09', '69459447', 'images/67a35d2d9987b.jpg', 'Pulang\" adalah novel karya Tere Liye yang diterbitkan pada tahun 2015.erita ini mengikuti perjalanan hidup Bujang, seorang remaja berusia 15 tahun yang memiliki keahlian luar biasa dalam berburu babi hutan.emampuan ini menarik perhatian Teuku Muda, seorang tokoh berpengaruh yang membawanya ke kota dan mengasuhnya layaknya anak sendiri.\r\ni bawah asuhan Teuku Muda, Bujang mendapatkan pendidikan dan pelatihan bela diri dari para ahli, termasuk guru tinju Kopong, pelatih menembak Salonga, dan guru samurai Bushi.a tumbuh menjadi sosok yang cerdas, kuat, dan terampil dalam berbagai bidang.eahliannya membuatnya terlibat dalam berbagai misi penting, seperti pemberantasan judi dan pencurian sandi rahasia dari keluarga Master Dragon.\r\neiring berjalannya waktu, kesehatan Teuku Muda menurun.enyadari hal ini, ia menawarkan Bujang untuk menjadi kepala keluarga dan memimpin orang-orang yang selama ini bekerja untuknya.amun, Bujang lebih memilih untuk tetap setia dan membantu Teuku Muda dalam menghadapi pengkhianatan dari dalam keluarga besar mereka.uatu hari, Bujang menerima kabar bahwa ibunya telah pergi tanpa jejak, yang mendorongnya untuk kembali ke kampung halamannya dan mencari tahu kebenaran di balik kabar tersebut. Melalui kisah Bujang, novel ini menyajikan tema tentang perjuangan hidup, kesetiaan, dan pencarian identitas diri.ere Liye berhasil menggabungkan elemen aksi, petualangan, dan refleksi mendalam dalam narasinya, menjadikannya salah satu karya yang layak untuk dibaca.'),
(24, '5 Sekawan', 20, 16, 17, 'N', '2025-02-05 05:48:36', '2025-02-25 13:02:51', '63831966', 'images/67a35e24da90f.jpg', 'Seri *Lima Sekawan* (judul asli *The Famous Five*) adalah rangkaian buku petualangan anak-anak yang sangat populer yang ditulis oleh Enid Blyton. Dimulai pada tahun 1942, seri ini berfokus pada lima anak yang sangat dekat satu sama lain dan suka menjelajahi dunia, memecahkan misteri, serta mengungkap kejahatan. Karakter utama dalam seri ini adalah Julian, Dick, Anne, George (yang sebenarnya bernama Georgina, tetapi ia lebih suka dipanggil George dan membenci ide menjadi gadis), serta anjing mereka, Timmy.\r\nSetiap buku dalam seri ini mengikuti petualangan kelima anak ini, yang sering kali melibatkan mereka dalam kasus yang melibatkan penyelundupan, pencurian, atau kejahatan lainnya. Mereka berani dan cerdas, serta menggunakan keterampilan masing-masing untuk mengatasi masalah yang mereka hadapi. Julian sering menjadi pemimpin kelompok, sementara Dick cenderung lebih lucu dan ceria, Anne memiliki sifat penyayang, George adalah anak perempuan yang tomboy dan penuh semangat, dan Timmy, anjing mereka, adalah sosok yang setia dan sangat membantu dalam banyak situasi.\r\nPetualangan pertama mereka dimulai saat keluarga mereka menghabiskan liburan di rumah George yang terletak di tepi laut, di Pulau Kirrin. Dalam buku pertama ini, mereka menemukan peta harta karun yang membawa mereka pada petualangan seru di pulau tersebut, berusaha menemukan harta karun yang tersembunyi. Namun, mereka harus menghadapi musuh-musuh yang mencoba merebut peta mereka dan menghalangi mereka mencapai tujuan.\r\nSetelah buku pertama, berbagai petualangan terus menguji keberanian mereka. Dalam *Lima Sekawan dan Kereta Hantu*, mereka berhadapan dengan misteri seputar sebuah kereta api yang konon berhantu. Di *Lima Sekawan dan Penculikan Timmy*, mereka harus menyelamatkan anjing kesayangan mereka, Timmy, dari penculik yang berbahaya. Dalam *Lima Sekawan dan Pencurian* serta buku-buku lainnya, mereka menghadapi lebih banyak kasus seru, seperti menyelidiki penyelundup, menemukan harta karun tersembunyi, atau mengejar kejahatan besar lainnya.\r\nSelain petualangan seru dan misteri, buku-buku *Lima Sekawan* juga menyampaikan nilai-nilai persahabatan, keberanian, kejujuran, dan saling membantu. Para pembaca muda dapat melihat bagaimana karakter-karakter ini bekerja sama untuk menyelesaikan masalah, mengatasi rasa takut mereka, dan membantu orang lain. Karakter utama dalam cerita ini juga menunjukkan pentingnya rasa tanggung jawab, ketekunan, dan keinginan untuk melakukan hal yang benar, tidak peduli betapa sulit atau menakutkannya situasi tersebut.\r\nSeri ini menjadi salah satu karya literatur anak-anak yang paling terkenal dan banyak dibaca di seluruh dunia. Buku ini telah diterjemahkan ke dalam berbagai bahasa dan masih sangat digemari oleh pembaca muda hingga sekarang. Meskipun buku pertama kali diterbitkan lebih dari tujuh dekade yang lalu, kisah petualangan Lima Sekawan tetap relevan karena kekuatan cerita dan tema-tema universal yang diangkat.\r\nMelalui cerita yang sederhana namun menarik ini, Enid Blyton berhasil menciptakan dunia yang penuh keajaiban dan petualangan yang membuat pembaca terpesona dan penasaran untuk mengikuti perjalanan Lima Sekawan dalam buku-buku berikutnya.'),
(32, 'Berdamai Dengan Emosi', 17, 16, 17, 'Y', '2025-02-25 13:38:16', '2025-02-25 13:45:29', '29082616', 'images/67be2b893f947.jpg', 'Persoalan-persoalan yang ringan kadang-kadang dapat diatasi dalam waktu yang singkat, akan tetapi persoalan lainnya memakan waktu yang lebih lama. Konflik dan tekanan merupakan penyebab ketegangan dalam hidup. Bahkan ada peribahasa mengatakan bahwa sebenarnya tidak ada orang yang dapat dikatakan sebagai orang normal. Kita kadang-kadang menunjukkan perilaku yang tidak logis serta memaksa, dan menderita penyakit yang disebabkan oleh emosi. Ingatlah, berapa kali kita mengeluh ketika terlambat datang ke tempat kuliah, atau ketika kita dibebani tugas berlebih oleh atasan. Bila kita menderita sakit yang disebabkan oleh jiwa dan emosi, apakah sebaiknya kita merawat diri sendiri?\r\n\r\nDalam buku ini, kita akan mendapatkan teori sekaligus praktik untuk penyembuhan diri sendiri yang berkaitan dengan masalah kejiwaan. Misalnya lewat hipnotis diri maupun latihan-latihan sederhana untuk melepaskan persoalaan kejiwaan di masa lalu yang masih terbawa hingga saat ini. Walaupun kita abaikan persoalan di masa lalu, akan tetapi secara tidak kita sadari akan memengaruhi perilaku kita di masa kita. Jadi, mengapa kita bawa beban masa lalu, jika kita mampu melepaskan beban itu?'),
(33, 'Laskar Pelangi', 15, 17, 18, 'N', '2025-02-25 14:07:52', '2025-03-13 16:16:33', '74557319', 'images/67be31288113b.jpg', 'Cerita terjadi di Desa Gantung, Belitung Timur. Dimulai ketika sekolah Muhammadiyah terancam akan dibubarkan oleh Depdikbud Sumsel jikalau tidak mencapai siswa baru sejumlah 10 anak. Ketika itu baru 9 anak yang menghadiri upacara pembukaan, akan tetapi tepat ketika Pak Harfan, sang kepala sekolah, hendak berpidato menutup sekolah, Harun dan ibunya datang untuk mendaftarkan diri di sekolah kecil itu.\r\n\r\nDari sanalah dimulai cerita mereka. Mulai dari penempatan tempat duduk, pertemuan mereka dengan Pak Harfan, perkenalan mereka yang luar biasa di mana A Kiong yang malah cengar-cengir ketika ditanyakan namanya oleh guru mereka, Bu Mus. Kejadian bodoh yang dilakukan oleh Borek, pemilihan ketua kelas yang diprotes keras oleh Kucai, kejadian ditemukannya bakat luar biasa Mahar, pengalaman cinta pertama Ikal, sampai pertaruhan nyawa Lintang yang mengayuh sepeda 80 km pulang pergi dari rumahnya ke sekolah.\r\n\r\nMereka, Laskar Pelangi –nama yang diberikan Bu Muslimah akan kesenangan mereka terhadap pelangi– pun sempat mengharumkan nama sekolah dengan berbagai cara. Misalnya pembalasan dendam Mahar yang selalu dipojokkan kawan-kawannya karena kesenangannya pada okultisme yang membuahkan kemenangan manis pada karnaval 17 Agustus, dan kegeniusan luar biasa Lintang yang menantang dan mengalahkan Drs. Zulfikar, guru sekolah kaya PN yang berijazah dan terkenal, dan memenangkan lomba cerdas cermat. Laskar Pelangi mengarungi hari-hari menyenangkan, tertawa dan menangis bersama. Kisah sepuluh kawanan ini berakhir dengan kematian ayah Lintang yang memaksa Einstein cilik itu putus sekolah dengan sangat mengharukan, dan dilanjutkan dengan kejadian 12 tahun kemudian di mana Ikal yang berjuang di luar pulau Belitong kembali ke kampungnya. Kisah indah ini diringkas dengan kocak dan mengharukan oleh Andrea Hirata, kita bahkan bisa merasakan semangat masa kecil anggota sepuluh Laskar Pelangi ini.');

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `return_date` timestamp NULL DEFAULT NULL,
  `issue_status` varchar(255) DEFAULT NULL,
  `return_day` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rental_price` varchar(255) NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_issues`
--

INSERT INTO `book_issues` (`id`, `student_id`, `book_id`, `issue_date`, `return_date`, `issue_status`, `return_day`, `created_at`, `updated_at`, `rental_price`, `user_id`) VALUES
(89, NULL, 23, '2025-02-17 17:00:00', '2025-02-20 17:00:00', 'N', NULL, '2025-02-18 11:43:09', '2025-02-18 11:43:09', '0', 14),
(91, NULL, 24, '2025-02-24 17:00:00', '2025-02-27 17:00:00', 'N', NULL, '2025-02-25 13:02:51', '2025-02-25 13:02:51', '0', 17),
(93, NULL, 33, '2025-03-12 17:00:00', '2025-03-15 17:00:00', 'N', NULL, '2025-03-13 16:16:33', '2025-03-13 16:16:33', '0', 12),
(95, NULL, 20, '2025-03-16 17:00:00', '2025-03-19 17:00:00', 'N', NULL, '2025-03-16 18:26:59', '2025-03-16 18:26:59', '0', 12);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(14, 'History', '2025-01-22 00:39:11', '2025-01-22 00:39:11'),
(15, 'Romance', '2025-01-22 00:39:56', '2025-01-22 00:39:56'),
(16, 'Sci-Fi', '2025-02-02 05:53:12', '2025-02-02 05:53:12'),
(17, 'Drama', '2025-02-02 05:53:21', '2025-02-02 05:53:21'),
(18, 'Science', '2025-02-05 03:54:01', '2025-02-05 03:54:01'),
(19, 'Fantasy', '2025-02-05 05:41:00', '2025-02-05 05:41:00'),
(20, 'Mistery', '2025-02-05 05:46:18', '2025-02-05 05:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `return_date` timestamp NULL DEFAULT NULL,
  `issue_status` varchar(255) DEFAULT NULL,
  `return_day` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `student_name`, `book_name`, `issue_date`, `return_date`, `issue_status`, `return_day`, `created_at`, `updated_at`, `denda`) VALUES
(41, 'Amelia Earhart', 'buku informatika', '2024-12-11 22:56:07', '2025-01-23 17:00:00', 'N', 3, '2025-01-22 01:45:58', '2025-01-22 01:45:58', 500),
(42, 'Amelia Earhart', 'buku informatika', '2025-01-01 22:56:23', '2025-01-23 17:00:00', 'N', 3, '2025-01-22 01:48:25', '2025-01-22 01:48:25', 500),
(43, 'Amelia Earhart', 'Buku IPA', '2025-01-21 22:56:18', '2025-01-23 17:00:00', 'N', 3, '2025-01-22 01:48:31', '2025-01-22 01:48:31', 500),
(44, 'Sifo', 'Buku IPA', '2025-01-21 22:56:25', '2025-01-23 17:00:00', 'N', 3, '2025-01-22 01:49:41', '2025-01-22 01:49:41', 500),
(52, 'Amelia Earhart', 'The Star Diaries', '2025-01-30 22:56:29', '2025-02-03 17:00:00', 'N', 3, '2025-02-04 08:00:18', '2025-02-04 08:00:18', 500),
(53, 'Ahmad Ruri Al-Mutokhir', 'The Star Diaries', '2025-01-30 22:56:30', '2025-02-03 17:00:00', 'N', 3, '2025-02-04 08:01:30', '2025-02-04 08:01:30', 500),
(54, 'Ahmad Ruri Al-Mutokhir', 'Pulang Pergi', '2025-01-30 22:56:32', '2025-02-03 17:00:00', 'N', 3, '2025-02-04 08:01:53', '2025-02-04 08:01:53', 500),
(55, 'Amelia Earhart', 'Mein Kampfh', '2025-01-31 22:56:37', '2025-02-03 17:00:00', 'Y', 3, '2025-02-04 08:24:08', '2025-02-04 08:24:08', 500),
(56, 'Amelia Earhart', 'Mein Kampfh', '2025-01-31 22:56:41', '2025-02-03 17:00:00', 'Y', 3, '2025-02-04 08:24:16', '2025-02-04 08:24:16', 500),
(57, 'Muhammad Agus Supardi', 'Pulang Pergi', '2025-01-31 22:56:42', '2025-02-03 17:00:00', 'Y', 3, '2025-02-04 08:24:44', '2025-02-04 08:24:44', 500),
(58, 'Muhammad Agus Supardi', 'Mein Kampfh', '2025-02-04 22:56:44', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:09:37', '2025-02-09 05:09:37', 500),
(59, 'Ahmad Ruri Al-Mutokhir', '5 Sekawan', '2025-02-04 22:56:45', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:10:39', '2025-02-09 05:10:39', 500),
(60, 'Muhammad Agus Supardi', 'Mein Kampfh', '2025-02-04 22:56:46', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:14:24', '2025-02-09 05:14:24', 500),
(61, 'Ahmad Ruri Al-Mutokhir', '5 Sekawan', '2025-02-06 22:56:49', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:14:28', '2025-02-09 05:14:28', 500),
(64, 'Amelia Earhart', 'Dasar Teknik Pengujian Tegangan Tinggi', '2025-02-05 22:56:51', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:29:42', '2025-02-09 05:29:42', 500),
(65, 'Muhammad Agus Supardi', '5 Sekawan', '2025-02-07 22:56:52', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:30:19', '2025-02-09 05:30:19', 500),
(66, 'Ahmad Ruri Al-Mutokhir', 'Pulang', '2025-02-07 22:56:53', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:32:24', '2025-02-09 05:32:24', 500),
(67, 'Ahmad Ruri Al-Mutokhir', 'Dasar Teknik Pengujian Tegangan Tinggi', '2025-02-07 22:56:56', '2025-02-08 17:00:00', 'Y', 3, '2025-02-09 05:32:29', '2025-02-09 05:32:29', 500),
(68, 'Amelia Earhart', 'The Star Diaries', '2025-02-19 17:00:00', '2025-02-24 17:00:00', 'Y', 3, '2025-02-25 13:01:08', '2025-02-25 13:01:08', 1500),
(69, 'Ahmad Ruri Al-Mutokhir', 'Laskar Pelangi', '2025-02-24 17:00:00', '2025-02-24 17:00:00', 'Y', 3, '2025-02-25 14:09:28', '2025-02-25 14:09:28', 1500),
(70, 'Gotterdammerung', 'Mein Kampfh', '2025-02-15 17:00:00', '2025-03-12 17:00:00', 'Y', 3, '2025-03-13 16:03:25', '2025-03-13 16:03:25', 1000),
(71, 'Gotterdammerung', 'Dasar Teknik Pengujian Tegangan Tinggi', '2025-02-17 17:00:00', '2025-03-12 17:00:00', 'Y', 3, '2025-03-13 16:04:00', '2025-03-13 16:04:00', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_28_031441_create_settings_table', 1),
(6, '2021_12_28_032107_create_students_table', 1),
(7, '2021_12_28_032307_create_publishers_table', 1),
(8, '2021_12_28_032327_create_categories_table', 1),
(9, '2021_12_28_032552_create_authers_table', 1),
(10, '2021_12_28_032555_create_books_table', 1),
(11, '2021_12_28_032649_create_book_issues_table', 1),
(12, '2024_11_05_092026_add_role_to_users_table', 1),
(13, '2024_12_16_051158_history', 2);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Prof. Ivory Hackett', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(3, 'Carissa Torp', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(5, 'Miss Leatha Schuppe', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(7, 'Diana Klein', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(8, 'Pat Luettgen', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(9, 'Prof. Cesar Carroll PhD', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(13, 'Serindo', '2025-01-14 08:14:18', '2025-01-14 08:14:18'),
(14, 'Gramedia', '2025-01-22 00:41:05', '2025-01-22 00:41:05'),
(15, 'Erlangga', '2025-02-05 03:53:44', '2025-02-05 03:53:44'),
(16, 'Republika', '2025-02-05 05:41:47', '2025-02-05 05:41:47'),
(17, 'Hodder & Stoughton', '2025-02-05 05:46:10', '2025-02-05 05:46:10'),
(18, 'Bentang Pustaka', '2025-02-25 14:05:32', '2025-02-25 14:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_days` varchar(255) NOT NULL,
  `fine` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `denda` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `return_days`, `fine`, `created_at`, `updated_at`, `denda`) VALUES
(1, '3', '4', '2024-12-15 21:07:43', '2025-02-25 14:35:34', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `age`, `gender`, `email`, `phone`, `address`, `class`, `created_at`, `updated_at`) VALUES
(1, 'Ms. Lydia Funk', '30', 'female', 'moore.macey@example.com', '+16053940911', '78995 Wilton Fork Suite 219\nEast Ignacioborough, KY 65617-8652', 'Et id harum.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(2, 'Macey Monahan', '24', 'female', 'annette63@example.org', '909-870-0083', '3214 Brayan Center\nSouth Maya, HI 02541', 'Quam fugiat et.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(3, 'Miss Antonia Monahan', '32', 'male', 'steuber.syble@example.net', '650.639.7586', '64444 Koch Road Suite 775\nEast Meredith, NJ 62356', 'Tenetur autem ut.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(4, 'Johnnie Bosco', '73', 'male', 'jhamill@example.net', '+1.251.716.9081', '263 Brett Lock\nNadiaburgh, LA 97058', 'Eos autem iste veritatis.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(5, 'Kim Schumm', '34', 'female', 'bins.estefania@example.com', '(832) 496-1803', '59073 Zoie Alley Apt. 381\nCarterborough, NV 33327-4240', 'A et aliquam qui.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(6, 'Aubrey Hilpert', '35', 'male', 'dejon48@example.net', '+1-443-580-9736', '500 Balistreri Underpass Apt. 148\nMadgeshire, NJ 07492', 'Ullam cum qui.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(7, 'Jennyfer O\'Connell', '79', 'female', 'dawn41@example.com', '(812) 714-1354', '880 Ward Ramp\nMurazikmouth, MI 00030', 'Dolores praesentium perferendis molestiae.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(8, 'Jan Mante', '25', 'female', 'daphney54@example.org', '231.673.3928', '3419 Glenda Walks\nSouth Crystalborough, CA 70783', 'Optio quas omnis rerum.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(9, 'Kacie Dietrich', '78', 'female', 'fritsch.jaclyn@example.net', '1-401-557-9206', '93806 Ferry Lake Suite 293\nSouth Dorianshire, CO 96166', 'Ab at natus rerum.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(10, 'Theo Schmidt DVM', '60', 'female', 'jmccullough@example.com', '(936) 432-7881', '9632 Stracke Ridge\nWest Maidaton, ME 67778-4029', 'Minus assumenda perferendis nihil.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(11, 'Moses Crist', '18', 'male', 'rklocko@example.net', '(223) 298-6917', '30507 Crona Trail\nKozeyview, NM 26554', 'Nemo consequatur neque.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(12, 'Claire Bayer', '22', 'female', 'micaela.halvorson@example.net', '1-551-365-2839', '19557 Jena Knolls Suite 535\nBurleyburgh, DE 00830', 'Laboriosam praesentium autem labore.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(13, 'Quinn Bartoletti', '79', 'male', 'schuster.roselyn@example.org', '1-240-667-4130', '569 Haskell River Suite 067\nNew Kyleestad, SC 71192-6717', 'Quo quidem enim.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(14, 'Melvina Casper', '38', 'male', 'bschuster@example.org', '(860) 730-4475', '8390 Wolf Cove Suite 196\nVilmastad, FL 48459-0232', 'Quia saepe dignissimos.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(15, 'Miss Lenna Bogisich MD', '28', 'male', 'lynch.keon@example.com', '270-238-5243', '399 Turcotte Mission\nNorth Lenora, NY 13164-0056', 'Consequatur eum voluptatem et.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(16, 'Miss Meghan Rowe', '73', 'male', 'kiarra.green@example.com', '+1-920-483-9554', '637 Koss Vista Apt. 785\nPort Crawford, SC 53464', 'Possimus et quo labore.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(17, 'Carol Kertzmann', '52', 'female', 'beau88@example.org', '1-747-489-0417', '4605 Herminio Shoal Suite 535\nKacifurt, UT 70448-9222', 'Vitae sequi enim.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(18, 'Genevieve O\'Conner', '54', 'female', 'janick51@example.org', '+1 (434) 970-5238', '1348 Schmeler Ranch\nLake Iva, SD 01522-1732', 'Quo dolor iste iure.', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(19, 'Adriana McCullough', '66', 'male', 'zprice@example.com', '1-989-694-5332', '73611 Mathias Stream Apt. 148\nWest Adolphus, NJ 43062', 'Nesciunt cumque autem.', '2024-12-15 21:07:43', '2024-12-15 21:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('student','librarian') NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`, `email`, `role`, `age`, `gender`, `phone`, `address`, `class`) VALUES
(3, 'kiki', 'kiki', '$2y$10$/BRJOPEHGQO0DxyZ97esd.TA2WdItDdFg7Qr4Hcrmom2ypNGKaqCa', '2024-12-17 00:04:42', '2024-12-17 00:04:42', 'kiki@gmail.com', 'librarian', '', '', '', '', ''),
(9, 'Gotterdammerung', NULL, '$2y$10$NbqTmzm8hwWpqYjzy3sLh.hwEcQsXEy60BN83uPqh.2E.1AbXDara', '2025-01-19 01:32:46', '2025-02-05 03:45:35', 'adolf@gmail.com', 'student', '11', 'male', '08123654123213', 'Germany', '9'),
(11, 'Muhammad Agus Supardi', NULL, '$2y$10$Nl7dZbCMwL.WvAQTCO.O/OOrpi7z72XZ7DAZg1wxOAUHJdihWEWZe', '2025-01-22 00:49:25', '2025-01-22 00:49:25', 'agus@gmail.com', 'student', '18', 'male', '082131234123123', 'Magelang', 'VII'),
(12, 'Ahmad Ruri Al-Mutokhir', NULL, '$2y$10$f6Ie8Abe/BMWxxIUPvln..zGwqp43waCbEFT/8W3MwXnCe.6dEbKi', '2025-01-22 00:50:09', '2025-01-22 00:50:09', 'ahmad@gmail.com', 'student', '18', 'male', '08133212464343', 'Semarang', 'VIII'),
(14, 'Amelia Earhart', NULL, '$2y$10$Qfe/ST/ZjyGK/wcCwFYg4eG4DO.HtXTIWbIQ0uaCNHZo1G0jqJHLK', '2025-01-22 01:00:18', '2025-01-22 01:02:42', 'amelia@gmail.com', 'student', '19', 'female', '0812341231231', 'Amerika', 'IX'),
(17, 'Bagaskoro', NULL, '$2y$10$NJUB6sNMLBqtArutKhd8CO.5fUogoMnKYYxGWBt9okSds2pbeJaBW', '2025-02-17 19:41:06', '2025-02-17 19:41:06', 'bagaskoro@gmail.com', 'student', '22', 'male', '012391422140123', 'Magelang', 'VIII');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authers`
--
ALTER TABLE `authers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`name`,`created_at`,`updated_at`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`),
  ADD KEY `books_auther_id_foreign` (`auther_id`),
  ADD KEY `books_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_issues_student_id_foreign` (`student_id`),
  ADD KEY `book_issues_book_id_foreign` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authers`
--
ALTER TABLE `authers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_auther_id_foreign` FOREIGN KEY (`auther_id`) REFERENCES `authers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `books_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD CONSTRAINT `book_issues_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_issues_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
