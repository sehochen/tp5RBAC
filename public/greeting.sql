/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : greeting

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-14 14:41:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1552029790', '58');
INSERT INTO `t_admin` VALUES ('36', 'seho', '14e1b600b1fd579f47433b88e8d85291', '1552466195', '59');
INSERT INTO `t_admin` VALUES ('39', 'bool', 'c3284d0f94606de1fd2af172aba15bf3', '1552525605', '60');
INSERT INTO `t_admin` VALUES ('41', '66666', 'e10adc3949ba59abbe56e057f20f883e', '1552543173', '1');

-- ----------------------------
-- Table structure for t_auth
-- ----------------------------
DROP TABLE IF EXISTS `t_auth`;
CREATE TABLE `t_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '模块',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL DEFAULT '' COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '基别',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth
-- ----------------------------
INSERT INTO `t_auth` VALUES ('101', '管理员管理', '0', '', '', '101', '0');
INSERT INTO `t_auth` VALUES ('102', '角色管理', '101', 'role', 'index', '101-102', '1');
INSERT INTO `t_auth` VALUES ('103', '菜单管理', '101', 'auth', 'index', '101-103', '1');
INSERT INTO `t_auth` VALUES ('104', '文章管理', '0', '', '', '104', '0');
INSERT INTO `t_auth` VALUES ('105', '文章列表', '104', 'article', 'index', '104-105', '1');
INSERT INTO `t_auth` VALUES ('106', '用户列表', '101', 'admin', 'index', '101-106', '1');
INSERT INTO `t_auth` VALUES ('107', '图片管理', '0', '', '', '107', '0');
INSERT INTO `t_auth` VALUES ('108', '图片列表', '107', 'Photoshop', 'index', '107-108', '1');
INSERT INTO `t_auth` VALUES ('109', '系统设置', '0', '', '', '109', '0');
INSERT INTO `t_auth` VALUES ('110', '网站配置', '109', 'System', 'index', '109-110', '1');

-- ----------------------------
-- Table structure for t_role
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '模块-操作',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_role
-- ----------------------------
INSERT INTO `t_role` VALUES ('1', '普通管理员', '', null);
INSERT INTO `t_role` VALUES ('58', '全栈管理员', '101,102,103,106,104,105', 'role-index,auth-index,article-index,admin-index');
INSERT INTO `t_role` VALUES ('59', '文章管理员', '101,104,105', 'article-index');
INSERT INTO `t_role` VALUES ('60', '系统管理员', '', null);
