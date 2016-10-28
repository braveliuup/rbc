/*
Navicat MySQL Data Transfer

Source Server         : wamp5.4local
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : ceshi5

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-10-28 01:49:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rbc_parter_staff_info
-- ----------------------------
DROP TABLE IF EXISTS `rbc_parter_staff_info`;
CREATE TABLE `rbc_parter_staff_info` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT 'id',
  `staffID` varchar(50) default NULL COMMENT '员工编号',
  `loginID` varchar(50) default NULL COMMENT '员工登录账号',
  `staffName` varchar(20) default NULL COMMENT '员工姓名',
  `sex` varchar(1) default NULL COMMENT '性别',
  `phone` varchar(50) default NULL COMMENT '员工手机号',
  `commission` int(3) default NULL COMMENT '员工分佣比例',
  `state` varchar(10) default '可用' COMMENT '可用状态',
  `password` varchar(50) default NULL COMMENT '员工登录密码',
  `parter_id` int(11) default NULL COMMENT '所属合作商id',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rbc_parter_staff_info
-- ----------------------------
INSERT INTO `rbc_parter_staff_info` VALUES ('1', null, '1', '1', '女', '1', '1', '可用', '1', '0');
INSERT INTO `rbc_parter_staff_info` VALUES ('2', '2', '1', '1', '男', '1', '12', '可用', '1', '10');
INSERT INTO `rbc_parter_staff_info` VALUES ('3', null, '1', '12', '男', '12', '12', '可用', '1', '0');
INSERT INTO `rbc_parter_staff_info` VALUES ('4', 'J1231231244', '1', '1', '男', '1', '1', '可用', '1', '10');
INSERT INTO `rbc_parter_staff_info` VALUES ('5', null, '222', '22', '男', '2222', '22', '可用', '222', '0');
