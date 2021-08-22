/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : localhost:8860
 Source Schema         : zdev-gathering

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 22/08/2021 21:20:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_event` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_klien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_mulai` date NULL DEFAULT NULL,
  `tanggal_selesai` date NULL DEFAULT NULL,
  `jam_mulai` time(0) NULL DEFAULT NULL,
  `jam_selesai` time(0) NULL DEFAULT NULL,
  `total_hari` int(11) NULL DEFAULT NULL,
  `biaya_tempat` int(11) NULL DEFAULT NULL,
  `lokasi_id` int(11) NULL DEFAULT NULL,
  `mc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_mc` int(255) NULL DEFAULT NULL,
  `band` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_band` int(255) NULL DEFAULT NULL,
  `rundown` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `file_pendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `undian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `harga_undian` int(11) NULL DEFAULT NULL,
  `makanan_per_porsi` int(255) NULL DEFAULT NULL,
  `jml_porsi` int(255) NULL DEFAULT NULL,
  `biaya_makanan` int(255) NULL DEFAULT NULL,
  `eo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_eo` int(11) NULL DEFAULT NULL,
  `total_budget` int(255) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event
-- ----------------------------
INSERT INTO `event` VALUES (1, '20210728-F8Mf-0', 'David', '2021-07-27', '2021-07-30', '01:00:00', '00:00:00', 4, 20000000, 10, 'MC 1', 1000000, 'ST 12', 2000000, '- Pembukaan \r\n- Penutupan', '1627484832Laporan Penjualan.pdf', '- Motor\r\n- Mobil', 100000000, 20000, 1000, 20000000, 'Jasa 1', 500000, 143500000, 'lunas', '2021-07-28 22:19:39', '2021-07-28 15:19:39');

-- ----------------------------
-- Table structure for layout_dokumentasi
-- ----------------------------
DROP TABLE IF EXISTS `layout_dokumentasi`;
CREATE TABLE `layout_dokumentasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NULL DEFAULT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of layout_dokumentasi
-- ----------------------------
INSERT INTO `layout_dokumentasi` VALUES (1, 1, 'david0-1627484832.jpg');

-- ----------------------------
-- Table structure for lokasi
-- ----------------------------
DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE `lokasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `harga` int(11) NULL DEFAULT NULL,
  `kapasitas_parkir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `unit_display` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kapasitas_tamu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasi
-- ----------------------------
INSERT INTO `lokasi` VALUES (5, 'Gor Padjajaran', 'Babakan Ciamis, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40171', 1000000, '100 Motor + 10 Mobil', 'Gelanggang Olahraga Padjadjaran adalah sebuah gelanggang olahraga serbaguna di Kota Bandung, Jawa Barat, Indonesia. Gelanggang olahraga ini umumnya digunakan untuk olahraga basket dan bulu tangkis', '2 Unit', '100 Kursi');
INSERT INTO `lokasi` VALUES (9, 'Grand Ballrom Pasundan', 'Jl. Peta No.147 - 149, Suka Asih, Kec. Bojongloa Kaler, Kota Bandung, Jawa Barat 40233', 5000000, '100 Mobil + 1000 Motor', 'Grand Pasundan Convention Hotel menawarkan pilihan paket wedding Jayagiri, Dayang Sumbi dan ...', '2 Unit', '1500 Kursi');
INSERT INTO `lokasi` VALUES (10, 'Grand Ballroom Sudirman', 'Jl. Jend. Sudirman No.620, Dungus Cariang, Kec. Andir, Kota Bandung, Jawa Barat 40183', 5000000, '100 Motor + 10 Mobil', 'Ruang pertemuan di Bandung, Jawa Barat', '2 Unit', '300 Kursi');

-- ----------------------------
-- Table structure for lokasi_gambar
-- ----------------------------
DROP TABLE IF EXISTS `lokasi_gambar`;
CREATE TABLE `lokasi_gambar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi_id` int(11) NULL DEFAULT NULL,
  `image_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasi_gambar
-- ----------------------------
INSERT INTO `lokasi_gambar` VALUES (10, 5, 'gor-padjajaran0-1623857538.jpg');
INSERT INTO `lokasi_gambar` VALUES (11, 5, 'gor-padjajaran1-1623857538.jpg');
INSERT INTO `lokasi_gambar` VALUES (12, 5, 'gor-padjajaran2-1623857539.jpg');
INSERT INTO `lokasi_gambar` VALUES (17, 9, 'grand-ballrom-pasundan0-1625240337.jpg');
INSERT INTO `lokasi_gambar` VALUES (18, 9, 'grand-ballrom-pasundan1-1625240337.jpg');
INSERT INTO `lokasi_gambar` VALUES (19, 10, 'grand-ballroom-sudirman0-1627484719.jpg');
INSERT INTO `lokasi_gambar` VALUES (20, 10, 'grand-ballroom-sudirman1-1627484719.jpg');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Superadmin', 'superadmin', '$2y$10$rjXWpbQEv0ZI97QAW4xGQelGJWhN6bh2MaQIxc67luiRDU6FD6mL2', 'superadmin', NULL, '2021-01-09 13:35:56', '2021-06-12 07:08:08');
INSERT INTO `users` VALUES (13, 'Pimpinan', 'pimpinan', '$2y$10$8w1HuHt2lPwQXjlh6doQ3OaPOyGql2ZtQTO1VZuhA6V1k66vs.RRW', 'pimpinan', NULL, '2021-08-04 12:14:26', '2021-08-04 12:14:26');

SET FOREIGN_KEY_CHECKS = 1;
