/*
Navicat MySQL Data Transfer

Source Server         : wamp1.7.4
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : ceshi5

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-10-23 16:29:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rbc_parter
-- ----------------------------
DROP TABLE IF EXISTS `rbc_parter`;
CREATE TABLE `rbc_parter` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT 'id',
  `parter_code` varchar(255) NOT NULL COMMENT '合作商代码',
  `partnersLoginName` varchar(20) default NULL COMMENT '合作商登陆名',
  `partnersName` varchar(50) default NULL COMMENT '合作商全称',
  `partnersAddress` varchar(200) default NULL COMMENT '合作商地址',
  `detailAddress` text COMMENT '详细地址',
  `leaderName` varchar(20) default NULL COMMENT '负责人名称',
  `leaderPhone` varchar(50) default NULL COMMENT '负责人手机',
  `leaderTel` varchar(50) default NULL COMMENT '负责人座机',
  `leaderEmail` varchar(100) default NULL COMMENT '负责人邮箱',
  `leaderWeixin` varchar(100) default NULL COMMENT '负责人微信号',
  `partnersBankAccount` varchar(100) default NULL COMMENT '合作商银行账号',
  `partnersBankAccountName` varchar(50) default NULL COMMENT '合作商银行账户名称',
  `partnersDepositBank` varchar(50) default NULL COMMENT '合作商开户银行',
  `partnersBankAddress` varchar(200) default NULL COMMENT '合作商开户银行地址',
  `parter_share_percent` double(5,0) default NULL COMMENT '合作商分佣比例',
  `pater_emp_share_percent` double default NULL COMMENT '合作商员工建议分佣比例',
  `paymentDate` varchar(0) default NULL COMMENT '结款日',
  `check_state` varchar(255) default '未审核' COMMENT '审核状态',
  `valid_state` varchar(255) default '停用' COMMENT '可用状态',
  `check_man` varchar(255) default NULL COMMENT '审核人',
  `check_man_code` varchar(255) default NULL COMMENT '审核人编号',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
