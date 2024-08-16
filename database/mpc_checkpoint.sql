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

 Date: 16/08/2024 16:51:32
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
INSERT INTO `patrol_base_tbl` VALUES (1, 'papa1', '2024-08-16');
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
INSERT INTO `patrolbase_assign_tbl` VALUES (1, 1, 'asd', 'asd', 'asd', NULL, 'asd', NULL, NULL);
INSERT INTO `patrolbase_assign_tbl` VALUES (2, 1, 'miste', 'ry', 'major', '2024-08-15', 'active', 'lispu', 'lispu');
INSERT INTO `patrolbase_assign_tbl` VALUES (3, 1, 'asd', 'asd', 'Police Director General', '2024-08-15', 'asd', NULL, NULL);
INSERT INTO `patrolbase_assign_tbl` VALUES (4, 1, 'asd', 'asd', 'Chief Superintendent', '2024-08-15', 'asd', NULL, NULL);

-- ----------------------------
-- Table structure for traffic_violations
-- ----------------------------
DROP TABLE IF EXISTS `traffic_violations`;
CREATE TABLE `traffic_violations`  (
  `violation_id` int NOT NULL AUTO_INCREMENT,
  `officer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `violation_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_plate_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `driver_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `traffic_violations` VALUES (1, '1', 'illegal_parking', '123123', 'Miste Ry', 'uploads/driver_images/photo_2024-05-20_07-17-54.jpg', 'Tambler', '2024-08-16', '04:52:00', 'uploads/evidence/luffy_shen.png', 'asd', 'Unsolved', '2024-08-16 15:51:35');

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
INSERT INTO `user_table` VALUES (1, 'hi', 'hello', 'admin', 'admin', 'admin', '2024-08-13', NULL, NULL);
INSERT INTO `user_table` VALUES (3, 'Starbrigh', 'Gensan', 'user', 'admin', 'admin', '2024-08-16', 'active', 'admin@gmail.com');

SET FOREIGN_KEY_CHECKS = 1;
