/*
Navicat MySQL Data Transfer

Source Server         : wamp1.7.4
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : ceshi5

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-10-30 14:51:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rbc_pay_for_another
-- ----------------------------
DROP TABLE IF EXISTS `rbc_pay_for_another`;
CREATE TABLE `rbc_pay_for_another` (
  `pay_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `user_name` varchar(255) default NULL,
  `user_phone` varchar(255) default NULL,
  `check_emp_id` int(11) default NULL,
  `check_emp_name` varchar(255) default NULL,
  `check_emp_phone` varchar(255) default NULL,
  `pay_total` varchar(255) default NULL,
  `apply_for_date` datetime default NULL,
  `pay_status` varchar(255) default NULL,
  `parter_id` int(11) default NULL,
  PRIMARY KEY  (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rbc_pay_for_another
-- ----------------------------
INSERT INTO `rbc_pay_for_another` VALUES ('1', '1', 'sadf', '123213', '8', 'asdfasd', '123123', '123123', '2016-10-30 12:00:00', '未审核代付', '8');
