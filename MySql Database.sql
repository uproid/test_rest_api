/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : library

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 14/07/2021 13:07:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for authors
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_persian_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_persian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of authors
-- ----------------------------
INSERT INTO `authors` VALUES (10, 'Uitgeverij Coutinho', '');
INSERT INTO `authors` VALUES (11, 'The Silver Spoon Kitchen', 'The Silver Spoon Kitchen is an archive of traditional recipes collected from across the country and includes every regional specialty. Eating is a serious matter in Italy. Cooking and food are among the finest expressions of Italian culture, vividly portraying the country\'s history, regions and traditions. The skills of Italian cooking are handed down from one generation to the next, and its unique character has come about through centuries of testing in family kitchens.');
INSERT INTO `authors` VALUES (9, 'Astrid Koppers', 'Illustrated by	Astrid Koppers\r\nContributors	Ad Bakker, Tekstase (Eexterveen)\r\nPublished	2015');

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `isbn` char(17) CHARACTER SET utf8 COLLATE utf8_persian_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_persian_ci NULL,
  `category_id` int(10) NOT NULL DEFAULT 0,
  `author_id` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_persian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES (30, '9789058759108', 'Naar Nederland', 'voorbereiding op het basisexamen inburgering in het buitenland : Nederlands-Oekraiens : gekuiste versie', 12, 9);
INSERT INTO `books` VALUES (31, '9783125288768', 'Nederlands in Gang', 'Uitgeverij coutinho, 2010\r\n', 12, 10);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_persian_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_persian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (12, 'Taal', 'Taal te leren');
INSERT INTO `categories` VALUES (13, 'Cooking', 'We haven\'t found any reviews in the usual places.\r\n');

SET FOREIGN_KEY_CHECKS = 1;
