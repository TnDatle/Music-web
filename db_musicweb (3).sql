-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 02, 2024 lúc 10:33 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_musicweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `TenTV` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `TenTV`, `Username`, `Password`, `Email`) VALUES
(1, 'Tấn Đạt', 'TanDat', '123', 'datle211104@gmail.co'),
(2, 'Huy Hoàng', 'HuyHoang', '123', 'huyhoang123@gmail.co'),
(3, 'Nhật Hào', 'NhatHao', '123', 'nhathao123@gmail.com'),
(4, 'Quốc Trí', 'QuocTri', '123', 'quoctri123@gmail.com'),
(5, 'Bích Ngọc', 'BichNgoc', '123', 'bichngoc123@gmail.co');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_artist`
--

CREATE TABLE `tbl_artist` (
  `id_artist` int(10) NOT NULL,
  `name` text NOT NULL,
  `image_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_updated` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_artist`
--

INSERT INTO `tbl_artist` (`id_artist`, `name`, `image_path`, `date_created`, `date_updated`) VALUES
(1, 'The Weekend', '../Admin/image_artist/tw.jpg', '', ''),
(2, 'HIEUTHUHAI', '../Admin/image_artist/hth.jpg', NULL, 'urrent_timestamp('),
(3, 'Vũ Cát Tường', '../Admin/image_artist/vct.jpg', NULL, 'urrent_timestamp('),
(4, 'Vũ', '../Admin/image_artist/vu.jpg', NULL, 'urrent_timestamp('),
(5, 'Sơn Tùng MTP', '../Admin/image_artist/st.jpg', NULL, 'urrent_timestamp('),
(6, 'MONO', '../Admin/image_artist/mn.jpg', NULL, 'urrent_timestamp('),
(7, 'Obito', '../Admin/image_artist/obito.jpg', NULL, 'urrent_timestamp('),
(8, 'MCK', '../Admin/image_artist/mck.jpg', NULL, 'urrent_timestamp('),
(9, 'Phan Mạnh Quỳnh', '../Admin/image_artist/pmq.jpg', NULL, 'urrent_timestamp(');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_chude`
--

CREATE TABLE `tbl_chude` (
  `id_topic` int(11) NOT NULL,
  `name_topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_music`
--

CREATE TABLE `tbl_music` (
  `id` int(10) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `audio_path` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_artist` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_music`
--

INSERT INTO `tbl_music` (`id`, `title`, `description`, `audio_path`, `image_path`, `date_created`, `date_updated`, `id_artist`) VALUES
(10, 'Die For You', 'The Weekend', '../Admin/audio/Die_For_You.mp3?v=1711601206', '../Admin/images/6604f63614c68_DFU.jpg?v=1711601206', '2024-03-28 11:46:46', '2024-03-30 21:58:47', 1),
(12, 'After Hours', 'The Weekend', '../Admin/audio/The_Weeknd__After_Hours_Audio.mp3?v=1711601365', '../Admin/images/6604f6d55709c_AH.png?v=1711601365', '2024-03-28 11:49:25', '2024-03-31 16:19:24', 1),
(13, 'LAVIAI', 'HIEUTHUHAI ', '../Admin/audio/y2mate.com_-_WXRDIE__LAVIAI_REMIX_ft_HIEUTHUHAI__2PILLZ.mp3?v=1711601397', '../Admin/images/6604f6f539fbf_LAVIAI.jpg?v=1711601397', '2024-03-28 11:49:57', '2024-03-31 17:07:22', 2),
(14, 'Exit Sign', 'HIEUTHUHAI', '../Admin/audio/y2mate.com_-_HIEUTHUHAI__Exit_Sign_prod_by_Kewtiie_ft_marzuz_Official_Lyric_Video.mp3?v=1711601421', '../Admin/images/6604f70d42ecf_ES.jpg?v=1711601421', '2024-03-28 11:50:21', '2024-03-31 17:07:31', 2),
(15, 'MƠ', 'Vũ Cát Tường', '../Admin/audio/y2mate.com_-_Vu_Cat_Tuong__Mơ_Dreaming__Official_MV.mp3?v=1711601502', '../Admin/images/6604f75ec03a2_Mo.jpg?v=1711601502', '2024-03-28 11:51:42', '2024-03-31 18:20:58', 3),
(16, 'Từng Là', 'Vũ Cát Tường', '../Admin/audio/y2mate.com_-_TỪNG_LÀ__VŨ_CÁT_TƯỜNG__OFFICIAL.mp3?v=1711601526', '../Admin/images/6604f776ccf2f_TL.jpg?v=1711601526', '2024-03-28 11:52:06', '2024-03-31 18:21:10', 3),
(17, 'Anh Nhớ Ra', 'Vũ', '../Admin/audio/y2mate.com_-_ANH_NHỚ_RA__Vũ_Feat_Trang__Official_Audio.mp3?v=1711601542', '../Admin/images/6604f786e29f9_ANR.jpg?v=1711601542', '2024-03-28 11:52:22', '2024-03-31 18:21:21', 4),
(18, 'Những Lời Hứa Bỏ Quên', 'Vũ', '../Admin/audio/y2mate.com_-_NHỮNG_LỜI_HỨA_BỎ_QUÊN__VŨ_x_DEAR_JANE_Official_MV.mp3?v=1711601563', '../Admin/images/6604f79b2478f_NLHBQ.jpg?v=1711601563', '2024-03-28 11:52:43', '2024-03-31 18:21:33', 4),
(19, 'Có Chắc Yêu Là Đây', 'Sơn Tùng MTP', '../Admin/audio/y2mate.com_-_SƠN_TÙNG_MTP__CÓ_CHẮC_YÊU_LÀ_ĐÂY__OFFICIAL_MUSIC_VIDEO.mp3?v=1711601586', '../Admin/images/6604f7b2d6bbc_CCYLD.jpg?v=1711601586', '2024-03-28 11:53:06', '2024-03-31 18:21:44', 5),
(20, 'Chúng Ta Của Tương Lai', 'Sơn Tùng MTP', '../Admin/audio/y2mate.com_-_SƠN_TÙNG_MTP__CHÚNG_TA_CỦA_TƯƠNG_LAI__OFFICIAL_MUSIC_VIDEO.mp3?v=1711601608', '../Admin/images/6604f7c8e9b5d_CTCTL.jpg?v=1711601608', '2024-03-28 11:53:28', '2024-03-31 18:21:55', 5),
(21, 'Em Là', 'MONO', '../Admin/audio/y2mate.com_-_MONO__Em_Là_Album_22__Track_No03.mp3?v=1711601630', '../Admin/images/6604f7deb83f2_EL.jpg?v=1711601630', '2024-03-28 11:53:50', '2024-03-31 18:22:07', 6),
(22, 'Open Your Eyes', 'MONO', '../Admin/audio/y2mate.com_-_MONO__Open_Your_Eyes_Official_Music_Video.mp3?v=1711601668', '../Admin/images/6604f804d50f6_0.jpg?v=1711601668', '2024-03-28 11:54:28', '2024-03-31 18:22:18', 6),
(23, 'Si Mê You', 'Obito', '../Admin/audio/y2mate.com_-_Si_Mê_You__Obito__Official_Music_Video.mp3?v=1711601689', '../Admin/images/6604f8194f72e_sime.jpg?v=1711601689', '2024-03-28 11:54:49', '2024-03-31 18:22:28', 7),
(24, 'Your Smile', 'Obito', '../Admin/audio/y2mate.com_-_Obito_ft_VSTRA_live_YOUR_SMILE__Emma_x_Seachains_x_Obito____Collaborative_Session_19.mp3?v=1711601713', '../Admin/images/6604f8312f97a_ursmile.jpg?v=1711601713', '2024-03-28 11:55:13', '2024-03-31 18:22:41', 7),
(25, 'Chỉ Một Đêm Nữa Thôi', 'Mck', '../Admin/audio/y2mate.com_-_06_Chỉ_Một_Đêm_Nữa_Thôi__RPT_MCK__ft_tlinh____99__the_album.mp3?v=1711604040', '../Admin/images/66050148d77f1_cmdnx.jpg?v=1711604040', '2024-03-28 12:34:00', '2024-03-31 18:23:16', 8),
(26, 'TayTo', 'Mck', '../Admin/audio/y2mate.com_-_Rapitalove_EP_Tay_To__RPT_MCK_x_RPT_PhongKhin_Prod_by_RPT_PhongKhin_Official_Lyric_Video.mp3?v=1711604273', '../Admin/images/66050231883d7_tay.jpg?v=1711604273', '2024-03-28 12:37:53', '2024-03-31 18:23:26', 8),
(27, 'Sao Cha Không', 'Phan Mạnh Quỳnh', '../Admin/audio/y2mate.com_-_SAO_CHA_KHÔNG__PHAN_MẠNH_QUỲNH__OFFICIAL_MV__OST_BỐ_GIÀ_2021.mp3?v=1711604557', '../Admin/images/6605034d16312_saocha.jpg?v=1711604557', '2024-03-28 12:42:37', '2024-03-31 18:23:35', 9),
(28, 'Nhạt', 'Phan Mạnh Quỳnh', '../Admin/audio/y2mate.com_-_NHẠT__Phan_Mạnh_Quỳnh__AUDIO.mp3?v=1711604571', '../Admin/images/6605035b2511d_nhat.jpg?v=1711604571', '2024-03-28 12:42:51', '2024-03-31 18:23:43', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhanxet`
--

CREATE TABLE `tbl_nhanxet` (
  `id_comment` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_theloai`
--

CREATE TABLE `tbl_theloai` (
  `id_category` int(11) NOT NULL,
  `name_category` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `Name`, `Username`, `Email`, `Password`) VALUES
(1, 'Bích Ngọc', 'bichngoc', 'bichngoc@gmail.com', '123'),
(2, 'Duy Tùng', 'duytung', 'duytung@gmail.com', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tbl_artist`
--
ALTER TABLE `tbl_artist`
  ADD PRIMARY KEY (`id_artist`),
  ADD UNIQUE KEY `id_artist` (`id_artist`);

--
-- Chỉ mục cho bảng `tbl_chude`
--
ALTER TABLE `tbl_chude`
  ADD PRIMARY KEY (`id_topic`);

--
-- Chỉ mục cho bảng `tbl_music`
--
ALTER TABLE `tbl_music`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_nhanxet`
--
ALTER TABLE `tbl_nhanxet`
  ADD PRIMARY KEY (`id_comment`);

--
-- Chỉ mục cho bảng `tbl_theloai`
--
ALTER TABLE `tbl_theloai`
  ADD KEY `fk_theloai_chude` (`id_topic`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_artist`
--
ALTER TABLE `tbl_artist`
  MODIFY `id_artist` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_chude`
--
ALTER TABLE `tbl_chude`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_music`
--
ALTER TABLE `tbl_music`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `tbl_nhanxet`
--
ALTER TABLE `tbl_nhanxet`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_theloai`
--
ALTER TABLE `tbl_theloai`
  ADD CONSTRAINT `fk_theloai_chude` FOREIGN KEY (`id_topic`) REFERENCES `tbl_chude` (`id_topic`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
