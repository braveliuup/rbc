/*
Navicat MySQL Data Transfer

Source Server         : wamp5.4local
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : ceshi5

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-10-27 16:52:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_user_address
-- ----------------------------
DROP TABLE IF EXISTS `ecs_user_address`;
CREATE TABLE `ecs_user_address` (
  `address_id` mediumint(8) unsigned NOT NULL auto_increment,
  `address_name` varchar(50) NOT NULL default '',
  `user_id` varchar(10) NOT NULL default '0',
  `consignee` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `country` smallint(5) NOT NULL default '0',
  `province` smallint(5) NOT NULL default '0',
  `city` smallint(5) NOT NULL default '0',
  `district` smallint(5) NOT NULL default '0',
  `address` varchar(120) NOT NULL default '',
  `zipcode` varchar(60) NOT NULL default '',
  `tel` varchar(60) NOT NULL default '',
  `mobile` varchar(60) NOT NULL default '',
  `sign_building` varchar(120) NOT NULL default '',
  `best_time` varchar(120) NOT NULL default '',
  `tel_prefix` varchar(255) NOT NULL,
  `tel_main` varchar(255) NOT NULL,
  `tel_suffix` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL,
  PRIMARY KEY  (`address_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_user_address
-- ----------------------------
INSERT INTO `ecs_user_address` VALUES ('1', '', '1', '刘先生', 'ecshop@ecshop.com', '1', '2', '52', '502', '海兴大厦', '', '010-25851234', '13986765412', '', '', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('2', '', '3', '叶先生', 'text@ecshop.com', '1', '2', '52', '510', '通州区旗舰凯旋小区', '', '13588104710', '', '', '', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('3', '', '6', 'q111', 'admin123@qq.com', '1', '4', '55', '540', '22', '', '333', '', '', '', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('4', '', '8', '111', '444@qq.com', '1', '7', '102', '907', '22', '', '333', '', '', '', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('5', '', '12', '小松', '123456@qq.com', '1', '25', '321', '2709', '中山北路2911号中关村科技大厦2402室', '', '15221019886', '', '', '', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('6', '', '14', '测试', 'xiaocong@qq.com', '1', '25', '321', '2709', '测试', '454545', '4', '545', '4', '5', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('7', '', '15', '1111', '88100139@qq.com', '1', '3', '37', '411', '111', '111', '111', '111', '111', '111', '', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('8', '', '0', '士大夫', '', '1', '0', '0', '0', '阿斯蒂芬', '撒地方', '撒地方', '萨达', '', '', '', '', '', '0');
INSERT INTO `ecs_user_address` VALUES ('9', '', '0', '士大夫', '', '1', '0', '0', '0', '阿斯蒂芬', '撒地方', '撒地方', '萨达', '', '', '', '', '', '0');
INSERT INTO `ecs_user_address` VALUES ('10', '', '0', '士大夫', '', '1', '0', '0', '0', '阿斯蒂芬', '撒地方', '撒地方', '萨达', '', '', '', '', '', '0');
INSERT INTO `ecs_user_address` VALUES ('11', '', '0', '士大夫', '', '1', '2', '5', '6', '阿斯蒂芬', '撒地方', '撒地方', '萨达', '', '', '', '', '', '1');
INSERT INTO `ecs_user_address` VALUES ('12', '', '0', '士大夫', '', '1', '0', '0', '0', '阿斯蒂芬', '撒地方', '撒地方', '萨达', '', '', '', '', '', '0');
INSERT INTO `ecs_user_address` VALUES ('13', '', '0', '', '', '1', '0', '0', '0', '', '', '', '', '', '', '', '', '', '0');
INSERT INTO `ecs_user_address` VALUES ('37', '', 'J123123124', '阿斯蒂芬', '', '1', '3', '36', '400', '撒地方', '撒地方', '', '撒地方', '', '', '123', '123', '123', '1');
INSERT INTO `ecs_user_address` VALUES ('40', '', 'J123123124', '撒的', '', '1', '0', '0', '0', '阿萨德', '阿萨德', '', '撒旦', '', '', '按时', '', '', '');
INSERT INTO `ecs_user_address` VALUES ('45', '', 'J123123124', '', '', '1', '0', '0', '0', '', '', '', '', '', '', '', '', '', '');
