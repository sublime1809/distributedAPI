/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : cs462

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-04-08 11:28:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `classes`
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of classes
-- ----------------------------

-- ----------------------------
-- Table structure for `signins`
-- ----------------------------
DROP TABLE IF EXISTS `signins`;
CREATE TABLE `signins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_id` varchar(32) NOT NULL,
  `name` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '1',
  `phone` varchar(16) NOT NULL,
  `sign_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of signins
-- ----------------------------
INSERT INTO `signins` VALUES ('1', '1', 'lgunter', 'Leckie Gunter', '385 204-1887', '0000-00-00 00:00:00');
INSERT INTO `signins` VALUES ('2', '1', 'sublime1807', 'Chrys Ramos', '208 695-6442', '2014-04-08 11:20:35');
INSERT INTO `signins` VALUES ('3', '1', 'sclarkson', 'Stephen Clarkson', '208 695-6442', '2014-04-08 11:20:29');
