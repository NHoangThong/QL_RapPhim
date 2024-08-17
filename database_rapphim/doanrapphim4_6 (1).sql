-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 02:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doanrapphim4_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id_banner` bigint(20) NOT NULL,
  `hinh` text NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id_banner`, `hinh`, `trang_thai`, `create_at`, `update_at`) VALUES
(6, 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717325585/PHP_Laravel/Banner/t5n7ezlttbtkb2lvcctg.jpg', 1, NULL, NULL),
(9, 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717324909/PHP_Laravel/Banner/f33gg0xu3gplpkudzz8i.jpg', 1, NULL, NULL),
(10, 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717324919/PHP_Laravel/Banner/gjzmmgp2qdxyalfmj9jw.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `combos`
--

CREATE TABLE `combos` (
  `id_combo` bigint(20) NOT NULL,
  `ten_combo` varchar(255) NOT NULL,
  `hinh` text NOT NULL,
  `gia` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `combos`
--

INSERT INTO `combos` (`id_combo`, `ten_combo`, `hinh`, `gia`, `status`) VALUES
(4, 'Combo sale to', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717305585/PHP_Laravel/combo/k0kjqrs1x99psfibtodk.jpg', 1500000, 1),
(5, 'Combo BlockBuster', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717325868/PHP_Laravel/combo/cx9ioge3rm4jwx4ha6xb.jpg', 100000, 1),
(8, 'Combo bắp nước truyền thống', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717325833/PHP_Laravel/combo/sefnqjql5advo3prmcjl.jpg', 70000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `combo_food`
--

CREATE TABLE `combo_food` (
  `id_combo` bigint(20) NOT NULL,
  `id_food` bigint(20) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `combo_food`
--

INSERT INTO `combo_food` (`id_combo`, `id_food`, `so_luong`, `created_at`, `updated_at`) VALUES
(8, 1, 2, NULL, NULL),
(8, 2, 2, NULL, NULL),
(5, 1, 3, NULL, NULL),
(5, 2, 2, NULL, NULL),
(4, 1, 3, NULL, NULL),
(4, 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daodien_phim`
--

CREATE TABLE `daodien_phim` (
  `id_phim` bigint(20) NOT NULL,
  `id_dao_dien` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daodien_phim`
--

INSERT INTO `daodien_phim` (`id_phim`, `id_dao_dien`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 4),
(6, 5),
(12, 3),
(13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dao_dien`
--

CREATE TABLE `dao_dien` (
  `id_dao_dien` bigint(20) NOT NULL,
  `ten_dao_dien` text NOT NULL,
  `hinh_dao_dien` text NOT NULL,
  `ngaysinh` date NOT NULL,
  `quoc_gia` text DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dao_dien`
--

INSERT INTO `dao_dien` (`id_dao_dien`, `ten_dao_dien`, `hinh_dao_dien`, `ngaysinh`, `quoc_gia`, `content`) VALUES
(1, 'Trấn Thành', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717168131/PHP_Laravel/DaoDien/st1vkhxekfqjstostedm.jpg', '2024-04-08', 'Việt Nam', 'Trấn Thành ngoài là danh hài, MC nổi tiếng còn là đạo diện của các dự án lớn như Bố Già, Nhà Bà Nữ, Mai,..'),
(2, 'Lý Hải', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717168148/UEhQX0xhcmF2ZWwvRGFvRGllbi9ndG1lN3psd2RlcWlxN3NzbWRtaw==/drilldown', '1960-05-05', 'Việt Nam', 'Năm 2001, Lý Hải đã cho ra mắt album Trọn đời bên em. Album này sau khi phát hành đã bán được 2.500 bản. Nhưng phải đến khi album Trọn đời bên em vol.2 ra mắt thì mới tạo được sự chú ý đặc biệt của khán giả do có sự kết hợp mới lạ giữa phim và ca nhạc[11][12]. Nối tiếp thành công của vol.2, album vol.1 được tái bản. Sau đó, ông tiếp tục cộng tác với Vĩnh Thuyên để cho ra đời Trọn đời bên em vol.3 và vol.4. Tất cả đều tiếp tục được khán giả đón nhận. Thành công của series Trọn đời bên em được đánh giá là đã giúp đưa tên tuổi Lý Hải vào hàng những ngôi sao của thị trường âm nhạc Việt thời điểm đó[2]. Năm 2004, sau những thành công với sự góp sức không nhỏ của mình, Vĩnh Thuyên đã kết thúc vai trò người quản lý cho Lý Hải, nguyên nhân được cho là do Vĩnh Thuyên và ông đã không đạt được thống nhất về vai trò quản lý của Vĩnh Thuyên với một ca sĩ trẻ khác là Trần Tâm.[13]'),
(3, 'Trần Hữu Tấn', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717605223/UEhQX0xhcmF2ZWwvRGFvRGllbi9UcmFuLUh1dS1UYW5fZWxsZW1hbl9qcWZ0cXY=/drilldown', '2000-01-01', 'Việt Nam', 'Trần Hữu Tấn là đạo diễn trẻ theo đuổi dòng phim kinh dị. Những tác phẩm của anh như “Bắc Kim Thang”, “Rừng thế mạng”, “Chuyện ma gần nhà” mang đến cho khán giả câu chuyện điện ảnh và ẩn sau đó là dáng dấp văn hóa Việt Nam. Ở đó, khán giả cảm nhận được cảnh núi non hùng vĩ, những công trình kiến trúc cổ hay câu chuyện dân gian truyền miệng được lý giải bằng góc nhìn mới. Điều đặc biệt ở người đạo diễn trẻ chưa kinh qua trường lớp về điện ảnh này chính là niềm say mê làm phim bằng tự học và kinh nghiệm sống của mình.'),
(4, 'Nguyễn Quang Dũng', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717605404/UEhQX0xhcmF2ZWwvRGFvRGllbi9pbWFnZXNfMl9oaGQ1NTU=/drilldown', '1990-02-02', 'Việt Nam', 'Trưa 25-10, đạo diễn Nguyễn Quang Dũng giải bày rằng thời gian qua có nhiều người công kích phim \"Đất rừng phương Nam\", thậm chí còn thóa mạ. Anh có đọc hết và thấy rất nhiều, có thể nói là đa phần những người cực đoan đó đều chưa xem phim.'),
(5, 'Jang Jae-Hyun', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717605531/UEhQX0xhcmF2ZWwvRGFvRGllbi9saWNlbnNlZC1pbWFnZV9pYnFzYWM=/drilldown', '1980-03-03', 'Hàn Quốc', 'Quật mộ trùng ma (Exhuma) là một sản phẩm của đạo diễn Jang Jae Hyun. Chỉ riêng cái tên này đã đủ để khiến khán giả hồi hộp và háo hức ra rạp khi ông được biết đến là bậc thầy của dòng phim huyền bí Hàn Quốc. Trước đó, ông từng gây dấu ấn với những bộ phim ăn khách, bao gồm Svaha: The Sixth Finger và The Priest'),
(8, 'NGUYEN VAN A', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717168281/PHP_Laravel/DaoDien/jgzfqdjtytiamdrvofm3.jpg', '1980-05-18', 'Viet Nam', '<p>aaaaa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `dienvien_phim`
--

CREATE TABLE `dienvien_phim` (
  `id_phim` bigint(20) NOT NULL,
  `id_dien_vien` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dienvien_phim`
--

INSERT INTO `dienvien_phim` (`id_phim`, `id_dien_vien`) VALUES
(1, 1),
(1, 2),
(3, 6),
(3, 25),
(4, 4),
(5, 3),
(6, 23),
(6, 24),
(12, 22),
(13, 6);

-- --------------------------------------------------------

--
-- Table structure for table `dien_vien`
--

CREATE TABLE `dien_vien` (
  `id_dien_vien` bigint(20) NOT NULL,
  `ten_dien_vien` text NOT NULL,
  `hinh_dien_vien` text NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `quoc_gia` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dien_vien`
--

INSERT INTO `dien_vien` (`id_dien_vien`, `ten_dien_vien`, `hinh_dien_vien`, `ngaysinh`, `quoc_gia`, `content`) VALUES
(1, 'Tuấn Trần', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717166693/PHP_Laravel/DienVien/muwm9pxuf4hpgmgoolp4.jpg', '2024-06-02', 'Việt Nam', 'Tuấn Trần sinh ra và lớn lên tại Thành phố Hồ Chí Minh, trong một gia đình trung lưu, truyền thống không có ai theo nghệ thuật.[2] Trải qua tuổi thơ không mấy hạnh phúc khi chứng kiến mẹ thường xuyên bị cha đánh đập, từ năm 3 tuổi đã phải theo mẹ rong ruổi khắp nơi bán vé số dạo mưu sinh, anh trở thành một chàng trai trưởng thành và sống nội tâm, cũng như phải đi làm từ rất sớm để lo cho bản thân, đỡ đần gánh nặng một phần kinh tế của gia đình.[cần dẫn nguồn][3] Tuấn Trần từng theo học chuyên ngành quản trị kinh doanh tại Đại học Sài Gòn, song khi vừa tốt nghiệp Đại học, anh bỗng nhận ra mình đam mê nghệ thuật và quyết tâm theo đuổi nó.'),
(2, 'Phương Anh Đào', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717166580/PHP_Laravel/DienVien/poabx6epkfmf1kmquuem.jpg', '2024-06-02', 'Việt Nam', 'Phương Anh Đào là nữ diễn viên với nét diễn mộc mạc. Tuy nhiên cô cũng không quá nổi bậc mãi cho đến khi tham gia vào dự án phim Mai cùng với Tuấn Trần của đạo diễn Trấn Thành,...'),
(3, 'Hạo Khang', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717603658/UEhQX0xhcmF2ZWwvUGhpbS9oYW9raGFuZ2RhdHJ1bmdwaHVvbmduYW0yLTE2OTgtNTU5Mi0xMjcyLTE2OTgwMzE0MTlfbV85MDB4NTQwX3h2eWt6eA==/drilldown', '2024-06-02', 'Việt Nam', 'Huỳnh Hạo Khang sinh năm 2010, được gia đình khuyến khích theo nghệ thuật từ nhỏ. Em tham gia các cuộc thi hát của trường và quận, sau đó đóng các phim truyền hình, sit-com như Hoa sơn trà, Vũ điệu mùa xuân, Nhỏ to chốn văn phòng. Năm 2022, Hạo Khang tham gia Hãy nghe tôi hát nhí, đạt giải đồng khuyến khích.'),
(4, 'Thanh Hiền', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717604069/UEhQX0xhcmF2ZWwvUGhpbS90aGFuaC1oaWVuLW5zLTEtMTcxNDE0MTg2MC05OTU2LTE3MTQxNDI1MzNfZ3poZ2xq/drilldown', '2015-04-09', 'Việt Nam', 'Thanh Hiền, tên thật là Trần Thị Thanh Hiền (sinh năm 1954) là một nữ diễn viên người Việt Nam. Bắt đầu sự nghiệp diễn xuất từ năm 51 tuổi, sau 20 năm, bà đã tham gia hơn 700 dự án điện ảnh và truyền hình.[1] Thanh Hiền được biết đến qua bộ phim điện ảnh Lật mặt 7: Một điều ước của đạo diễn Lý Hải năm 2024.[2]\r\n\r\nThanh Hiền bắt đầu diễn xuất từ năm 1990 với một vai diễn nhỏ trong dự án truyền hình Mùi ngò gai. Kể từ đó, bà không ngừng tham gia vào nhiều dự án khác và đã hoàn thành gần 800 vai diễn trong các phim truyền hình, điện ảnh, sitcom và quảng cáo.[3]'),
(6, 'Lê Giang', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717604227/UEhQX0xhcmF2ZWwvUGhpbS9sZS1naWFuZy0xLTE2NzM5MzcyMDctMzI4NC0xNjczOTM3Nzc1X252N2N4ag==/drilldown', '1999-10-20', 'Việt Nam', 'Lê Giang sinh năm 1972, ở một tỉnh miền Tây Nam bộ. Xuất thân từ Đoàn cải lương Thanh Nga, Lê Giang nổi tiếng năm mới 16 tuổi khi cùng Hữu Nghĩa có mặt trong vở cải lương truyền hình \"Kỷ niệm thời con gái\". Năm 1990, chị giành huy chương vàng Hội diễn sân khấu chuyên nghiệp với vở Dòng sông đầm lầy.[1]\r\n\r\nNăm 1992, Lê Giang kết hôn với nghệ sĩ hài Duy Phương tạo nên cặp đôi \"vàng\" trong làng hài kịch trên khắp các sân khấu ở Thành phố Hồ Chí Minh. Đến năm 1999, cả hai chia tay sau khi có hai con chung là Duy Phước và Lê Lộc.[1] Năm 2009, cô tái hôn rồi sang Úc định cư và có một người con trai.[2][3] Cuối năm 2015, Lê Giang về Việt Nam hoạt động nghệ thuật sau sáu năm định cư ở nước ngoài.[1][4]'),
(22, 'Trịnh Tài', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717604464/UEhQX0xhcmF2ZWwvUGhpbS9iZmFmX3l5OG9raw==/drilldown', '2024-05-11', 'Việt Nam', 'Gần đây, nam diễn trẻ Trịnh Tài, từng góp mặt trong phim kinh dị ăn khách Bắc kim thang cuối năm 2019 bỗng được truyền thông và khán giả Trung Quốc chú ý vì ngoại hình giống hệt nam diễn viên, ca sĩ quá cố Trương Quốc Vinh.\r\n\r\nTrên QQ và Baidu có khá nhiều bài viết về Trịnh Tài với tiêu đề: \"Ngôi sao trẻ Việt Nam 27 tuổi gây sốt vì quá giống Trương Quốc Vinh\" hay \"Người hâm mộ thấy Trương Quốc Vinh trở lại qua nam diễn viên trẻ Việt Nam\"... Cùng với đó là rất nhiều bình luận của khán giả khen ngợi nét đẹp điển trai, ánh mắt buồn đẹp của Trịnh Tài. Thậm chí, cư dân mạng xứ Trung còn nhầm tưởng nam diễn viên trẻ phẫu thuật thẩm mỹ vì quá giống nam tài tử Hong Kong. '),
(23, 'Lee Do-Hyun', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717604571/UEhQX0xhcmF2ZWwvUGhpbS9MZWUtRG8tSHl1bi1FeGh1bWEtMl9idWhkb28=/drilldown', '2024-06-02', 'Hàn Quốc', 'Lee Do-hyun (Tiếng Hàn: 이도현, sinh ngày 11 tháng 04 năm 1995) tên thật là Lim Dong-hyun (Tiếng Hàn: 임동현), là một nam diễn viên người Hàn Quốc. Bắt đầu sự nghiệp vào năm 2017 với vai Lee Joon-ho (lúc trẻ), đến nay, anh đã góp mặt trong một số bộ phim truyền hình Hotel Del Luna (2019), Trở lại tuổi 18 (2020), Sweet Home: Thế giới ma quái (2020-hiện tại), Tuổi trẻ của tháng Năm (2021), Vinh quang trong thù hận (2022–2023), và Người mẹ tồi của tôi (2023), cũng như bộ phim điện ảnh Exhuma: Quật mộ trùng ma (2024).'),
(24, 'Kim Go-Eun', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717604703/UEhQX0xhcmF2ZWwvUGhpbS9pbWFnZXNfeHJzcHB4/drilldown', '2024-06-09', 'Hàn Quốc', 'Kim Go-Eun (Tiếng Hàn: 김고은; sinh ngày 2 tháng 7 năm 1991) là nữ diễn viên và người mẫu người Hàn Quốc. Cô bắt đầu sự nghiệp diễn xuất với bộ phim A Muse (2012) và tiếp tục xuất hiện trong bộ phim tội phạm kinh dị Monster (2014) và Coin Locker Girl (2015). Sau đó, Go-eun tiếp nhận vai nữ chính trong hai bộ phim truyền hình phát sóng trên kênh tvN là Bẫy tình yêu (2016) và Yêu tinh (2016–17).'),
(25, 'Uyển Ân', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717604942/UEhQX0xhcmF2ZWwvUGhpbS9pbWFnZXNfMV90dHRleG0=/drilldown', '2024-06-03', 'Việt Nam', 'Nhiều người cho rằng vì là em gái của Trấn Thành - nghệ sĩ được săn đón nhất nhì hiện nay - nên Uyển Ân không phải lo lắng về kinh tế, chỉ diễn xuất vì đam mê. Trước ý kiến này, người đẹp cho biết Trấn Thành đã ngừng chu cấp tiền cho mình kể từ khi cô tròn 18 tuổi. \"Anh chỉ chu cấp học phí cho tôi, còn những nhu cầu cá nhân hay trau chuốt hình ảnh khi đi sự kiện thì tôi phải tự chi trả. Cũng vì mưu sinh mà đôi lúc có vai diễn tôi không thích lắm nhưng vẫn nhận\", Uyển Ân nói.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `ho_ten` text NOT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id_food` bigint(20) NOT NULL,
  `ten_food` text NOT NULL,
  `hinh_food` text NOT NULL,
  `gia_food` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id_food`, `ten_food`, `hinh_food`, `gia_food`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'Bắp Rang', 'bapRang.jpg', 35000, 1, NULL, NULL),
(2, 'CoCa CoLa', 'nuoc.jpg', 30000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ghe`
--

CREATE TABLE `ghe` (
  `id_ghe` bigint(20) NOT NULL,
  `row` text NOT NULL,
  `col` int(11) NOT NULL,
  `ms` int(11) DEFAULT NULL,
  `me` int(11) DEFAULT NULL,
  `mb` int(11) DEFAULT NULL,
  `id_loai_ghe` bigint(20) NOT NULL,
  `id_phong` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ghe`
--

INSERT INTO `ghe` (`id_ghe`, `row`, `col`, `ms`, `me`, `mb`, `id_loai_ghe`, `id_phong`, `status`) VALUES
(821, 'A', 1, NULL, NULL, NULL, 1, 2, 1),
(822, 'A', 2, 0, NULL, NULL, 1, 2, 1),
(823, 'A', 3, NULL, NULL, NULL, 1, 2, 1),
(824, 'A', 4, NULL, NULL, NULL, 1, 2, 1),
(825, 'A', 5, NULL, NULL, NULL, 1, 2, 1),
(826, 'A', 6, NULL, NULL, NULL, 1, 2, 1),
(827, 'A', 7, NULL, NULL, NULL, 1, 2, 1),
(828, 'A', 8, NULL, NULL, NULL, 1, 2, 1),
(829, 'A', 9, NULL, NULL, NULL, 1, 2, 1),
(830, 'A', 10, NULL, NULL, NULL, 1, 2, 1),
(831, 'A', 11, NULL, NULL, NULL, 1, 2, 1),
(832, 'A', 12, NULL, NULL, NULL, 1, 2, 1),
(833, 'A', 13, NULL, NULL, NULL, 1, 2, 1),
(834, 'A', 14, NULL, NULL, NULL, 1, 2, 1),
(835, 'A', 15, NULL, NULL, NULL, 1, 2, 1),
(836, 'A', 16, NULL, NULL, NULL, 1, 2, 1),
(837, 'A', 17, NULL, NULL, NULL, 1, 2, 1),
(838, 'A', 18, NULL, NULL, NULL, 1, 2, 1),
(839, 'B', 1, NULL, NULL, NULL, 1, 2, 1),
(840, 'B', 2, 0, NULL, NULL, 1, 2, 1),
(841, 'B', 3, NULL, NULL, NULL, 1, 2, 1),
(842, 'B', 4, NULL, NULL, NULL, 1, 2, 1),
(843, 'B', 5, NULL, NULL, NULL, 1, 2, 1),
(844, 'B', 6, NULL, NULL, NULL, 1, 2, 1),
(845, 'B', 7, NULL, NULL, NULL, 1, 2, 1),
(846, 'B', 8, NULL, NULL, NULL, 1, 2, 1),
(847, 'B', 9, NULL, NULL, NULL, 1, 2, 1),
(848, 'B', 10, NULL, NULL, NULL, 1, 2, 1),
(849, 'B', 11, NULL, NULL, NULL, 1, 2, 1),
(850, 'B', 12, NULL, NULL, NULL, 1, 2, 1),
(851, 'B', 13, NULL, NULL, NULL, 1, 2, 1),
(852, 'B', 14, NULL, NULL, NULL, 1, 2, 1),
(853, 'B', 15, NULL, NULL, NULL, 1, 2, 1),
(854, 'B', 16, NULL, NULL, NULL, 1, 2, 1),
(855, 'B', 17, NULL, NULL, NULL, 1, 2, 1),
(856, 'B', 18, NULL, NULL, NULL, 1, 2, 1),
(857, 'C', 1, NULL, NULL, NULL, 1, 2, 1),
(858, 'C', 2, 0, NULL, NULL, 1, 2, 1),
(859, 'C', 3, NULL, NULL, NULL, 1, 2, 1),
(860, 'C', 4, NULL, NULL, NULL, 1, 2, 1),
(861, 'C', 5, NULL, NULL, NULL, 1, 2, 1),
(862, 'C', 6, NULL, NULL, NULL, 1, 2, 1),
(863, 'C', 7, NULL, NULL, NULL, 1, 2, 1),
(864, 'C', 8, NULL, NULL, NULL, 1, 2, 1),
(865, 'C', 9, NULL, NULL, NULL, 1, 2, 1),
(866, 'C', 10, NULL, NULL, NULL, 1, 2, 1),
(867, 'C', 11, NULL, NULL, NULL, 1, 2, 1),
(868, 'C', 12, NULL, NULL, NULL, 1, 2, 1),
(869, 'C', 13, NULL, NULL, NULL, 1, 2, 1),
(870, 'C', 14, NULL, NULL, NULL, 1, 2, 1),
(871, 'C', 15, NULL, NULL, NULL, 1, 2, 1),
(872, 'C', 16, NULL, NULL, NULL, 1, 2, 1),
(873, 'C', 17, NULL, NULL, NULL, 1, 2, 1),
(874, 'C', 18, NULL, NULL, NULL, 1, 2, 1),
(875, 'D', 1, NULL, NULL, NULL, 1, 2, 1),
(876, 'D', 2, 0, NULL, NULL, 1, 2, 1),
(877, 'D', 3, NULL, NULL, NULL, 1, 2, 1),
(878, 'D', 4, NULL, NULL, NULL, 1, 2, 1),
(879, 'D', 5, NULL, NULL, NULL, 1, 2, 1),
(880, 'D', 6, NULL, NULL, NULL, 1, 2, 1),
(881, 'D', 7, NULL, NULL, NULL, 1, 2, 1),
(882, 'D', 8, NULL, NULL, NULL, 1, 2, 1),
(883, 'D', 9, NULL, NULL, NULL, 1, 2, 1),
(884, 'D', 10, NULL, NULL, NULL, 1, 2, 1),
(885, 'D', 11, NULL, NULL, NULL, 1, 2, 1),
(886, 'D', 12, NULL, NULL, NULL, 1, 2, 1),
(887, 'D', 13, NULL, NULL, NULL, 1, 2, 1),
(888, 'D', 14, NULL, NULL, NULL, 1, 2, 1),
(889, 'D', 15, NULL, NULL, NULL, 1, 2, 1),
(890, 'D', 16, NULL, NULL, NULL, 1, 2, 1),
(891, 'D', 17, NULL, NULL, NULL, 1, 2, 1),
(892, 'D', 18, NULL, NULL, NULL, 1, 2, 1),
(893, 'E', 1, NULL, NULL, NULL, 1, 2, 1),
(894, 'E', 2, 0, NULL, NULL, 1, 2, 1),
(895, 'E', 3, NULL, NULL, NULL, 1, 2, 1),
(896, 'E', 4, NULL, NULL, NULL, 1, 2, 1),
(897, 'E', 5, NULL, NULL, NULL, 1, 2, 1),
(898, 'E', 6, NULL, NULL, NULL, 1, 2, 1),
(899, 'E', 7, NULL, NULL, NULL, 1, 2, 1),
(900, 'E', 8, NULL, NULL, NULL, 1, 2, 1),
(901, 'E', 9, NULL, NULL, NULL, 1, 2, 1),
(902, 'E', 10, NULL, NULL, NULL, 1, 2, 1),
(903, 'E', 11, NULL, NULL, NULL, 1, 2, 1),
(904, 'E', 12, NULL, NULL, NULL, 1, 2, 1),
(905, 'E', 13, NULL, NULL, NULL, 1, 2, 1),
(906, 'E', 14, NULL, NULL, NULL, 1, 2, 1),
(907, 'E', 15, NULL, NULL, NULL, 1, 2, 1),
(908, 'E', 16, NULL, NULL, NULL, 1, 2, 1),
(909, 'E', 17, NULL, NULL, NULL, 1, 2, 1),
(910, 'E', 18, NULL, NULL, NULL, 1, 2, 1),
(911, 'F', 1, NULL, NULL, NULL, 1, 2, 1),
(912, 'F', 2, 0, NULL, NULL, 1, 2, 1),
(913, 'F', 3, NULL, NULL, NULL, 1, 2, 1),
(914, 'F', 4, NULL, NULL, NULL, 1, 2, 1),
(915, 'F', 5, NULL, NULL, NULL, 1, 2, 1),
(916, 'F', 6, NULL, NULL, NULL, 1, 2, 1),
(917, 'F', 7, NULL, NULL, NULL, 1, 2, 1),
(918, 'F', 8, NULL, NULL, NULL, 1, 2, 1),
(919, 'F', 9, NULL, NULL, NULL, 1, 2, 1),
(920, 'F', 10, NULL, NULL, NULL, 1, 2, 1),
(921, 'F', 11, NULL, NULL, NULL, 1, 2, 1),
(922, 'F', 12, NULL, NULL, NULL, 1, 2, 1),
(923, 'F', 13, NULL, NULL, NULL, 1, 2, 1),
(924, 'F', 14, NULL, NULL, NULL, 1, 2, 1),
(925, 'F', 15, NULL, NULL, NULL, 1, 2, 1),
(926, 'F', 16, NULL, NULL, NULL, 1, 2, 1),
(927, 'F', 17, NULL, NULL, NULL, 1, 2, 1),
(928, 'F', 18, NULL, NULL, NULL, 1, 2, 1),
(929, 'G', 1, NULL, NULL, NULL, 1, 2, 1),
(930, 'G', 2, 0, NULL, NULL, 1, 2, 1),
(931, 'G', 3, NULL, NULL, NULL, 1, 2, 1),
(932, 'G', 4, NULL, NULL, NULL, 1, 2, 1),
(933, 'G', 5, NULL, NULL, NULL, 1, 2, 1),
(934, 'G', 6, NULL, NULL, NULL, 1, 2, 1),
(935, 'G', 7, NULL, NULL, NULL, 1, 2, 1),
(936, 'G', 8, NULL, NULL, NULL, 1, 2, 1),
(937, 'G', 9, NULL, NULL, NULL, 1, 2, 1),
(938, 'G', 10, NULL, NULL, NULL, 1, 2, 1),
(939, 'G', 11, NULL, NULL, NULL, 1, 2, 1),
(940, 'G', 12, NULL, NULL, NULL, 1, 2, 1),
(941, 'G', 13, NULL, NULL, NULL, 1, 2, 1),
(942, 'G', 14, NULL, NULL, NULL, 1, 2, 1),
(943, 'G', 15, NULL, NULL, NULL, 1, 2, 1),
(944, 'G', 16, NULL, NULL, NULL, 1, 2, 1),
(945, 'G', 17, NULL, NULL, NULL, 1, 2, 1),
(946, 'G', 18, NULL, NULL, NULL, 1, 2, 1),
(947, 'H', 1, NULL, NULL, NULL, 1, 2, 1),
(948, 'H', 2, 0, NULL, NULL, 1, 2, 1),
(949, 'H', 3, NULL, NULL, NULL, 1, 2, 1),
(950, 'H', 4, NULL, NULL, NULL, 1, 2, 1),
(951, 'H', 5, NULL, NULL, NULL, 1, 2, 1),
(952, 'H', 6, NULL, NULL, NULL, 1, 2, 1),
(953, 'H', 7, NULL, NULL, NULL, 1, 2, 1),
(954, 'H', 8, NULL, NULL, NULL, 1, 2, 1),
(955, 'H', 9, NULL, NULL, NULL, 1, 2, 1),
(956, 'H', 10, NULL, NULL, NULL, 1, 2, 1),
(957, 'H', 11, NULL, NULL, NULL, 1, 2, 1),
(958, 'H', 12, NULL, NULL, NULL, 1, 2, 1),
(959, 'H', 13, NULL, NULL, NULL, 1, 2, 1),
(960, 'H', 14, NULL, NULL, NULL, 1, 2, 1),
(961, 'H', 15, NULL, NULL, NULL, 1, 2, 1),
(962, 'H', 16, NULL, NULL, NULL, 1, 2, 1),
(963, 'H', 17, NULL, NULL, NULL, 1, 2, 1),
(964, 'H', 18, NULL, NULL, NULL, 1, 2, 1),
(965, 'I', 1, NULL, NULL, NULL, 1, 2, 1),
(966, 'I', 2, 0, NULL, NULL, 1, 2, 1),
(967, 'I', 3, NULL, NULL, NULL, 1, 2, 1),
(968, 'I', 4, NULL, NULL, NULL, 1, 2, 1),
(969, 'I', 5, NULL, NULL, NULL, 1, 2, 1),
(970, 'I', 6, NULL, NULL, NULL, 1, 2, 1),
(971, 'I', 7, NULL, NULL, NULL, 1, 2, 1),
(972, 'I', 8, NULL, NULL, NULL, 1, 2, 1),
(973, 'I', 9, NULL, NULL, NULL, 1, 2, 1),
(974, 'I', 10, NULL, NULL, NULL, 1, 2, 1),
(975, 'I', 11, NULL, NULL, NULL, 1, 2, 1),
(976, 'I', 12, NULL, NULL, NULL, 1, 2, 1),
(977, 'I', 13, NULL, NULL, NULL, 1, 2, 1),
(978, 'I', 14, NULL, NULL, NULL, 1, 2, 1),
(979, 'I', 15, NULL, NULL, NULL, 1, 2, 1),
(980, 'I', 16, NULL, NULL, NULL, 1, 2, 1),
(981, 'I', 17, NULL, NULL, NULL, 1, 2, 1),
(982, 'I', 18, NULL, NULL, NULL, 1, 2, 1),
(983, 'J', 1, NULL, NULL, NULL, 1, 2, 1),
(984, 'J', 2, 0, NULL, NULL, 1, 2, 1),
(985, 'J', 3, NULL, NULL, NULL, 1, 2, 1),
(986, 'J', 4, NULL, NULL, NULL, 1, 2, 1),
(987, 'J', 5, NULL, NULL, NULL, 1, 2, 1),
(988, 'J', 6, NULL, NULL, NULL, 1, 2, 1),
(989, 'J', 7, NULL, NULL, NULL, 1, 2, 1),
(990, 'J', 8, NULL, NULL, NULL, 1, 2, 1),
(991, 'J', 9, NULL, NULL, NULL, 1, 2, 1),
(992, 'J', 10, NULL, NULL, NULL, 1, 2, 1),
(993, 'J', 11, NULL, NULL, NULL, 1, 2, 1),
(994, 'J', 12, NULL, NULL, NULL, 1, 2, 1),
(995, 'J', 13, NULL, NULL, NULL, 1, 2, 1),
(996, 'J', 14, NULL, NULL, NULL, 1, 2, 1),
(997, 'J', 15, NULL, NULL, NULL, 1, 2, 1),
(998, 'J', 16, NULL, NULL, NULL, 1, 2, 1),
(999, 'J', 17, NULL, NULL, NULL, 1, 2, 1),
(1000, 'J', 18, NULL, NULL, NULL, 1, 2, 1),
(1001, 'K', 1, NULL, NULL, NULL, 1, 2, 1),
(1002, 'K', 2, 0, NULL, NULL, 1, 2, 1),
(1003, 'K', 3, NULL, NULL, NULL, 1, 2, 1),
(1004, 'K', 4, NULL, NULL, NULL, 1, 2, 1),
(1005, 'K', 5, NULL, NULL, NULL, 1, 2, 1),
(1006, 'K', 6, NULL, NULL, NULL, 1, 2, 1),
(1007, 'K', 7, NULL, NULL, NULL, 1, 2, 1),
(1008, 'K', 8, NULL, NULL, NULL, 1, 2, 1),
(1009, 'K', 9, NULL, NULL, NULL, 1, 2, 1),
(1010, 'K', 10, NULL, NULL, NULL, 1, 2, 1),
(1011, 'K', 11, NULL, NULL, NULL, 1, 2, 1),
(1012, 'K', 12, NULL, NULL, NULL, 1, 2, 1),
(1013, 'K', 13, NULL, NULL, NULL, 1, 2, 1),
(1014, 'K', 14, NULL, NULL, NULL, 1, 2, 1),
(1015, 'K', 15, NULL, NULL, NULL, 1, 2, 1),
(1016, 'K', 16, NULL, NULL, NULL, 1, 2, 1),
(1017, 'K', 17, NULL, NULL, NULL, 1, 2, 1),
(1018, 'K', 18, NULL, NULL, NULL, 1, 2, 1),
(1019, 'L', 1, NULL, NULL, NULL, 1, 2, 1),
(1020, 'L', 2, 0, NULL, NULL, 1, 2, 1),
(1021, 'L', 3, NULL, NULL, NULL, 1, 2, 1),
(1022, 'L', 4, NULL, NULL, NULL, 1, 2, 1),
(1023, 'L', 5, NULL, NULL, NULL, 1, 2, 1),
(1024, 'L', 6, NULL, NULL, NULL, 1, 2, 1),
(1025, 'L', 7, NULL, NULL, NULL, 1, 2, 1),
(1026, 'L', 8, NULL, NULL, NULL, 1, 2, 1),
(1027, 'L', 9, NULL, NULL, NULL, 1, 2, 1),
(1028, 'L', 10, NULL, NULL, NULL, 1, 2, 1),
(1029, 'L', 11, NULL, NULL, NULL, 1, 2, 1),
(1030, 'L', 12, NULL, NULL, NULL, 1, 2, 1),
(1031, 'L', 13, NULL, NULL, NULL, 1, 2, 1),
(1032, 'L', 14, NULL, NULL, NULL, 1, 2, 1),
(1033, 'L', 15, NULL, NULL, NULL, 1, 2, 1),
(1034, 'L', 16, NULL, NULL, NULL, 1, 2, 1),
(1035, 'L', 17, NULL, NULL, NULL, 1, 2, 1),
(1036, 'L', 18, NULL, NULL, NULL, 1, 2, 1),
(1037, 'M', 1, NULL, NULL, NULL, 1, 2, 1),
(1038, 'M', 2, 0, NULL, NULL, 1, 2, 1),
(1039, 'M', 3, NULL, NULL, NULL, 1, 2, 1),
(1040, 'M', 4, NULL, NULL, NULL, 1, 2, 1),
(1041, 'M', 5, NULL, NULL, NULL, 1, 2, 1),
(1042, 'M', 6, NULL, NULL, NULL, 1, 2, 1),
(1043, 'M', 7, NULL, NULL, NULL, 1, 2, 1),
(1044, 'M', 8, NULL, NULL, NULL, 1, 2, 1),
(1045, 'M', 9, NULL, NULL, NULL, 1, 2, 1),
(1046, 'M', 10, NULL, NULL, NULL, 1, 2, 1),
(1047, 'M', 11, NULL, NULL, NULL, 1, 2, 1),
(1048, 'M', 12, NULL, NULL, NULL, 1, 2, 1),
(1049, 'M', 13, NULL, NULL, NULL, 1, 2, 1),
(1050, 'M', 14, NULL, NULL, NULL, 1, 2, 1),
(1051, 'M', 15, NULL, NULL, NULL, 1, 2, 1),
(1052, 'M', 16, NULL, NULL, NULL, 1, 2, 1),
(1053, 'M', 17, NULL, NULL, NULL, 1, 2, 1),
(1054, 'M', 18, NULL, NULL, NULL, 1, 2, 1),
(1055, 'N', 1, NULL, NULL, NULL, 1, 2, 1),
(1056, 'N', 2, 0, NULL, NULL, 1, 2, 1),
(1057, 'N', 3, NULL, NULL, NULL, 1, 2, 1),
(1058, 'N', 4, NULL, NULL, NULL, 1, 2, 1),
(1059, 'N', 5, NULL, NULL, NULL, 1, 2, 1),
(1060, 'N', 6, NULL, NULL, NULL, 1, 2, 1),
(1061, 'N', 7, NULL, NULL, NULL, 1, 2, 1),
(1062, 'N', 8, NULL, NULL, NULL, 1, 2, 1),
(1063, 'N', 9, NULL, NULL, NULL, 1, 2, 1),
(1064, 'N', 10, NULL, NULL, NULL, 1, 2, 1),
(1065, 'N', 11, NULL, NULL, NULL, 1, 2, 1),
(1066, 'N', 12, NULL, NULL, NULL, 1, 2, 1),
(1067, 'N', 13, NULL, NULL, NULL, 1, 2, 1),
(1068, 'N', 14, NULL, NULL, NULL, 1, 2, 1),
(1069, 'N', 15, NULL, NULL, NULL, 1, 2, 1),
(1070, 'N', 16, NULL, NULL, NULL, 1, 2, 1),
(1071, 'N', 17, NULL, NULL, NULL, 1, 2, 1),
(1072, 'N', 18, NULL, NULL, NULL, 1, 2, 1),
(1073, 'O', 1, NULL, NULL, NULL, 1, 2, 1),
(1074, 'O', 2, 0, NULL, NULL, 1, 2, 1),
(1075, 'O', 3, NULL, NULL, NULL, 1, 2, 1),
(1076, 'O', 4, NULL, NULL, NULL, 1, 2, 1),
(1077, 'O', 5, NULL, NULL, NULL, 1, 2, 1),
(1078, 'O', 6, NULL, NULL, NULL, 1, 2, 1),
(1079, 'O', 7, NULL, NULL, NULL, 1, 2, 1),
(1080, 'O', 8, NULL, NULL, NULL, 1, 2, 1),
(1081, 'O', 9, NULL, NULL, NULL, 1, 2, 1),
(1082, 'O', 10, NULL, NULL, NULL, 1, 2, 1),
(1083, 'O', 11, NULL, NULL, NULL, 1, 2, 1),
(1084, 'O', 12, NULL, NULL, NULL, 1, 2, 1),
(1085, 'O', 13, NULL, NULL, NULL, 1, 2, 1),
(1086, 'O', 14, NULL, NULL, NULL, 1, 2, 1),
(1087, 'O', 15, NULL, NULL, NULL, 1, 2, 1),
(1088, 'O', 16, NULL, NULL, NULL, 1, 2, 1),
(1089, 'O', 17, NULL, NULL, NULL, 1, 2, 1),
(1090, 'O', 18, NULL, NULL, NULL, 1, 2, 1),
(1091, 'P', 1, NULL, NULL, NULL, 1, 2, 1),
(1092, 'P', 2, 0, NULL, NULL, 1, 2, 1),
(1093, 'P', 3, NULL, NULL, NULL, 1, 2, 1),
(1094, 'P', 4, NULL, NULL, NULL, 1, 2, 1),
(1095, 'P', 5, NULL, NULL, NULL, 1, 2, 1),
(1096, 'P', 6, NULL, NULL, NULL, 1, 2, 1),
(1097, 'P', 7, NULL, NULL, NULL, 1, 2, 1),
(1098, 'P', 8, NULL, NULL, NULL, 1, 2, 1),
(1099, 'P', 9, NULL, NULL, NULL, 1, 2, 1),
(1100, 'P', 10, NULL, NULL, NULL, 1, 2, 1),
(1101, 'P', 11, NULL, NULL, NULL, 1, 2, 1),
(1102, 'P', 12, NULL, NULL, NULL, 1, 2, 1),
(1103, 'P', 13, NULL, NULL, NULL, 1, 2, 1),
(1104, 'P', 14, NULL, NULL, NULL, 1, 2, 1),
(1105, 'P', 15, NULL, NULL, NULL, 1, 2, 1),
(1106, 'P', 16, NULL, NULL, NULL, 1, 2, 1),
(1107, 'P', 17, NULL, NULL, NULL, 1, 2, 1),
(1108, 'P', 18, NULL, NULL, NULL, 1, 2, 1),
(1109, 'Q', 1, NULL, NULL, NULL, 1, 2, 1),
(1110, 'Q', 2, 0, NULL, NULL, 1, 2, 1),
(1111, 'Q', 3, NULL, NULL, NULL, 1, 2, 1),
(1112, 'Q', 4, NULL, NULL, NULL, 1, 2, 1),
(1113, 'Q', 5, NULL, NULL, NULL, 1, 2, 1),
(1114, 'Q', 6, NULL, NULL, NULL, 1, 2, 1),
(1115, 'Q', 7, NULL, NULL, NULL, 1, 2, 1),
(1116, 'Q', 8, NULL, NULL, NULL, 1, 2, 1),
(1117, 'Q', 9, NULL, NULL, NULL, 1, 2, 1),
(1118, 'Q', 10, NULL, NULL, NULL, 1, 2, 1),
(1119, 'Q', 11, NULL, NULL, NULL, 1, 2, 1),
(1120, 'Q', 12, NULL, NULL, NULL, 1, 2, 1),
(1121, 'Q', 13, NULL, NULL, NULL, 1, 2, 1),
(1122, 'Q', 14, NULL, NULL, NULL, 1, 2, 1),
(1123, 'Q', 15, NULL, NULL, NULL, 1, 2, 1),
(1124, 'Q', 16, NULL, NULL, NULL, 1, 2, 1),
(1125, 'Q', 17, NULL, NULL, NULL, 1, 2, 1),
(1126, 'Q', 18, NULL, NULL, NULL, 1, 2, 1),
(1127, 'R', 1, NULL, NULL, NULL, 1, 2, 1),
(1128, 'R', 2, 0, NULL, NULL, 1, 2, 1),
(1129, 'R', 3, NULL, NULL, NULL, 1, 2, 1),
(1130, 'R', 4, NULL, NULL, NULL, 1, 2, 1),
(1131, 'R', 5, NULL, NULL, NULL, 1, 2, 1),
(1132, 'R', 6, NULL, NULL, NULL, 1, 2, 1),
(1133, 'R', 7, NULL, NULL, NULL, 1, 2, 1),
(1134, 'R', 8, NULL, NULL, NULL, 1, 2, 1),
(1135, 'R', 9, NULL, NULL, NULL, 1, 2, 1),
(1136, 'R', 10, NULL, NULL, NULL, 1, 2, 1),
(1137, 'R', 11, NULL, NULL, NULL, 1, 2, 1),
(1138, 'R', 12, NULL, NULL, NULL, 1, 2, 1),
(1139, 'R', 13, NULL, NULL, NULL, 1, 2, 1),
(1140, 'R', 14, NULL, NULL, NULL, 1, 2, 1),
(1141, 'R', 15, NULL, NULL, NULL, 1, 2, 1),
(1142, 'R', 16, NULL, NULL, NULL, 1, 2, 1),
(1143, 'R', 17, NULL, NULL, NULL, 1, 2, 1),
(1144, 'R', 18, NULL, NULL, NULL, 1, 2, 1),
(1145, 'S', 1, NULL, NULL, NULL, 1, 2, 1),
(1146, 'S', 2, 0, NULL, NULL, 1, 2, 1),
(1147, 'S', 3, NULL, NULL, NULL, 1, 2, 1),
(1148, 'S', 4, NULL, NULL, NULL, 1, 2, 1),
(1149, 'S', 5, NULL, NULL, NULL, 1, 2, 1),
(1150, 'S', 6, NULL, NULL, NULL, 1, 2, 1),
(1151, 'S', 7, NULL, NULL, NULL, 1, 2, 1),
(1152, 'S', 8, NULL, NULL, NULL, 1, 2, 1),
(1153, 'S', 9, NULL, NULL, NULL, 1, 2, 1),
(1154, 'S', 10, NULL, NULL, NULL, 1, 2, 1),
(1155, 'S', 11, NULL, NULL, NULL, 1, 2, 1),
(1156, 'S', 12, NULL, NULL, NULL, 1, 2, 1),
(1157, 'S', 13, NULL, NULL, NULL, 1, 2, 1),
(1158, 'S', 14, NULL, NULL, NULL, 1, 2, 1),
(1159, 'S', 15, NULL, NULL, NULL, 1, 2, 1),
(1160, 'S', 16, NULL, NULL, NULL, 1, 2, 1),
(1161, 'S', 17, NULL, NULL, NULL, 1, 2, 1),
(1162, 'S', 18, NULL, NULL, NULL, 1, 2, 1),
(1373, 'A', 1, NULL, NULL, NULL, 1, 1, 1),
(1374, 'A', 2, 0, NULL, NULL, 1, 1, 1),
(1375, 'A', 3, 1, NULL, NULL, 1, 1, 1),
(1376, 'A', 4, NULL, NULL, NULL, 1, 1, 1),
(1377, 'A', 5, NULL, NULL, NULL, 1, 1, 1),
(1378, 'A', 6, NULL, NULL, NULL, 1, 1, 1),
(1379, 'A', 7, 0, NULL, NULL, 1, 1, 1),
(1380, 'A', 8, NULL, NULL, NULL, 1, 1, 1),
(1381, 'A', 9, 1, NULL, NULL, 1, 1, 1),
(1382, 'A', 10, NULL, NULL, NULL, 1, 1, 1),
(1383, 'B', 1, NULL, NULL, NULL, 1, 1, 1),
(1384, 'B', 2, 0, NULL, NULL, 1, 1, 1),
(1385, 'B', 3, 1, NULL, NULL, 1, 1, 1),
(1386, 'B', 4, NULL, NULL, NULL, 1, 1, 1),
(1387, 'B', 5, NULL, NULL, NULL, 1, 1, 1),
(1388, 'B', 6, NULL, NULL, NULL, 1, 1, 1),
(1389, 'B', 7, 0, NULL, NULL, 1, 1, 1),
(1390, 'B', 8, NULL, NULL, NULL, 1, 1, 1),
(1391, 'B', 9, 1, NULL, NULL, 1, 1, 1),
(1392, 'B', 10, NULL, NULL, NULL, 1, 1, 1),
(1393, 'C', 1, NULL, NULL, NULL, 1, 1, 1),
(1394, 'C', 2, 0, NULL, NULL, 1, 1, 1),
(1395, 'C', 3, 1, NULL, NULL, 1, 1, 1),
(1396, 'C', 4, NULL, NULL, NULL, 1, 1, 1),
(1397, 'C', 5, NULL, NULL, NULL, 1, 1, 1),
(1398, 'C', 6, NULL, NULL, NULL, 1, 1, 1),
(1399, 'C', 7, 0, NULL, NULL, 1, 1, 1),
(1400, 'C', 8, NULL, NULL, NULL, 1, 1, 1),
(1401, 'C', 9, 1, NULL, NULL, 1, 1, 1),
(1402, 'C', 10, NULL, NULL, NULL, 1, 1, 1),
(1403, 'D', 1, NULL, NULL, NULL, 1, 1, 1),
(1404, 'D', 2, 0, NULL, NULL, 1, 1, 1),
(1405, 'D', 3, 1, NULL, NULL, 1, 1, 1),
(1406, 'D', 4, NULL, NULL, NULL, 1, 1, 1),
(1407, 'D', 5, NULL, NULL, NULL, 1, 1, 1),
(1408, 'D', 6, NULL, NULL, NULL, 1, 1, 1),
(1409, 'D', 7, 0, NULL, NULL, 1, 1, 1),
(1410, 'D', 8, NULL, NULL, NULL, 1, 1, 1),
(1411, 'D', 9, 1, NULL, NULL, 1, 1, 1),
(1412, 'D', 10, NULL, NULL, NULL, 1, 1, 1),
(1413, 'E', 1, NULL, NULL, NULL, 1, 1, 1),
(1414, 'E', 2, 0, NULL, NULL, 1, 1, 1),
(1415, 'E', 3, 1, NULL, NULL, 1, 1, 1),
(1416, 'E', 4, NULL, NULL, NULL, 1, 1, 1),
(1417, 'E', 5, NULL, NULL, NULL, 1, 1, 1),
(1418, 'E', 6, NULL, NULL, NULL, 1, 1, 1),
(1419, 'E', 7, 0, NULL, NULL, 1, 1, 1),
(1420, 'E', 8, NULL, NULL, NULL, 1, 1, 1),
(1421, 'E', 9, 1, NULL, NULL, 1, 1, 1),
(1422, 'E', 10, NULL, NULL, NULL, 1, 1, 1),
(1423, 'F', 1, NULL, NULL, NULL, 1, 1, 1),
(1424, 'F', 2, 0, NULL, NULL, 1, 1, 1),
(1425, 'F', 3, 1, NULL, NULL, 1, 1, 1),
(1426, 'F', 4, NULL, NULL, NULL, 1, 1, 1),
(1427, 'F', 5, NULL, NULL, NULL, 1, 1, 1),
(1428, 'F', 6, NULL, NULL, NULL, 1, 1, 1),
(1429, 'F', 7, 0, NULL, NULL, 1, 1, 1),
(1430, 'F', 8, NULL, NULL, NULL, 1, 1, 1),
(1431, 'F', 9, 1, NULL, NULL, 1, 1, 1),
(1432, 'F', 10, NULL, NULL, NULL, 1, 1, 1),
(1433, 'G', 1, NULL, NULL, NULL, 1, 1, 1),
(1434, 'G', 2, 0, NULL, NULL, 1, 1, 1),
(1435, 'G', 3, 1, NULL, NULL, 1, 1, 1),
(1436, 'G', 4, NULL, NULL, NULL, 1, 1, 1),
(1437, 'G', 5, NULL, NULL, NULL, 1, 1, 1),
(1438, 'G', 6, NULL, NULL, NULL, 1, 1, 1),
(1439, 'G', 7, 0, NULL, NULL, 1, 1, 1),
(1440, 'G', 8, NULL, NULL, NULL, 1, 1, 1),
(1441, 'G', 9, 1, NULL, NULL, 1, 1, 1),
(1442, 'G', 10, NULL, NULL, NULL, 1, 1, 1),
(1443, 'H', 1, NULL, NULL, NULL, 3, 1, 1),
(1444, 'H', 2, 0, NULL, NULL, 3, 1, 1),
(1445, 'H', 3, 1, NULL, NULL, 3, 1, 1),
(1446, 'H', 4, NULL, NULL, NULL, 3, 1, 1),
(1447, 'H', 5, NULL, NULL, NULL, 3, 1, 1),
(1448, 'H', 6, NULL, NULL, NULL, 3, 1, 1),
(1449, 'H', 7, 0, NULL, NULL, 3, 1, 1),
(1450, 'H', 8, NULL, NULL, NULL, 3, 1, 1),
(1451, 'H', 9, 1, NULL, NULL, 3, 1, 1),
(1452, 'H', 10, NULL, NULL, NULL, 3, 1, 1),
(1453, 'I', 1, NULL, NULL, NULL, 3, 1, 1),
(1454, 'I', 2, 0, NULL, NULL, 3, 1, 1),
(1455, 'I', 3, 1, NULL, NULL, 3, 1, 1),
(1456, 'I', 4, NULL, NULL, NULL, 3, 1, 1),
(1457, 'I', 5, NULL, NULL, NULL, 3, 1, 1),
(1458, 'I', 6, NULL, NULL, NULL, 3, 1, 1),
(1459, 'I', 7, 0, NULL, NULL, 3, 1, 1),
(1460, 'I', 8, NULL, NULL, NULL, 3, 1, 1),
(1461, 'I', 9, 1, NULL, NULL, 3, 1, 1),
(1462, 'I', 10, NULL, NULL, NULL, 3, 1, 1),
(1463, 'J', 1, NULL, NULL, NULL, 2, 1, 1),
(1464, 'J', 2, 0, NULL, NULL, 2, 1, 1),
(1465, 'J', 3, 1, NULL, NULL, 2, 1, 1),
(1466, 'J', 4, NULL, NULL, NULL, 2, 1, 1),
(1467, 'J', 5, NULL, NULL, NULL, 2, 1, 1),
(1468, 'J', 6, NULL, NULL, NULL, 2, 1, 1),
(1469, 'J', 7, 0, NULL, NULL, 2, 1, 1),
(1470, 'J', 8, NULL, NULL, NULL, 2, 1, 1),
(1471, 'J', 9, 1, NULL, NULL, 2, 1, 1),
(1472, 'J', 10, NULL, NULL, NULL, 2, 1, 1),
(1473, 'K', 1, NULL, NULL, NULL, 2, 1, 1),
(1474, 'K', 2, 0, NULL, NULL, 2, 1, 1),
(1475, 'K', 3, 1, NULL, NULL, 2, 1, 1),
(1476, 'K', 4, NULL, NULL, NULL, 2, 1, 1),
(1477, 'K', 5, NULL, NULL, NULL, 2, 1, 1),
(1478, 'K', 6, NULL, NULL, NULL, 2, 1, 1),
(1479, 'K', 7, 0, NULL, NULL, 2, 1, 1),
(1480, 'K', 8, NULL, NULL, NULL, 2, 1, 1),
(1481, 'K', 9, 1, NULL, NULL, 2, 1, 1),
(1482, 'K', 10, NULL, NULL, NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gia_ve`
--

CREATE TABLE `gia_ve` (
  `id_gia_ve` bigint(20) NOT NULL,
  `gia_ve` int(11) NOT NULL,
  `ngay` varchar(255) NOT NULL,
  `thoi_gian_sau` time NOT NULL,
  `generation` varchar(255) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gia_ve`
--

INSERT INTO `gia_ve` (`id_gia_ve`, `gia_ve`, `ngay`, `thoi_gian_sau`, `generation`, `id_user`) VALUES
(1, 70000, 'Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'hssv', NULL),
(2, 80000, 'Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'hssv', NULL),
(3, 80000, 'Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'nl', NULL),
(4, 90000, 'Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'nl', NULL),
(5, 60000, 'Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'nctte', NULL),
(6, 70000, 'Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'nctte', NULL),
(7, 75000, 'Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'vtt', NULL),
(8, 85000, 'Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'vtt', NULL),
(9, 80000, 'Friday, Saturday, Sunday', '08:00:00', 'hssv', NULL),
(10, 100000, 'Friday, Saturday, Sunday', '17:00:00', 'hssv', NULL),
(11, 90000, 'Friday, Saturday, Sunday', '08:00:00', 'nl', NULL),
(12, 120000, 'Friday, Saturday, Sunday', '17:00:00', 'nl', NULL),
(13, 70000, 'Friday, Saturday, Sunday', '08:00:00', 'nctte', NULL),
(14, 80000, 'Friday, Saturday, Sunday', '17:00:00', 'nctte', NULL),
(15, 85000, 'Friday, Saturday, Sunday', '08:00:00', 'vtt', NULL),
(16, 90000, 'Friday, Saturday, Sunday', '17:00:00', 'vtt', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gioi_han_do_tuoi`
--

CREATE TABLE `gioi_han_do_tuoi` (
  `id_gioi_han_do_tuoi` bigint(20) NOT NULL,
  `ten_gioi_han` text NOT NULL,
  `mieu_ta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gioi_han_do_tuoi`
--

INSERT INTO `gioi_han_do_tuoi` (`id_gioi_han_do_tuoi`, `ten_gioi_han`, `mieu_ta`) VALUES
(1, 'P', 'Dành cho mọi đối tượng'),
(2, 'C13', 'Dành cho người từ 13 tuổi trở lên'),
(3, 'C16', 'Dành cho người từ 16 tuổi trở lên'),
(4, 'C18', 'Dành cho người từ 18 tuổi trở lên');

-- --------------------------------------------------------

--
-- Table structure for table `infors`
--

CREATE TABLE `infors` (
  `id_info` bigint(20) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `worktime` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `id_khuyen_mai` bigint(20) NOT NULL,
  `ten_khuyen_mai` text NOT NULL,
  `ma_code` text NOT NULL,
  `phan_tram` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`id_khuyen_mai`, `ten_khuyen_mai`, `ma_code`, `phan_tram`, `so_luong`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'Khuyến Mãi 15%', 'giam15p', 15, 99, 1, NULL, '2024-07-16 12:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `lich_trinh`
--

CREATE TABLE `lich_trinh` (
  `id_lich_trinh` bigint(20) NOT NULL,
  `id_phim` bigint(20) NOT NULL,
  `id_phong` bigint(20) NOT NULL,
  `ngay` date NOT NULL,
  `thoi_gian_bat_dau` time DEFAULT NULL,
  `thoi_gian_ket_thuc` time DEFAULT NULL,
  `early` tinyint(1) DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lich_trinh`
--

INSERT INTO `lich_trinh` (`id_lich_trinh`, `id_phim`, `id_phong`, `ngay`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `early`, `trang_thai`, `created_at`, `updated_at`) VALUES
(148510, 1, 1, '2024-06-15', '16:00:56', '17:20:56', 1, 0, NULL, '2024-07-16 12:32:39'),
(148529, 1, 1, '2024-06-01', '08:00:00', '10:40:00', 0, 0, '2024-06-01 02:33:54', '2024-07-16 12:32:39'),
(148530, 1, 1, '2024-06-01', '10:50:00', '13:30:00', 0, 0, '2024-06-01 02:34:14', '2024-07-16 12:32:39'),
(148531, 1, 1, '2024-06-05', '13:40:00', '15:40:00', 1, 0, '2024-06-01 03:15:37', '2024-07-16 12:32:39'),
(148532, 1, 1, '2024-06-04', '08:00:00', '10:40:00', 0, 0, '2024-06-04 13:21:39', '2024-07-16 12:32:39'),
(148533, 1, 1, '2024-06-28', '10:50:00', '13:30:00', 1, 0, '2024-06-04 13:21:39', '2024-07-16 12:32:39'),
(148534, 1, 1, '2024-06-04', '13:40:00', '16:20:00', 0, 0, '2024-06-04 13:21:39', '2024-07-16 12:32:39'),
(148535, 1, 1, '2024-06-04', '16:30:00', '19:10:00', 0, 0, '2024-06-04 13:21:39', '2024-07-16 12:32:39'),
(148536, 1, 1, '2024-06-04', '19:20:00', '22:00:00', 0, 0, '2024-06-04 13:21:39', '2024-07-16 12:32:39'),
(148537, 1, 2, '2024-06-05', '08:00:00', '10:40:00', 0, 0, '2024-06-04 16:16:41', '2024-07-16 12:32:39'),
(148538, 1, 2, '2024-06-05', '10:50:00', '13:30:00', 0, 0, '2024-06-04 16:16:41', '2024-07-16 12:32:39'),
(148539, 1, 2, '2024-06-05', '13:40:00', '16:20:00', 0, 0, '2024-06-04 16:16:41', '2024-07-16 12:32:39'),
(148540, 1, 2, '2024-07-19', '16:30:00', '19:10:00', 0, 1, '2024-06-04 16:16:41', '2024-06-06 00:20:37'),
(148542, 1, 1, '2024-07-18', '17:30:00', '20:10:00', 0, 1, '2024-06-06 00:20:21', '2024-06-06 00:20:30'),
(148543, 1, 1, '2024-07-16', '08:00:00', '10:40:00', 0, 0, '2024-07-16 07:57:51', '2024-07-16 12:32:39'),
(148544, 1, 1, '2024-07-16', '10:50:00', '13:30:00', 0, 0, '2024-07-16 07:57:51', '2024-07-16 12:32:39'),
(148545, 1, 1, '2024-07-16', '13:40:00', '16:20:00', 0, 0, '2024-07-16 07:57:51', '2024-07-16 12:32:39'),
(148546, 1, 1, '2024-07-16', '16:30:00', '19:10:00', 0, 0, '2024-07-16 07:57:51', '2024-07-16 12:32:39'),
(148547, 1, 1, '2024-07-16', '19:20:00', '22:00:00', 0, 1, '2024-07-16 07:57:51', '2024-07-16 07:58:04'),
(148548, 1, 1, '2024-07-20', '08:00:00', '10:40:00', 0, 1, '2024-07-16 07:59:12', '2024-07-16 08:00:15'),
(148549, 1, 1, '2024-07-20', '10:50:00', '13:30:00', 1, 1, '2024-07-16 07:59:12', '2024-07-16 08:00:14'),
(148550, 1, 1, '2024-07-20', '13:40:00', '16:20:00', 0, 1, '2024-07-16 07:59:12', '2024-07-16 08:00:13'),
(148551, 1, 1, '2024-07-20', '16:30:00', '19:10:00', 1, 1, '2024-07-16 07:59:12', '2024-07-16 08:00:11'),
(148552, 1, 1, '2024-07-20', '19:20:00', '22:00:00', 0, 1, '2024-07-16 07:59:12', '2024-07-16 08:00:10'),
(148553, 1, 1, '2024-07-22', '08:00:00', '10:40:00', 0, 1, '2024-07-16 12:32:39', '2024-07-16 12:32:44'),
(148554, 1, 1, '2024-07-22', '10:50:00', '13:30:00', 0, 1, '2024-07-16 12:32:39', '2024-07-16 12:32:45'),
(148555, 1, 1, '2024-07-22', '13:40:00', '16:20:00', 0, 1, '2024-07-16 12:32:39', '2024-07-16 12:32:47'),
(148556, 1, 1, '2024-07-22', '16:30:00', '19:10:00', 0, 1, '2024-07-16 12:32:39', '2024-07-16 12:32:48'),
(148557, 1, 1, '2024-07-22', '19:20:00', '22:00:00', 0, 1, '2024-07-16 12:32:39', '2024-07-16 12:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `loai_ghe`
--

CREATE TABLE `loai_ghe` (
  `id_loai_ghe` bigint(20) NOT NULL,
  `ten_loai_ghe` text NOT NULL,
  `phu_phi` int(11) NOT NULL,
  `mau_loai_ghe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loai_ghe`
--

INSERT INTO `loai_ghe` (`id_loai_ghe`, `ten_loai_ghe`, `phu_phi`, `mau_loai_ghe`) VALUES
(1, 'normal', -3, '#FFF0C7'),
(2, 'vip', 20000, '#FFC8CB'),
(3, 'couple', 30000, '#FF62B0');

-- --------------------------------------------------------

--
-- Table structure for table `loai_phim`
--

CREATE TABLE `loai_phim` (
  `id_loai_phim` bigint(20) NOT NULL,
  `ten_loai_phim` text NOT NULL,
  `trang_thai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loai_phim`
--

INSERT INTO `loai_phim` (`id_loai_phim`, `ten_loai_phim`, `trang_thai`) VALUES
(2, 'Lãng Mạn', 1),
(3, 'Hành Động', 1),
(4, 'Kinh Dị', 1),
(5, 'Hài Hước', 1),
(6, 'Tình Cảm', 1),
(7, 'Tiểu Thuyết', 1),
(8, 'Lịch Sử', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loai_phim_phim`
--

CREATE TABLE `loai_phim_phim` (
  `id_phim` bigint(20) NOT NULL,
  `id_loai_phim` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loai_phim_phim`
--

INSERT INTO `loai_phim_phim` (`id_phim`, `id_loai_phim`) VALUES
(1, 2),
(1, 6),
(2, 3),
(3, 5),
(3, 6),
(4, 4),
(4, 6),
(5, 7),
(5, 8),
(6, 4),
(6, 5),
(12, 4),
(13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `loai_phong`
--

CREATE TABLE `loai_phong` (
  `id_loai_phong` bigint(20) NOT NULL,
  `ten_loai_phong` text NOT NULL,
  `phu_phi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loai_phong`
--

INSERT INTO `loai_phong` (`id_loai_phong`, `ten_loai_phong`, `phu_phi`) VALUES
(1, 'Phong VIP', -3),
(2, 'Phong Thuong', 20000),
(3, 'Phong Doi', 30000),
(4, 'Phong Don', 5000),
(5, 'Phong Ngoi', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `phim`
--

CREATE TABLE `phim` (
  `id_phim` bigint(20) NOT NULL,
  `ten_phim` text DEFAULT NULL,
  `image` text CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `thoi_luong_phim` int(11) NOT NULL,
  `ngay_phat_hanh` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `quoc_giasx` text DEFAULT NULL,
  `trailer` text NOT NULL,
  `id_gioi_han_do_tuoi` bigint(20) NOT NULL,
  `trang_thai` tinyint(1) DEFAULT NULL,
  `mieu_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phim`
--

INSERT INTO `phim` (`id_phim`, `ten_phim`, `image`, `thoi_luong_phim`, `ngay_phat_hanh`, `ngay_ket_thuc`, `quoc_giasx`, `trailer`, `id_gioi_han_do_tuoi`, `trang_thai`, `mieu_ta`) VALUES
(1, 'Mai', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717500185/PHP_Laravel/Phim/Mai_daqszi.png', 160, '2024-05-05', '2025-01-01', 'Việt Nam', 'https://www.youtube.com/embed/EX6clvId19s', 4, 1, 'Phim Mai của Trấn Thành khởi chiếu vào mùng 1 Tết 2024 - 10.2.2024. Mai xoay quanh câu chuyện về tình chị em “dở khóc dở cười” của Mai (Phương Anh Đào) và Dương (Tuấn Trần), cùng sự giao thoa bí ẩn giữa câu chuyện quá khứ - tương lai liên tục được nhắc đến.'),
(2, 'Lật Mặt 6: Tấm Vé Định Mệnh', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717500343/PHP_Laravel/Phim/TamVeDinhMenh_sisriq.jpg', 120, '2024-07-15', '2025-01-01', 'Việt Nam', 'https://www.youtube.com/embed/L-XhraxUsAs', 1, 1, 'Trải qua 5 phần phim, Lật Mặt đã tìm thấy phần hay nhất của thương hiệu ở Lật Mặt 6: Tấm Vé Định Mệnh. Không còn chỉ có thể dựa vào những màn hành động hay những miếng hài để gây ấn tượng, Lật Mặt 6: Tấm Vé Định Mệnh vẽ nên một câu chuyện đào sâu mặt sáng tối của con người và nêu lên những mảng xám hiện thực khiến người ta không khỏi lặng người.'),
(3, 'Nhà Bà Nữ', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717500542/PHP_Laravel/Phim/NhaBaNu_fx72n7.jpg', 120, '2024-05-01', '2025-01-01', 'Việt Nam', 'https://www.youtube.com/embed/IkaP0KJWTsQ', 1, 1, 'Review Nhà Bà Nữ và lịch chiếu Nhà Bà Nữ tại Moveek. Phim xoay quanh gia đình của bà Nữ (nghệ sĩ Lê Giang đảm nhận) - người làm nghề bán bánh canh. Truyện phim khắc họa mối quan hệ phức tạp, đa chiều xảy ra với các thành viên trong gia đình. Câu tagline (thông điệp) chính \"Mỗi gia đình đều có những bí mật\" chứa nhiều ẩn ý về nội dung bộ phim muốn gửi gắm.'),
(4, 'Lật Mặt 7: Một Điều Ước', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717500668/PHP_Laravel/Phim/LatMat7_lowbwp.jpg', 130, '2024-05-02', '2025-01-01', 'Việt Nam', 'https://www.youtube.com/embed/d1ZHdosjNX8', 1, 1, 'Lật Mặt 7: Một Điều Ước là bộ phim của Lý Hải, sẽ ra mắt dịp lễ 30/4. Kể câu chuyện về bà Nguyễn Thị Hai và năm người con, bộ phim xoáy vào một câu hỏi đầy nhức nhối trong xã hội hiện đại – khi cha mẹ già đi, liệu người con nào có trách nhiệm phụng dưỡng đây? Một bên là cuộc sống riêng, một bên là chữ hiếu, làm sao để cân bằng cả hai?'),
(5, 'Đất Rừng Phương Nam', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717500756/PHP_Laravel/Phim/DatRungPN_cdw1br.jpg', 140, '2024-05-03', '2025-01-01', 'Việt Nam', 'https://www.youtube.com/embed/hktzirCnJmQ', 1, 1, 'Đất Rừng Phương Nam phiên bản điện ảnh được kế thừa và phát triển từ tiểu thuyết cùng tên của nhà văn Đoàn Giỏi và tác phẩm truyền hình nổi tiếng “Đất Phương Nam” của đạo diễn Nguyễn Vinh Sơn. Bộ phim kể về hành trình phiêu lưu của An - một cậu bé chẳng may mất mẹ trên đường đi tìm cha. Cùng với An, khán giả sẽ trải nghiệm sự trù phú của thiên nhiên và nét đẹp văn hoá đặc sắc của vùng đất Nam Kì Lục Tỉnh, sự hào hiệp của những người nông dân bám đất bám rừng và tinh thần yêu nước kháng Pháp đầu thế kỉ 20. Bên cạnh đó, tình cảm gia đình, tình bạn, tình người, tình thầy trò, tình yêu nước là những cung bậc cảm xúc sâu sắc sẽ đọng lại qua mỗi bước chân của An và đồng bạn'),
(6, 'Quật Mộ Trùng Ma', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717500850/PHP_Laravel/Phim/QuatMoTrungMa_yqlnaf.jpg', 150, '2024-05-04', '2025-01-01', 'Việt Nam', 'https://www.youtube.com/embed/5-oRO4rYNQ4', 4, 1, 'Dưới đôi tay của Bậc thầy kinh dị Jang Jae Hyun - cha đẻ của \"Svaha: Ngón Tay Thứ Sáu\" và \"Mục Sư\", phim điện ảnh nổi bật nhất năm 2024 của Hàn Quốc hứa hẹn mang đến trải nghiệm mãn nhãn trên màn ảnh rộng tại Việt Nam vào tháng 3 này!'),
(12, 'Bắc Kim Thang', 'https://res-console.cloudinary.com/dmwzseqfw/thumbnails/v1/image/upload/v1717603328/UEhQX0xhcmF2ZWwvUGhpbS81NjMyX0JZQ19LSU1fVEhBTkdfcjdkazdy/drilldown', 120, '2024-06-02', '2024-06-30', 'Việt Nam', 'https://www.youtube.com/embed/mNLu1cQwZcE', 4, 0, 'Bắc Kim Thang có kịch bản khá vững vàng và nhất quán. Mở đầu với chuyến về quê miền Tây thăm nhà của chàng trai Thiện Tâm (Trịnh Tài đóng), phim dần gỡ bỏ những lớp vỏ bọc chằng chịt quanh mỗi nhân vật, quanh toàn bộ gia đình của Thiện Tâm, khiến khán giả ngỡ ngàng vì những bi kịch ẩn giấu và chốt lại bằng một cú twist (nút thắt) khá choáng váng.\r\n\r\nTrong quá trình bóc trần từng lớp vỏ, Bắc Kim Thang có thể khiến khán giả khó hiểu vì lối kể đan xen quá khứ và hiện tại, giữa những gì xảy trong tâm tưởng của Thiện Tâm và đời thực. Sự đan xen này khiến phim đôi khi khá rối rắm, không rõ các tình tiết đang diễn ra ở khung thời gian nào.\r\n\r\nChính vì điểm này, dư luận về phim chia làm hai hướng đối lập: nhiều khán giả khen hết lời, nhiều khán giả lại chê \"không hiểu gì\".'),
(13, 'Mắt Biếc', 'matbiet.jpg', 120, '2024-07-23', '2024-07-02', 'Viet Nam', 'https://www.youtube.com/embed/ITlQ0oU7tDA', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `id_phong` bigint(20) NOT NULL,
  `ten_phong` text NOT NULL,
  `id_loai_phong` bigint(20) NOT NULL,
  `id_rap` bigint(20) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`id_phong`, `ten_phong`, `id_loai_phong`, `id_rap`, `trang_thai`) VALUES
(1, 'Phong 1', 1, 1, 1),
(2, 'Phong 2', 2, 2, 1),
(3, 'Phong 3', 3, 3, 1),
(4, 'Phong 4', 4, 4, 0),
(5, 'Phong 5', 5, 5, 1),
(11, 'Phòng2', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rap`
--

CREATE TABLE `rap` (
  `id_rap` bigint(20) NOT NULL,
  `ten_rap` text NOT NULL,
  `dia_chi` text NOT NULL,
  `thanh_pho` text NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 0,
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rap`
--

INSERT INTO `rap` (`id_rap`, `ten_rap`, `dia_chi`, `thanh_pho`, `trang_thai`, `location`) VALUES
(1, 'Rap 1', 'Dia chi 1', 'Thanh pho 1', 1, 'https://maps.app.goo.gl/ErzVNGJGLWDC3ekq9'),
(2, 'Rap 2', 'Dia chi 2', 'Thanh pho 2', 1, NULL),
(3, 'Rap 3', 'Dia chi 3', 'Thanh pho 3', 1, NULL),
(4, 'Rap 4', 'Dia chi 4', 'Thanh pho 4', 1, NULL),
(5, 'Rap 5', 'Dia chi 5', 'Thanh pho 5', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ffff', 'ffff', '2024-05-19 11:30:44', NULL),
(2, 'aaaaaa', 'aaa', '2024-05-19 11:31:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `su_kien`
--

CREATE TABLE `su_kien` (
  `id_su_kien` bigint(20) NOT NULL,
  `tieu_de` text NOT NULL,
  `hinh` text NOT NULL,
  `content` text NOT NULL,
  `dieu_kien` text NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tin_tuc`
--

CREATE TABLE `tin_tuc` (
  `id_tin_tuc` bigint(20) NOT NULL,
  `tieu_de` text NOT NULL,
  `hinh_tin_tuc` text NOT NULL,
  `content` text NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tin_tuc`
--

INSERT INTO `tin_tuc` (`id_tin_tuc`, `tieu_de`, `hinh_tin_tuc`, `content`, `trang_thai`, `id_user`, `created_at`, `updated_at`) VALUES
(2, '[Review] The Flash: Ezra Miller Diễn Xuất Sắc Làm Lu Mờ Loạt Scandal Chấn Động!', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717510751/PHP_Laravel/TinTuc/tgj0nwjhtluodszed4q6.jpg', 'gagag', 1, NULL, '2024-06-04 07:20:40', '2024-06-04 00:20:40'),
(3, '[Review] Spider-Man Across The Spider-Verse: Phim Siêu Anh Hùng Xuất Sắc Nhất Từ Trước Đến Nay?', 'https://res.cloudinary.com/dmwzseqfw/image/upload/v1717510800/PHP_Laravel/TinTuc/h5p2tdbvnujbs1w0ihnq.jpg', '<p>aaa</p>', 1, NULL, '2024-06-04 07:20:12', '2024-06-04 00:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `xacminh_email` tinyint(1) DEFAULT NULL,
  `id_rap` bigint(20) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `point` bigint(20) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `fullName`, `password`, `email`, `phone`, `xacminh_email`, `id_rap`, `remember_token`, `point`, `role`, `status`, `created_at`, `updated_at`) VALUES
(56, 'Sang', '$2y$10$kbtYt8vQG4EzgLxFaeEA4O4HYHc8g/hha8fZJEVxsYqW7T1CPGVRS', 'Huynhsang1020@gmail.com', '0944384929', 1, 1, NULL, NULL, 1, 1, '2024-06-05 16:52:00', '2024-05-23 05:19:05'),
(57, 'Quan Ly Rap Phim', '$2y$10$dTj7fown.ZGLNq6VvcCGHecwbwt/JtfYbI4G70OAU/qXOylXZJZey', 'admin@gmail.com', '', 1, 1, NULL, NULL, 0, 1, '2024-06-05 16:53:17', NULL),
(62, 'Nguyen Khanh Duy', '$2y$10$FT1aX/4ut4moJu6W5t9.tOjaH5HL/jB7aCydAtcO9ykYR1wvdKuNy', 'nguyenkhanhduy.learn@gmail.com', '0962336422', 1, NULL, 'Yv6Wh1a91Ct2xW3vEPc7Ty6oIiniOc2IOaGowcSv5YFZmzwqTN8RdJWokdGY', 92998, 1, 1, '2024-07-16 07:12:30', '2024-06-25 16:15:38'),
(64, 'Nguyen Khanh Duy', '$2y$10$5pkyV8fHNy3fBWP7AYVbSe/Q/0eqa4Og2VjUGU86bKmYWFdmv58p.', 'nguyenkhanhduy.ttlk@gmail.com', '0962336433', 1, NULL, 'ps9zmsdyQ8w5RNOAF6RphuCjxaFaLGq1DnzSiETV4fAdO16qe3vy5ofQkiJh', NULL, 1, 1, '2024-07-16 12:26:54', '2024-07-16 12:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `ve`
--

CREATE TABLE `ve` (
  `id_ve` bigint(20) NOT NULL,
  `id_lich_trinh` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `trang_thai_giu_ve` tinyint(1) DEFAULT NULL,
  `trang_thai_dat_ve` tinyint(1) NOT NULL,
  `trang_thai_thanh_toan` tinyint(1) DEFAULT NULL,
  `trang_thai_combo` tinyint(1) DEFAULT NULL,
  `trang_thai_giam_gia` tinyint(1) DEFAULT NULL,
  `tong_tien_ve` bigint(20) DEFAULT NULL,
  `ma_code` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ve`
--

INSERT INTO `ve` (`id_ve`, `id_lich_trinh`, `id_user`, `trang_thai_giu_ve`, `trang_thai_dat_ve`, `trang_thai_thanh_toan`, `trang_thai_combo`, `trang_thai_giam_gia`, `tong_tien_ve`, `ma_code`, `created_at`, `updated_at`) VALUES
(173, 148531, 57, 0, 1, 1, NULL, NULL, 1744994, 1402926730, '2024-06-05 11:18:22', '2024-06-05 11:18:56'),
(174, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 1745243024, '2024-06-05 11:24:46', '2024-06-05 11:24:53'),
(178, 148531, 57, 0, 1, 1, NULL, NULL, 1714994, 8112172416, '2024-06-05 11:38:07', '2024-06-05 11:40:38'),
(180, 148531, 57, 0, 1, 1, NULL, NULL, 149988, 2436443785, '2024-06-05 11:46:44', '2024-06-05 12:52:32'),
(182, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 6140335778, '2024-06-05 11:52:53', '2024-06-05 11:52:57'),
(183, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 4358231437, '2024-06-05 11:55:45', '2024-06-05 11:55:52'),
(185, 148531, 57, 0, 1, 1, NULL, NULL, 1644994, 8349884238, '2024-06-05 12:06:28', '2024-06-05 12:07:23'),
(186, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 7390755569, '2024-06-05 12:07:38', '2024-06-05 12:07:45'),
(188, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 6276717839, '2024-06-05 12:09:03', '2024-06-05 12:09:09'),
(202, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 8799877270, '2024-06-05 12:46:56', '2024-06-05 12:47:07'),
(206, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 2625631260, '2024-06-05 12:56:11', '2024-06-05 12:56:13'),
(210, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 4082055548, '2024-06-05 12:58:19', '2024-06-05 12:58:26'),
(217, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 7355499608, '2024-06-05 13:04:50', '2024-06-05 13:05:12'),
(218, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 7785972313, '2024-06-05 13:14:19', '2024-06-05 13:14:29'),
(219, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 8681493713, '2024-06-05 13:15:52', '2024-06-05 13:15:57'),
(220, 148531, 57, 0, 1, 1, NULL, NULL, 74994, 3440946685, '2024-06-05 13:23:07', '2024-06-05 13:23:10'),
(226, 148510, 57, 0, 1, 1, NULL, NULL, 1669988, 5050644833, '2024-06-05 14:55:12', '2024-06-05 14:55:33'),
(229, 148510, 62, 0, 0, 1, NULL, NULL, 169988, 2587715855, '2024-06-06 02:08:08', '2024-06-06 02:10:07'),
(233, 148533, 62, 0, 0, 1, NULL, NULL, 1669988, 7812044088, '2024-06-25 16:13:52', '2024-06-25 16:15:38'),
(245, 148548, 64, 0, 0, 1, NULL, 1, 1529995, 3039818800, '2024-07-16 12:23:08', '2024-07-16 12:24:48'),
(246, NULL, NULL, 0, 0, 0, NULL, NULL, 1500000, 3344324938, '2024-07-16 12:33:24', '2024-07-16 12:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `ve_combo`
--

CREATE TABLE `ve_combo` (
  `ten_combo` text NOT NULL,
  `gia_combo` int(11) DEFAULT NULL,
  `mieu_ta` text NOT NULL,
  `so_luong` int(11) NOT NULL,
  `id_ve` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ve_combo`
--

INSERT INTO `ve_combo` (`ten_combo`, `gia_combo`, `mieu_ta`, `so_luong`, `id_ve`, `created_at`, `updated_at`) VALUES
('Combo sale to', 1500000, '3 Bắp Rang + 3 CoCa CoLa', 1, 173, '2024-06-05 11:18:48', '2024-06-05 11:18:48'),
('Combo BlockBuster', 100000, '3 Bắp Rang + 2 CoCa CoLa', 1, 173, '2024-06-05 11:18:48', '2024-06-05 11:18:48'),
('Combo bắp nước truyền thống', 70000, '2 Bắp Rang + 2 CoCa CoLa', 1, 173, '2024-06-05 11:18:48', '2024-06-05 11:18:48'),
('Combo sale to', 1500000, '3 Bắp Rang + 3 CoCa CoLa', 1, 178, '2024-06-05 11:38:17', '2024-06-05 11:38:17'),
('Combo bắp nước truyền thống', 70000, '2 Bắp Rang + 2 CoCa CoLa', 2, 178, '2024-06-05 11:38:17', '2024-06-05 11:38:17'),
('Combo sale to', 1500000, '3 Bắp Rang + 3 CoCa CoLa', 1, 185, '2024-06-05 12:06:41', '2024-06-05 12:06:41'),
('Combo bắp nước truyền thống', 70000, '2 Bắp Rang + 2 CoCa CoLa', 1, 185, '2024-06-05 12:06:41', '2024-06-05 12:06:41'),
('Combo sale to', 1500000, '3 Bắp Rang + 3 CoCa CoLa', 1, 226, '2024-06-05 14:55:18', '2024-06-05 14:55:18'),
('Combo sale to', 1500000, '3 Bắp Rang + 3 CoCa CoLa', 1, 233, '2024-06-25 16:13:56', '2024-06-25 16:13:56'),
('Combo sale to', 1500000, '3 Bắp Rang + 3 CoCa CoLa', 1, 245, '2024-07-16 12:23:15', '2024-07-16 12:23:15'),
('Combo bắp nước truyền thống', 70000, '2 Bắp Rang + 2 CoCa CoLa', 1, 245, '2024-07-16 12:23:15', '2024-07-16 12:23:15'),
('Combo sale to', NULL, '3 Bắp Rang + 3 CoCa CoLa', 1, 246, '2024-07-16 12:33:24', '2024-07-16 12:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `ve_food`
--

CREATE TABLE `ve_food` (
  `ten_food` text NOT NULL,
  `gia_food` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `id_ve` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ve_ghe`
--

CREATE TABLE `ve_ghe` (
  `row` text NOT NULL,
  `col` int(11) NOT NULL,
  `gia_ve` int(11) NOT NULL,
  `id_ve` bigint(20) NOT NULL,
  `ten_loai_ghe` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ve_ghe`
--

INSERT INTO `ve_ghe` (`row`, `col`, `gia_ve`, `id_ve`, `ten_loai_ghe`, `created_at`, `updated_at`) VALUES
('B', 1, 74994, 173, 'normal', '2024-06-05 11:18:22', '2024-06-05 11:18:22'),
('C', 1, 74994, 174, 'normal', '2024-06-05 11:24:46', '2024-06-05 11:24:46'),
('D', 1, 74994, 178, 'normal', '2024-06-05 11:38:07', '2024-06-05 11:38:07'),
('E', 1, 74994, 180, 'normal', '2024-06-05 11:46:44', '2024-06-05 11:46:44'),
('F', 1, 74994, 182, 'normal', '2024-06-05 11:52:53', '2024-06-05 11:52:53'),
('G', 1, 74994, 183, 'normal', '2024-06-05 11:55:45', '2024-06-05 11:55:45'),
('H', 1, 74994, 185, 'normal', '2024-06-05 12:06:28', '2024-06-05 12:06:28'),
('I', 1, 74994, 186, 'normal', '2024-06-05 12:07:38', '2024-06-05 12:07:38'),
('K', 1, 74994, 188, 'normal', '2024-06-05 12:09:03', '2024-06-05 12:09:03'),
('R', 1, 74994, 202, 'normal', '2024-06-05 12:46:56', '2024-06-05 12:46:56'),
('Q', 1, 74994, 206, 'normal', '2024-06-05 12:56:11', '2024-06-05 12:56:11'),
('B', 2, 74994, 210, 'normal', '2024-06-05 12:58:19', '2024-06-05 12:58:19'),
('B', 3, 74994, 217, 'normal', '2024-06-05 13:04:50', '2024-06-05 13:04:50'),
('B', 4, 74994, 218, 'normal', '2024-06-05 13:14:19', '2024-06-05 13:14:19'),
('B', 5, 74994, 219, 'normal', '2024-06-05 13:15:52', '2024-06-05 13:15:52'),
('B', 6, 74994, 220, 'normal', '2024-06-05 13:23:07', '2024-06-05 13:23:07'),
('C', 2, 84994, 226, 'normal', '2024-06-05 14:55:12', '2024-06-05 14:55:12'),
('C', 1, 84994, 226, 'normal', '2024-06-05 14:55:12', '2024-06-05 14:55:12'),
('D', 1, 84994, 229, 'normal', '2024-06-06 02:08:08', '2024-06-06 02:08:08'),
('D', 2, 84994, 229, 'normal', '2024-06-06 02:08:08', '2024-06-06 02:08:08'),
('G', 1, 84994, 233, 'normal', '2024-06-25 16:13:52', '2024-06-25 16:13:52'),
('G', 2, 84994, 233, 'normal', '2024-06-25 16:13:52', '2024-06-25 16:13:52'),
('H', 1, 114997, 245, 'couple', '2024-07-16 12:23:08', '2024-07-16 12:23:08'),
('H', 2, 114997, 245, 'couple', '2024-07-16 12:23:08', '2024-07-16 12:23:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id_combo`);

--
-- Indexes for table `combo_food`
--
ALTER TABLE `combo_food`
  ADD KEY `id_combo` (`id_combo`,`id_food`),
  ADD KEY `fk_combofood_food` (`id_food`);

--
-- Indexes for table `daodien_phim`
--
ALTER TABLE `daodien_phim`
  ADD PRIMARY KEY (`id_phim`,`id_dao_dien`),
  ADD KEY `id_phim` (`id_phim`,`id_dao_dien`),
  ADD KEY `fk_daodien_phim_daodien` (`id_dao_dien`);

--
-- Indexes for table `dao_dien`
--
ALTER TABLE `dao_dien`
  ADD PRIMARY KEY (`id_dao_dien`);

--
-- Indexes for table `dienvien_phim`
--
ALTER TABLE `dienvien_phim`
  ADD PRIMARY KEY (`id_phim`,`id_dien_vien`),
  ADD KEY `id_phim` (`id_phim`,`id_dien_vien`),
  ADD KEY `fk_dienvien_phim_dienvien` (`id_dien_vien`);

--
-- Indexes for table `dien_vien`
--
ALTER TABLE `dien_vien`
  ADD PRIMARY KEY (`id_dien_vien`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id_food`);

--
-- Indexes for table `ghe`
--
ALTER TABLE `ghe`
  ADD PRIMARY KEY (`id_ghe`),
  ADD KEY `id_loai_ghe` (`id_loai_ghe`,`id_phong`),
  ADD KEY `fk_ghe_phong` (`id_phong`);

--
-- Indexes for table `gia_ve`
--
ALTER TABLE `gia_ve`
  ADD PRIMARY KEY (`id_gia_ve`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `gioi_han_do_tuoi`
--
ALTER TABLE `gioi_han_do_tuoi`
  ADD PRIMARY KEY (`id_gioi_han_do_tuoi`);

--
-- Indexes for table `infors`
--
ALTER TABLE `infors`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`id_khuyen_mai`);

--
-- Indexes for table `lich_trinh`
--
ALTER TABLE `lich_trinh`
  ADD PRIMARY KEY (`id_lich_trinh`),
  ADD KEY `id_phim` (`id_phim`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Indexes for table `loai_ghe`
--
ALTER TABLE `loai_ghe`
  ADD PRIMARY KEY (`id_loai_ghe`);

--
-- Indexes for table `loai_phim`
--
ALTER TABLE `loai_phim`
  ADD PRIMARY KEY (`id_loai_phim`);

--
-- Indexes for table `loai_phim_phim`
--
ALTER TABLE `loai_phim_phim`
  ADD PRIMARY KEY (`id_phim`,`id_loai_phim`),
  ADD KEY `id_phim` (`id_phim`,`id_loai_phim`),
  ADD KEY `id_the_loai_phim` (`id_loai_phim`);

--
-- Indexes for table `loai_phong`
--
ALTER TABLE `loai_phong`
  ADD PRIMARY KEY (`id_loai_phong`);

--
-- Indexes for table `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`id_phim`),
  ADD KEY `id_gioi_han_do_tuoi` (`id_gioi_han_do_tuoi`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id_phong`),
  ADD KEY `id_loai_phong` (`id_loai_phong`,`id_rap`),
  ADD KEY `fk_phong_rap` (`id_rap`);

--
-- Indexes for table `rap`
--
ALTER TABLE `rap`
  ADD PRIMARY KEY (`id_rap`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `su_kien`
--
ALTER TABLE `su_kien`
  ADD PRIMARY KEY (`id_su_kien`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tin_tuc`
--
ALTER TABLE `tin_tuc`
  ADD PRIMARY KEY (`id_tin_tuc`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_rap` (`id_rap`);

--
-- Indexes for table `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`id_ve`),
  ADD KEY `id_lich_trinh` (`id_lich_trinh`,`id_user`),
  ADD KEY `fk_ve_user` (`id_user`);

--
-- Indexes for table `ve_combo`
--
ALTER TABLE `ve_combo`
  ADD KEY `id_ve` (`id_ve`);

--
-- Indexes for table `ve_food`
--
ALTER TABLE `ve_food`
  ADD KEY `fk_vefood_ve` (`id_ve`);

--
-- Indexes for table `ve_ghe`
--
ALTER TABLE `ve_ghe`
  ADD KEY `id_ve` (`id_ve`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id_banner` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `combos`
--
ALTER TABLE `combos`
  MODIFY `id_combo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dao_dien`
--
ALTER TABLE `dao_dien`
  MODIFY `id_dao_dien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dien_vien`
--
ALTER TABLE `dien_vien`
  MODIFY `id_dien_vien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id_food` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ghe`
--
ALTER TABLE `ghe`
  MODIFY `id_ghe` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1483;

--
-- AUTO_INCREMENT for table `gia_ve`
--
ALTER TABLE `gia_ve`
  MODIFY `id_gia_ve` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gioi_han_do_tuoi`
--
ALTER TABLE `gioi_han_do_tuoi`
  MODIFY `id_gioi_han_do_tuoi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `infors`
--
ALTER TABLE `infors`
  MODIFY `id_info` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `id_khuyen_mai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lich_trinh`
--
ALTER TABLE `lich_trinh`
  MODIFY `id_lich_trinh` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148558;

--
-- AUTO_INCREMENT for table `loai_ghe`
--
ALTER TABLE `loai_ghe`
  MODIFY `id_loai_ghe` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loai_phim`
--
ALTER TABLE `loai_phim`
  MODIFY `id_loai_phim` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loai_phong`
--
ALTER TABLE `loai_phong`
  MODIFY `id_loai_phong` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phim`
--
ALTER TABLE `phim`
  MODIFY `id_phim` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `id_phong` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rap`
--
ALTER TABLE `rap`
  MODIFY `id_rap` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `su_kien`
--
ALTER TABLE `su_kien`
  MODIFY `id_su_kien` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tin_tuc`
--
ALTER TABLE `tin_tuc`
  MODIFY `id_tin_tuc` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ve`
--
ALTER TABLE `ve`
  MODIFY `id_ve` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `combo_food`
--
ALTER TABLE `combo_food`
  ADD CONSTRAINT `fk_combofood_combo` FOREIGN KEY (`id_combo`) REFERENCES `combos` (`id_combo`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_combofood_food` FOREIGN KEY (`id_food`) REFERENCES `foods` (`id_food`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `daodien_phim`
--
ALTER TABLE `daodien_phim`
  ADD CONSTRAINT `fk_daodien_phim_daodien` FOREIGN KEY (`id_dao_dien`) REFERENCES `dao_dien` (`id_dao_dien`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_daodien_phim_phim` FOREIGN KEY (`id_phim`) REFERENCES `phim` (`id_phim`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dienvien_phim`
--
ALTER TABLE `dienvien_phim`
  ADD CONSTRAINT `fk_dienvien_phim_dienvien` FOREIGN KEY (`id_dien_vien`) REFERENCES `dien_vien` (`id_dien_vien`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dienvien_phim_phim` FOREIGN KEY (`id_phim`) REFERENCES `phim` (`id_phim`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ghe`
--
ALTER TABLE `ghe`
  ADD CONSTRAINT `fk_ghe_loai_ghe` FOREIGN KEY (`id_loai_ghe`) REFERENCES `loai_ghe` (`id_loai_ghe`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ghe_phong` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id_phong`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `gia_ve`
--
ALTER TABLE `gia_ve`
  ADD CONSTRAINT `fk_giave_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `lich_trinh`
--
ALTER TABLE `lich_trinh`
  ADD CONSTRAINT `fk_lichtrinh_phim` FOREIGN KEY (`id_phim`) REFERENCES `phim` (`id_phim`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lichtrinh_phong` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id_phong`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `loai_phim_phim`
--
ALTER TABLE `loai_phim_phim`
  ADD CONSTRAINT `loai_phim_phim_ibfk_1` FOREIGN KEY (`id_phim`) REFERENCES `phim` (`id_phim`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `loai_phim_phim_ibfk_2` FOREIGN KEY (`id_loai_phim`) REFERENCES `loai_phim` (`id_loai_phim`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `phim`
--
ALTER TABLE `phim`
  ADD CONSTRAINT `fk_phim_gioihandotuoi` FOREIGN KEY (`id_gioi_han_do_tuoi`) REFERENCES `gioi_han_do_tuoi` (`id_gioi_han_do_tuoi`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `fk_phong_loai_phong` FOREIGN KEY (`id_loai_phong`) REFERENCES `loai_phong` (`id_loai_phong`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_phong_rap` FOREIGN KEY (`id_rap`) REFERENCES `rap` (`id_rap`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `su_kien`
--
ALTER TABLE `su_kien`
  ADD CONSTRAINT `fk_sukien_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tin_tuc`
--
ALTER TABLE `tin_tuc`
  ADD CONSTRAINT `fk_tintuc_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_rap_phim` FOREIGN KEY (`id_rap`) REFERENCES `rap` (`id_rap`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `fk_ve_lichtrinh` FOREIGN KEY (`id_lich_trinh`) REFERENCES `lich_trinh` (`id_lich_trinh`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ve_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ve_combo`
--
ALTER TABLE `ve_combo`
  ADD CONSTRAINT `fk_vecombo_ve` FOREIGN KEY (`id_ve`) REFERENCES `ve` (`id_ve`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ve_food`
--
ALTER TABLE `ve_food`
  ADD CONSTRAINT `fk_vefood_ve` FOREIGN KEY (`id_ve`) REFERENCES `ve` (`id_ve`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ve_ghe`
--
ALTER TABLE `ve_ghe`
  ADD CONSTRAINT `fk_veghe_ve` FOREIGN KEY (`id_ve`) REFERENCES `ve` (`id_ve`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
