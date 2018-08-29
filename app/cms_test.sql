/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : cms_test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-08-29 13:45:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'admin', 'admin@admin.com', '$2y$10$v1Z8Re80oCimaRdvOAkUeexLBz526ClW4BlKoYkz5cqTgjkCDr4Om', '7qfmRbSEsFM4iRQC0GHTb8nHtwCDRxGL2NZJKqdUX7OF2k8mC2qEprg4kqB5', '2018-08-27 10:04:25', '2018-08-27 10:04:25');

-- ----------------------------
-- Table structure for `defaults`
-- ----------------------------
DROP TABLE IF EXISTS `defaults`;
CREATE TABLE `defaults` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `defaults_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of defaults
-- ----------------------------
INSERT INTO `defaults` VALUES ('1', 'Locale', 'en', '2018-08-27 10:04:25', '2018-08-27 14:21:41');
INSERT INTO `defaults` VALUES ('2', 'home_page', 'Home', '2018-08-27 13:08:05', '2018-08-28 13:33:40');

-- ----------------------------
-- Table structure for `design_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `design_blocks`;
CREATE TABLE `design_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_classes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `design_blocks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `design_blocks_title_unique` (`title`),
  UNIQUE KEY `design_blocks_view_unique` (`view`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of design_blocks
-- ----------------------------
INSERT INTO `design_blocks` VALUES ('1', 'slide', null, null, '', '2018-08-27 13:01:17', '2018-08-27 13:01:17');
INSERT INTO `design_blocks` VALUES ('2', 'slider', 'frontend.index.slider', null, 'slide', '2018-08-27 13:02:13', '2018-08-27 13:02:13');
INSERT INTO `design_blocks` VALUES ('3', 'call to action', 'frontend.index.call_action', null, '', '2018-08-28 05:56:14', '2018-08-28 05:56:14');
INSERT INTO `design_blocks` VALUES ('4', 'features item', null, null, '', '2018-08-28 06:04:30', '2018-08-28 06:04:30');
INSERT INTO `design_blocks` VALUES ('5', 'features container', 'frontend.index.features', null, 'features item', '2018-08-28 06:06:15', '2018-08-28 06:06:15');
INSERT INTO `design_blocks` VALUES ('6', 'line divider', 'frontend.index.solid_divider', null, '', '2018-08-28 06:42:20', '2018-08-28 06:42:20');
INSERT INTO `design_blocks` VALUES ('7', 'project item success', null, 'progress-bar-success', '', '2018-08-28 06:48:35', '2018-08-28 06:49:09');
INSERT INTO `design_blocks` VALUES ('8', 'project item info', null, 'progress-bar-info', '', '2018-08-28 06:49:53', '2018-08-28 06:49:53');
INSERT INTO `design_blocks` VALUES ('9', 'project item warning', null, 'progress-bar-warning', '', '2018-08-28 06:50:32', '2018-08-28 06:50:32');
INSERT INTO `design_blocks` VALUES ('10', 'project item danger', null, 'progress-bar-danger', '', '2018-08-28 06:51:08', '2018-08-28 06:53:46');
INSERT INTO `design_blocks` VALUES ('11', 'about company', 'frontend.index.about_company', null, 'project item success,project item info,project item warning,project item danger', '2018-08-28 06:55:16', '2018-08-28 06:55:16');
INSERT INTO `design_blocks` VALUES ('12', 'blank divider', 'frontend.index.blank_divider', null, '', '2018-08-28 07:04:58', '2018-08-28 07:04:58');
INSERT INTO `design_blocks` VALUES ('13', 'countdown item', null, null, '', '2018-08-28 07:08:43', '2018-08-28 07:08:43');
INSERT INTO `design_blocks` VALUES ('14', 'countdown container', 'frontend.index.countdown', null, 'countdown item', '2018-08-28 07:09:22', '2018-08-28 07:09:22');
INSERT INTO `design_blocks` VALUES ('15', 'feedback item', null, null, '', '2018-08-28 07:41:27', '2018-08-28 07:41:27');
INSERT INTO `design_blocks` VALUES ('16', 'feedback container', 'frontend.index.parts.testimonial.feedback', null, 'feedback item', '2018-08-28 07:43:32', '2018-08-28 08:03:30');
INSERT INTO `design_blocks` VALUES ('20', 'tab item image left', null, 'pull-left', '', '2018-08-28 07:52:29', '2018-08-28 07:52:29');
INSERT INTO `design_blocks` VALUES ('21', 'tab item image right', null, 'pull-right', '', '2018-08-28 07:53:35', '2018-08-28 07:53:35');
INSERT INTO `design_blocks` VALUES ('22', 'tab item', null, null, '', '2018-08-28 07:54:08', '2018-08-28 07:54:08');
INSERT INTO `design_blocks` VALUES ('23', 'tab container', 'frontend.index.parts.testimonial.tabs', null, 'tab item,tab item image left,tab item image right', '2018-08-28 07:54:52', '2018-08-28 08:03:49');
INSERT INTO `design_blocks` VALUES ('24', 'testimonial', 'frontend.index.testimonial', null, 'feedback container,tab container', '2018-08-28 07:55:32', '2018-08-28 07:55:32');
INSERT INTO `design_blocks` VALUES ('27', 'portfolio class', null, null, '', '2018-08-28 09:42:27', '2018-08-28 09:42:27');
INSERT INTO `design_blocks` VALUES ('29', 'portfolio item', null, null, '', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks` VALUES ('30', 'portfolio classes container', 'frontend.index.parts.portfolio.classes', null, 'portfolio class', '2018-08-28 09:51:29', '2018-08-28 10:42:45');
INSERT INTO `design_blocks` VALUES ('31', 'portfolio items container', 'frontend.index.parts.portfolio.items', null, 'portfolio item', '2018-08-28 09:51:46', '2018-08-28 10:43:13');
INSERT INTO `design_blocks` VALUES ('32', 'portfolio', 'frontend.index.portfolio', null, 'portfolio classes container,portfolio items container', '2018-08-28 09:53:07', '2018-08-28 09:53:07');
INSERT INTO `design_blocks` VALUES ('33', 'price item feature', null, null, '', '2018-08-28 11:07:12', '2018-08-28 11:07:12');
INSERT INTO `design_blocks` VALUES ('34', 'price item', null, null, 'price item feature', '2018-08-28 11:08:13', '2018-08-28 11:08:13');
INSERT INTO `design_blocks` VALUES ('35', 'price item special', null, 'pricing-item-special', 'price item feature', '2018-08-28 11:11:58', '2018-08-28 11:11:58');
INSERT INTO `design_blocks` VALUES ('36', 'price container', 'frontend.index.prices', null, 'price item,price item special', '2018-08-28 11:13:26', '2018-08-28 11:13:26');
INSERT INTO `design_blocks` VALUES ('39', 'clients container', 'frontend.index.clients', null, '', '2018-08-28 11:36:39', '2018-08-28 11:36:39');
INSERT INTO `design_blocks` VALUES ('40', 'paragraph', null, null, '', '2018-08-28 12:04:12', '2018-08-28 12:04:12');
INSERT INTO `design_blocks` VALUES ('42', 'content fullwidth image', 'frontend.page.content', null, 'paragraph', '2018-08-28 12:15:12', '2018-08-28 12:15:12');
INSERT INTO `design_blocks` VALUES ('43', 'map', 'frontend.contact.parts.content.map', null, '', '2018-08-28 12:32:45', '2018-08-28 12:32:45');
INSERT INTO `design_blocks` VALUES ('45', 'form', 'frontend.contact.parts.content.form', null, '', '2018-08-28 12:34:32', '2018-08-28 12:34:32');
INSERT INTO `design_blocks` VALUES ('46', 'contact content', 'frontend.contact.content', null, 'map,form', '2018-08-28 12:35:05', '2018-08-28 12:35:05');

-- ----------------------------
-- Table structure for `design_blocks_info_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `design_blocks_info_blocks`;
CREATE TABLE `design_blocks_info_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `design_block_id` int(10) unsigned NOT NULL,
  `info_block_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `design_blocks_info_blocks_design_block_id_foreign` (`design_block_id`),
  KEY `design_blocks_info_blocks_info_block_id_foreign` (`info_block_id`),
  CONSTRAINT `design_blocks_info_blocks_design_block_id_foreign` FOREIGN KEY (`design_block_id`) REFERENCES `design_blocks` (`id`),
  CONSTRAINT `design_blocks_info_blocks_info_block_id_foreign` FOREIGN KEY (`info_block_id`) REFERENCES `info_blocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of design_blocks_info_blocks
-- ----------------------------
INSERT INTO `design_blocks_info_blocks` VALUES ('1', 'image', '1', '3', '2018-08-27 13:01:17', '2018-08-27 13:01:17');
INSERT INTO `design_blocks_info_blocks` VALUES ('2', 'heading', '1', '1', '2018-08-27 13:01:17', '2018-08-27 13:01:17');
INSERT INTO `design_blocks_info_blocks` VALUES ('3', 'description', '1', '2', '2018-08-27 13:01:17', '2018-08-27 13:01:17');
INSERT INTO `design_blocks_info_blocks` VALUES ('4', 'link sign', '1', '1', '2018-08-27 13:01:17', '2018-08-27 13:01:17');
INSERT INTO `design_blocks_info_blocks` VALUES ('5', 'link refference', '1', '1', '2018-08-27 13:01:17', '2018-08-27 13:01:17');
INSERT INTO `design_blocks_info_blocks` VALUES ('6', 'heading', '3', '1', '2018-08-28 05:56:14', '2018-08-28 05:56:14');
INSERT INTO `design_blocks_info_blocks` VALUES ('7', 'description', '3', '1', '2018-08-28 05:56:14', '2018-08-28 05:56:14');
INSERT INTO `design_blocks_info_blocks` VALUES ('8', 'action refference', '3', '1', '2018-08-28 05:56:14', '2018-08-28 05:56:14');
INSERT INTO `design_blocks_info_blocks` VALUES ('9', 'action sign', '3', '1', '2018-08-28 05:56:14', '2018-08-28 05:56:14');
INSERT INTO `design_blocks_info_blocks` VALUES ('10', 'icon', '4', '1', '2018-08-28 06:04:30', '2018-08-28 06:04:30');
INSERT INTO `design_blocks_info_blocks` VALUES ('11', 'sign', '4', '1', '2018-08-28 06:04:30', '2018-08-28 06:04:30');
INSERT INTO `design_blocks_info_blocks` VALUES ('12', 'heading', '5', '1', '2018-08-28 06:06:15', '2018-08-28 06:06:15');
INSERT INTO `design_blocks_info_blocks` VALUES ('13', 'description', '5', '2', '2018-08-28 06:06:15', '2018-08-28 06:06:15');
INSERT INTO `design_blocks_info_blocks` VALUES ('14', 'percent', '7', '1', '2018-08-28 06:48:35', '2018-08-28 06:48:35');
INSERT INTO `design_blocks_info_blocks` VALUES ('15', 'sign', '7', '1', '2018-08-28 06:48:35', '2018-08-28 06:48:35');
INSERT INTO `design_blocks_info_blocks` VALUES ('16', 'percent', '8', '1', '2018-08-28 06:49:53', '2018-08-28 06:49:53');
INSERT INTO `design_blocks_info_blocks` VALUES ('17', 'sign', '8', '1', '2018-08-28 06:49:54', '2018-08-28 06:49:54');
INSERT INTO `design_blocks_info_blocks` VALUES ('18', 'percent', '9', '1', '2018-08-28 06:50:32', '2018-08-28 06:50:32');
INSERT INTO `design_blocks_info_blocks` VALUES ('19', 'sign', '9', '1', '2018-08-28 06:50:32', '2018-08-28 06:50:32');
INSERT INTO `design_blocks_info_blocks` VALUES ('20', 'percent', '10', '1', '2018-08-28 06:51:08', '2018-08-28 06:51:08');
INSERT INTO `design_blocks_info_blocks` VALUES ('21', 'sign', '10', '1', '2018-08-28 06:51:08', '2018-08-28 06:51:08');
INSERT INTO `design_blocks_info_blocks` VALUES ('22', 'heading', '11', '1', '2018-08-28 06:55:16', '2018-08-28 06:55:16');
INSERT INTO `design_blocks_info_blocks` VALUES ('23', 'strong', '11', '1', '2018-08-28 06:55:16', '2018-08-28 06:55:16');
INSERT INTO `design_blocks_info_blocks` VALUES ('24', 'paragraph 1', '11', '2', '2018-08-28 06:55:16', '2018-08-28 06:55:16');
INSERT INTO `design_blocks_info_blocks` VALUES ('25', 'paragraph 2', '11', '2', '2018-08-28 06:55:16', '2018-08-28 06:55:16');
INSERT INTO `design_blocks_info_blocks` VALUES ('26', 'icon', '13', '1', '2018-08-28 07:08:43', '2018-08-28 07:08:43');
INSERT INTO `design_blocks_info_blocks` VALUES ('27', 'number', '13', '1', '2018-08-28 07:08:43', '2018-08-28 07:08:43');
INSERT INTO `design_blocks_info_blocks` VALUES ('28', 'sign', '13', '1', '2018-08-28 07:08:43', '2018-08-28 07:08:43');
INSERT INTO `design_blocks_info_blocks` VALUES ('29', 'image', '14', '3', '2018-08-28 07:09:22', '2018-08-28 07:09:22');
INSERT INTO `design_blocks_info_blocks` VALUES ('30', 'comment', '15', '2', '2018-08-28 07:41:27', '2018-08-28 07:41:27');
INSERT INTO `design_blocks_info_blocks` VALUES ('31', 'name', '15', '1', '2018-08-28 07:41:27', '2018-08-28 07:41:27');
INSERT INTO `design_blocks_info_blocks` VALUES ('32', 'company', '15', '1', '2018-08-28 07:41:27', '2018-08-28 07:41:27');
INSERT INTO `design_blocks_info_blocks` VALUES ('41', 'heading', '20', '1', '2018-08-28 07:52:29', '2018-08-28 07:52:29');
INSERT INTO `design_blocks_info_blocks` VALUES ('42', 'image', '20', '3', '2018-08-28 07:52:29', '2018-08-28 07:52:29');
INSERT INTO `design_blocks_info_blocks` VALUES ('43', 'paragraph 1', '20', '2', '2018-08-28 07:52:29', '2018-08-28 07:52:29');
INSERT INTO `design_blocks_info_blocks` VALUES ('44', 'paragraph 2', '20', '2', '2018-08-28 07:52:29', '2018-08-28 07:52:29');
INSERT INTO `design_blocks_info_blocks` VALUES ('45', 'heading', '21', '1', '2018-08-28 07:53:35', '2018-08-28 07:53:35');
INSERT INTO `design_blocks_info_blocks` VALUES ('46', 'image', '21', '3', '2018-08-28 07:53:35', '2018-08-28 07:53:35');
INSERT INTO `design_blocks_info_blocks` VALUES ('47', 'paragraph 1', '21', '2', '2018-08-28 07:53:35', '2018-08-28 07:53:35');
INSERT INTO `design_blocks_info_blocks` VALUES ('48', 'paragraph 2', '21', '2', '2018-08-28 07:53:36', '2018-08-28 07:53:36');
INSERT INTO `design_blocks_info_blocks` VALUES ('49', 'heading', '22', '1', '2018-08-28 07:54:08', '2018-08-28 07:54:08');
INSERT INTO `design_blocks_info_blocks` VALUES ('50', 'paragraph 1', '22', '2', '2018-08-28 07:54:08', '2018-08-28 07:54:08');
INSERT INTO `design_blocks_info_blocks` VALUES ('51', 'paragraph 2', '22', '2', '2018-08-28 07:54:08', '2018-08-28 07:54:08');
INSERT INTO `design_blocks_info_blocks` VALUES ('52', 'heading', '24', '1', '2018-08-28 07:55:33', '2018-08-28 07:55:33');
INSERT INTO `design_blocks_info_blocks` VALUES ('61', 'title', '27', '1', '2018-08-28 09:42:27', '2018-08-28 09:42:27');
INSERT INTO `design_blocks_info_blocks` VALUES ('62', 'class', '27', '1', '2018-08-28 09:42:27', '2018-08-28 09:42:27');
INSERT INTO `design_blocks_info_blocks` VALUES ('63', 'thumbnail', '29', '3', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks_info_blocks` VALUES ('64', 'image', '29', '3', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks_info_blocks` VALUES ('65', 'class', '29', '1', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks_info_blocks` VALUES ('66', 'thumbnail title', '29', '1', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks_info_blocks` VALUES ('67', 'thumbnail description', '29', '2', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks_info_blocks` VALUES ('68', 'title', '29', '2', '2018-08-28 09:45:09', '2018-08-28 09:45:09');
INSERT INTO `design_blocks_info_blocks` VALUES ('69', 'heading', '32', '1', '2018-08-28 09:53:07', '2018-08-28 09:53:07');
INSERT INTO `design_blocks_info_blocks` VALUES ('70', 'title', '33', '1', '2018-08-28 11:07:12', '2018-08-28 11:07:12');
INSERT INTO `design_blocks_info_blocks` VALUES ('71', 'heading', '34', '1', '2018-08-28 11:08:13', '2018-08-28 11:08:13');
INSERT INTO `design_blocks_info_blocks` VALUES ('72', 'price', '34', '1', '2018-08-28 11:08:13', '2018-08-28 11:08:13');
INSERT INTO `design_blocks_info_blocks` VALUES ('73', 'action sign', '34', '1', '2018-08-28 11:08:13', '2018-08-28 11:08:13');
INSERT INTO `design_blocks_info_blocks` VALUES ('74', 'action refference', '34', '1', '2018-08-28 11:08:13', '2018-08-28 11:08:13');
INSERT INTO `design_blocks_info_blocks` VALUES ('75', 'heading', '35', '1', '2018-08-28 11:11:58', '2018-08-28 11:11:58');
INSERT INTO `design_blocks_info_blocks` VALUES ('76', 'price', '35', '1', '2018-08-28 11:11:58', '2018-08-28 11:11:58');
INSERT INTO `design_blocks_info_blocks` VALUES ('77', 'action sign', '35', '1', '2018-08-28 11:11:58', '2018-08-28 11:11:58');
INSERT INTO `design_blocks_info_blocks` VALUES ('78', 'action refference', '35', '1', '2018-08-28 11:11:58', '2018-08-28 11:11:58');
INSERT INTO `design_blocks_info_blocks` VALUES ('79', 'heading', '36', '1', '2018-08-28 11:13:26', '2018-08-28 11:13:26');
INSERT INTO `design_blocks_info_blocks` VALUES ('81', 'images', '39', '4', '2018-08-28 11:36:39', '2018-08-28 11:36:39');
INSERT INTO `design_blocks_info_blocks` VALUES ('82', 'text', '40', '2', '2018-08-28 12:04:12', '2018-08-28 12:04:12');
INSERT INTO `design_blocks_info_blocks` VALUES ('84', 'heading', '42', '1', '2018-08-28 12:15:12', '2018-08-28 12:15:12');
INSERT INTO `design_blocks_info_blocks` VALUES ('85', 'image', '42', '3', '2018-08-28 12:15:12', '2018-08-28 12:15:12');
INSERT INTO `design_blocks_info_blocks` VALUES ('86', 'map search query', '43', '1', '2018-08-28 12:32:45', '2018-08-28 12:32:45');
INSERT INTO `design_blocks_info_blocks` VALUES ('87', 'heading', '45', '1', '2018-08-28 12:34:32', '2018-08-28 12:34:32');

-- ----------------------------
-- Table structure for `general_infos`
-- ----------------------------
DROP TABLE IF EXISTS `general_infos`;
CREATE TABLE `general_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `general_infos_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of general_infos
-- ----------------------------
INSERT INTO `general_infos` VALUES ('1', 'Title', 'Sailor', '2018-08-27 11:52:50', '2018-08-27 11:52:50');
INSERT INTO `general_infos` VALUES ('2', 'Phone number 1', '+62 088 999 123', '2018-08-27 11:53:05', '2018-08-27 11:53:05');
INSERT INTO `general_infos` VALUES ('3', 'Phone number 2', '(123) 456-7890', '2018-08-27 11:53:25', '2018-08-27 11:53:25');
INSERT INTO `general_infos` VALUES ('4', 'Phone number 3', '(123) 555-7891', '2018-08-27 11:53:37', '2018-08-27 11:53:37');
INSERT INTO `general_infos` VALUES ('5', 'Address', '<strong>Sailor company Inc</strong><br>Sailor suite room V124, DB 91<br> Someplace 71745 Earth', '2018-08-27 11:54:43', '2018-08-27 11:54:43');
INSERT INTO `general_infos` VALUES ('6', 'Email', 'email@domainname.com', '2018-08-27 12:00:00', '2018-08-27 12:00:00');
INSERT INTO `general_infos` VALUES ('7', 'Facebook', 'https://facebook.com', '2018-08-27 12:01:05', '2018-08-27 12:03:20');
INSERT INTO `general_infos` VALUES ('8', 'Twitter', '#', '2018-08-27 12:01:10', '2018-08-27 12:01:10');
INSERT INTO `general_infos` VALUES ('9', 'Linkedin', '#', '2018-08-27 12:01:20', '2018-08-27 12:01:20');
INSERT INTO `general_infos` VALUES ('10', 'Pinterest', '#', '2018-08-27 12:01:34', '2018-08-27 12:01:34');
INSERT INTO `general_infos` VALUES ('11', 'Google plus', '#', '2018-08-27 12:01:43', '2018-08-27 12:01:43');

-- ----------------------------
-- Table structure for `info_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `info_blocks`;
CREATE TABLE `info_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of info_blocks
-- ----------------------------
INSERT INTO `info_blocks` VALUES ('1', 'text', '2018-08-27 10:04:25', '2018-08-27 10:04:25');
INSERT INTO `info_blocks` VALUES ('2', 'textarea', '2018-08-27 10:04:25', '2018-08-27 10:04:25');
INSERT INTO `info_blocks` VALUES ('3', 'media', '2018-08-27 10:04:25', '2018-08-27 10:04:25');
INSERT INTO `info_blocks` VALUES ('4', 'media_area', '2018-08-27 10:04:25', '2018-08-27 10:04:25');

-- ----------------------------
-- Table structure for `locales`
-- ----------------------------
DROP TABLE IF EXISTS `locales`;
CREATE TABLE `locales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of locales
-- ----------------------------
INSERT INTO `locales` VALUES ('1', 'English', 'en', '2018-08-27 10:04:25', '2018-08-27 10:04:25');
INSERT INTO `locales` VALUES ('2', 'Russian', 'ru', '2018-08-27 10:05:37', '2018-08-27 10:05:37');

-- ----------------------------
-- Table structure for `menu_items`
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `parent_menu` int(10) unsigned DEFAULT NULL,
  `page_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_items_title_unique` (`title`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  KEY `menu_items_parent_menu_foreign` (`parent_menu`),
  KEY `menu_items_page_id_foreign` (`page_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `menu_items_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `menu_items_parent_menu_foreign` FOREIGN KEY (`parent_menu`) REFERENCES `menu_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu_items
-- ----------------------------
INSERT INTO `menu_items` VALUES ('1', 'Home', '1', '1', null, '1', '2018-08-28 12:40:46', '2018-08-28 12:40:46');
INSERT INTO `menu_items` VALUES ('2', 'Features', '2', '1', null, null, '2018-08-28 12:49:05', '2018-08-28 12:50:29');
INSERT INTO `menu_items` VALUES ('3', 'Portfolio', '3', '1', null, '3', '2018-08-28 12:53:24', '2018-08-28 12:53:24');
INSERT INTO `menu_items` VALUES ('4', 'Contact', '4', '1', null, '4', '2018-08-28 12:54:06', '2018-08-28 12:54:06');
INSERT INTO `menu_items` VALUES ('5', 'Page', '1', '1', '2', '2', '2018-08-28 12:54:23', '2018-08-28 12:54:23');
INSERT INTO `menu_items` VALUES ('6', 'Pages', '2', '1', '2', null, '2018-08-28 12:54:54', '2018-08-28 12:54:54');
INSERT INTO `menu_items` VALUES ('7', 'Sub page', '1', '1', '6', null, '2018-08-28 12:55:19', '2018-08-28 12:55:19');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'top menu', '2018-08-28 12:40:28', '2018-08-28 12:40:28');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_06_01_000001_create_oauth_auth_codes_table', '1');
INSERT INTO `migrations` VALUES ('4', '2016_06_01_000002_create_oauth_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1');
INSERT INTO `migrations` VALUES ('6', '2016_06_01_000004_create_oauth_clients_table', '1');
INSERT INTO `migrations` VALUES ('7', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1');
INSERT INTO `migrations` VALUES ('8', '2018_08_01_085336_create_info_blocks_table', '1');
INSERT INTO `migrations` VALUES ('9', '2018_08_01_085405_create_design_blocks_table', '1');
INSERT INTO `migrations` VALUES ('10', '2018_08_01_085408_create_seos_table', '1');
INSERT INTO `migrations` VALUES ('11', '2018_08_01_085409_create_page_templates_table', '1');
INSERT INTO `migrations` VALUES ('12', '2018_08_01_085434_create_pages_table', '1');
INSERT INTO `migrations` VALUES ('13', '2018_08_01_125047_create_general_infos_table', '1');
INSERT INTO `migrations` VALUES ('14', '2018_08_02_001100_create_widgets_table', '1');
INSERT INTO `migrations` VALUES ('15', '2018_08_03_081057_create_pages_design_blocks_table', '1');
INSERT INTO `migrations` VALUES ('16', '2018_08_06_062730_create_design_blocks_info_blocks_table', '1');
INSERT INTO `migrations` VALUES ('17', '2018_08_06_101130_create_widgets_design_blocks_table', '1');
INSERT INTO `migrations` VALUES ('18', '2018_08_06_101136_create_widgets_blocks_contents_table', '1');
INSERT INTO `migrations` VALUES ('19', '2018_08_06_101244_create_pages_blocks_contents_table', '1');
INSERT INTO `migrations` VALUES ('20', '2018_08_14_065055_create_locales_table', '1');
INSERT INTO `migrations` VALUES ('21', '2018_08_14_065439_create_pages_blocks_locale_contents_table', '1');
INSERT INTO `migrations` VALUES ('22', '2018_08_14_065513_create_widgets_blocks_locale_contents_table', '1');
INSERT INTO `migrations` VALUES ('23', '2018_08_23_055005_create_menus_table', '1');
INSERT INTO `migrations` VALUES ('24', '2018_08_23_055013_create_menu_items_table', '1');
INSERT INTO `migrations` VALUES ('25', '2018_08_23_085554_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('26', '2018_08_27_090904_create_defaults_table', '1');

-- ----------------------------
-- Table structure for `oauth_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `oauth_auth_codes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for `oauth_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------

-- ----------------------------
-- Table structure for `oauth_personal_access_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------

-- ----------------------------
-- Table structure for `oauth_refresh_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `page_templates`
-- ----------------------------
DROP TABLE IF EXISTS `page_templates`;
CREATE TABLE `page_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_templates_title_unique` (`title`),
  UNIQUE KEY `page_templates_view_unique` (`view`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of page_templates
-- ----------------------------
INSERT INTO `page_templates` VALUES ('1', 'main', 'layouts.frontend.main', '2018-08-27 13:06:49', '2018-08-27 13:06:49');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `seo_id` int(10) unsigned NOT NULL,
  `page_template_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_title_unique` (`title`),
  UNIQUE KEY `pages_url_unique` (`url`),
  KEY `pages_seo_id_foreign` (`seo_id`),
  KEY `pages_page_template_id_foreign` (`page_template_id`),
  CONSTRAINT `pages_page_template_id_foreign` FOREIGN KEY (`page_template_id`) REFERENCES `page_templates` (`id`),
  CONSTRAINT `pages_seo_id_foreign` FOREIGN KEY (`seo_id`) REFERENCES `seos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Home', 'home', '1', '1', '1', '2018-08-27 13:07:54', '2018-08-29 10:21:48');
INSERT INTO `pages` VALUES ('2', 'Page', 'features/page', '1', '2', '1', '2018-08-28 11:58:48', '2018-08-29 10:13:19');
INSERT INTO `pages` VALUES ('3', 'Portfolio', 'portfolio', '1', '3', '1', '2018-08-28 12:19:16', '2018-08-29 10:13:13');
INSERT INTO `pages` VALUES ('4', 'Contact', 'contact', '1', '4', '1', '2018-08-28 12:21:53', '2018-08-29 10:13:07');

-- ----------------------------
-- Table structure for `pages_blocks_contents`
-- ----------------------------
DROP TABLE IF EXISTS `pages_blocks_contents`;
CREATE TABLE `pages_blocks_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `design_blocks_info_block_id` int(10) unsigned NOT NULL,
  `pages_design_block_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_blocks_contents_design_blocks_info_block_id_foreign` (`design_blocks_info_block_id`),
  KEY `pages_blocks_contents_pages_design_block_id_foreign` (`pages_design_block_id`),
  CONSTRAINT `pages_blocks_contents_design_blocks_info_block_id_foreign` FOREIGN KEY (`design_blocks_info_block_id`) REFERENCES `design_blocks_info_blocks` (`id`),
  CONSTRAINT `pages_blocks_contents_pages_design_block_id_foreign` FOREIGN KEY (`pages_design_block_id`) REFERENCES `pages_design_blocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pages_blocks_contents
-- ----------------------------
INSERT INTO `pages_blocks_contents` VALUES ('1', '1', '2', '2018-08-27 13:10:52', '2018-08-27 13:10:52');
INSERT INTO `pages_blocks_contents` VALUES ('2', '2', '2', '2018-08-27 13:10:52', '2018-08-27 13:10:52');
INSERT INTO `pages_blocks_contents` VALUES ('3', '3', '2', '2018-08-27 13:10:52', '2018-08-27 13:10:52');
INSERT INTO `pages_blocks_contents` VALUES ('4', '4', '2', '2018-08-27 13:10:52', '2018-08-27 13:10:52');
INSERT INTO `pages_blocks_contents` VALUES ('5', '5', '2', '2018-08-27 13:10:52', '2018-08-27 13:10:52');
INSERT INTO `pages_blocks_contents` VALUES ('6', '1', '3', '2018-08-27 13:11:00', '2018-08-27 13:11:00');
INSERT INTO `pages_blocks_contents` VALUES ('7', '2', '3', '2018-08-27 13:11:00', '2018-08-27 13:11:00');
INSERT INTO `pages_blocks_contents` VALUES ('8', '3', '3', '2018-08-27 13:11:00', '2018-08-27 13:11:00');
INSERT INTO `pages_blocks_contents` VALUES ('9', '4', '3', '2018-08-27 13:11:00', '2018-08-27 13:11:00');
INSERT INTO `pages_blocks_contents` VALUES ('10', '5', '3', '2018-08-27 13:11:00', '2018-08-27 13:11:00');
INSERT INTO `pages_blocks_contents` VALUES ('11', '1', '4', '2018-08-27 13:11:06', '2018-08-27 13:11:06');
INSERT INTO `pages_blocks_contents` VALUES ('12', '2', '4', '2018-08-27 13:11:06', '2018-08-27 13:11:06');
INSERT INTO `pages_blocks_contents` VALUES ('13', '3', '4', '2018-08-27 13:11:06', '2018-08-27 13:11:06');
INSERT INTO `pages_blocks_contents` VALUES ('14', '4', '4', '2018-08-27 13:11:06', '2018-08-27 13:11:06');
INSERT INTO `pages_blocks_contents` VALUES ('15', '5', '4', '2018-08-27 13:11:06', '2018-08-27 13:11:06');
INSERT INTO `pages_blocks_contents` VALUES ('16', '6', '5', '2018-08-28 05:56:43', '2018-08-28 05:56:43');
INSERT INTO `pages_blocks_contents` VALUES ('17', '7', '5', '2018-08-28 05:56:44', '2018-08-28 05:56:44');
INSERT INTO `pages_blocks_contents` VALUES ('18', '8', '5', '2018-08-28 05:56:44', '2018-08-28 05:56:44');
INSERT INTO `pages_blocks_contents` VALUES ('19', '9', '5', '2018-08-28 05:56:44', '2018-08-28 05:56:44');
INSERT INTO `pages_blocks_contents` VALUES ('20', '12', '6', '2018-08-28 06:06:31', '2018-08-28 06:06:31');
INSERT INTO `pages_blocks_contents` VALUES ('21', '13', '6', '2018-08-28 06:06:31', '2018-08-28 06:06:31');
INSERT INTO `pages_blocks_contents` VALUES ('22', '10', '7', '2018-08-28 06:06:31', '2018-08-28 06:06:31');
INSERT INTO `pages_blocks_contents` VALUES ('23', '11', '7', '2018-08-28 06:06:31', '2018-08-28 06:06:31');
INSERT INTO `pages_blocks_contents` VALUES ('24', '10', '8', '2018-08-28 06:07:51', '2018-08-28 06:07:51');
INSERT INTO `pages_blocks_contents` VALUES ('25', '11', '8', '2018-08-28 06:07:51', '2018-08-28 06:07:51');
INSERT INTO `pages_blocks_contents` VALUES ('26', '10', '9', '2018-08-28 06:07:59', '2018-08-28 06:07:59');
INSERT INTO `pages_blocks_contents` VALUES ('27', '11', '9', '2018-08-28 06:07:59', '2018-08-28 06:07:59');
INSERT INTO `pages_blocks_contents` VALUES ('28', '10', '10', '2018-08-28 06:08:09', '2018-08-28 06:08:09');
INSERT INTO `pages_blocks_contents` VALUES ('29', '11', '10', '2018-08-28 06:08:09', '2018-08-28 06:08:09');
INSERT INTO `pages_blocks_contents` VALUES ('30', '22', '12', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('31', '23', '12', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('32', '24', '12', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('33', '25', '12', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('34', '14', '13', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('35', '15', '13', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('36', '16', '14', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('37', '17', '14', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('38', '18', '15', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('39', '19', '15', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('40', '20', '16', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('41', '21', '16', '2018-08-28 06:55:29', '2018-08-28 06:55:29');
INSERT INTO `pages_blocks_contents` VALUES ('42', '29', '18', '2018-08-28 07:09:31', '2018-08-28 07:09:31');
INSERT INTO `pages_blocks_contents` VALUES ('43', '26', '19', '2018-08-28 07:09:31', '2018-08-28 07:09:31');
INSERT INTO `pages_blocks_contents` VALUES ('44', '27', '19', '2018-08-28 07:09:31', '2018-08-28 07:09:31');
INSERT INTO `pages_blocks_contents` VALUES ('45', '28', '19', '2018-08-28 07:09:31', '2018-08-28 07:09:31');
INSERT INTO `pages_blocks_contents` VALUES ('46', '26', '20', '2018-08-28 07:29:55', '2018-08-28 07:29:55');
INSERT INTO `pages_blocks_contents` VALUES ('47', '27', '20', '2018-08-28 07:29:55', '2018-08-28 07:29:55');
INSERT INTO `pages_blocks_contents` VALUES ('48', '28', '20', '2018-08-28 07:29:55', '2018-08-28 07:29:55');
INSERT INTO `pages_blocks_contents` VALUES ('49', '26', '21', '2018-08-28 07:30:11', '2018-08-28 07:30:11');
INSERT INTO `pages_blocks_contents` VALUES ('50', '27', '21', '2018-08-28 07:30:11', '2018-08-28 07:30:11');
INSERT INTO `pages_blocks_contents` VALUES ('51', '28', '21', '2018-08-28 07:30:12', '2018-08-28 07:30:12');
INSERT INTO `pages_blocks_contents` VALUES ('52', '26', '22', '2018-08-28 07:30:33', '2018-08-28 07:30:33');
INSERT INTO `pages_blocks_contents` VALUES ('53', '27', '22', '2018-08-28 07:30:33', '2018-08-28 07:30:33');
INSERT INTO `pages_blocks_contents` VALUES ('54', '28', '22', '2018-08-28 07:30:33', '2018-08-28 07:30:33');
INSERT INTO `pages_blocks_contents` VALUES ('55', '52', '23', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('56', '30', '25', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('57', '31', '25', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('58', '32', '25', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('59', '41', '27', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('60', '42', '27', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('61', '43', '27', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('62', '44', '27', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('63', '45', '28', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('64', '46', '28', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('65', '47', '28', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('66', '48', '28', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('67', '49', '29', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('68', '50', '29', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('69', '51', '29', '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_blocks_contents` VALUES ('70', '30', '30', '2018-08-28 07:56:05', '2018-08-28 07:56:05');
INSERT INTO `pages_blocks_contents` VALUES ('71', '31', '30', '2018-08-28 07:56:05', '2018-08-28 07:56:05');
INSERT INTO `pages_blocks_contents` VALUES ('72', '32', '30', '2018-08-28 07:56:05', '2018-08-28 07:56:05');
INSERT INTO `pages_blocks_contents` VALUES ('73', '79', '34', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('74', '71', '35', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('75', '72', '35', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('76', '73', '35', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('77', '74', '35', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('78', '70', '36', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('79', '75', '37', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('80', '76', '37', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('81', '77', '37', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('82', '78', '37', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('83', '70', '38', '2018-08-28 11:13:38', '2018-08-28 11:13:38');
INSERT INTO `pages_blocks_contents` VALUES ('84', '71', '39', '2018-08-28 11:14:07', '2018-08-28 11:14:07');
INSERT INTO `pages_blocks_contents` VALUES ('85', '72', '39', '2018-08-28 11:14:07', '2018-08-28 11:14:07');
INSERT INTO `pages_blocks_contents` VALUES ('86', '73', '39', '2018-08-28 11:14:07', '2018-08-28 11:14:07');
INSERT INTO `pages_blocks_contents` VALUES ('87', '74', '39', '2018-08-28 11:14:07', '2018-08-28 11:14:07');
INSERT INTO `pages_blocks_contents` VALUES ('88', '70', '40', '2018-08-28 11:14:07', '2018-08-28 11:14:07');
INSERT INTO `pages_blocks_contents` VALUES ('89', '71', '41', '2018-08-28 11:14:19', '2018-08-28 11:14:19');
INSERT INTO `pages_blocks_contents` VALUES ('90', '72', '41', '2018-08-28 11:14:19', '2018-08-28 11:14:19');
INSERT INTO `pages_blocks_contents` VALUES ('91', '73', '41', '2018-08-28 11:14:19', '2018-08-28 11:14:19');
INSERT INTO `pages_blocks_contents` VALUES ('92', '74', '41', '2018-08-28 11:14:19', '2018-08-28 11:14:19');
INSERT INTO `pages_blocks_contents` VALUES ('93', '70', '42', '2018-08-28 11:14:19', '2018-08-28 11:14:19');
INSERT INTO `pages_blocks_contents` VALUES ('94', '70', '43', '2018-08-28 11:18:08', '2018-08-28 11:18:08');
INSERT INTO `pages_blocks_contents` VALUES ('95', '70', '44', '2018-08-28 11:18:16', '2018-08-28 11:18:16');
INSERT INTO `pages_blocks_contents` VALUES ('96', '70', '45', '2018-08-28 11:18:25', '2018-08-28 11:18:25');
INSERT INTO `pages_blocks_contents` VALUES ('97', '70', '46', '2018-08-28 11:18:36', '2018-08-28 11:18:36');
INSERT INTO `pages_blocks_contents` VALUES ('98', '70', '47', '2018-08-28 11:19:01', '2018-08-28 11:19:01');
INSERT INTO `pages_blocks_contents` VALUES ('99', '70', '48', '2018-08-28 11:19:15', '2018-08-28 11:19:15');
INSERT INTO `pages_blocks_contents` VALUES ('100', '70', '49', '2018-08-28 11:19:24', '2018-08-28 11:19:24');
INSERT INTO `pages_blocks_contents` VALUES ('101', '70', '50', '2018-08-28 11:19:36', '2018-08-28 11:19:36');
INSERT INTO `pages_blocks_contents` VALUES ('102', '70', '51', '2018-08-28 11:19:46', '2018-08-28 11:19:46');
INSERT INTO `pages_blocks_contents` VALUES ('103', '70', '52', '2018-08-28 11:19:56', '2018-08-28 11:19:56');
INSERT INTO `pages_blocks_contents` VALUES ('104', '70', '53', '2018-08-28 11:20:05', '2018-08-28 11:20:05');
INSERT INTO `pages_blocks_contents` VALUES ('105', '70', '54', '2018-08-28 11:20:15', '2018-08-28 11:20:15');
INSERT INTO `pages_blocks_contents` VALUES ('106', '70', '55', '2018-08-28 11:20:26', '2018-08-28 11:20:26');
INSERT INTO `pages_blocks_contents` VALUES ('107', '70', '56', '2018-08-28 11:20:36', '2018-08-28 11:20:36');
INSERT INTO `pages_blocks_contents` VALUES ('108', '70', '57', '2018-08-28 11:20:56', '2018-08-28 11:20:56');
INSERT INTO `pages_blocks_contents` VALUES ('109', '70', '58', '2018-08-28 11:21:05', '2018-08-28 11:21:05');
INSERT INTO `pages_blocks_contents` VALUES ('111', '81', '61', '2018-08-28 11:36:59', '2018-08-28 11:36:59');
INSERT INTO `pages_blocks_contents` VALUES ('116', '84', '66', '2018-08-28 12:15:21', '2018-08-28 12:15:21');
INSERT INTO `pages_blocks_contents` VALUES ('117', '85', '66', '2018-08-28 12:15:21', '2018-08-28 12:15:21');
INSERT INTO `pages_blocks_contents` VALUES ('118', '82', '67', '2018-08-28 12:15:21', '2018-08-28 12:15:21');
INSERT INTO `pages_blocks_contents` VALUES ('119', '82', '68', '2018-08-28 12:15:43', '2018-08-28 12:15:43');
INSERT INTO `pages_blocks_contents` VALUES ('120', '82', '69', '2018-08-28 12:15:51', '2018-08-28 12:15:51');
INSERT INTO `pages_blocks_contents` VALUES ('121', '86', '72', '2018-08-28 12:35:16', '2018-08-28 12:35:16');
INSERT INTO `pages_blocks_contents` VALUES ('122', '87', '73', '2018-08-28 12:35:16', '2018-08-28 12:35:16');

-- ----------------------------
-- Table structure for `pages_blocks_locale_contents`
-- ----------------------------
DROP TABLE IF EXISTS `pages_blocks_locale_contents`;
CREATE TABLE `pages_blocks_locale_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages_blocks_content_id` int(10) unsigned NOT NULL,
  `locale_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_blocks_locale_contents_pages_blocks_content_id_foreign` (`pages_blocks_content_id`),
  KEY `pages_blocks_locale_contents_locale_id_foreign` (`locale_id`),
  CONSTRAINT `pages_blocks_locale_contents_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`),
  CONSTRAINT `pages_blocks_locale_contents_pages_blocks_content_id_foreign` FOREIGN KEY (`pages_blocks_content_id`) REFERENCES `pages_blocks_contents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=489 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pages_blocks_locale_contents
-- ----------------------------
INSERT INTO `pages_blocks_locale_contents` VALUES ('1', 'a:3:{s:4:\"name\";s:5:\"1.jpg\";s:3:\"alt\";s:1:\"1\";s:4:\"path\";s:20:\"/storage/media/1.jpg\";}', '1', '1', '2018-08-27 13:10:52', '2018-08-27 14:09:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('2', 'a:3:{s:4:\"name\";s:5:\"1.jpg\";s:3:\"alt\";N;s:4:\"path\";s:20:\"/storage/media/1.jpg\";}', '1', '2', '2018-08-27 13:10:52', '2018-08-29 06:50:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('5', 'Modern Design', '2', '1', '2018-08-27 13:10:52', '2018-08-27 14:09:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('6', 'Modern Design', '2', '2', '2018-08-27 13:10:52', '2018-08-29 06:50:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('9', 'Duis fermentum auctor ligula ac malesuada. Mauris et metus odio, in pulvinar urna', '3', '1', '2018-08-27 13:10:52', '2018-08-27 14:09:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('10', 'Duis fermentum auctor ligula ac malesuada. Mauris et metus odio, in pulvinar urna', '3', '2', '2018-08-27 13:10:52', '2018-08-29 06:50:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('13', 'Learn More', '4', '1', '2018-08-27 13:10:52', '2018-08-27 14:09:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('14', '#', '4', '2', '2018-08-27 13:10:52', '2018-08-29 06:50:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('17', '#', '5', '1', '2018-08-27 13:10:52', '2018-08-27 14:09:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('18', 'Learn More', '5', '2', '2018-08-27 13:10:52', '2018-08-29 06:50:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('21', 'a:3:{s:4:\"name\";s:5:\"2.jpg\";s:3:\"alt\";s:1:\"2\";s:4:\"path\";s:20:\"/storage/media/2.jpg\";}', '6', '1', '2018-08-27 13:11:00', '2018-08-27 14:09:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('22', 'a:3:{s:4:\"name\";s:5:\"2.jpg\";s:3:\"alt\";N;s:4:\"path\";s:20:\"/storage/media/2.jpg\";}', '6', '2', '2018-08-27 13:11:00', '2018-08-29 06:51:11');
INSERT INTO `pages_blocks_locale_contents` VALUES ('25', 'Fully Responsive', '7', '1', '2018-08-27 13:11:00', '2018-08-27 14:09:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('26', 'Fully Responsive', '7', '2', '2018-08-27 13:11:00', '2018-08-29 06:51:11');
INSERT INTO `pages_blocks_locale_contents` VALUES ('29', 'Sodales neque vitae justo sollicitudin aliquet sit amet diam curabitur sed fermentum.', '8', '1', '2018-08-27 13:11:00', '2018-08-27 14:09:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('30', 'Sodales neque vitae justo sollicitudin aliquet sit amet diam curabitur sed fermentum.', '8', '2', '2018-08-27 13:11:00', '2018-08-29 06:51:11');
INSERT INTO `pages_blocks_locale_contents` VALUES ('33', 'Learn More', '9', '1', '2018-08-27 13:11:00', '2018-08-27 14:09:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('34', '#', '9', '2', '2018-08-27 13:11:00', '2018-08-29 06:51:11');
INSERT INTO `pages_blocks_locale_contents` VALUES ('37', '#', '10', '1', '2018-08-27 13:11:00', '2018-08-27 14:09:35');
INSERT INTO `pages_blocks_locale_contents` VALUES ('38', 'Learn More', '10', '2', '2018-08-27 13:11:00', '2018-08-29 06:51:11');
INSERT INTO `pages_blocks_locale_contents` VALUES ('41', 'a:3:{s:4:\"name\";s:5:\"3.jpg\";s:3:\"alt\";s:1:\"3\";s:4:\"path\";s:20:\"/storage/media/3.jpg\";}', '11', '1', '2018-08-27 13:11:06', '2018-08-27 14:09:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('42', 'a:3:{s:4:\"name\";s:5:\"3.jpg\";s:3:\"alt\";N;s:4:\"path\";s:20:\"/storage/media/3.jpg\";}', '11', '2', '2018-08-27 13:11:06', '2018-08-29 07:15:42');
INSERT INTO `pages_blocks_locale_contents` VALUES ('45', 'Clean & Fast', '12', '1', '2018-08-27 13:11:06', '2018-08-27 14:09:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('46', 'Clean & Fast', '12', '2', '2018-08-27 13:11:06', '2018-08-29 07:15:42');
INSERT INTO `pages_blocks_locale_contents` VALUES ('49', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit donec mer lacinia.', '13', '1', '2018-08-27 13:11:06', '2018-08-27 14:09:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit donec mer lacinia.', '13', '2', '2018-08-27 13:11:06', '2018-08-29 07:15:42');
INSERT INTO `pages_blocks_locale_contents` VALUES ('53', 'Learn More', '14', '1', '2018-08-27 13:11:06', '2018-08-27 14:09:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('54', '#', '14', '2', '2018-08-27 13:11:06', '2018-08-29 07:15:42');
INSERT INTO `pages_blocks_locale_contents` VALUES ('57', '#', '15', '1', '2018-08-27 13:11:06', '2018-08-27 14:09:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('58', 'Learn More', '15', '2', '2018-08-27 13:11:06', '2018-08-29 07:15:42');
INSERT INTO `pages_blocks_locale_contents` VALUES ('61', 'Awesome site template <span>corporate</span> business', '16', '1', '2018-08-28 05:56:43', '2018-08-28 05:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('62', 'Awesome site template <span>corporate</span> business', '16', '2', '2018-08-28 05:56:44', '2018-08-29 06:52:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('65', 'Etiam adipiscing, justo quis feugiat.Suspendisse eu erat quam. Vivamus porttitor eros qui nisi lacinia sed interdum', '17', '1', '2018-08-28 05:56:44', '2018-08-28 05:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('66', 'Etiam adipiscing, justo quis feugiat.Suspendisse eu erat quam. Vivamus porttitor eros quis nisi lacinia sed interdum', '17', '2', '2018-08-28 05:56:44', '2018-08-29 06:52:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('69', '#', '18', '1', '2018-08-28 05:56:44', '2018-08-28 05:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('70', '#', '18', '2', '2018-08-28 05:56:44', '2018-08-29 06:52:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('73', 'Grab it now', '19', '1', '2018-08-28 05:56:44', '2018-08-28 05:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('74', 'Grab it now', '19', '2', '2018-08-28 05:56:44', '2018-08-29 06:52:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('77', 'We use <span class=\"highlight\">modern</span> infrastructure & technology', '20', '1', '2018-08-28 06:06:31', '2018-08-28 06:07:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('78', 'We use <span class=\"highlight\">modern</span> infrastructure & technology', '20', '2', '2018-08-28 06:06:31', '2018-08-29 06:52:44');
INSERT INTO `pages_blocks_locale_contents` VALUES ('81', 'Lorem ipsum dolor sit amet, ne duis posse mei, ut cum vero nominati. Sed graece aeterno consectetuer te. Cu duo tota deleniti, vis ea fuisset nostrum. Meliore inciderint qui ne. Suas cotidieque vel ut ei eros perpetua qui. Ponderum lobortis reformidans', '21', '1', '2018-08-28 06:06:31', '2018-08-28 06:07:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('82', 'Lorem ipsum dolor sit amet, ne duis posse mei, ut cum vero nominati. Sed graece aeterno consectetuer te. Cu duo tota deleniti, vis ea fuisset nostrum. Meliore inciderint qui ne. Suas cotidieque vel ut  ei eros perpetua qui. Ponderum lobortis reformidans', '21', '2', '2018-08-28 06:06:31', '2018-08-29 06:52:44');
INSERT INTO `pages_blocks_locale_contents` VALUES ('85', 'desktop', '22', '1', '2018-08-28 06:06:31', '2018-08-28 06:07:48');
INSERT INTO `pages_blocks_locale_contents` VALUES ('86', 'fa-desktop', '22', '2', '2018-08-28 06:06:31', '2018-08-29 06:53:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('89', 'Fully responsive', '23', '1', '2018-08-28 06:06:31', '2018-08-28 06:07:48');
INSERT INTO `pages_blocks_locale_contents` VALUES ('90', 'Fully responsive', '23', '2', '2018-08-28 06:06:31', '2018-08-29 06:53:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('93', 'file-code-o', '24', '1', '2018-08-28 06:07:51', '2018-08-28 06:08:36');
INSERT INTO `pages_blocks_locale_contents` VALUES ('94', 'file-code-o', '24', '2', '2018-08-28 06:07:51', '2018-08-29 06:53:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('97', 'Fully responsive', '25', '1', '2018-08-28 06:07:51', '2018-08-28 06:08:36');
INSERT INTO `pages_blocks_locale_contents` VALUES ('98', 'Fully responsive', '25', '2', '2018-08-28 06:07:51', '2018-08-29 06:53:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('101', 'paper-plane-o', '26', '1', '2018-08-28 06:07:59', '2018-08-28 06:08:51');
INSERT INTO `pages_blocks_locale_contents` VALUES ('102', 'paper-plane-o', '26', '2', '2018-08-28 06:07:59', '2018-08-29 06:53:32');
INSERT INTO `pages_blocks_locale_contents` VALUES ('105', 'Fully responsive', '27', '1', '2018-08-28 06:07:59', '2018-08-28 06:08:51');
INSERT INTO `pages_blocks_locale_contents` VALUES ('106', 'Fully responsive', '27', '2', '2018-08-28 06:07:59', '2018-08-29 06:53:32');
INSERT INTO `pages_blocks_locale_contents` VALUES ('109', 'cubes', '28', '1', '2018-08-28 06:08:09', '2018-08-28 06:09:05');
INSERT INTO `pages_blocks_locale_contents` VALUES ('110', 'cubes', '28', '2', '2018-08-28 06:08:09', '2018-08-29 06:53:49');
INSERT INTO `pages_blocks_locale_contents` VALUES ('113', 'Fully responsive', '29', '1', '2018-08-28 06:08:09', '2018-08-28 06:09:05');
INSERT INTO `pages_blocks_locale_contents` VALUES ('114', 'Fully responsive', '29', '2', '2018-08-28 06:08:09', '2018-08-29 06:53:49');
INSERT INTO `pages_blocks_locale_contents` VALUES ('117', 'About our company', '30', '1', '2018-08-28 06:55:29', '2018-08-28 06:56:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('118', 'About our company', '30', '2', '2018-08-28 06:55:29', '2018-08-29 06:54:41');
INSERT INTO `pages_blocks_locale_contents` VALUES ('121', 'Meliore inciderint qui ne. Suas cotidieque vel ut lobortis reformidans duo', '31', '1', '2018-08-28 06:55:29', '2018-08-28 06:56:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('122', 'Meliore inciderint qui ne. Suas cotidieque vel ut lobortis reformidans duo', '31', '2', '2018-08-28 06:55:29', '2018-08-29 06:54:41');
INSERT INTO `pages_blocks_locale_contents` VALUES ('125', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae odit iste exercitationem praesentium deleniti nostrum laborum rem id nihil tempora. Adipisci ea commodi unde nam placeat cupiditate quasi a ducimus rem consequuntur ex eligendi minima voluptatem assumenda voluptas quidem sit maiores odio velit voluptate', '32', '1', '2018-08-28 06:55:29', '2018-08-28 06:56:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('126', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae odit iste exercitationem praesentium deleniti nostrum laborum rem id nihil tempora. Adipisci ea commodi unde nam placeat cupiditate quasi a ducimus rem consequuntur ex eligendi minima voluptatem assumenda voluptas quidem sit maiores odio velit voluptate', '32', '2', '2018-08-28 06:55:29', '2018-08-29 06:54:41');
INSERT INTO `pages_blocks_locale_contents` VALUES ('129', 'Mel explicari adipiscing consectetuer no, no mel apeirian scripserit repudiandae, ad assum mundi scribentur eam. Graecis offendit phaedrum eu his, eius ferri quidam eos ad, quis delenit vel ei. Alia modus facete te eos, eu tation appellantur per', '33', '1', '2018-08-28 06:55:29', '2018-08-28 06:56:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('130', 'Mel explicari adipiscing consectetuer no, no mel apeirian scripserit repudiandae, ad assum mundi scribentur eam. Graecis offendit phaedrum eu his, eius ferri quidam eos ad, quis delenit vel ei. Alia modus facete te eos, eu tation appellantur per', '33', '2', '2018-08-28 06:55:29', '2018-08-29 06:54:41');
INSERT INTO `pages_blocks_locale_contents` VALUES ('133', '40', '34', '1', '2018-08-28 06:55:29', '2018-08-28 06:56:59');
INSERT INTO `pages_blocks_locale_contents` VALUES ('134', '40', '34', '2', '2018-08-28 06:55:29', '2018-08-29 06:54:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('137', '40% Complete (success)', '35', '1', '2018-08-28 06:55:29', '2018-08-28 06:56:59');
INSERT INTO `pages_blocks_locale_contents` VALUES ('138', '40% Complete (success)', '35', '2', '2018-08-28 06:55:29', '2018-08-29 06:54:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('141', '20', '36', '1', '2018-08-28 06:55:29', '2018-08-28 06:57:13');
INSERT INTO `pages_blocks_locale_contents` VALUES ('142', '20', '36', '2', '2018-08-28 06:55:29', '2018-08-29 06:55:06');
INSERT INTO `pages_blocks_locale_contents` VALUES ('145', '20% Complete', '37', '1', '2018-08-28 06:55:29', '2018-08-28 06:57:13');
INSERT INTO `pages_blocks_locale_contents` VALUES ('146', '20% Complete', '37', '2', '2018-08-28 06:55:29', '2018-08-29 06:55:06');
INSERT INTO `pages_blocks_locale_contents` VALUES ('149', '60', '38', '1', '2018-08-28 06:55:29', '2018-08-28 06:57:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('150', '60', '38', '2', '2018-08-28 06:55:29', '2018-08-29 06:55:18');
INSERT INTO `pages_blocks_locale_contents` VALUES ('153', '60% Complete (warning)', '39', '1', '2018-08-28 06:55:29', '2018-08-28 06:57:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('154', '60% Complete (warning)', '39', '2', '2018-08-28 06:55:29', '2018-08-29 06:55:18');
INSERT INTO `pages_blocks_locale_contents` VALUES ('157', '80', '40', '1', '2018-08-28 06:55:29', '2018-08-28 06:57:38');
INSERT INTO `pages_blocks_locale_contents` VALUES ('158', '80', '40', '2', '2018-08-28 06:55:29', '2018-08-29 06:55:28');
INSERT INTO `pages_blocks_locale_contents` VALUES ('161', '80% Complete', '41', '1', '2018-08-28 06:55:29', '2018-08-28 06:57:38');
INSERT INTO `pages_blocks_locale_contents` VALUES ('162', '80% Complete', '41', '2', '2018-08-28 06:55:29', '2018-08-29 06:55:28');
INSERT INTO `pages_blocks_locale_contents` VALUES ('165', 'a:3:{s:4:\"name\";s:45:\"7dgDyVL0PTSX0mlmrjl0vZywc8Z3JfZ8Y7gowtBy.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/7dgDyVL0PTSX0mlmrjl0vZywc8Z3JfZ8Y7gowtBy.jpeg\";}', '42', '1', '2018-08-28 07:09:31', '2018-08-28 07:34:32');
INSERT INTO `pages_blocks_locale_contents` VALUES ('166', 'a:3:{s:4:\"name\";s:45:\"7dgDyVL0PTSX0mlmrjl0vZywc8Z3JfZ8Y7gowtBy.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/7dgDyVL0PTSX0mlmrjl0vZywc8Z3JfZ8Y7gowtBy.jpeg\";}', '42', '2', '2018-08-28 07:09:31', '2018-08-29 06:55:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('169', 'clock-o', '43', '1', '2018-08-28 07:09:31', '2018-08-28 07:31:30');
INSERT INTO `pages_blocks_locale_contents` VALUES ('170', 'clock-o', '43', '2', '2018-08-28 07:09:31', '2018-08-29 06:56:00');
INSERT INTO `pages_blocks_locale_contents` VALUES ('173', '1232', '44', '1', '2018-08-28 07:09:31', '2018-08-28 07:31:30');
INSERT INTO `pages_blocks_locale_contents` VALUES ('174', '1232', '44', '2', '2018-08-28 07:09:31', '2018-08-29 06:56:00');
INSERT INTO `pages_blocks_locale_contents` VALUES ('177', 'Minutes', '45', '1', '2018-08-28 07:09:31', '2018-08-28 07:31:30');
INSERT INTO `pages_blocks_locale_contents` VALUES ('178', 'Minutes', '45', '2', '2018-08-28 07:09:31', '2018-08-29 06:56:00');
INSERT INTO `pages_blocks_locale_contents` VALUES ('181', 'music', '46', '1', '2018-08-28 07:29:55', '2018-08-28 07:31:48');
INSERT INTO `pages_blocks_locale_contents` VALUES ('182', 'music', '46', '2', '2018-08-28 07:29:55', '2018-08-29 06:56:20');
INSERT INTO `pages_blocks_locale_contents` VALUES ('185', '345', '47', '1', '2018-08-28 07:29:55', '2018-08-28 07:31:48');
INSERT INTO `pages_blocks_locale_contents` VALUES ('186', '345', '47', '2', '2018-08-28 07:29:55', '2018-08-29 06:56:20');
INSERT INTO `pages_blocks_locale_contents` VALUES ('189', 'MP3 Songs', '48', '1', '2018-08-28 07:29:55', '2018-08-28 07:31:48');
INSERT INTO `pages_blocks_locale_contents` VALUES ('190', 'MP3 Songs', '48', '2', '2018-08-28 07:29:55', '2018-08-29 06:56:20');
INSERT INTO `pages_blocks_locale_contents` VALUES ('193', 'coffee', '49', '1', '2018-08-28 07:30:11', '2018-08-28 07:32:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('194', 'coffee', '49', '2', '2018-08-28 07:30:11', '2018-08-29 06:56:37');
INSERT INTO `pages_blocks_locale_contents` VALUES ('197', '501', '50', '1', '2018-08-28 07:30:12', '2018-08-28 07:32:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('198', '501', '50', '2', '2018-08-28 07:30:12', '2018-08-29 06:56:37');
INSERT INTO `pages_blocks_locale_contents` VALUES ('201', 'Coffee Cups', '51', '1', '2018-08-28 07:30:12', '2018-08-28 07:32:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('202', 'Coffee Cups', '51', '2', '2018-08-28 07:30:12', '2018-08-29 06:56:37');
INSERT INTO `pages_blocks_locale_contents` VALUES ('205', 'trophy', '52', '1', '2018-08-28 07:30:33', '2018-08-28 07:32:26');
INSERT INTO `pages_blocks_locale_contents` VALUES ('206', 'trophy', '52', '2', '2018-08-28 07:30:33', '2018-08-29 06:56:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('209', '378', '53', '1', '2018-08-28 07:30:33', '2018-08-28 07:32:26');
INSERT INTO `pages_blocks_locale_contents` VALUES ('210', '378', '53', '2', '2018-08-28 07:30:33', '2018-08-29 06:56:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('213', 'Awwards', '54', '1', '2018-08-28 07:30:33', '2018-08-28 07:32:26');
INSERT INTO `pages_blocks_locale_contents` VALUES ('214', 'Awwards', '54', '2', '2018-08-28 07:30:33', '2018-08-29 06:56:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('217', 'Testimonials', '55', '1', '2018-08-28 07:55:46', '2018-08-28 07:55:58');
INSERT INTO `pages_blocks_locale_contents` VALUES ('218', 'Testimonials', '55', '2', '2018-08-28 07:55:46', '2018-08-29 06:57:04');
INSERT INTO `pages_blocks_locale_contents` VALUES ('221', 'Usu ei porro deleniti similique, per no consetetur necessitatibus. Ut sed augue docendi alienum, ex oblique scaevola inciderint pri, unum movet cu cum. Et cum impedit epicuri', '56', '1', '2018-08-28 07:55:46', '2018-08-28 07:56:45');
INSERT INTO `pages_blocks_locale_contents` VALUES ('222', 'Usu ei porro deleniti similique, per no consetetur necessitatibus. Ut sed augue docendi alienum, ex oblique scaevola inciderint pri, unum movet cu cum. Et cum impedit epicuri', '56', '2', '2018-08-28 07:55:46', '2018-08-29 06:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('225', 'Daniel Dan', '57', '1', '2018-08-28 07:55:46', '2018-08-28 07:56:45');
INSERT INTO `pages_blocks_locale_contents` VALUES ('226', 'Daniel Dan', '57', '2', '2018-08-28 07:55:46', '2018-08-29 06:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('229', 'MA System', '58', '1', '2018-08-28 07:55:46', '2018-08-28 07:56:45');
INSERT INTO `pages_blocks_locale_contents` VALUES ('230', 'MA System', '58', '2', '2018-08-28 07:55:46', '2018-08-29 06:57:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('233', 'One', '59', '1', '2018-08-28 07:55:46', '2018-08-28 07:58:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('234', 'One', '59', '2', '2018-08-28 07:55:46', '2018-08-29 06:58:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('237', 'a:3:{s:4:\"name\";s:10:\"dummy1.jpg\";s:3:\"alt\";N;s:4:\"path\";s:25:\"/storage/media/dummy1.jpg\";}', '60', '1', '2018-08-28 07:55:46', '2018-08-28 07:58:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('238', 'a:3:{s:4:\"name\";s:10:\"dummy1.jpg\";s:3:\"alt\";N;s:4:\"path\";s:25:\"/storage/media/dummy1.jpg\";}', '60', '2', '2018-08-28 07:55:46', '2018-08-29 06:58:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('241', '<strong>Augue iriure</strong> dolorum per ex, ne iisque ornatus veritus duo. Ex nobis integre lucilius sit, pri ea falli ludus appareat. Eum quodsi fuisset id, nostro patrioque qui id. Nominati eloquentiam in mea.', '61', '1', '2018-08-28 07:55:46', '2018-08-28 07:58:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('242', '<strong>Augue iriure</strong> dolorum per ex, ne iisque ornatus veritus duo. Ex nobis integre lucilius sit, pri ea falli ludus appareat. Eum quodsi fuisset id, nostro patrioque qui id. Nominati eloquentiam in mea.', '61', '2', '2018-08-28 07:55:46', '2018-08-29 06:58:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('245', 'No eum sanctus vituperata reformidans, dicant abhorreant ut pro. Duo id enim iisque praesent, amet intellegat per et, solet referrentur eum et.', '62', '1', '2018-08-28 07:55:46', '2018-08-28 07:58:10');
INSERT INTO `pages_blocks_locale_contents` VALUES ('246', 'No eum sanctus vituperata reformidans, dicant abhorreant ut pro. Duo id enim iisque praesent, amet intellegat per et, solet referrentur eum et.', '62', '2', '2018-08-28 07:55:46', '2018-08-29 06:58:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('249', 'Two', '63', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:03');
INSERT INTO `pages_blocks_locale_contents` VALUES ('250', 'Two', '63', '2', '2018-08-28 07:55:46', '2018-08-29 07:32:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('253', 'a:3:{s:4:\"name\";s:10:\"dummy1.jpg\";s:3:\"alt\";N;s:4:\"path\";s:25:\"/storage/media/dummy1.jpg\";}', '64', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:03');
INSERT INTO `pages_blocks_locale_contents` VALUES ('254', 'a:3:{s:4:\"name\";s:10:\"dummy1.jpg\";s:3:\"alt\";N;s:4:\"path\";s:25:\"/storage/media/dummy1.jpg\";}', '64', '2', '2018-08-28 07:55:46', '2018-08-29 07:32:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('257', 'Tale dolor mea ex, te enim assum suscipit cum, vix aliquid omittantur in. Duo eu cibo dolorum menandri, nam sumo dicit admodum ei. Ne mazim commune honestatis cum, mentitum phaedrum sit et.', '65', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:03');
INSERT INTO `pages_blocks_locale_contents` VALUES ('258', 'Tale dolor mea ex, te enim assum suscipit cum, vix aliquid omittantur in. Duo eu cibo dolorum menandri, nam sumo dicit admodum ei. Ne mazim commune honestatis cum, mentitum phaedrum sit et.', '65', '2', '2018-08-28 07:55:46', '2018-08-29 07:32:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('261', 'Lorem ipsum dolor sit amet, vel laoreet pertinacia at, nam ea ornatus ocurreret gubergren. Per facete graecis eu.', '66', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:03');
INSERT INTO `pages_blocks_locale_contents` VALUES ('262', 'Lorem ipsum dolor sit amet, vel laoreet pertinacia at, nam ea ornatus ocurreret gubergren. Per facete graecis eu.', '66', '2', '2018-08-28 07:55:46', '2018-08-29 07:32:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('265', 'Three', '67', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:36');
INSERT INTO `pages_blocks_locale_contents` VALUES ('266', 'Three', '67', '2', '2018-08-28 07:55:46', '2018-08-29 06:59:58');
INSERT INTO `pages_blocks_locale_contents` VALUES ('269', 'Lorem ipsum dolor sit amet, vel laoreet pertinacia at, nam ea ornatus ocurreret gubergren. Per facete graecis eu.', '68', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:36');
INSERT INTO `pages_blocks_locale_contents` VALUES ('270', 'Lorem ipsum dolor sit amet, vel laoreet pertinacia at, nam ea ornatus ocurreret gubergren. Per facete graecis eu.', '68', '2', '2018-08-28 07:55:46', '2018-08-29 06:59:58');
INSERT INTO `pages_blocks_locale_contents` VALUES ('273', 'Cu cum commodo regione definiebas. Cum ea eros laboramus, audire deseruisse his at, munere aeterno ut quo. Et ius doming causae philosophia, vitae bonorum intellegat usu cu.', '69', '1', '2018-08-28 07:55:46', '2018-08-28 07:59:36');
INSERT INTO `pages_blocks_locale_contents` VALUES ('274', 'Cu cum commodo regione definiebas. Cum ea eros laboramus, audire deseruisse his at, munere aeterno ut quo. Et ius doming causae philosophia, vitae bonorum intellegat usu cu.', '69', '2', '2018-08-28 07:55:46', '2018-08-29 06:59:58');
INSERT INTO `pages_blocks_locale_contents` VALUES ('277', 'Usu ei porro deleniti similique, per no consetetur necessitatibus. Ut sed augue docendi alienum, ex oblique scaevola inciderint pri, unum movet cu cum. Et cum impedit epicuri', '70', '1', '2018-08-28 07:56:05', '2018-08-28 07:57:14');
INSERT INTO `pages_blocks_locale_contents` VALUES ('278', 'Usu ei porro deleniti similique, per no consetetur necessitatibus. Ut sed augue docendi alienum, ex oblique scaevola inciderint pri, unum movet cu cum. Et cum impedit epicuri', '70', '2', '2018-08-28 07:56:05', '2018-08-29 06:57:56');
INSERT INTO `pages_blocks_locale_contents` VALUES ('281', 'Mark Wellbeck', '71', '1', '2018-08-28 07:56:05', '2018-08-28 07:57:14');
INSERT INTO `pages_blocks_locale_contents` VALUES ('282', 'Mark Wellbeck', '71', '2', '2018-08-28 07:56:05', '2018-08-29 06:57:56');
INSERT INTO `pages_blocks_locale_contents` VALUES ('285', 'AC Software', '72', '1', '2018-08-28 07:56:05', '2018-08-28 07:57:14');
INSERT INTO `pages_blocks_locale_contents` VALUES ('286', 'AC Software', '72', '2', '2018-08-28 07:56:05', '2018-08-29 06:57:56');
INSERT INTO `pages_blocks_locale_contents` VALUES ('289', 'Prices', '73', '1', '2018-08-28 11:13:38', '2018-08-28 11:14:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('290', 'Example on <strong>4 columns</strong>', '73', '2', '2018-08-28 11:13:38', '2018-08-29 07:00:31');
INSERT INTO `pages_blocks_locale_contents` VALUES ('293', 'Very <strong>Basic</strong>', '74', '1', '2018-08-28 11:13:38', '2018-08-28 11:15:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('294', 'Very <strong>Basic</strong>', '74', '2', '2018-08-28 11:13:38', '2018-08-29 07:01:09');
INSERT INTO `pages_blocks_locale_contents` VALUES ('297', '$15.00 / Month', '75', '1', '2018-08-28 11:13:38', '2018-08-28 11:15:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('298', '$15.00 / Month', '75', '2', '2018-08-28 11:13:38', '2018-08-29 07:01:09');
INSERT INTO `pages_blocks_locale_contents` VALUES ('301', 'Register now', '76', '1', '2018-08-28 11:13:38', '2018-08-28 11:15:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('302', 'Register now', '76', '2', '2018-08-28 11:13:38', '2018-08-29 07:01:09');
INSERT INTO `pages_blocks_locale_contents` VALUES ('305', '#', '77', '1', '2018-08-28 11:13:38', '2018-08-28 11:15:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('306', '#', '77', '2', '2018-08-28 11:13:38', '2018-08-29 07:01:09');
INSERT INTO `pages_blocks_locale_contents` VALUES ('309', '100 applications', '78', '1', '2018-08-28 11:13:38', '2018-08-28 11:21:24');
INSERT INTO `pages_blocks_locale_contents` VALUES ('310', '100 applications', '78', '2', '2018-08-28 11:13:38', '2018-08-29 07:02:46');
INSERT INTO `pages_blocks_locale_contents` VALUES ('313', 'Special <strong>Choice</strong>', '79', '1', '2018-08-28 11:13:38', '2018-08-28 11:17:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('314', 'Special <strong>Choice</strong>', '79', '2', '2018-08-28 11:13:38', '2018-08-29 07:02:04');
INSERT INTO `pages_blocks_locale_contents` VALUES ('317', '$15.00 / Month', '80', '1', '2018-08-28 11:13:38', '2018-08-28 11:17:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('318', '$15.00 / Month', '80', '2', '2018-08-28 11:13:38', '2018-08-29 07:02:04');
INSERT INTO `pages_blocks_locale_contents` VALUES ('321', 'Register now', '81', '1', '2018-08-28 11:13:38', '2018-08-28 11:17:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('322', 'Register now', '81', '2', '2018-08-28 11:13:38', '2018-08-29 07:02:04');
INSERT INTO `pages_blocks_locale_contents` VALUES ('325', '#', '82', '1', '2018-08-28 11:13:38', '2018-08-28 11:17:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('326', '#', '82', '2', '2018-08-28 11:13:38', '2018-08-29 07:02:04');
INSERT INTO `pages_blocks_locale_contents` VALUES ('329', '100 applications', '83', '1', '2018-08-28 11:13:38', '2018-08-28 11:22:51');
INSERT INTO `pages_blocks_locale_contents` VALUES ('330', '100 applications', '83', '2', '2018-08-28 11:13:38', '2018-08-29 07:04:18');
INSERT INTO `pages_blocks_locale_contents` VALUES ('333', 'Simple <strong>Choice</strong>', '84', '1', '2018-08-28 11:14:07', '2018-08-28 11:16:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('334', 'Simple <strong>Choice</strong>', '84', '2', '2018-08-28 11:14:07', '2018-08-29 07:01:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('337', '$20.00 / Month', '85', '1', '2018-08-28 11:14:07', '2018-08-28 11:16:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('338', '$20.00 / Month', '85', '2', '2018-08-28 11:14:07', '2018-08-29 07:01:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('341', 'Register now', '86', '1', '2018-08-28 11:14:07', '2018-08-28 11:16:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('342', 'Register now', '86', '2', '2018-08-28 11:14:07', '2018-08-29 07:01:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('345', '#', '87', '1', '2018-08-28 11:14:07', '2018-08-28 11:16:25');
INSERT INTO `pages_blocks_locale_contents` VALUES ('346', '#', '87', '2', '2018-08-28 11:14:07', '2018-08-29 07:01:39');
INSERT INTO `pages_blocks_locale_contents` VALUES ('349', '100 applications', '88', '1', '2018-08-28 11:14:07', '2018-08-28 11:22:06');
INSERT INTO `pages_blocks_locale_contents` VALUES ('350', '100 applications', '88', '2', '2018-08-28 11:14:07', '2018-08-29 07:03:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('353', 'Just <strong>Happy</strong>', '89', '1', '2018-08-28 11:14:19', '2018-08-28 11:17:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('354', 'Just <strong>Happy</strong>', '89', '2', '2018-08-28 11:14:19', '2018-08-29 07:02:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('357', '$15.00 / Month', '90', '1', '2018-08-28 11:14:19', '2018-08-28 11:17:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('358', '$15.00 / Month', '90', '2', '2018-08-28 11:14:19', '2018-08-29 07:02:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('361', 'Register now', '91', '1', '2018-08-28 11:14:19', '2018-08-28 11:17:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('362', 'Register now', '91', '2', '2018-08-28 11:14:19', '2018-08-29 07:02:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('365', '#', '92', '1', '2018-08-28 11:14:19', '2018-08-28 11:17:34');
INSERT INTO `pages_blocks_locale_contents` VALUES ('366', '#', '92', '2', '2018-08-28 11:14:19', '2018-08-29 07:02:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('369', '100 applications', '93', '1', '2018-08-28 11:14:19', '2018-08-28 11:23:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('370', '100 applications', '93', '2', '2018-08-28 11:14:19', '2018-08-29 07:04:56');
INSERT INTO `pages_blocks_locale_contents` VALUES ('373', '24x7 support available', '94', '1', '2018-08-28 11:18:08', '2018-08-28 11:21:32');
INSERT INTO `pages_blocks_locale_contents` VALUES ('374', '24x7 support available', '94', '2', '2018-08-28 11:18:08', '2018-08-29 07:02:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('377', 'No hidden fees', '95', '1', '2018-08-28 11:18:16', '2018-08-28 11:21:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('378', 'No hidden fees', '95', '2', '2018-08-28 11:18:16', '2018-08-29 07:03:01');
INSERT INTO `pages_blocks_locale_contents` VALUES ('381', 'Free 30-days trial', '96', '1', '2018-08-28 11:18:25', '2018-08-28 11:21:48');
INSERT INTO `pages_blocks_locale_contents` VALUES ('382', 'Free 30-days trial', '96', '2', '2018-08-28 11:18:25', '2018-08-29 07:03:08');
INSERT INTO `pages_blocks_locale_contents` VALUES ('385', 'Stop anytime easily', '97', '1', '2018-08-28 11:18:36', '2018-08-28 11:21:55');
INSERT INTO `pages_blocks_locale_contents` VALUES ('386', 'Stop anytime easily', '97', '2', '2018-08-28 11:18:36', '2018-08-29 07:03:15');
INSERT INTO `pages_blocks_locale_contents` VALUES ('389', '24x7 support available', '98', '1', '2018-08-28 11:19:01', '2018-08-28 11:22:17');
INSERT INTO `pages_blocks_locale_contents` VALUES ('390', '24x7 support available', '98', '2', '2018-08-28 11:19:01', '2018-08-29 07:03:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('393', 'No hidden fees', '99', '1', '2018-08-28 11:19:15', '2018-08-28 11:22:24');
INSERT INTO `pages_blocks_locale_contents` VALUES ('394', 'No hidden fees', '99', '2', '2018-08-28 11:19:15', '2018-08-29 07:03:46');
INSERT INTO `pages_blocks_locale_contents` VALUES ('397', 'Free 30-days trial', '100', '1', '2018-08-28 11:19:24', '2018-08-28 11:22:32');
INSERT INTO `pages_blocks_locale_contents` VALUES ('398', 'Free 30-days trial', '100', '2', '2018-08-28 11:19:24', '2018-08-29 07:03:52');
INSERT INTO `pages_blocks_locale_contents` VALUES ('401', 'Stop anytime easily', '101', '1', '2018-08-28 11:19:36', '2018-08-28 11:22:38');
INSERT INTO `pages_blocks_locale_contents` VALUES ('402', 'Stop anytime easily', '101', '2', '2018-08-28 11:19:36', '2018-08-29 07:04:01');
INSERT INTO `pages_blocks_locale_contents` VALUES ('405', '24x7 support available', '102', '1', '2018-08-28 11:19:46', '2018-08-28 11:22:57');
INSERT INTO `pages_blocks_locale_contents` VALUES ('406', '24x7 support available', '102', '2', '2018-08-28 11:19:46', '2018-08-29 07:04:27');
INSERT INTO `pages_blocks_locale_contents` VALUES ('409', 'No hidden fees', '103', '1', '2018-08-28 11:19:56', '2018-08-28 11:23:05');
INSERT INTO `pages_blocks_locale_contents` VALUES ('410', 'No hidden fees', '103', '2', '2018-08-28 11:19:56', '2018-08-29 07:04:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('413', 'Free 30-days trial', '104', '1', '2018-08-28 11:20:05', '2018-08-28 11:23:14');
INSERT INTO `pages_blocks_locale_contents` VALUES ('414', 'Free 30-days trial', '104', '2', '2018-08-28 11:20:05', '2018-08-29 07:04:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('417', 'Stop anytime easily', '105', '1', '2018-08-28 11:20:15', '2018-08-28 11:23:23');
INSERT INTO `pages_blocks_locale_contents` VALUES ('418', 'Stop anytime easily', '105', '2', '2018-08-28 11:20:15', '2018-08-29 07:04:47');
INSERT INTO `pages_blocks_locale_contents` VALUES ('421', '24x7 support available', '106', '1', '2018-08-28 11:20:26', '2018-08-28 11:23:41');
INSERT INTO `pages_blocks_locale_contents` VALUES ('422', '24x7 support available', '106', '2', '2018-08-28 11:20:26', '2018-08-29 07:05:03');
INSERT INTO `pages_blocks_locale_contents` VALUES ('425', 'No hidden fees', '107', '1', '2018-08-28 11:20:36', '2018-08-28 11:23:47');
INSERT INTO `pages_blocks_locale_contents` VALUES ('426', 'No hidden fees', '107', '2', '2018-08-28 11:20:36', '2018-08-29 07:05:09');
INSERT INTO `pages_blocks_locale_contents` VALUES ('429', 'Free 30-days trial', '108', '1', '2018-08-28 11:20:56', '2018-08-28 11:23:54');
INSERT INTO `pages_blocks_locale_contents` VALUES ('430', 'Free 30-days trial', '108', '2', '2018-08-28 11:20:56', '2018-08-29 07:05:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('433', 'Stop anytime easily', '109', '1', '2018-08-28 11:21:05', '2018-08-28 11:24:02');
INSERT INTO `pages_blocks_locale_contents` VALUES ('434', 'Stop anytime easily', '109', '2', '2018-08-28 11:21:05', '2018-08-29 07:05:22');
INSERT INTO `pages_blocks_locale_contents` VALUES ('441', 'a:6:{i:0;a:3:{s:4:\"name\";s:44:\"svQatPOU6sDJyWtk30goxVbs4vCRU5JPpO5kdBO4.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/svQatPOU6sDJyWtk30goxVbs4vCRU5JPpO5kdBO4.png\";}i:1;a:3:{s:4:\"name\";s:44:\"vOJ7Sv1pdjuR39XdUE6ynkiZnUPzKmsw6SEadvAX.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/vOJ7Sv1pdjuR39XdUE6ynkiZnUPzKmsw6SEadvAX.png\";}i:2;a:3:{s:4:\"name\";s:44:\"SRO801wutiEt9K1wYXNwdaE8yVeqjK7AKjABx2eK.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/SRO801wutiEt9K1wYXNwdaE8yVeqjK7AKjABx2eK.png\";}i:3;a:3:{s:4:\"name\";s:44:\"25OQlxnBX4kmzFFYUn9awqN0wE1ouijWi2xwYNo7.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/25OQlxnBX4kmzFFYUn9awqN0wE1ouijWi2xwYNo7.png\";}i:4;a:3:{s:4:\"name\";s:44:\"JJW39yIsYbYOzIvrlEmfVPkzb7umu4IxHN0uCwJP.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/JJW39yIsYbYOzIvrlEmfVPkzb7umu4IxHN0uCwJP.png\";}i:5;a:3:{s:4:\"name\";s:44:\"HC4zOHDqN3LJkl5wRthdRJZGAkoSBHFOzDb0AfPM.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/HC4zOHDqN3LJkl5wRthdRJZGAkoSBHFOzDb0AfPM.png\";}}', '111', '1', '2018-08-28 11:36:59', '2018-08-28 11:44:32');
INSERT INTO `pages_blocks_locale_contents` VALUES ('442', 'a:6:{i:0;a:3:{s:4:\"name\";s:44:\"25OQlxnBX4kmzFFYUn9awqN0wE1ouijWi2xwYNo7.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/25OQlxnBX4kmzFFYUn9awqN0wE1ouijWi2xwYNo7.png\";}i:1;a:3:{s:4:\"name\";s:44:\"HC4zOHDqN3LJkl5wRthdRJZGAkoSBHFOzDb0AfPM.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/HC4zOHDqN3LJkl5wRthdRJZGAkoSBHFOzDb0AfPM.png\";}i:2;a:3:{s:4:\"name\";s:44:\"JJW39yIsYbYOzIvrlEmfVPkzb7umu4IxHN0uCwJP.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/JJW39yIsYbYOzIvrlEmfVPkzb7umu4IxHN0uCwJP.png\";}i:3;a:3:{s:4:\"name\";s:44:\"SRO801wutiEt9K1wYXNwdaE8yVeqjK7AKjABx2eK.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/SRO801wutiEt9K1wYXNwdaE8yVeqjK7AKjABx2eK.png\";}i:4;a:3:{s:4:\"name\";s:44:\"svQatPOU6sDJyWtk30goxVbs4vCRU5JPpO5kdBO4.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/svQatPOU6sDJyWtk30goxVbs4vCRU5JPpO5kdBO4.png\";}i:5;a:3:{s:4:\"name\";s:44:\"vOJ7Sv1pdjuR39XdUE6ynkiZnUPzKmsw6SEadvAX.png\";s:3:\"alt\";N;s:4:\"path\";s:59:\"/storage/media/vOJ7Sv1pdjuR39XdUE6ynkiZnUPzKmsw6SEadvAX.png\";}}', '111', '2', '2018-08-28 11:36:59', '2018-08-29 07:06:17');
INSERT INTO `pages_blocks_locale_contents` VALUES ('461', 'Single fullwidth page title', '116', '1', '2018-08-28 12:15:21', '2018-08-28 12:15:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('462', 'Single fullwidth page title', '116', '2', '2018-08-28 12:15:21', '2018-08-29 07:07:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('465', 'a:3:{s:4:\"name\";s:45:\"eDcgYd5k3bRnq97kQnlfgowpXmMEJo7vvGumPlQW.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/eDcgYd5k3bRnq97kQnlfgowpXmMEJo7vvGumPlQW.jpeg\";}', '117', '1', '2018-08-28 12:15:21', '2018-08-28 12:15:40');
INSERT INTO `pages_blocks_locale_contents` VALUES ('466', 'a:3:{s:4:\"name\";s:45:\"QW6H1p3YrbSIVyvOrwLdIbkVhCnuq71KV1eQ1I2O.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/QW6H1p3YrbSIVyvOrwLdIbkVhCnuq71KV1eQ1I2O.jpeg\";}', '117', '2', '2018-08-28 12:15:21', '2018-08-29 07:07:16');
INSERT INTO `pages_blocks_locale_contents` VALUES ('469', 'Lorem ipsum dolor sit amet, no vix sint solet, et ius utinam deseruisse intellegam, ne pro modus vitae tation. Vis ex soluta tritani. Ne pro esse facete expetendis, laudem eirmod minimum nec in. Est quidam urbanitas gloriatur no, eu unum suscipit disputando eam, nam bonorum facilisi ut. Putent efficiantur et pri, eu primis laoreet eum, ut malis everti mel.', '118', '1', '2018-08-28 12:15:21', '2018-08-28 12:16:07');
INSERT INTO `pages_blocks_locale_contents` VALUES ('470', 'Lorem ipsum dolor sit amet, no vix sint solet, et ius utinam deseruisse intellegam, ne pro modus vitae tation. Vis ex soluta tritani. Ne pro esse facete expetendis, laudem eirmod minimum nec in. Est quidam urbanitas gloriatur no, eu unum suscipit disputando eam, nam bonorum facilisi ut. \r\n		Putent efficiantur et pri, eu primis laoreet eum, ut malis everti mel.', '118', '2', '2018-08-28 12:15:21', '2018-08-29 07:07:33');
INSERT INTO `pages_blocks_locale_contents` VALUES ('473', 'Ne utroque prodesset mei, mea no aliquam utroque. Has ne tation argumentum. Vis ex insolens reformidans, mea semper impetus argumentum ad. Sea erroribus sadipscing in. Mel cu dolore admodum accumsan, mea timeam perpetua disputationi ne, urbanitas prodesset ex vel. Ei nostro molestiae moderatius cum. Adhuc persius dolores ut sed, quis vidisse vituperata duo in. Quot signiferumque eos cu, ad dissentiet theophrastus has, eum tota utroque nusquam te. Ei elit eirmod delicata pri. Solet affert theophrastus pro ei, ius enim homero deleniti te.', '119', '1', '2018-08-28 12:15:43', '2018-08-28 12:16:20');
INSERT INTO `pages_blocks_locale_contents` VALUES ('474', 'Ne utroque prodesset mei, mea no aliquam utroque. Has ne tation argumentum. Vis ex insolens reformidans, mea semper impetus argumentum ad. Sea erroribus sadipscing in. Mel cu dolore admodum accumsan, mea timeam perpetua disputationi ne, urbanitas prodesset ex vel.\r\n\r\nEi nostro molestiae moderatius cum. Adhuc persius dolores ut sed, quis vidisse vituperata duo in. Quot signiferumque eos cu, ad dissentiet theophrastus has, eum tota utroque nusquam te. Ei elit eirmod delicata pri. Solet affert theophrastus pro ei, ius enim homero deleniti te.', '119', '2', '2018-08-28 12:15:43', '2018-08-29 07:07:43');
INSERT INTO `pages_blocks_locale_contents` VALUES ('477', 'Vel quot idque philosophia ex. In possit ceteros accumsan vel, modus impedit recusabo ne eam, ne mel wisi delenit repudiandae. Ei eum oratio patrioque instructior, cibo melius tacimates vis cu. Aeque voluptatum sit ut, pri reque labitur explicari ad, docendi democritum vix no. Quo ne adhuc semper vituperata, quo ex vide justo nusquam, pro impedit philosophia an. Ad sed veri choro utroque, aeque definiebas an sea. Populo conceptam te qui. Pri eu doming urbanitas, eu omnes qualisque splendide mei. Has admodum honestatis no, cu sonet nullam vim.', '120', '1', '2018-08-28 12:15:51', '2018-08-28 12:16:37');
INSERT INTO `pages_blocks_locale_contents` VALUES ('478', 'Vel quot idque philosophia ex. In possit ceteros accumsan vel, modus impedit recusabo ne eam, ne mel wisi delenit repudiandae. Ei eum oratio patrioque instructior, cibo melius tacimates vis cu. Aeque voluptatum sit ut, pri reque labitur explicari ad, docendi democritum vix no.\r\n\r\nQuo ne adhuc semper vituperata, quo ex vide justo nusquam, pro impedit philosophia an. Ad sed veri choro utroque, aeque definiebas an sea. Populo conceptam te qui. Pri eu doming urbanitas, eu omnes qualisque splendide mei. Has admodum honestatis no, cu sonet nullam vim.', '120', '2', '2018-08-28 12:15:51', '2018-08-29 07:08:00');
INSERT INTO `pages_blocks_locale_contents` VALUES ('481', 'Ibiza, Spain', '121', '1', '2018-08-28 12:35:16', '2018-08-28 12:36:14');
INSERT INTO `pages_blocks_locale_contents` VALUES ('482', 'Eiffel Tower, Avenue Anatole France, Paris, France', '121', '2', '2018-08-28 12:35:16', '2018-08-29 07:08:56');
INSERT INTO `pages_blocks_locale_contents` VALUES ('485', 'Contact us <small>get in touch with us by filling form below</small>', '122', '1', '2018-08-28 12:35:16', '2018-08-28 12:36:27');
INSERT INTO `pages_blocks_locale_contents` VALUES ('486', 'Contact us <small>get in touch with us by filling form below</small>', '122', '2', '2018-08-28 12:35:16', '2018-08-29 07:09:12');

-- ----------------------------
-- Table structure for `pages_design_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `pages_design_blocks`;
CREATE TABLE `pages_design_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `page_id` int(10) unsigned NOT NULL,
  `design_block_id` int(10) unsigned DEFAULT NULL,
  `parent_design_block` int(10) unsigned DEFAULT NULL,
  `widget_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_design_blocks_page_id_foreign` (`page_id`),
  KEY `pages_design_blocks_design_block_id_foreign` (`design_block_id`),
  KEY `pages_design_blocks_parent_design_block_foreign` (`parent_design_block`),
  KEY `pages_design_blocks_widget_id_foreign` (`widget_id`),
  CONSTRAINT `pages_design_blocks_design_block_id_foreign` FOREIGN KEY (`design_block_id`) REFERENCES `design_blocks` (`id`),
  CONSTRAINT `pages_design_blocks_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `pages_design_blocks_parent_design_block_foreign` FOREIGN KEY (`parent_design_block`) REFERENCES `pages_design_blocks` (`id`),
  CONSTRAINT `pages_design_blocks_widget_id_foreign` FOREIGN KEY (`widget_id`) REFERENCES `widgets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pages_design_blocks
-- ----------------------------
INSERT INTO `pages_design_blocks` VALUES ('1', '1', '1', '2', null, null, '2018-08-27 13:10:52', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('2', '1', '1', '1', '1', null, '2018-08-27 13:10:52', '2018-08-28 11:47:51');
INSERT INTO `pages_design_blocks` VALUES ('3', '2', '1', '1', '1', null, '2018-08-27 13:11:00', '2018-08-28 11:47:51');
INSERT INTO `pages_design_blocks` VALUES ('4', '3', '1', '1', '1', null, '2018-08-27 13:11:06', '2018-08-28 11:47:51');
INSERT INTO `pages_design_blocks` VALUES ('5', '2', '1', '3', null, null, '2018-08-28 05:56:43', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('6', '3', '1', '5', null, null, '2018-08-28 06:06:31', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('7', '1', '1', '4', '6', null, '2018-08-28 06:06:31', '2018-08-29 06:53:16');
INSERT INTO `pages_design_blocks` VALUES ('8', '2', '1', '4', '6', null, '2018-08-28 06:07:51', '2018-08-29 06:53:16');
INSERT INTO `pages_design_blocks` VALUES ('9', '3', '1', '4', '6', null, '2018-08-28 06:07:59', '2018-08-29 06:53:16');
INSERT INTO `pages_design_blocks` VALUES ('10', '4', '1', '4', '6', null, '2018-08-28 06:08:09', '2018-08-29 06:53:16');
INSERT INTO `pages_design_blocks` VALUES ('11', '4', '1', '6', null, null, '2018-08-28 06:42:30', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('12', '5', '1', '11', null, null, '2018-08-28 06:55:29', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('13', '1', '1', '7', '12', null, '2018-08-28 06:55:29', '2018-08-29 06:55:18');
INSERT INTO `pages_design_blocks` VALUES ('14', '2', '1', '8', '12', null, '2018-08-28 06:55:29', '2018-08-29 06:55:18');
INSERT INTO `pages_design_blocks` VALUES ('15', '3', '1', '9', '12', null, '2018-08-28 06:55:29', '2018-08-29 06:55:18');
INSERT INTO `pages_design_blocks` VALUES ('16', '4', '1', '10', '12', null, '2018-08-28 06:55:29', '2018-08-29 06:55:18');
INSERT INTO `pages_design_blocks` VALUES ('17', '6', '1', '12', null, null, '2018-08-28 07:05:07', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('18', '7', '1', '14', null, null, '2018-08-28 07:09:31', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('19', '1', '1', '13', '18', null, '2018-08-28 07:09:31', '2018-08-28 07:31:49');
INSERT INTO `pages_design_blocks` VALUES ('20', '2', '1', '13', '18', null, '2018-08-28 07:29:55', '2018-08-28 07:31:49');
INSERT INTO `pages_design_blocks` VALUES ('21', '3', '1', '13', '18', null, '2018-08-28 07:30:11', '2018-08-28 07:31:49');
INSERT INTO `pages_design_blocks` VALUES ('22', '4', '1', '13', '18', null, '2018-08-28 07:30:33', '2018-08-28 07:31:49');
INSERT INTO `pages_design_blocks` VALUES ('23', '8', '1', '24', null, null, '2018-08-28 07:55:46', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('24', '1', '1', '16', '23', null, '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_design_blocks` VALUES ('25', '1', '1', '15', '24', null, '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_design_blocks` VALUES ('26', '2', '1', '23', '23', null, '2018-08-28 07:55:46', '2018-08-28 07:55:46');
INSERT INTO `pages_design_blocks` VALUES ('27', '1', '1', '20', '26', null, '2018-08-28 07:55:46', '2018-08-29 06:59:49');
INSERT INTO `pages_design_blocks` VALUES ('28', '2', '1', '21', '26', null, '2018-08-28 07:55:46', '2018-08-29 06:59:49');
INSERT INTO `pages_design_blocks` VALUES ('29', '3', '1', '22', '26', null, '2018-08-28 07:55:46', '2018-08-29 06:59:49');
INSERT INTO `pages_design_blocks` VALUES ('30', '2', '1', '15', '24', null, '2018-08-28 07:56:05', '2018-08-28 07:56:05');
INSERT INTO `pages_design_blocks` VALUES ('31', '9', '1', '6', null, null, '2018-08-28 08:38:20', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('32', '10', '1', null, null, '1', '2018-08-28 10:28:29', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('33', '11', '1', '6', null, null, '2018-08-28 11:01:16', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('34', '12', '1', '36', null, null, '2018-08-28 11:13:38', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('35', '1', '1', '34', '34', null, '2018-08-28 11:13:38', '2018-08-28 11:32:22');
INSERT INTO `pages_design_blocks` VALUES ('36', '1', '1', '33', '35', null, '2018-08-28 11:13:38', '2018-08-29 07:02:54');
INSERT INTO `pages_design_blocks` VALUES ('37', '3', '1', '35', '34', null, '2018-08-28 11:13:38', '2018-08-28 11:32:22');
INSERT INTO `pages_design_blocks` VALUES ('38', '1', '1', '33', '37', null, '2018-08-28 11:13:38', '2018-08-29 07:04:18');
INSERT INTO `pages_design_blocks` VALUES ('39', '2', '1', '34', '34', null, '2018-08-28 11:14:07', '2018-08-28 11:32:22');
INSERT INTO `pages_design_blocks` VALUES ('40', '1', '1', '33', '39', null, '2018-08-28 11:14:07', '2018-08-28 11:22:25');
INSERT INTO `pages_design_blocks` VALUES ('41', '4', '1', '34', '34', null, '2018-08-28 11:14:19', '2018-08-28 11:32:22');
INSERT INTO `pages_design_blocks` VALUES ('42', '1', '1', '33', '41', null, '2018-08-28 11:14:19', '2018-08-28 11:14:19');
INSERT INTO `pages_design_blocks` VALUES ('43', '2', '1', '33', '35', null, '2018-08-28 11:18:08', '2018-08-29 07:02:54');
INSERT INTO `pages_design_blocks` VALUES ('44', '3', '1', '33', '35', null, '2018-08-28 11:18:16', '2018-08-29 07:02:54');
INSERT INTO `pages_design_blocks` VALUES ('45', '4', '1', '33', '35', null, '2018-08-28 11:18:25', '2018-08-29 07:02:54');
INSERT INTO `pages_design_blocks` VALUES ('46', '5', '1', '33', '35', null, '2018-08-28 11:18:36', '2018-08-29 07:02:54');
INSERT INTO `pages_design_blocks` VALUES ('47', '2', '1', '33', '39', null, '2018-08-28 11:19:01', '2018-08-28 11:22:25');
INSERT INTO `pages_design_blocks` VALUES ('48', '3', '1', '33', '39', null, '2018-08-28 11:19:15', '2018-08-28 11:22:25');
INSERT INTO `pages_design_blocks` VALUES ('49', '4', '1', '33', '39', null, '2018-08-28 11:19:24', '2018-08-28 11:22:25');
INSERT INTO `pages_design_blocks` VALUES ('50', '5', '1', '33', '39', null, '2018-08-28 11:19:36', '2018-08-28 11:22:25');
INSERT INTO `pages_design_blocks` VALUES ('51', '2', '1', '33', '37', null, '2018-08-28 11:19:46', '2018-08-29 07:04:18');
INSERT INTO `pages_design_blocks` VALUES ('52', '3', '1', '33', '37', null, '2018-08-28 11:19:56', '2018-08-29 07:04:18');
INSERT INTO `pages_design_blocks` VALUES ('53', '4', '1', '33', '37', null, '2018-08-28 11:20:05', '2018-08-29 07:04:18');
INSERT INTO `pages_design_blocks` VALUES ('54', '5', '1', '33', '37', null, '2018-08-28 11:20:15', '2018-08-29 07:04:18');
INSERT INTO `pages_design_blocks` VALUES ('55', '2', '1', '33', '41', null, '2018-08-28 11:20:26', '2018-08-28 11:20:26');
INSERT INTO `pages_design_blocks` VALUES ('56', '3', '1', '33', '41', null, '2018-08-28 11:20:36', '2018-08-28 11:20:36');
INSERT INTO `pages_design_blocks` VALUES ('57', '4', '1', '33', '41', null, '2018-08-28 11:20:56', '2018-08-28 11:20:56');
INSERT INTO `pages_design_blocks` VALUES ('58', '5', '1', '33', '41', null, '2018-08-28 11:21:05', '2018-08-28 11:21:05');
INSERT INTO `pages_design_blocks` VALUES ('61', '13', '1', '39', null, null, '2018-08-28 11:36:59', '2018-08-29 07:54:50');
INSERT INTO `pages_design_blocks` VALUES ('66', '14', '2', '42', null, null, '2018-08-28 12:15:21', '2018-08-28 12:15:21');
INSERT INTO `pages_design_blocks` VALUES ('67', '1', '2', '40', '66', null, '2018-08-28 12:15:21', '2018-08-28 12:15:21');
INSERT INTO `pages_design_blocks` VALUES ('68', '2', '2', '40', '66', null, '2018-08-28 12:15:43', '2018-08-28 12:15:43');
INSERT INTO `pages_design_blocks` VALUES ('69', '3', '2', '40', '66', null, '2018-08-28 12:15:51', '2018-08-28 12:15:51');
INSERT INTO `pages_design_blocks` VALUES ('70', '15', '3', null, null, '1', '2018-08-28 12:19:35', '2018-08-28 12:19:35');
INSERT INTO `pages_design_blocks` VALUES ('71', '2', '4', '46', null, null, '2018-08-28 12:35:16', '2018-08-28 12:36:49');
INSERT INTO `pages_design_blocks` VALUES ('72', '1', '4', '43', '71', null, '2018-08-28 12:35:16', '2018-08-28 12:36:15');
INSERT INTO `pages_design_blocks` VALUES ('73', '2', '4', '45', '71', null, '2018-08-28 12:35:16', '2018-08-28 12:36:15');
INSERT INTO `pages_design_blocks` VALUES ('74', '1', '4', '12', null, null, '2018-08-28 12:36:44', '2018-08-28 12:36:49');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `seos`
-- ----------------------------
DROP TABLE IF EXISTS `seos`;
CREATE TABLE `seos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of seos
-- ----------------------------
INSERT INTO `seos` VALUES ('1', 'asgwegerwtgewrhgwerhe', 'erhg,erg,wegwev,wevwev,wegwe', '2018-08-27 13:07:54', '2018-08-27 13:07:54');
INSERT INTO `seos` VALUES ('2', 'sdgdsfhdsfhdfsh', 'sdg,wefg,wev,wegwe,wefwef', '2018-08-28 11:58:48', '2018-08-28 13:14:31');
INSERT INTO `seos` VALUES ('3', 'wefvwegvwevwe', 'wevg,wef,sdvcsdv,wqew,svsgv', '2018-08-28 12:19:16', '2018-08-28 12:19:16');
INSERT INTO `seos` VALUES ('4', 'sdgsebhwehgwerhewrh', 'weg,rtntr,sdsdf,werhyeu', '2018-08-28 12:21:53', '2018-08-28 12:21:53');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for `widgets`
-- ----------------------------
DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widgets_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of widgets
-- ----------------------------
INSERT INTO `widgets` VALUES ('1', 'portfolio', '2018-08-28 09:54:04', '2018-08-28 09:54:04');

-- ----------------------------
-- Table structure for `widgets_blocks_contents`
-- ----------------------------
DROP TABLE IF EXISTS `widgets_blocks_contents`;
CREATE TABLE `widgets_blocks_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `design_blocks_info_block_id` int(10) unsigned NOT NULL,
  `widgets_design_block_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `widgets_blocks_contents_design_blocks_info_block_id_foreign` (`design_blocks_info_block_id`),
  KEY `widgets_blocks_contents_widgets_design_block_id_foreign` (`widgets_design_block_id`),
  CONSTRAINT `widgets_blocks_contents_design_blocks_info_block_id_foreign` FOREIGN KEY (`design_blocks_info_block_id`) REFERENCES `design_blocks_info_blocks` (`id`),
  CONSTRAINT `widgets_blocks_contents_widgets_design_block_id_foreign` FOREIGN KEY (`widgets_design_block_id`) REFERENCES `widgets_design_blocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of widgets_blocks_contents
-- ----------------------------
INSERT INTO `widgets_blocks_contents` VALUES ('1', '69', '1', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('2', '61', '3', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('3', '62', '3', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('4', '63', '5', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('5', '64', '5', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('6', '65', '5', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('7', '66', '5', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('8', '67', '5', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('9', '68', '5', '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_blocks_contents` VALUES ('10', '61', '6', '2018-08-28 09:54:51', '2018-08-28 09:54:51');
INSERT INTO `widgets_blocks_contents` VALUES ('11', '62', '6', '2018-08-28 09:54:51', '2018-08-28 09:54:51');
INSERT INTO `widgets_blocks_contents` VALUES ('12', '61', '7', '2018-08-28 09:55:19', '2018-08-28 09:55:19');
INSERT INTO `widgets_blocks_contents` VALUES ('13', '62', '7', '2018-08-28 09:55:19', '2018-08-28 09:55:19');
INSERT INTO `widgets_blocks_contents` VALUES ('14', '61', '8', '2018-08-28 09:55:29', '2018-08-28 09:55:29');
INSERT INTO `widgets_blocks_contents` VALUES ('15', '62', '8', '2018-08-28 09:55:29', '2018-08-28 09:55:29');
INSERT INTO `widgets_blocks_contents` VALUES ('16', '63', '9', '2018-08-28 09:57:25', '2018-08-28 09:57:25');
INSERT INTO `widgets_blocks_contents` VALUES ('17', '64', '9', '2018-08-28 09:57:25', '2018-08-28 09:57:25');
INSERT INTO `widgets_blocks_contents` VALUES ('18', '65', '9', '2018-08-28 09:57:25', '2018-08-28 09:57:25');
INSERT INTO `widgets_blocks_contents` VALUES ('19', '66', '9', '2018-08-28 09:57:25', '2018-08-28 09:57:25');
INSERT INTO `widgets_blocks_contents` VALUES ('20', '67', '9', '2018-08-28 09:57:25', '2018-08-28 09:57:25');
INSERT INTO `widgets_blocks_contents` VALUES ('21', '68', '9', '2018-08-28 09:57:25', '2018-08-28 09:57:25');
INSERT INTO `widgets_blocks_contents` VALUES ('22', '63', '10', '2018-08-28 09:57:32', '2018-08-28 09:57:32');
INSERT INTO `widgets_blocks_contents` VALUES ('23', '64', '10', '2018-08-28 09:57:32', '2018-08-28 09:57:32');
INSERT INTO `widgets_blocks_contents` VALUES ('24', '65', '10', '2018-08-28 09:57:32', '2018-08-28 09:57:32');
INSERT INTO `widgets_blocks_contents` VALUES ('25', '66', '10', '2018-08-28 09:57:33', '2018-08-28 09:57:33');
INSERT INTO `widgets_blocks_contents` VALUES ('26', '67', '10', '2018-08-28 09:57:33', '2018-08-28 09:57:33');
INSERT INTO `widgets_blocks_contents` VALUES ('27', '68', '10', '2018-08-28 09:57:33', '2018-08-28 09:57:33');
INSERT INTO `widgets_blocks_contents` VALUES ('28', '63', '11', '2018-08-28 09:57:41', '2018-08-28 09:57:41');
INSERT INTO `widgets_blocks_contents` VALUES ('29', '64', '11', '2018-08-28 09:57:41', '2018-08-28 09:57:41');
INSERT INTO `widgets_blocks_contents` VALUES ('30', '65', '11', '2018-08-28 09:57:41', '2018-08-28 09:57:41');
INSERT INTO `widgets_blocks_contents` VALUES ('31', '66', '11', '2018-08-28 09:57:41', '2018-08-28 09:57:41');
INSERT INTO `widgets_blocks_contents` VALUES ('32', '67', '11', '2018-08-28 09:57:41', '2018-08-28 09:57:41');
INSERT INTO `widgets_blocks_contents` VALUES ('33', '68', '11', '2018-08-28 09:57:41', '2018-08-28 09:57:41');
INSERT INTO `widgets_blocks_contents` VALUES ('34', '63', '12', '2018-08-28 09:57:49', '2018-08-28 09:57:49');
INSERT INTO `widgets_blocks_contents` VALUES ('35', '64', '12', '2018-08-28 09:57:49', '2018-08-28 09:57:49');
INSERT INTO `widgets_blocks_contents` VALUES ('36', '65', '12', '2018-08-28 09:57:49', '2018-08-28 09:57:49');
INSERT INTO `widgets_blocks_contents` VALUES ('37', '66', '12', '2018-08-28 09:57:49', '2018-08-28 09:57:49');
INSERT INTO `widgets_blocks_contents` VALUES ('38', '67', '12', '2018-08-28 09:57:49', '2018-08-28 09:57:49');
INSERT INTO `widgets_blocks_contents` VALUES ('39', '68', '12', '2018-08-28 09:57:49', '2018-08-28 09:57:49');
INSERT INTO `widgets_blocks_contents` VALUES ('40', '63', '13', '2018-08-28 09:57:57', '2018-08-28 09:57:57');
INSERT INTO `widgets_blocks_contents` VALUES ('41', '64', '13', '2018-08-28 09:57:57', '2018-08-28 09:57:57');
INSERT INTO `widgets_blocks_contents` VALUES ('42', '65', '13', '2018-08-28 09:57:57', '2018-08-28 09:57:57');
INSERT INTO `widgets_blocks_contents` VALUES ('43', '66', '13', '2018-08-28 09:57:57', '2018-08-28 09:57:57');
INSERT INTO `widgets_blocks_contents` VALUES ('44', '67', '13', '2018-08-28 09:57:57', '2018-08-28 09:57:57');
INSERT INTO `widgets_blocks_contents` VALUES ('45', '68', '13', '2018-08-28 09:57:57', '2018-08-28 09:57:57');
INSERT INTO `widgets_blocks_contents` VALUES ('46', '63', '14', '2018-08-28 09:58:05', '2018-08-28 09:58:05');
INSERT INTO `widgets_blocks_contents` VALUES ('47', '64', '14', '2018-08-28 09:58:05', '2018-08-28 09:58:05');
INSERT INTO `widgets_blocks_contents` VALUES ('48', '65', '14', '2018-08-28 09:58:05', '2018-08-28 09:58:05');
INSERT INTO `widgets_blocks_contents` VALUES ('49', '66', '14', '2018-08-28 09:58:05', '2018-08-28 09:58:05');
INSERT INTO `widgets_blocks_contents` VALUES ('50', '67', '14', '2018-08-28 09:58:05', '2018-08-28 09:58:05');
INSERT INTO `widgets_blocks_contents` VALUES ('51', '68', '14', '2018-08-28 09:58:05', '2018-08-28 09:58:05');
INSERT INTO `widgets_blocks_contents` VALUES ('52', '63', '15', '2018-08-28 09:58:15', '2018-08-28 09:58:15');
INSERT INTO `widgets_blocks_contents` VALUES ('53', '64', '15', '2018-08-28 09:58:16', '2018-08-28 09:58:16');
INSERT INTO `widgets_blocks_contents` VALUES ('54', '65', '15', '2018-08-28 09:58:16', '2018-08-28 09:58:16');
INSERT INTO `widgets_blocks_contents` VALUES ('55', '66', '15', '2018-08-28 09:58:16', '2018-08-28 09:58:16');
INSERT INTO `widgets_blocks_contents` VALUES ('56', '67', '15', '2018-08-28 09:58:16', '2018-08-28 09:58:16');
INSERT INTO `widgets_blocks_contents` VALUES ('57', '68', '15', '2018-08-28 09:58:16', '2018-08-28 09:58:16');
INSERT INTO `widgets_blocks_contents` VALUES ('58', '63', '16', '2018-08-28 09:58:23', '2018-08-28 09:58:23');
INSERT INTO `widgets_blocks_contents` VALUES ('59', '64', '16', '2018-08-28 09:58:23', '2018-08-28 09:58:23');
INSERT INTO `widgets_blocks_contents` VALUES ('60', '65', '16', '2018-08-28 09:58:23', '2018-08-28 09:58:23');
INSERT INTO `widgets_blocks_contents` VALUES ('61', '66', '16', '2018-08-28 09:58:23', '2018-08-28 09:58:23');
INSERT INTO `widgets_blocks_contents` VALUES ('62', '67', '16', '2018-08-28 09:58:23', '2018-08-28 09:58:23');
INSERT INTO `widgets_blocks_contents` VALUES ('63', '68', '16', '2018-08-28 09:58:23', '2018-08-28 09:58:23');
INSERT INTO `widgets_blocks_contents` VALUES ('64', '63', '17', '2018-08-28 09:58:31', '2018-08-28 09:58:31');
INSERT INTO `widgets_blocks_contents` VALUES ('65', '64', '17', '2018-08-28 09:58:31', '2018-08-28 09:58:31');
INSERT INTO `widgets_blocks_contents` VALUES ('66', '65', '17', '2018-08-28 09:58:31', '2018-08-28 09:58:31');
INSERT INTO `widgets_blocks_contents` VALUES ('67', '66', '17', '2018-08-28 09:58:31', '2018-08-28 09:58:31');
INSERT INTO `widgets_blocks_contents` VALUES ('68', '67', '17', '2018-08-28 09:58:31', '2018-08-28 09:58:31');
INSERT INTO `widgets_blocks_contents` VALUES ('69', '68', '17', '2018-08-28 09:58:31', '2018-08-28 09:58:31');
INSERT INTO `widgets_blocks_contents` VALUES ('70', '63', '18', '2018-08-28 09:58:46', '2018-08-28 09:58:46');
INSERT INTO `widgets_blocks_contents` VALUES ('71', '64', '18', '2018-08-28 09:58:46', '2018-08-28 09:58:46');
INSERT INTO `widgets_blocks_contents` VALUES ('72', '65', '18', '2018-08-28 09:58:46', '2018-08-28 09:58:46');
INSERT INTO `widgets_blocks_contents` VALUES ('73', '66', '18', '2018-08-28 09:58:46', '2018-08-28 09:58:46');
INSERT INTO `widgets_blocks_contents` VALUES ('74', '67', '18', '2018-08-28 09:58:46', '2018-08-28 09:58:46');
INSERT INTO `widgets_blocks_contents` VALUES ('75', '68', '18', '2018-08-28 09:58:46', '2018-08-28 09:58:46');
INSERT INTO `widgets_blocks_contents` VALUES ('76', '63', '19', '2018-08-28 09:58:54', '2018-08-28 09:58:54');
INSERT INTO `widgets_blocks_contents` VALUES ('77', '64', '19', '2018-08-28 09:58:54', '2018-08-28 09:58:54');
INSERT INTO `widgets_blocks_contents` VALUES ('78', '65', '19', '2018-08-28 09:58:54', '2018-08-28 09:58:54');
INSERT INTO `widgets_blocks_contents` VALUES ('79', '66', '19', '2018-08-28 09:58:54', '2018-08-28 09:58:54');
INSERT INTO `widgets_blocks_contents` VALUES ('80', '67', '19', '2018-08-28 09:58:54', '2018-08-28 09:58:54');
INSERT INTO `widgets_blocks_contents` VALUES ('81', '68', '19', '2018-08-28 09:58:54', '2018-08-28 09:58:54');

-- ----------------------------
-- Table structure for `widgets_blocks_locale_contents`
-- ----------------------------
DROP TABLE IF EXISTS `widgets_blocks_locale_contents`;
CREATE TABLE `widgets_blocks_locale_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widgets_blocks_content_id` int(10) unsigned NOT NULL,
  `locale_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `widgets_blocks_locale_contents_widgets_blocks_content_id_foreign` (`widgets_blocks_content_id`),
  KEY `widgets_blocks_locale_contents_locale_id_foreign` (`locale_id`),
  CONSTRAINT `widgets_blocks_locale_contents_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`),
  CONSTRAINT `widgets_blocks_locale_contents_widgets_blocks_content_id_foreign` FOREIGN KEY (`widgets_blocks_content_id`) REFERENCES `widgets_blocks_contents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of widgets_blocks_locale_contents
-- ----------------------------
INSERT INTO `widgets_blocks_locale_contents` VALUES ('1', 'Recent Works', '1', '1', '2018-08-28 09:54:04', '2018-08-28 10:40:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('2', 'укрпукрукрукрукрукрукр', '1', '2', '2018-08-28 09:54:04', '2018-08-29 06:32:51');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('5', 'Identity', '2', '1', '2018-08-28 09:54:04', '2018-08-28 09:55:55');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('6', 'Дизайн', '2', '2', '2018-08-28 09:54:04', '2018-08-29 07:12:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('9', 'identity', '3', '1', '2018-08-28 09:54:04', '2018-08-28 09:55:55');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('10', 'design', '3', '2', '2018-08-28 09:54:04', '2018-08-29 07:12:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('13', 'a:3:{s:4:\"name\";s:45:\"XFTdIhO7bIaDQ7VNVeZRV59YdJjCzaSyjmCh5AQg.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/XFTdIhO7bIaDQ7VNVeZRV59YdJjCzaSyjmCh5AQg.jpeg\";}', '4', '1', '2018-08-28 09:54:04', '2018-08-28 10:17:20');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('14', 'a:3:{s:4:\"name\";s:45:\"XFTdIhO7bIaDQ7VNVeZRV59YdJjCzaSyjmCh5AQg.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/XFTdIhO7bIaDQ7VNVeZRV59YdJjCzaSyjmCh5AQg.jpeg\";}', '4', '2', '2018-08-28 09:54:04', '2018-08-29 06:38:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('17', 'a:3:{s:4:\"name\";s:45:\"LEumxho44Bvlu03mnb9Na47npC6A4E14vh6QNaeR.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/LEumxho44Bvlu03mnb9Na47npC6A4E14vh6QNaeR.jpeg\";}', '5', '1', '2018-08-28 09:54:04', '2018-08-28 10:17:20');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('18', 'a:3:{s:4:\"name\";s:45:\"LEumxho44Bvlu03mnb9Na47npC6A4E14vh6QNaeR.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/LEumxho44Bvlu03mnb9Na47npC6A4E14vh6QNaeR.jpeg\";}', '5', '2', '2018-08-28 09:54:04', '2018-08-29 06:38:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('21', 'graphic', '6', '1', '2018-08-28 09:54:04', '2018-08-28 10:17:20');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('22', 'else graphic', '6', '2', '2018-08-28 09:54:04', '2018-08-29 06:38:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('25', 'Dashboard', '7', '1', '2018-08-28 09:54:04', '2018-08-28 10:17:20');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('26', 'Dashboard', '7', '2', '2018-08-28 09:54:04', '2018-08-29 06:38:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('29', 'Web Design / Graphic', '8', '1', '2018-08-28 09:54:04', '2018-08-28 10:17:20');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('30', 'Web Design / Graphic', '8', '2', '2018-08-28 09:54:04', '2018-08-29 06:38:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('33', 'Dashboard<br>by Paul Flavius Nechita', '9', '1', '2018-08-28 09:54:04', '2018-08-28 10:17:20');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('34', 'Dashboard<br>by Paul Flavius Nechita', '9', '2', '2018-08-28 09:54:04', '2018-08-29 06:38:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('37', 'Web Design', '10', '1', '2018-08-28 09:54:51', '2018-08-28 09:56:18');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('38', 'Лого', '10', '2', '2018-08-28 09:54:51', '2018-08-29 06:33:26');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('41', 'web-design', '11', '1', '2018-08-28 09:54:51', '2018-08-28 09:56:18');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('42', 'logo', '11', '2', '2018-08-28 09:54:51', '2018-08-29 06:33:26');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('45', 'Graphic', '12', '1', '2018-08-28 09:55:19', '2018-08-28 09:56:35');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('46', 'Графика', '12', '2', '2018-08-28 09:55:19', '2018-08-29 06:33:59');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('49', 'graphic', '13', '1', '2018-08-28 09:55:19', '2018-08-28 09:56:35');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('50', 'graphic', '13', '2', '2018-08-28 09:55:19', '2018-08-29 06:33:59');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('53', 'Logo', '14', '1', '2018-08-28 09:55:29', '2018-08-28 09:56:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('54', 'Что то еще', '14', '2', '2018-08-28 09:55:29', '2018-08-29 06:35:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('57', 'logo', '15', '1', '2018-08-28 09:55:29', '2018-08-28 09:56:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('58', 'else', '15', '2', '2018-08-28 09:55:29', '2018-08-29 06:35:14');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('61', 'a:3:{s:4:\"name\";s:45:\"AY0ubpACplt6NjfE8n0FhzD2JcsCH274nYnHrsH8.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/AY0ubpACplt6NjfE8n0FhzD2JcsCH274nYnHrsH8.jpeg\";}', '16', '1', '2018-08-28 09:57:25', '2018-08-28 10:18:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('62', 'a:3:{s:4:\"name\";s:45:\"AY0ubpACplt6NjfE8n0FhzD2JcsCH274nYnHrsH8.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/AY0ubpACplt6NjfE8n0FhzD2JcsCH274nYnHrsH8.jpeg\";}', '16', '2', '2018-08-28 09:57:25', '2018-08-29 06:39:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('65', 'a:3:{s:4:\"name\";s:45:\"WV6TdVzJOgxk8v29t0UhE4F6LGWDx2Msz8ntSaa9.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/WV6TdVzJOgxk8v29t0UhE4F6LGWDx2Msz8ntSaa9.jpeg\";}', '17', '1', '2018-08-28 09:57:25', '2018-08-28 10:18:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('66', 'a:3:{s:4:\"name\";s:45:\"WV6TdVzJOgxk8v29t0UhE4F6LGWDx2Msz8ntSaa9.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/WV6TdVzJOgxk8v29t0UhE4F6LGWDx2Msz8ntSaa9.jpeg\";}', '17', '2', '2018-08-28 09:57:25', '2018-08-29 06:39:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('69', 'web-design logo', '18', '1', '2018-08-28 09:57:25', '2018-08-28 10:18:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('70', 'else', '18', '2', '2018-08-28 09:57:25', '2018-08-29 06:39:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('73', 'World Clock Widget', '19', '1', '2018-08-28 09:57:25', '2018-08-28 10:18:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('74', 'World Clock Widget', '19', '2', '2018-08-28 09:57:25', '2018-08-29 06:39:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('77', 'Logo / Web Design', '20', '1', '2018-08-28 09:57:25', '2018-08-28 10:18:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('78', 'Logo / Web Design', '20', '2', '2018-08-28 09:57:25', '2018-08-29 06:39:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('81', 'World Clock Widget<br>by Paul Flavius Nechita', '21', '1', '2018-08-28 09:57:25', '2018-08-28 10:18:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('82', 'World Clock Widget<br>by Paul Flavius Nechita', '21', '2', '2018-08-28 09:57:25', '2018-08-29 06:39:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('85', 'a:3:{s:4:\"name\";s:45:\"rDWKIm2MKHUynh8esaxxEaDlByDpM85Zw4FsBlRs.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/rDWKIm2MKHUynh8esaxxEaDlByDpM85Zw4FsBlRs.jpeg\";}', '22', '1', '2018-08-28 09:57:32', '2018-08-28 10:56:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('86', 'a:3:{s:4:\"name\";s:45:\"rDWKIm2MKHUynh8esaxxEaDlByDpM85Zw4FsBlRs.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/rDWKIm2MKHUynh8esaxxEaDlByDpM85Zw4FsBlRs.jpeg\";}', '22', '2', '2018-08-28 09:57:32', '2018-08-29 07:33:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('89', 'a:3:{s:4:\"name\";s:12:\"28215807.mp4\";s:3:\"alt\";N;s:4:\"path\";s:27:\"/storage/media/28215807.mp4\";}', '23', '1', '2018-08-28 09:57:32', '2018-08-28 10:56:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('90', 'a:3:{s:4:\"name\";s:12:\"28215807.mp4\";s:3:\"alt\";N;s:4:\"path\";s:27:\"/storage/media/28215807.mp4\";}', '23', '2', '2018-08-28 09:57:32', '2018-08-29 07:33:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('93', 'graphic logo', '24', '1', '2018-08-28 09:57:32', '2018-08-28 10:56:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('94', 'logo design', '24', '2', '2018-08-28 09:57:33', '2018-08-29 07:33:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('97', 'To-Do Dashboard', '25', '1', '2018-08-28 09:57:33', '2018-08-28 10:56:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('98', 'To-Do Dashboard', '25', '2', '2018-08-28 09:57:33', '2018-08-29 07:33:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('101', 'Graphic / Logo', '26', '1', '2018-08-28 09:57:33', '2018-08-28 10:56:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('102', 'Graphic / Logo', '26', '2', '2018-08-28 09:57:33', '2018-08-29 07:33:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('105', 'To-Do Dashboard<br>by Tiberiu Neamu', '27', '1', '2018-08-28 09:57:33', '2018-08-28 10:56:49');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('106', 'To-Do Dashboard<br>by Tiberiu Neamu', '27', '2', '2018-08-28 09:57:33', '2018-08-29 07:33:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('109', 'a:3:{s:4:\"name\";s:45:\"74WIECZmHnylB8BLuJDNIF1y9kdKoNoTOr08hfA9.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/74WIECZmHnylB8BLuJDNIF1y9kdKoNoTOr08hfA9.jpeg\";}', '28', '1', '2018-08-28 09:57:41', '2018-08-28 10:25:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('110', 'a:3:{s:4:\"name\";s:45:\"74WIECZmHnylB8BLuJDNIF1y9kdKoNoTOr08hfA9.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/74WIECZmHnylB8BLuJDNIF1y9kdKoNoTOr08hfA9.jpeg\";}', '28', '2', '2018-08-28 09:57:41', '2018-08-29 06:41:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('113', 'a:3:{s:4:\"name\";s:45:\"PNLl8u1siXEPz0yD8PU0En0Pj1E0qvbI1uzXlodT.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/PNLl8u1siXEPz0yD8PU0En0Pj1E0qvbI1uzXlodT.jpeg\";}', '29', '1', '2018-08-28 09:57:41', '2018-08-28 10:25:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('114', 'a:3:{s:4:\"name\";s:45:\"PNLl8u1siXEPz0yD8PU0En0Pj1E0qvbI1uzXlodT.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/PNLl8u1siXEPz0yD8PU0En0Pj1E0qvbI1uzXlodT.jpeg\";}', '29', '2', '2018-08-28 09:57:41', '2018-08-29 06:41:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('117', 'web-design graphic', '30', '1', '2018-08-28 09:57:41', '2018-08-28 10:25:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('118', 'graphic', '30', '2', '2018-08-28 09:57:41', '2018-08-29 06:41:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('121', 'Events and More', '31', '1', '2018-08-28 09:57:41', '2018-08-28 10:25:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('122', 'Events and More', '31', '2', '2018-08-28 09:57:41', '2018-08-29 06:41:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('125', 'Web Design / Graphic', '32', '1', '2018-08-28 09:57:41', '2018-08-28 10:25:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('126', 'Web Design / Graphic', '32', '2', '2018-08-28 09:57:41', '2018-08-29 06:41:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('129', 'Events and  More<br>by Tiberiu Neamu', '33', '1', '2018-08-28 09:57:41', '2018-08-28 10:25:23');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('130', 'Events and  More<br>by Tiberiu Neamu', '33', '2', '2018-08-28 09:57:41', '2018-08-29 06:41:24');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('133', 'a:3:{s:4:\"name\";s:45:\"1DfBksfSqCbrGYYziND6HB08iFjiozXr4vZAyQfL.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/1DfBksfSqCbrGYYziND6HB08iFjiozXr4vZAyQfL.jpeg\";}', '34', '1', '2018-08-28 09:57:49', '2018-08-28 10:25:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('134', 'a:3:{s:4:\"name\";s:45:\"1DfBksfSqCbrGYYziND6HB08iFjiozXr4vZAyQfL.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/1DfBksfSqCbrGYYziND6HB08iFjiozXr4vZAyQfL.jpeg\";}', '34', '2', '2018-08-28 09:57:49', '2018-08-29 06:42:33');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('137', 'a:3:{s:4:\"name\";s:45:\"rGtPSCuLCPAElMNwdWJpJ75ORdVobmGxwtwQdSBN.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/rGtPSCuLCPAElMNwdWJpJ75ORdVobmGxwtwQdSBN.jpeg\";}', '35', '1', '2018-08-28 09:57:49', '2018-08-28 10:25:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('138', 'a:3:{s:4:\"name\";s:45:\"rGtPSCuLCPAElMNwdWJpJ75ORdVobmGxwtwQdSBN.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/rGtPSCuLCPAElMNwdWJpJ75ORdVobmGxwtwQdSBN.jpeg\";}', '35', '2', '2018-08-28 09:57:49', '2018-08-29 06:42:33');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('141', 'identity web-design', '36', '1', '2018-08-28 09:57:49', '2018-08-28 10:25:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('142', 'design graphic', '36', '2', '2018-08-28 09:57:49', '2018-08-29 06:42:33');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('145', 'WhereTO App', '37', '1', '2018-08-28 09:57:49', '2018-08-28 10:25:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('146', 'WhereTO App', '37', '2', '2018-08-28 09:57:49', '2018-08-29 06:42:33');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('149', 'Web Design / Identity', '38', '1', '2018-08-28 09:57:49', '2018-08-28 10:25:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('150', 'Web Design / Identity', '38', '2', '2018-08-28 09:57:49', '2018-08-29 06:42:33');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('153', 'WhereTO App<br>by Tiberiu Neamu', '39', '1', '2018-08-28 09:57:49', '2018-08-28 10:25:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('154', 'WhereTO App<br>by Tiberiu Neamu', '39', '2', '2018-08-28 09:57:49', '2018-08-29 06:42:33');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('157', 'a:3:{s:4:\"name\";s:45:\"tpZhkTh36oU3CgmvLav1O9nck6smyrqGGg6scgCV.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/tpZhkTh36oU3CgmvLav1O9nck6smyrqGGg6scgCV.jpeg\";}', '40', '1', '2018-08-28 09:57:57', '2018-08-28 10:26:09');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('158', 'a:3:{s:4:\"name\";s:45:\"tpZhkTh36oU3CgmvLav1O9nck6smyrqGGg6scgCV.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/tpZhkTh36oU3CgmvLav1O9nck6smyrqGGg6scgCV.jpeg\";}', '40', '2', '2018-08-28 09:57:57', '2018-08-29 10:36:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('161', 'a:3:{s:4:\"name\";s:45:\"a7g4Xi6fIgYHN1iDyPsiLb5vuiuxnGtcFxtoNg1K.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/a7g4Xi6fIgYHN1iDyPsiLb5vuiuxnGtcFxtoNg1K.jpeg\";}', '41', '1', '2018-08-28 09:57:57', '2018-08-28 10:26:09');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('162', 'a:3:{s:4:\"name\";s:45:\"a7g4Xi6fIgYHN1iDyPsiLb5vuiuxnGtcFxtoNg1K.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/a7g4Xi6fIgYHN1iDyPsiLb5vuiuxnGtcFxtoNg1K.jpeg\";}', '41', '2', '2018-08-28 09:57:57', '2018-08-29 10:36:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('165', 'identity web-design', '42', '1', '2018-08-28 09:57:57', '2018-08-28 10:26:09');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('166', 'logo else', '42', '2', '2018-08-28 09:57:57', '2018-08-29 10:36:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('169', 'Ski * Buddy', '43', '1', '2018-08-28 09:57:57', '2018-08-28 10:26:09');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('170', 'Ski * Buddy', '43', '2', '2018-08-28 09:57:57', '2018-08-29 10:36:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('173', 'Identity / Web Design', '44', '1', '2018-08-28 09:57:57', '2018-08-28 10:26:09');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('174', 'Identity / Web Design', '44', '2', '2018-08-28 09:57:57', '2018-08-29 10:36:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('177', 'Ski * Buddy<br>by Tiberiu Neamu', '45', '1', '2018-08-28 09:57:57', '2018-08-28 10:26:09');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('178', 'Ski * Buddy<br>by Tiberiu Neamu', '45', '2', '2018-08-28 09:57:57', '2018-08-29 10:36:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('181', 'a:3:{s:4:\"name\";s:45:\"c5Q3aNmCCTCUjC6ZcNRENKfKHAwcrIJaju22DjeB.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/c5Q3aNmCCTCUjC6ZcNRENKfKHAwcrIJaju22DjeB.jpeg\";}', '46', '1', '2018-08-28 09:58:05', '2018-08-28 10:26:25');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('182', 'a:3:{s:4:\"name\";s:45:\"c5Q3aNmCCTCUjC6ZcNRENKfKHAwcrIJaju22DjeB.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/c5Q3aNmCCTCUjC6ZcNRENKfKHAwcrIJaju22DjeB.jpeg\";}', '46', '2', '2018-08-28 09:58:05', '2018-08-29 10:37:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('185', 'a:3:{s:4:\"name\";s:45:\"6Be8nomZ3n3cu7edSB1GsIFnIBzom8gEeoSaLYPi.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/6Be8nomZ3n3cu7edSB1GsIFnIBzom8gEeoSaLYPi.jpeg\";}', '47', '1', '2018-08-28 09:58:05', '2018-08-28 10:26:25');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('186', 'a:3:{s:4:\"name\";s:45:\"6Be8nomZ3n3cu7edSB1GsIFnIBzom8gEeoSaLYPi.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/6Be8nomZ3n3cu7edSB1GsIFnIBzom8gEeoSaLYPi.jpeg\";}', '47', '2', '2018-08-28 09:58:05', '2018-08-29 10:37:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('189', 'graphic logo', '48', '1', '2018-08-28 09:58:05', '2018-08-28 10:26:25');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('190', 'else design', '48', '2', '2018-08-28 09:58:05', '2018-08-29 10:37:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('193', 'Seemple* Music for iPad', '49', '1', '2018-08-28 09:58:05', '2018-08-28 10:26:25');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('194', 'Seemple* Music for iPad', '49', '2', '2018-08-28 09:58:05', '2018-08-29 10:37:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('197', 'Graphic / Logo', '50', '1', '2018-08-28 09:58:05', '2018-08-28 10:26:25');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('198', 'Graphic / Logo', '50', '2', '2018-08-28 09:58:05', '2018-08-29 10:37:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('201', 'Seemple* Music for iPad<br>by Tiberiu Neamu', '51', '1', '2018-08-28 09:58:05', '2018-08-28 10:26:25');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('202', 'Seemple* Music for iPad<br>by Tiberiu Neamu', '51', '2', '2018-08-28 09:58:05', '2018-08-29 10:37:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('205', 'a:3:{s:4:\"name\";s:45:\"EJ8kM63S2ByReNHFzg8uFT90vBYxFL8BRRKIql6J.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/EJ8kM63S2ByReNHFzg8uFT90vBYxFL8BRRKIql6J.jpeg\";}', '52', '1', '2018-08-28 09:58:16', '2018-08-28 10:26:41');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('206', 'a:3:{s:4:\"name\";s:45:\"EJ8kM63S2ByReNHFzg8uFT90vBYxFL8BRRKIql6J.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/EJ8kM63S2ByReNHFzg8uFT90vBYxFL8BRRKIql6J.jpeg\";}', '52', '2', '2018-08-28 09:58:16', '2018-08-29 06:45:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('209', 'a:3:{s:4:\"name\";s:45:\"uysC2s2mPIr19Nb9reVhEcQg6SMkUTLbcheOAUJK.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/uysC2s2mPIr19Nb9reVhEcQg6SMkUTLbcheOAUJK.jpeg\";}', '53', '1', '2018-08-28 09:58:16', '2018-08-28 10:26:41');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('210', 'a:3:{s:4:\"name\";s:45:\"uysC2s2mPIr19Nb9reVhEcQg6SMkUTLbcheOAUJK.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/uysC2s2mPIr19Nb9reVhEcQg6SMkUTLbcheOAUJK.jpeg\";}', '53', '2', '2018-08-28 09:58:16', '2018-08-29 06:45:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('213', 'graphic logo', '54', '1', '2018-08-28 09:58:16', '2018-08-28 10:26:41');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('214', 'graphic', '54', '2', '2018-08-28 09:58:16', '2018-08-29 06:45:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('217', 'Seemple* Music for iPad', '55', '1', '2018-08-28 09:58:16', '2018-08-28 10:26:41');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('218', 'Seemple* Music for iPad', '55', '2', '2018-08-28 09:58:16', '2018-08-29 06:45:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('221', 'Graphic / Logo', '56', '1', '2018-08-28 09:58:16', '2018-08-28 10:26:41');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('222', 'Graphic / Logo', '56', '2', '2018-08-28 09:58:16', '2018-08-29 06:45:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('225', 'Seemple* Music for iPad<br>by Tiberiu Neamu', '57', '1', '2018-08-28 09:58:16', '2018-08-28 10:26:41');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('226', 'Seemple* Music for iPad<br>by Tiberiu Neamu', '57', '2', '2018-08-28 09:58:16', '2018-08-29 06:45:44');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('229', 'a:3:{s:4:\"name\";s:45:\"kf69gwE0aDUbxdssyynGEdmi0U9j3GmaQOFBKnLh.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/kf69gwE0aDUbxdssyynGEdmi0U9j3GmaQOFBKnLh.jpeg\";}', '58', '1', '2018-08-28 09:58:23', '2018-08-28 10:27:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('230', 'a:3:{s:4:\"name\";s:45:\"kf69gwE0aDUbxdssyynGEdmi0U9j3GmaQOFBKnLh.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/kf69gwE0aDUbxdssyynGEdmi0U9j3GmaQOFBKnLh.jpeg\";}', '58', '2', '2018-08-28 09:58:23', '2018-08-29 06:46:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('233', 'a:3:{s:4:\"name\";s:45:\"MfJ0pClO9jV5biAv2Zzg56DRSRfoH1ZhXMdEtkpY.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/MfJ0pClO9jV5biAv2Zzg56DRSRfoH1ZhXMdEtkpY.jpeg\";}', '59', '1', '2018-08-28 09:58:23', '2018-08-28 10:27:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('234', 'a:3:{s:4:\"name\";s:45:\"MfJ0pClO9jV5biAv2Zzg56DRSRfoH1ZhXMdEtkpY.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/MfJ0pClO9jV5biAv2Zzg56DRSRfoH1ZhXMdEtkpY.jpeg\";}', '59', '2', '2018-08-28 09:58:23', '2018-08-29 06:46:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('237', 'graphic web-design', '60', '1', '2018-08-28 09:58:23', '2018-08-28 10:27:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('238', 'logo graphic', '60', '2', '2018-08-28 09:58:23', '2018-08-29 06:46:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('241', 'Shopping Gallery', '61', '1', '2018-08-28 09:58:23', '2018-08-28 10:27:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('242', 'Shopping Gallery', '61', '2', '2018-08-28 09:58:23', '2018-08-29 06:46:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('245', 'Graphic / Logo', '62', '1', '2018-08-28 09:58:23', '2018-08-28 10:27:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('246', 'Graphic / Logo', '62', '2', '2018-08-28 09:58:23', '2018-08-29 06:46:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('249', 'Shopping Gallery<br>by Cosmin Capitanu', '63', '1', '2018-08-28 09:58:23', '2018-08-28 10:27:01');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('250', 'Shopping Gallery<br>by Cosmin Capitanu', '63', '2', '2018-08-28 09:58:23', '2018-08-29 06:46:47');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('253', 'a:3:{s:4:\"name\";s:45:\"yRxXgzEUVtFCCZKk3ausPvOvFXyKWdrISQKzx6AS.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/yRxXgzEUVtFCCZKk3ausPvOvFXyKWdrISQKzx6AS.jpeg\";}', '64', '1', '2018-08-28 09:58:31', '2018-08-28 10:27:38');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('254', 'a:3:{s:4:\"name\";s:45:\"yRxXgzEUVtFCCZKk3ausPvOvFXyKWdrISQKzx6AS.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/yRxXgzEUVtFCCZKk3ausPvOvFXyKWdrISQKzx6AS.jpeg\";}', '64', '2', '2018-08-28 09:58:31', '2018-08-29 10:37:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('257', 'a:3:{s:4:\"name\";s:45:\"Cgy0V8A7WZNpuISRu4l6a7SJI2AIYYqwfwVx8bcI.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/Cgy0V8A7WZNpuISRu4l6a7SJI2AIYYqwfwVx8bcI.jpeg\";}', '65', '1', '2018-08-28 09:58:31', '2018-08-28 10:27:38');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('258', 'a:3:{s:4:\"name\";s:45:\"Cgy0V8A7WZNpuISRu4l6a7SJI2AIYYqwfwVx8bcI.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/Cgy0V8A7WZNpuISRu4l6a7SJI2AIYYqwfwVx8bcI.jpeg\";}', '65', '2', '2018-08-28 09:58:31', '2018-08-29 10:37:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('261', 'graphic logo', '66', '1', '2018-08-28 09:58:31', '2018-08-28 10:27:38');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('262', 'else graphic', '66', '2', '2018-08-28 09:58:31', '2018-08-29 10:37:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('265', 'Timezone Mgmt', '67', '1', '2018-08-28 09:58:31', '2018-08-28 10:27:38');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('266', 'Timezone Mgmt', '67', '2', '2018-08-28 09:58:31', '2018-08-29 10:37:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('269', 'Graphic / Logo', '68', '1', '2018-08-28 09:58:31', '2018-08-28 10:27:38');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('270', 'Graphic / Logo', '68', '2', '2018-08-28 09:58:31', '2018-08-29 10:37:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('273', 'Timezone Mgmt<br>by Cosmin Capitanu', '69', '1', '2018-08-28 09:58:31', '2018-08-28 10:27:38');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('274', 'Timezone Mgmt<br>by Cosmin Capitanu', '69', '2', '2018-08-28 09:58:31', '2018-08-29 10:37:48');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('277', 'a:3:{s:4:\"name\";s:45:\"uxw0PN7aoInSUhvo5uW5ZYelc8HYN2XN5y77poEQ.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/uxw0PN7aoInSUhvo5uW5ZYelc8HYN2XN5y77poEQ.jpeg\";}', '70', '1', '2018-08-28 09:58:46', '2018-08-28 10:27:54');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('278', 'a:3:{s:4:\"name\";s:45:\"uxw0PN7aoInSUhvo5uW5ZYelc8HYN2XN5y77poEQ.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/uxw0PN7aoInSUhvo5uW5ZYelc8HYN2XN5y77poEQ.jpeg\";}', '70', '2', '2018-08-28 09:58:46', '2018-08-29 06:48:30');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('281', 'a:3:{s:4:\"name\";s:45:\"dvVzxUNDXu20BesAwFwFZhdjxn7XwNA8wOT8xjoK.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/dvVzxUNDXu20BesAwFwFZhdjxn7XwNA8wOT8xjoK.jpeg\";}', '71', '1', '2018-08-28 09:58:46', '2018-08-28 10:27:54');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('282', 'a:3:{s:4:\"name\";s:45:\"dvVzxUNDXu20BesAwFwFZhdjxn7XwNA8wOT8xjoK.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/dvVzxUNDXu20BesAwFwFZhdjxn7XwNA8wOT8xjoK.jpeg\";}', '71', '2', '2018-08-28 09:58:46', '2018-08-29 06:48:30');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('285', 'graphic logo', '72', '1', '2018-08-28 09:58:46', '2018-08-28 10:27:54');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('286', 'logo', '72', '2', '2018-08-28 09:58:46', '2018-08-29 06:48:30');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('289', 'Story Book', '73', '1', '2018-08-28 09:58:46', '2018-08-28 10:27:54');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('290', 'Story Book', '73', '2', '2018-08-28 09:58:46', '2018-08-29 06:48:30');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('293', 'Graphic / Logo', '74', '1', '2018-08-28 09:58:46', '2018-08-28 10:27:54');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('294', 'Graphic / Logo', '74', '2', '2018-08-28 09:58:46', '2018-08-29 06:48:30');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('297', 'Story Book<br>by Cosmin Capitanu', '75', '1', '2018-08-28 09:58:46', '2018-08-28 10:27:54');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('298', 'Story Book<br>by Cosmin Capitanu', '75', '2', '2018-08-28 09:58:46', '2018-08-29 06:48:30');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('301', 'a:3:{s:4:\"name\";s:45:\"nKCFHrCgajBG1d9Sh2X9mFZa14RjXdthjvrkFalz.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/nKCFHrCgajBG1d9Sh2X9mFZa14RjXdthjvrkFalz.jpeg\";}', '76', '1', '2018-08-28 09:58:54', '2018-08-28 10:28:11');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('302', 'a:3:{s:4:\"name\";s:45:\"nKCFHrCgajBG1d9Sh2X9mFZa14RjXdthjvrkFalz.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/nKCFHrCgajBG1d9Sh2X9mFZa14RjXdthjvrkFalz.jpeg\";}', '76', '2', '2018-08-28 09:58:54', '2018-08-29 06:49:13');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('305', 'a:3:{s:4:\"name\";s:45:\"RbFMBkAM87Kb0xn2dLbUp13v7vT5uNuM5JwDRaeo.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/RbFMBkAM87Kb0xn2dLbUp13v7vT5uNuM5JwDRaeo.jpeg\";}', '77', '1', '2018-08-28 09:58:54', '2018-08-28 10:28:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('306', 'a:3:{s:4:\"name\";s:45:\"RbFMBkAM87Kb0xn2dLbUp13v7vT5uNuM5JwDRaeo.jpeg\";s:3:\"alt\";N;s:4:\"path\";s:60:\"/storage/media/RbFMBkAM87Kb0xn2dLbUp13v7vT5uNuM5JwDRaeo.jpeg\";}', '77', '2', '2018-08-28 09:58:54', '2018-08-29 06:49:13');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('309', 'identity web-design', '78', '1', '2018-08-28 09:58:54', '2018-08-28 10:28:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('310', 'logo', '78', '2', '2018-08-28 09:58:54', '2018-08-29 06:49:13');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('313', 'Website Lightbox', '79', '1', '2018-08-28 09:58:54', '2018-08-28 10:28:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('314', 'Website Lightbox', '79', '2', '2018-08-28 09:58:54', '2018-08-29 06:49:13');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('317', 'Identity', '80', '1', '2018-08-28 09:58:54', '2018-08-28 10:28:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('318', 'Identity', '80', '2', '2018-08-28 09:58:54', '2018-08-29 06:49:13');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('321', 'Website Lightbox<br>by Paul Flavius Nechita', '81', '1', '2018-08-28 09:58:54', '2018-08-28 10:28:12');
INSERT INTO `widgets_blocks_locale_contents` VALUES ('322', 'Website Lightbox<br>by Paul Flavius Nechita', '81', '2', '2018-08-28 09:58:54', '2018-08-29 06:49:13');

-- ----------------------------
-- Table structure for `widgets_design_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `widgets_design_blocks`;
CREATE TABLE `widgets_design_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `widget_id` int(10) unsigned NOT NULL,
  `design_block_id` int(10) unsigned NOT NULL,
  `parent_design_block` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `widgets_design_blocks_widget_id_foreign` (`widget_id`),
  KEY `widgets_design_blocks_design_block_id_foreign` (`design_block_id`),
  KEY `widgets_design_blocks_parent_design_block_foreign` (`parent_design_block`),
  CONSTRAINT `widgets_design_blocks_design_block_id_foreign` FOREIGN KEY (`design_block_id`) REFERENCES `design_blocks` (`id`),
  CONSTRAINT `widgets_design_blocks_parent_design_block_foreign` FOREIGN KEY (`parent_design_block`) REFERENCES `widgets_design_blocks` (`id`),
  CONSTRAINT `widgets_design_blocks_widget_id_foreign` FOREIGN KEY (`widget_id`) REFERENCES `widgets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of widgets_design_blocks
-- ----------------------------
INSERT INTO `widgets_design_blocks` VALUES ('1', '1', '1', '32', null, '2018-08-28 09:54:04', '2018-08-28 09:54:04');
INSERT INTO `widgets_design_blocks` VALUES ('2', '1', '1', '30', '1', '2018-08-28 09:54:04', '2018-08-28 10:05:42');
INSERT INTO `widgets_design_blocks` VALUES ('3', '1', '1', '27', '2', '2018-08-28 09:54:04', '2018-08-29 07:12:08');
INSERT INTO `widgets_design_blocks` VALUES ('4', '2', '1', '31', '1', '2018-08-28 09:54:04', '2018-08-28 10:05:42');
INSERT INTO `widgets_design_blocks` VALUES ('5', '1', '1', '29', '4', '2018-08-28 09:54:04', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('6', '2', '1', '27', '2', '2018-08-28 09:54:51', '2018-08-29 07:12:08');
INSERT INTO `widgets_design_blocks` VALUES ('7', '3', '1', '27', '2', '2018-08-28 09:55:19', '2018-08-29 07:12:08');
INSERT INTO `widgets_design_blocks` VALUES ('8', '4', '1', '27', '2', '2018-08-28 09:55:29', '2018-08-29 07:12:08');
INSERT INTO `widgets_design_blocks` VALUES ('9', '2', '1', '29', '4', '2018-08-28 09:57:25', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('10', '3', '1', '29', '4', '2018-08-28 09:57:32', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('11', '4', '1', '29', '4', '2018-08-28 09:57:41', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('12', '5', '1', '29', '4', '2018-08-28 09:57:49', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('13', '6', '1', '29', '4', '2018-08-28 09:57:57', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('14', '7', '1', '29', '4', '2018-08-28 09:58:05', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('15', '8', '1', '29', '4', '2018-08-28 09:58:15', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('16', '9', '1', '29', '4', '2018-08-28 09:58:23', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('17', '10', '1', '29', '4', '2018-08-28 09:58:31', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('18', '11', '1', '29', '4', '2018-08-28 09:58:46', '2018-08-29 06:47:51');
INSERT INTO `widgets_design_blocks` VALUES ('19', '12', '1', '29', '4', '2018-08-28 09:58:54', '2018-08-29 06:47:51');
