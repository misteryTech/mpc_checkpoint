/*
 Navicat Premium Data Transfer

 Source Server         : starbright
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : mpc_checkpoint

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 20/08/2024 16:46:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for patrol_base_tbl
-- ----------------------------
DROP TABLE IF EXISTS `patrol_base_tbl`;
CREATE TABLE `patrol_base_tbl`  (
  `patrol_id` int NOT NULL AUTO_INCREMENT,
  `patrol_basename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `assigned_date` date NULL DEFAULT current_timestamp,
  PRIMARY KEY (`patrol_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patrol_base_tbl
-- ----------------------------
INSERT INTO `patrol_base_tbl` VALUES (1, 'papa', '2024-08-16');
INSERT INTO `patrol_base_tbl` VALUES (2, 'Papa 2', '2024-08-16');

-- ----------------------------
-- Table structure for patrolbase_assign_tbl
-- ----------------------------
DROP TABLE IF EXISTS `patrolbase_assign_tbl`;
CREATE TABLE `patrolbase_assign_tbl`  (
  `assign_id` int NOT NULL AUTO_INCREMENT,
  `patrolbase_id` int NULL DEFAULT NULL,
  `police_firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `police_lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_register` date NULL DEFAULT current_timestamp,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`assign_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patrolbase_assign_tbl
-- ----------------------------
INSERT INTO `patrolbase_assign_tbl` VALUES (2, 1, 'miste', 'ry', 'Police Officer II', '2024-08-15', 'active', 'lispu', 'lispu');
INSERT INTO `patrolbase_assign_tbl` VALUES (3, 1, 'asd', 'asd', 'Police Director General', '2024-08-15', 'active', NULL, NULL);
INSERT INTO `patrolbase_assign_tbl` VALUES (4, 1, 'asd', 'asd', 'Chief Superintendent', '2024-08-15', 'active', NULL, NULL);

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `licensed_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `driver_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `released_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES (1, 'asd', 'asd', 'ASD@GMAIL.COM', 'asd', 'asd', 'uploads/photo_2024-05-20_07-17-54.jpg', '2024-08-17 13:21:06', NULL, NULL);
INSERT INTO `profiles` VALUES (2, 'asd', 'asd', 'ASD@GMAIL.COM', 'asd', 'asd', 'uploads/photo_2024-05-20_07-17-54.jpg', '2024-08-17 13:21:15', NULL, NULL);
INSERT INTO `profiles` VALUES (3, 'asd', 'asd', 'asd1231231@gmail.com', 'asd', 'asd', 'uploads/luffy_shen.png', '2024-08-17 13:28:56', NULL, NULL);
INSERT INTO `profiles` VALUES (4, 'asd', 'asd', 'asd1231231@gmail.com', 'asd', 'asd', 'uploads/luffy_shen.png', '2024-08-17 13:29:55', NULL, NULL);
INSERT INTO `profiles` VALUES (5, 'as', 'asd', 'asd1231231@gmail.com', '123', 'asd', 'uploads/302597659_483170430485654_5599727337940796982_n.jpg', '2024-08-17 13:31:49', NULL, NULL);
INSERT INTO `profiles` VALUES (6, 'asd', 'asd', 'ASD@GMAIL.COM', 'asd', 'as', 'uploads/302597659_483170430485654_5599727337940796982_n.jpg', '2024-08-17 13:33:43', 'Verified', '2024-09-07');
INSERT INTO `profiles` VALUES (7, 'reymark', 'escalante', 'asdasd@gmail.com', 'asads', 'asdasd', 'uploads/luffy_shen.png', '2024-08-17 13:52:32', 'Verified', '2024-09-02');
INSERT INTO `profiles` VALUES (8, 'ray leight mart ', 'Escalante', 'reymarkescalante@Gmail.com', '09399213074', '1904', 'uploads/1705311630014.jpg', '2024-08-17 14:30:09', 'Request', NULL);

-- ----------------------------
-- Table structure for traffic_violations
-- ----------------------------
DROP TABLE IF EXISTS `traffic_violations`;
CREATE TABLE `traffic_violations`  (
  `violation_id` int NOT NULL AUTO_INCREMENT,
  `officer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `violation_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_plate_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `driver_licensed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `driver_lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `driver_firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `driver_image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `violation_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `violation_date` date NOT NULL,
  `violation_time` time NOT NULL,
  `evidence_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `additional_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Unsolved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`violation_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of traffic_violations
-- ----------------------------
INSERT INTO `traffic_violations` VALUES (1, '1', 'Reckless Driving', '123123', '1904', 'Escalante', 'Reymarks', 'uploads/driver_images/picture.png', 'aa', '2024-08-15', '14:57:00', 'uploads/evidence/picture.png', 'asd', 'Unsolved', '2024-08-17 14:56:23');

-- ----------------------------
-- Table structure for user_table
-- ----------------------------
DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_registered` date NULL DEFAULT current_timestamp,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_table
-- ----------------------------
INSERT INTO `user_table` VALUES (3, 'Starbrigh', 'Gensan', 'user', 'admin', 'admin', '2024-08-16', 'active', 'admin@gmail.com');

SET FOREIGN_KEY_CHECKS = 1;
