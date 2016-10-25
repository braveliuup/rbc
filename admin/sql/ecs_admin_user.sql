/*
Navicat MySQL Data Transfer

Source Server         : wamp1.7.4
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : ceshi5

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-10-26 02:50:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `ecs_admin_user`;
CREATE TABLE `ecs_admin_user` (
  `user_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '员工编号_id',
  `user_name` varchar(60) NOT NULL default '' COMMENT '员工登录名',
  `email` varchar(60) NOT NULL default '',
  `password` varchar(32) NOT NULL default '' COMMENT '密码',
  `ec_salt` varchar(10) default NULL,
  `add_time` int(11) NOT NULL default '0',
  `last_login` int(11) NOT NULL default '0',
  `last_ip` varchar(15) NOT NULL default '',
  `action_list` text NOT NULL,
  `nav_list` text NOT NULL,
  `lang_type` varchar(50) NOT NULL default '',
  `agency_id` smallint(5) unsigned NOT NULL,
  `suppliers_id` smallint(5) unsigned default '0',
  `todolist` longtext,
  `role_id` smallint(5) default NULL,
  `seller_id` int(11) NOT NULL default '0' COMMENT '入驻商家ID',
  `name` varchar(255) default NULL COMMENT '员工姓名',
  `photo` varchar(255) default NULL COMMENT '员工照片_photo',
  `sex` varchar(255) default NULL COMMENT '性别_sex',
  `idcard` varchar(255) default NULL COMMENT '身份证号',
  `birth` varchar(255) default NULL COMMENT '出生日期_birth',
  `education` varchar(255) default NULL COMMENT '学历_edu',
  `depart_id` varchar(11) default NULL COMMENT '部门_emp',
  `title` varchar(255) default NULL COMMENT '职责_title',
  `tel` varchar(255) default NULL COMMENT '办公电话_tel',
  `mobile` varchar(255) default NULL COMMENT '手机号',
  `office_email` varchar(255) default NULL COMMENT '办公Email',
  `qq` varchar(255) default NULL COMMENT '办公QQ',
  `state` varchar(255) default NULL COMMENT '状态_state',
  `address` varchar(255) default NULL COMMENT '住址_addr',
  `detail_address` varchar(255) default NULL COMMENT '详细地址',
  `first_contact_man` varchar(255) default NULL COMMENT '紧急联系人姓名',
  `first_contact_relation` varchar(255) default NULL COMMENT '紧急联系人关系',
  `second_contact_mobile` varchar(255) default NULL COMMENT '备用联系人手机号',
  PRIMARY KEY  (`user_id`),
  KEY `user_name` (`user_name`),
  KEY `agency_id` (`agency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_admin_user
-- ----------------------------
INSERT INTO `ecs_admin_user` VALUES ('1', 'admin', '', '2b9a70d085b10cd8c61378f5c45ee189', '1978', '1398244330', '1477387926', '127.0.0.1', 'all', '商品列表|goods.php?act=list,订单列表|order.php?act=list,用户评论|comment_manage.php?act=list,会员列表|users.php?act=list,商店设置|shop_config.php?act=list_edit', '', '0', '0', null, null, '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ecs_admin_user` VALUES ('2', 'bjgonghuo1', 'bj@163.com', 'd0c015b6eb9a280f318a4c0510581e7e', null, '1245044099', '0', '', '', '商品列表|goods.php?act=list,订单列表|order.php?act=list,用户评论|comment_manage.php?act=list,会员列表|users.php?act=list,商店设置|shop_config.php?act=list_edit', '', '0', '1', '', null, '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ecs_admin_user` VALUES ('3', 'shhaigonghuo1', 'shanghai@163.com', '4146fecce77907d264f6bd873f4ea27b', null, '1245044202', '0', '', '', '商品列表|goods.php?act=list,订单列表|order.php?act=list,用户评论|comment_manage.php?act=list,会员列表|users.php?act=list,商店设置|shop_config.php?act=list_edit', '', '0', '2', '', null, '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ecs_admin_user` VALUES ('4', 'xiaocong', 'xiaocong@qq.com', '85de51928a11919d1ddc76f2615af739', '1542', '1432241828', '1432242035', '127.0.0.1', '0', '商品列表|goods.php?act=list,订单列表|order.php?act=list,用户评论|comment_manage.php?act=list', '', '0', '0', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
