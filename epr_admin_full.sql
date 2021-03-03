/*
 Navicat Premium Data Transfer

 Source Server         : imuzikp3
 Source Server Type    : MySQL
 Source Server Version : 50627
 Source Host           : 192.168.146.252:3307
 Source Schema         : imuzikp3

 Target Server Type    : MySQL
 Target Server Version : 50627
 File Encoding         : 65001

 Date: 24/02/2021 10:40:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for epr_admin
-- ----------------------------
DROP TABLE IF EXISTS `epr_admin`;
CREATE TABLE `epr_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `client_id` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_admin
-- ----------------------------
INSERT INTO `epr_admin` VALUES (1, 'toanhv9', 'NPNjWCGFWoupDsJ0FhRfHBD-ii0NsP1q', '$2y$13$BVxOjksPolRMK3puGx68i.dsf/xeOfuxSlAlC95A8vyqG2RTKnoI.', NULL, 'toanhv9@viettel.com.vn', 1, 1581413346, 1581413346, 'test');

-- ----------------------------
-- Table structure for epr_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `epr_auth_assignment`;
CREATE TABLE `epr_auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `idx-auth_assignment-user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_auth_assignment
-- ----------------------------
INSERT INTO `epr_auth_assignment` VALUES ('admin', '1', 1581414680);

-- ----------------------------
-- Table structure for epr_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `epr_auth_item`;
CREATE TABLE `epr_auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_auth_item
-- ----------------------------
INSERT INTO `epr_auth_item` VALUES ('/*', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/admin/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/assignment/*', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/assignment/assign', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/assignment/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/assignment/view', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/default/*', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/default/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/menu/*', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/menu/create', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/menu/delete', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/menu/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/menu/update', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/menu/view', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/*', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/assign', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/create', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/delete', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/remove', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/update', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/permission/view', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/*', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/assign', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/create', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/delete', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/remove', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/update', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/role/view', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/route/*', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/route/assign', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/route/create', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/route/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/route/refresh', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/route/remove', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/rule/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/rule/create', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/rule/delete', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/rule/index', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/rule/update', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/rule/view', 2, NULL, NULL, NULL, 1581412812, 1581412812);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/activate', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/change-password', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/delete', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/login', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/logout', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/reset-password', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/signup', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/admin/user/view', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/app/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/background/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/background/create', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/background/delete', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/background/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/background/update', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/background/view', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/charging-log/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/charging-log/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/default/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/default/db-explain', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/default/download-mail', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/default/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/default/toolbar', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/default/view', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/user/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/debug/user/set-identity', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enteprise/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enteprise/create', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enteprise/delete', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enteprise/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enteprise/update', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enteprise/view', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enterprise-rbt/*', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/enterprise-rbt/create', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enterprise-rbt/delete', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/enterprise-rbt/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/enterprise-rbt/update', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/enterprise-rbt/view', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/default/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/default/action', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/default/diff', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/default/index', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/default/preview', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gii/default/view', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gridview/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gridview/export/*', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/gridview/export/download', 2, NULL, NULL, NULL, 1581412813, 1581412813);
INSERT INTO `epr_auth_item` VALUES ('/info/*', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/info/create', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/info/delete', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/info/index', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/info/update', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/info/view', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/*', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/cp', 2, NULL, NULL, NULL, 1581482365, 1581482365);
INSERT INTO `epr_auth_item` VALUES ('/profile/create', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/delete', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/index', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/record', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/update', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/upload', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/profile/view', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/site/*', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/site/captcha', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/site/error', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/site/index', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/site/login', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/site/logout', 2, NULL, NULL, NULL, 1581412814, 1581412814);
INSERT INTO `epr_auth_item` VALUES ('/site/upload', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user-rbt/*', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user-rbt/create', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user-rbt/delete', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user-rbt/index', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user-rbt/update', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user-rbt/view', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user/*', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user/create', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user/delete', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user/index', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user/update', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/user/view', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/voices/*', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/voices/create', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/voices/delete', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/voices/index', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/voices/update', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('/voices/view', 2, NULL, NULL, NULL, 1581412815, 1581412815);
INSERT INTO `epr_auth_item` VALUES ('admin', 1, 'admin', NULL, NULL, 1581412800, 1581412800);

-- ----------------------------
-- Table structure for epr_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `epr_auth_item_child`;
CREATE TABLE `epr_auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_auth_item_child
-- ----------------------------
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/assignment/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/assignment/assign');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/assignment/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/assignment/revoke');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/assignment/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/default/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/default/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/menu/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/menu/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/menu/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/menu/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/menu/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/menu/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/assign');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/remove');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/permission/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/assign');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/remove');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/role/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/route/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/route/assign');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/route/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/route/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/route/refresh');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/route/remove');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/rule/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/rule/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/rule/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/rule/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/rule/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/rule/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/activate');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/change-password');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/login');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/logout');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/request-password-reset');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/reset-password');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/signup');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/admin/user/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/app/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/background/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/background/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/background/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/background/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/background/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/background/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/charging-log/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/charging-log/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/default/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/default/db-explain');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/default/download-mail');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/default/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/default/toolbar');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/default/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/user/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/user/reset-identity');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/debug/user/set-identity');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enteprise/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enteprise/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enteprise/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enteprise/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enteprise/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enteprise/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enterprise-rbt/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enterprise-rbt/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enterprise-rbt/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enterprise-rbt/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enterprise-rbt/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/enterprise-rbt/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/default/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/default/action');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/default/diff');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/default/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/default/preview');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gii/default/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gridview/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gridview/export/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/gridview/export/download');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/info/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/info/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/info/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/info/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/info/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/info/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/record');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/upload');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/profile/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/captcha');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/error');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/login');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/logout');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/site/upload');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user-rbt/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user-rbt/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user-rbt/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user-rbt/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user-rbt/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user-rbt/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/user/view');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/voices/*');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/voices/create');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/voices/delete');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/voices/index');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/voices/update');
INSERT INTO `epr_auth_item_child` VALUES ('admin', '/voices/view');

-- ----------------------------
-- Table structure for epr_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `epr_auth_rule`;
CREATE TABLE `epr_auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for epr_background
-- ----------------------------
DROP TABLE IF EXISTS `epr_background`;
CREATE TABLE `epr_background`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_background
-- ----------------------------
INSERT INTO `epr_background` VALUES (11, 'Nhạc nền 1', '/background/1.mp3');
INSERT INTO `epr_background` VALUES (12, 'Nhạc nền 2', '/background/2.mp3');
INSERT INTO `epr_background` VALUES (13, 'Nhạc nền 3', '/background/3.mp3');
INSERT INTO `epr_background` VALUES (14, 'Nhạc nền 4', '/background/4.mp3');
INSERT INTO `epr_background` VALUES (15, 'Nhạc nền 5', '/background/5.mp3');
INSERT INTO `epr_background` VALUES (16, 'Nhạc nền 6', '/background/6.mp3');
INSERT INTO `epr_background` VALUES (17, 'Nhạc nền 7', '/background/7.mp3');

-- ----------------------------
-- Table structure for epr_charging_log
-- ----------------------------
DROP TABLE IF EXISTS `epr_charging_log`;
CREATE TABLE `epr_charging_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `msisdn` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Số điện thoại',
  `fee` decimal(10, 0) NULL DEFAULT 0 COMMENT 'Phí',
  `cmd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Lệnh',
  `error_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Mã lỗi',
  `charged_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT 'Trừ lúc',
  `enterprise_file_id` bigint(20) UNSIGNED NULL DEFAULT 0 COMMENT 'Bài hát',
  `enterprise_id` bigint(20) UNSIGNED NULL DEFAULT 0 COMMENT 'Doanh nghiệp',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Content',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_charging_log
-- ----------------------------
INSERT INTO `epr_charging_log` VALUES (1, '972333327', 550000, 'CHARGE', '0', '2020-02-27 15:20:28', 385, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (2, '972333327', 550000, 'CHARGE', '0', '2020-02-27 16:47:12', 0, 0, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (3, '972333327', 550000, 'CHARGE', '0', '2020-02-27 16:48:01', 0, 0, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (4, '972333327', 550000, 'CHARGE', '0', '2020-02-27 16:50:17', 0, 0, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (5, '972333327', 550000, 'CHARGE', '0', '2020-02-27 16:54:07', 0, 0, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (6, '972333327', 550000, 'CHARGE', '0', '2020-02-27 16:59:42', 0, 0, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (7, '972333327', 550000, 'CHARGE', '0', '2020-02-27 17:09:56', 387, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (8, '972333327', 550000, 'CHARGE', '0', '2020-02-27 17:21:45', 388, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (9, '972333327', 550000, 'CHARGE', '0', '2020-02-27 17:25:20', 389, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (10, '972333327', 550000, 'CHARGE', '0', '2020-02-27 17:27:53', 390, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (11, '972333327', 550000, 'CHARGE', '0', '2020-02-28 08:51:55', 391, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (12, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:25:24', 392, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (13, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:27:28', 393, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (14, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:34:37', 394, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (15, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:37:06', 395, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (16, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:38:42', 396, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (17, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:39:58', 397, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (18, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:43:11', 398, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (19, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:46:08', 399, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (20, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:48:13', 400, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (21, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:49:37', 401, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (22, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:52:03', 402, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (23, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:53:58', 403, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (24, '972333327', 550000, 'CHARGE', '0', '2020-02-28 09:57:38', 404, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (25, '972333327', 550000, 'CHARGE', '0', '2020-02-28 10:06:57', 406, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (26, '972333327', 550000, 'CHARGE', '0', '2020-02-28 10:07:49', 407, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');
INSERT INTO `epr_charging_log` VALUES (27, '972333327', 550000, 'CHARGE', '0', '2020-03-02 09:11:17', 414, 125, 'CHARGE|IMZBUSINESS|TTVAS|972333327|||');

-- ----------------------------
-- Table structure for epr_enteprise
-- ----------------------------
DROP TABLE IF EXISTS `epr_enteprise`;
CREATE TABLE `epr_enteprise`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Trạng thái',
  `created_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Tạo lúc',
  `updated_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Cập nhật lúc',
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL COMMENT 'Người sửa',
  `msisdn` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số điện thoại',
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ tên',
  `id_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số chứng minh thư',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `msisdn`(`msisdn`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 137 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_enteprise
-- ----------------------------
INSERT INTO `epr_enteprise` VALUES (2, 'dinhlan1@gmail.com', 1, '2020-02-12 17:24:12', NULL, NULL, '978263886', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (29, '', 1, '2020-02-13 16:33:14', NULL, NULL, '978263888', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (33, 'landt@yahoo.com', 1, '2020-02-13 16:45:26', NULL, NULL, '978263881', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (34, 'abc@co.vn', 1, '2020-02-13 16:47:53', NULL, NULL, '978263882', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (35, 'abc-cd.ef@yahoo.com', 1, '2020-02-13 16:48:30', NULL, NULL, '978263883', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (36, 'abc-cd.ef@yahoo.com', 1, '2020-02-13 16:51:05', NULL, NULL, '978263884', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (37, 'abc-cd.ef@yahoo.com', 1, '2020-02-13 16:52:09', NULL, NULL, '978263885', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (105, 'abc-cd.ef5@yahoo.com', 1, '2020-02-14 13:57:41', NULL, NULL, '978263887', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (107, 'abc-cd.ef5@yahoo.com', 1, '2020-02-14 15:25:43', NULL, NULL, '978263889', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (109, 'abc-cd.ef5@yahoo.com', 1, '2020-02-14 15:28:15', NULL, NULL, '978263901', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (110, 'abc-cd.e@yahoo.com', 1, '2020-02-14 17:34:14', NULL, NULL, '978263902', '', '', '', NULL, NULL);
INSERT INTO `epr_enteprise` VALUES (125, 'phongnhh92@gmail.com', 1, '2020-02-18 16:53:11', '2020-02-18 16:54:07', NULL, '972333327', 'Nguyễn Hồ Hồng Phong', '187192444', 'a93ca660ddf9e821d5bce9c79593cbe5d7a596cb', 'GUR4u3spdn8osURgIIzvF7D355lsn2Wx_1582019075', 'HdDN4qVGJOlk9DToEWf6Pr9v3uVLJ3om');
INSERT INTO `epr_enteprise` VALUES (126, 'toanhv@viettel.com.vn', 1, '2020-02-19 09:56:21', '2020-02-19 09:56:21', NULL, '393636707', 'Toan', '038085003879', '6a433695dbd4feb006ac3d04855fd416b78e4e7b', 'FVJOu369M1gI6n-7_QWJ4epRsn8QWcVt_1582080981', 'j53qwQj3UeLlmuNBNoxEy3IJUHxInNMT');
INSERT INTO `epr_enteprise` VALUES (128, 'phongnhh9s2@gmail.com', 1, '2020-02-19 10:10:45', '2020-02-19 10:10:45', NULL, '972333372', 'Nguyễn Hồ Hồng Phong', '192334466', 'e22cecca5937a343f458bf6df8e72d675beed179', '-n90KSii9nfBAp3xUS9mIk0h9sOiwJAG_1582081274', 'Um5hRHkrBihX0Tjt4NBAlqZY72CfC5yh');
INSERT INTO `epr_enteprise` VALUES (130, 'phongnhh9s2aac@gmail.com', 1, '2020-03-02 08:44:52', '2020-03-02 08:44:52', NULL, '972333321', 'Nguyễn Hồ Hồng Phong', '132654978', 'fb4cd01300c8f9418f29a77c2dc727e29b321506', 'O-iEyFwDLTyke9UfnIWs3V2pp5TwbWQ6_1583112911', 'M-HpzRAazQ404i1rQA_OpPcPKo-SaFw_');
INSERT INTO `epr_enteprise` VALUES (131, 'leduong1987@gmail.com', 1, '2020-03-05 15:23:53', '2020-03-05 15:23:53', NULL, '973462530', 'Lê Dương', '123456789', 'de52d376809fd5247cab21c4ff00456b6c53cc1f', 'hTt9MqAafHBtIY1ncRlWs5kPeHNezFbX_1583396633', 'gY2MlfLlRZqdoYhN8-wLpSixJYoZ6dQa');
INSERT INTO `epr_enteprise` VALUES (132, 'phongnhh9zzzz2@gmail.com', 1, '2020-03-06 19:18:44', '2020-03-06 19:18:44', NULL, '234567890', 'Nguyễn Hồ Hồng Phong', '132546978', '38432cd7e44a8072f897bf37ce926ea4c794c6a7', 'GwFOmV4ZCGfE-E8mLdr8J91qeuV9Lob7_1583496544', 'MBT6omEdlGuxc4LX0vil97Ow_URnuLR8');
INSERT INTO `epr_enteprise` VALUES (133, 'phongnhh92nz@gmail.com', 1, '2020-03-06 20:22:11', '2020-03-06 20:22:11', NULL, '972333328', 'Nguyễn Hồ Hồng Phong', '1325469178', '38e39c281353ebb08bf023331cc2dbd2db8bf2b0', 'OYy5Pt00MdXLuVYF7TAB3FItWqN6NLW__1583500351', 'JR2Th8Z7qgAAmiPG17gvy6JZJDCUBA9X');
INSERT INTO `epr_enteprise` VALUES (134, 'phongnzzxhh92@gmail.com', 1, '2020-03-08 20:19:37', '2020-03-08 20:19:37', NULL, '987989741', 'Nguyễn Hồ Hồng Phong', '1325469178', '1e5a5beedf4fdd2159f8498b013a8f7bc9f9efbb', 'QYPAAnPqUw5gvCWYDLg0Ylel92cSV-0F_1583672997', 'lMKwwwhsy2E4eNB7MrWqDxXGKcLgjYAp');
INSERT INTO `epr_enteprise` VALUES (135, 'phongzxvasfnhh92@gmail.com', 1, '2020-03-09 08:15:55', '2020-03-09 08:15:55', NULL, '976332123', 'Nguyễn Hồ Hồng Phong', '1325469178', 'e1c7fa9d4fc98e69f556bc89875a5f134eb3552f', 'GSqLqs9xojWY9Lk3HO4eO12eFVoS0fmJ_1583715975', '7xBz4VHLyg6apIRlxCxV7NJDT38GfXtQ');
INSERT INTO `epr_enteprise` VALUES (136, 'phongnhhz92@gmail.com', 1, '2020-03-09 08:24:30', '2020-03-09 08:24:30', NULL, '976322123', 'Nguyễn Hồ Hồng Phong', '1325469178', 'd4cd1563006a2cc3d702dc56c3a2a9b277a81f9d', 'JYmNtGcmb-GxF1iS0thOEzJcYPCoxMss_1583716490', 'p-D3naaHymi2hCnN64mESSMHCNprkSGU');

-- ----------------------------
-- Table structure for epr_enterprise_file
-- ----------------------------
DROP TABLE IF EXISTS `epr_enterprise_file`;
CREATE TABLE `epr_enterprise_file`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) UNSIGNED NOT NULL COMMENT 'Doanh nghiệp',
  `accent` tinyint(1) UNSIGNED NULL DEFAULT NULL COMMENT 'Giọng đọc',
  `region` tinyint(1) UNSIGNED NULL DEFAULT NULL COMMENT 'Miền',
  `intonational` tinyint(1) UNSIGNED NULL DEFAULT NULL COMMENT 'Ngữ điệu',
  `business_license` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Giấy phép kinh doanh',
  `copyright_license` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Giấy tờ bản quyền',
  `recording_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'Nội dung thu âm',
  `sound_background` tinyint(1) UNSIGNED NULL DEFAULT NULL COMMENT 'Nhạc nền',
  `requires_recording` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Yêu cầu thu âm',
  `recording_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'File mp3',
  `msisdn_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'DS sđt kích hoạt',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '0:Khởi tạo; 1: Chờ phê duyệt; 3: Phê duyệt; 4: Từ chối duyệt',
  `created_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Tạo lúc',
  `updated_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Cập nhật lúc',
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL COMMENT 'Cập nhật bởi',
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Lý do từ chối duyệt',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Tên doanh nghiệp',
  `brand_id` int(3) UNSIGNED NULL DEFAULT 2 COMMENT 'brand_id gói cước crbt',
  `source` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'web' COMMENT 'Nguồn tạo hồ sơ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 504 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_enterprise_file
-- ----------------------------
INSERT INTO `epr_enterprise_file` VALUES (1, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, '/rbt/3c/f3/33/5e428c506e406.mp3', '/docs/a1/a8/8a/5e428c506c739.txt', 0, '2020-02-11 18:13:20', '2020-02-11 18:13:20', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (2, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, '/rbt/2a/ca/a2/5e428d0f5a5c3.mp3', '/docs/81/d6/68/5e428d0f5856c.txt', 1, '2020-02-11 18:16:31', '2020-02-11 18:16:31', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (3, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, '/rbt/e8/58/8e/5e428d2cba106.mp3', '/docs/00/cf/f0/5e428d2cb82e1.txt', 4, '2020-02-11 18:17:00', '2020-02-11 18:17:00', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (4, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, NULL, '/docs/a1/d6/6a/5e437043874c0.txt', 5, '2020-02-12 10:25:55', '2020-02-12 10:25:55', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (5, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, '/rbt/07/1e/e0/5e43709cb9519.mp3', '/docs/b4/9e/eb/5e43709cb66f4.txt', 3, '2020-02-12 10:27:25', '2020-02-12 10:27:25', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (6, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, '/rbt/60/e9/96/5e4370c85e4a2.mp3', '/docs/ec/74/4e/5e4370c85b4fd.txt', 3, '2020-02-12 10:28:08', '2020-02-12 10:28:08', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (7, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, NULL, '/docs/2b/d2/22/5e437120088b0.txt', 3, '2020-02-12 10:29:36', '2020-02-12 10:29:36', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (8, 2, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, '/rbt/f4/d1/1f/5e43d24cebb76.mp3', '/docs/de/e7/7d/5e43d24cea000.txt', 6, '2020-02-12 17:24:13', '2020-02-12 17:24:13', NULL, NULL, 'Ten bai hat Lan test', 471, 'test');
INSERT INTO `epr_enterprise_file` VALUES (9, 2, NULL, NULL, NULL, '', NULL, NULL, NULL, 4, NULL, '/docs/c7/bc/cc/5e44b73209439.txt', 6, '2020-02-13 09:40:50', '2020-02-13 09:40:50', NULL, NULL, 'Ten bai hat Lan test', 471, 'test');
INSERT INTO `epr_enterprise_file` VALUES (10, 13, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/3f/79/93/5e44cc69a932b.mp3', '/docs/dc/66/6d/5e44cc69a7892.txt', 6, '2020-02-13 11:11:21', '2020-02-13 11:11:21', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (11, 13, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, NULL, '/docs/48/bb/b4/5e44cc8d4a02c.txt', 6, '2020-02-13 11:11:57', '2020-02-13 11:11:57', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (12, 13, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, NULL, '/docs/01/dd/d0/5e44cc9029db8.txt', 6, '2020-02-13 11:12:00', '2020-02-13 11:12:00', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (13, 13, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, NULL, NULL, 6, '2020-02-13 11:13:55', '2020-02-13 11:13:55', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (14, 16, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/e4/8d/de/5e44ce739301a.mp3', NULL, 6, '2020-02-13 11:20:03', '2020-02-13 11:20:03', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (15, 2, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/fc/49/9f/5e44d0e06e3f0.mp3', NULL, 6, '2020-02-13 11:30:24', '2020-02-13 11:30:24', NULL, NULL, 'Ten bai hat Lan test', 471, 'test');
INSERT INTO `epr_enterprise_file` VALUES (16, 2, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/2b/95/52/5e44d1115dd4d.mp3', NULL, 6, '2020-02-13 11:31:13', '2020-02-13 11:31:13', NULL, NULL, 'Ten bai hat Lan test', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (17, 16, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/bd/17/7b/5e44d31019a51.mp3', NULL, 6, '2020-02-13 11:39:44', '2020-02-13 11:39:44', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (18, 16, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/8d/22/28/5e44d37cbc95d.mp3', '/docs/e0/8b/be/5e44d37cba94a.txt', 6, '2020-02-13 11:41:32', '2020-02-13 11:41:32', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (19, 16, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/62/22/26/5e44d3dc64b18.mp3', NULL, 6, '2020-02-13 11:43:08', '2020-02-13 11:43:08', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (20, 2, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/9c/f9/99/5e44d858568f5.mp3', NULL, 6, '2020-02-13 12:02:16', '2020-02-13 12:02:16', NULL, NULL, 'Ten bai hat Lan test 2', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (21, 20, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a9/b2/2a/5e44ff82dfd66.mp3', NULL, 6, '2020-02-13 14:49:23', '2020-02-13 14:49:23', NULL, NULL, 'ten bai !', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (22, 20, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/6c/50/06/5e44ffbdc479a.mp3', NULL, 6, '2020-02-13 14:50:22', '2020-02-13 14:50:22', NULL, NULL, 'ten bai', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (23, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/cc/e5/5c/5e45004213609.mp3', NULL, 6, '2020-02-13 14:52:34', '2020-02-13 14:52:34', NULL, NULL, '1', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (24, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/18/df/f1/5e45005266efa.mp3', NULL, 6, '2020-02-13 14:52:50', '2020-02-13 14:52:50', NULL, NULL, '`', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (25, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c7/65/5c/5e45010dde70e.mp3', NULL, 6, '2020-02-13 14:55:58', '2020-02-13 14:55:58', NULL, NULL, '[', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (26, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/3b/69/93/5e45011457b4a.mp3', NULL, 6, '2020-02-13 14:56:04', '2020-02-13 14:56:04', NULL, NULL, '[', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (27, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/7f/4f/f7/5e45014dae3a9.mp3', NULL, 6, '2020-02-13 14:57:01', '2020-02-13 14:57:01', NULL, NULL, ']', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (28, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/f3/79/9f/5e45016632207.mp3', NULL, 6, '2020-02-13 14:57:26', '2020-02-13 14:57:26', NULL, NULL, ';', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (29, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/fb/e3/3f/5e4501816b0e9.mp3', NULL, 6, '2020-02-13 14:57:53', '2020-02-13 14:57:53', NULL, NULL, '\"', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (30, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/b4/06/6b/5e4501b479e22.mp3', NULL, 6, '2020-02-13 14:58:44', '2020-02-13 14:58:44', NULL, NULL, '/', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (31, 25, 1, 1, 1, '', NULL, 'Với bệnh nhân V., sau khi xác định vợ và 2 con gái bệnh nhân bị mắc bệnh, TTKSBT tỉnh Vĩnh Phúc đã đưa bệnh nhân V. vào danh sách người tiếp xúc gần, được cách ly và theo dõi sức khoẻ hàng ngày. Trong quá trình theo dõi, bệnh nhân không có biểu hiện sốt, ho, khó thở. Tuy nhiên, ngày 11/2/2020, bệnh nhân cảm thấy mệt mỏi thoáng qua, được cán bộ y tế ghi nhận, lấy mẫu và gửi về Viện VSDTTƯ để xét nghiệm. Kết quả xét nghiệm cho thấy bệnh nhân dương tính với virus corona. Với bệnh nhân V., sau khi xác định vợ và 2 con gái bệnh nhân bị mắc bệnh, TTKSBT tỉnh Vĩnh Phúc đã đưa bệnh nhân V. vào danh sách người tiếp xúc gần, được cách ly và theo dõi sức khoẻ hàng ngày. Trong quá trình theo dõi, bệnh nhân không có biểu hiện sốt, ho, khó thở. Tuy nhiên, ngày 11/2/2020, bệnh nhân cảm thấy mệt mỏi thoáng qua, được cán bộ y tế ghi nhận, lấy mẫu và gửi về Viện VSDTTƯ để xét nghiệm. Kết quả xét nghiệm cho thấy bệnh nhân dương tính với virus corona.', 1, 1, NULL, '/docs/bf/47/7b/5e4503e2a317f.txt', 6, '2020-02-13 15:08:02', '2020-02-13 15:08:02', NULL, NULL, 'test xem the nao', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (32, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/4b/75/54/5e4514abf3a5c.mp3', NULL, 6, '2020-02-13 16:19:40', '2020-02-13 16:19:40', NULL, NULL, '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (33, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a9/1f/fa/5e4515c7991c0.mp3', NULL, 6, '2020-02-13 16:24:23', '2020-02-13 16:24:23', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (34, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/b8/b9/9b/5e451729be28d.mp3', NULL, 6, '2020-02-13 16:30:17', '2020-02-13 16:30:17', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (35, 21, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/31/09/93/5e451764f22cf.mp3', NULL, 6, '2020-02-13 16:31:17', '2020-02-13 16:31:17', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (36, 27, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a2/56/6a/5e451775c640e.mp3', NULL, 6, '2020-02-13 16:31:33', '2020-02-13 16:31:33', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (37, 29, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/85/0c/c8/5e4517da4ef3d.mp3', NULL, 6, '2020-02-13 16:33:14', '2020-02-13 16:33:14', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (38, 29, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/f9/6e/ef/5e45180aca7a2.mp3', NULL, 6, '2020-02-13 16:34:02', '2020-02-13 16:34:02', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (39, 29, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/01/88/80/5e45188b49294.mp3', NULL, 6, '2020-02-13 16:36:11', '2020-02-13 16:36:11', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (40, 2, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/fd/2a/af/5e4519be3466c.mp3', NULL, 6, '2020-02-13 16:41:18', '2020-02-13 16:41:18', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (41, 33, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/83/26/68/5e451ab68cacd.mp3', NULL, 6, '2020-02-13 16:45:26', '2020-02-13 16:45:26', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (42, 33, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/4a/a2/24/5e451b0b173e2.mp3', NULL, 6, '2020-02-13 16:46:51', '2020-02-13 16:46:51', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (43, 34, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/4e/43/34/5e451b49a97ea.mp3', NULL, 6, '2020-02-13 16:47:53', '2020-02-13 16:47:53', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (44, 35, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/b3/8f/fb/5e451b6e963b2.mp3', NULL, 6, '2020-02-13 16:48:30', '2020-02-13 16:48:30', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (45, 36, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/52/0b/b5/5e451c09f18fd.mp3', NULL, 6, '2020-02-13 16:51:06', '2020-02-13 16:51:06', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (46, 37, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/cf/83/3c/5e451c49d88f2.mp3', NULL, 6, '2020-02-13 16:52:10', '2020-02-13 16:52:10', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (47, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/4f/11/14/5e451c5a4b324.mp3', NULL, 6, '2020-02-13 16:52:26', '2020-02-13 16:52:26', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (48, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c0/cf/fc/5e451ff62605d.mp3', NULL, 6, '2020-02-13 17:07:50', '2020-02-13 17:07:50', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (49, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a1/9c/ca/5e4520123cb15.mp3', NULL, 6, '2020-02-13 17:08:18', '2020-02-13 17:08:18', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (50, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/f5/09/9f/5e452060eb642.mp3', NULL, 6, '2020-02-13 17:09:37', '2020-02-13 17:09:37', NULL, NULL, 'Ko file', 472, 'test');
INSERT INTO `epr_enterprise_file` VALUES (51, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/4e/e6/64/5e452146d8a2f.mp3', NULL, 6, '2020-02-13 17:13:27', '2020-02-13 17:13:27', NULL, NULL, 'Ko file', NULL, 'test');
INSERT INTO `epr_enterprise_file` VALUES (52, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/52/78/85/5e4521592cd3d.mp3', NULL, 6, '2020-02-13 17:13:45', '2020-02-13 17:13:45', NULL, NULL, 'Ko file', NULL, 'test');
INSERT INTO `epr_enterprise_file` VALUES (53, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c6/48/8c/5e45217a0e1d3.mp3', NULL, 6, '2020-02-13 17:14:18', '2020-02-13 17:14:18', NULL, NULL, 'Ko file', NULL, 'test');
INSERT INTO `epr_enterprise_file` VALUES (54, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/e3/37/7e/5e452183a5b85.mp3', NULL, 6, '2020-02-13 17:14:27', '2020-02-13 17:14:27', NULL, NULL, 'Ko file', 0, 'test');
INSERT INTO `epr_enterprise_file` VALUES (55, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/7c/71/17/5e4521d40ea19.mp3', NULL, 6, '2020-02-13 17:15:48', '2020-02-13 17:15:48', NULL, NULL, 'Ko file', 0, 'test');
INSERT INTO `epr_enterprise_file` VALUES (56, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/1f/f3/31/5e4521f395031.mp3', NULL, 6, '2020-02-13 17:16:19', '2020-02-13 17:16:19', NULL, NULL, 'Ko file', 2, 'test');
INSERT INTO `epr_enterprise_file` VALUES (57, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/1d/84/41/5e45224523063.mp3', NULL, 6, '2020-02-13 17:17:41', '2020-02-13 17:17:41', NULL, NULL, 'Ko file', 0, 'test');
INSERT INTO `epr_enterprise_file` VALUES (58, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/88/05/58/5e4522d3daa59.mp3', NULL, 6, '2020-02-13 17:20:04', '2020-02-13 17:20:04', NULL, NULL, 'Ko file', 1234560, 'test');
INSERT INTO `epr_enterprise_file` VALUES (59, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/d3/9d/dd/5e452302b64dd.mp3', NULL, 6, '2020-02-13 17:20:50', '2020-02-13 17:20:50', NULL, NULL, 'Ko file', 4294967295, 'test');
INSERT INTO `epr_enterprise_file` VALUES (60, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/6e/a4/46/5e452339c4f95.mp3', NULL, 6, '2020-02-13 17:21:45', '2020-02-13 17:21:45', NULL, NULL, 'Ko file', 4294967295, 'test');
INSERT INTO `epr_enterprise_file` VALUES (61, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/5d/9e/e5/5e452397883e8.mp3', NULL, 6, '2020-02-13 17:23:19', '2020-02-13 17:23:19', NULL, NULL, 'Ko file', 4294967295, 'test');
INSERT INTO `epr_enterprise_file` VALUES (62, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/40/e9/94/5e4523a963b77.mp3', NULL, 6, '2020-02-13 17:23:37', '2020-02-13 17:23:37', NULL, NULL, 'Ko file', 4294967295, 'test');
INSERT INTO `epr_enterprise_file` VALUES (63, 38, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/70/8f/f7/5e4524937460f.mp3', NULL, 6, '2020-02-13 17:27:31', '2020-02-13 17:27:31', NULL, NULL, 'Ko file', 4294967295, 'test');
INSERT INTO `epr_enterprise_file` VALUES (64, 95, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạch chủ đột ngột. Ở tuyến đầu phòng chống dịch, khi biết tin mẹ qua đời, Ngô Á Linh cố gắng chịu đựng nỗi đau và khăng khăng tiếp tục công việc. Tối đó, khi về đến ký túc xá, cô đã khóc suốt đêm.', 1, 1, NULL, NULL, 6, '2020-02-14 10:25:06', '2020-02-14 10:25:06', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (65, 96, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạch chủ đột ngột. Ở tuyến đầu phòng chống dịch, khi biết tin mẹ qua đời, Ngô Á Linh cố gắng chịu đựng nỗi đau và khăng khăng tiếp tục công việc. Tối đó, khi về đến ký túc xá, cô đã khóc suốt đêm.', 1, 1, NULL, NULL, 6, '2020-02-14 11:08:18', '2020-02-14 11:08:18', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (66, 96, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạch chủ đột ngột. Ở tuyến đầu phòng chống dịch, khi biết tin mẹ qua đời, Ngô Á Linh cố gắng chịu đựng nỗi đau và khăng khăng tiếp tục công việc. Tối đó, khi về đến ký túc xá, cô đã khóc suốt đêm.', 1, 1, NULL, NULL, 6, '2020-02-14 11:11:13', '2020-02-14 11:11:13', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (67, 96, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạ', 1, 1, NULL, NULL, 6, '2020-02-14 11:12:57', '2020-02-14 11:12:57', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (68, 96, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động m', 1, 1, NULL, NULL, 6, '2020-02-14 11:13:04', '2020-02-14 11:13:04', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (69, 98, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia pho', 1, 1, NULL, NULL, 6, '2020-02-14 11:16:01', '2020-02-14 11:16:01', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (70, 98, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 11:17:39', '2020-02-14 11:17:39', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (71, 100, 1, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 11:23:08', '2020-02-14 11:23:08', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (72, 104, 2, 1, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 11:35:45', '2020-02-14 11:35:45', NULL, NULL, 'Ko file', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (73, 105, 2, 2, 1, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 13:58:37', '2020-02-14 13:58:37', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (74, 105, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 13:59:59', '2020-02-14 13:59:59', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (75, 105, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', NULL, 1, NULL, NULL, 6, '2020-02-14 14:00:36', '2020-02-14 14:00:36', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (76, 105, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', NULL, 1, NULL, NULL, 6, '2020-02-14 14:01:12', '2020-02-14 14:01:12', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (77, 105, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 0, 1, NULL, NULL, 6, '2020-02-14 14:03:41', '2020-02-14 14:03:41', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (78, 105, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 14:04:45', '2020-02-14 14:04:45', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (79, 105, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c6/f0/0c/5e464e6c0b5fb.mp3', NULL, 6, '2020-02-14 14:38:20', '2020-02-14 14:38:20', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (80, 105, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/3a/fd/d3/5e464e7f87e8d.mp3', NULL, 6, '2020-02-14 14:38:39', '2020-02-14 14:38:39', NULL, NULL, 'Type la 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (81, 105, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/06/2e/e0/5e46549345e70.mp3', NULL, 6, '2020-02-14 15:04:35', '2020-02-14 15:04:35', NULL, NULL, 'Type = 1 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (82, 105, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/1d/ae/e1/5e4654aab4645.mp3', NULL, 6, '2020-02-14 15:04:58', '2020-02-14 15:04:58', NULL, NULL, 'Type = 1 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (83, 105, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/b7/64/4b/5e46551871315.mp3', NULL, 6, '2020-02-14 15:06:48', '2020-02-14 15:06:48', NULL, NULL, 'Type = 1 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (84, 105, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c5/9e/ec/5e4655289a318.mp3', NULL, 6, '2020-02-14 15:07:04', '2020-02-14 15:07:04', NULL, NULL, 'Type = 1 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (85, 105, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 15:12:58', '2020-02-14 15:12:58', NULL, NULL, 'Type = 1 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (92, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/eb/c7/7e/5e465a1f57fc2.mp3', NULL, 6, '2020-02-14 15:28:15', '2020-02-14 15:28:15', NULL, NULL, 'Type  2 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (93, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/db/dc/cd/5e465ace5d772.mp3', NULL, 6, '2020-02-14 15:31:10', '2020-02-14 15:31:10', NULL, NULL, 'Type  2 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (94, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/13/e9/91/5e465ae8f072e.mp3', NULL, 6, '2020-02-14 15:31:37', '2020-02-14 15:31:37', NULL, NULL, 'Type  2 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (95, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/d4/74/4d/5e465b8640c69.mp3', NULL, 6, '2020-02-14 15:34:14', '2020-02-14 15:34:14', NULL, NULL, 'Type  2 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (96, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/e5/42/2e/5e465ba558d93.mp3', NULL, 6, '2020-02-14 15:34:45', '2020-02-14 15:34:45', NULL, NULL, 'Type  2 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (97, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a8/5d/da/5e465bb8e1ae4.mp3', NULL, 6, '2020-02-14 15:35:05', '2020-02-14 15:35:05', NULL, NULL, 'Type  2 ten bai bat', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (98, 92, 1, 1, 1, '', NULL, 'Với bệnh nhân V., sau khi xác định vợ và 2 con gái bệnh nhân bị mắc bệnh, TTKSBT tỉnh Vĩnh Phúc đã đưa bệnh nhân V. vào danh sách người tiếp xúc gần, được cách ly và theo dõi sức khoẻ hàng ngày. Trong quá trình theo dõi, bệnh nhân không có biểu hiện sốt, ho, khó thở. Tuy nhiên, ngày 11/2/2020, bệnh nhân cảm thấy mệt mỏi thoáng qua, được cán bộ y tế ghi nhận, lấy mẫu và gửi về Viện VSDTTƯ để xét nghiệm. Kết quả xét nghiệm cho thấy bệnh nhân dương tính với virus corona. Với bệnh nhân V., sau khi xác định vợ và 2 con gái bệnh nhân bị mắc bệnh, TTKSBT tỉnh Vĩnh Phúc đã đưa bệnh nhân V. vào danh sách người tiếp xúc gần, được cách ly và theo dõi sức khoẻ hàng ngày. Trong quá trình theo dõi, bệnh nhân không có biểu hiện sốt, ho, khó thở. Tuy nhiên, ngày 11/2/2020, bệnh nhân cảm thấy mệt mỏi thoáng qua, được cán bộ y tế ghi nhận, lấy mẫu và gửi về Viện VSDTTƯ để xét nghiệm. Kết quả xét nghiệm cho thấy bệnh nhân dương tính với virus corona.', NULL, 1, NULL, '/docs/9f/5c/c9/5e466c87da333.txt', 6, '2020-02-14 16:46:47', '2020-02-14 16:46:47', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (99, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/6a/21/16/5e466f35b64fe.mp3', NULL, 6, '2020-02-14 16:58:13', '2020-02-14 16:58:13', NULL, NULL, 'Lan test type 1', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (100, 109, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 16:58:45', '2020-02-14 16:58:45', NULL, NULL, 'Lan test type 2', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (101, 109, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 17:01:30', '2020-02-14 17:01:30', NULL, NULL, 'Lan test type 1 co danh sach', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (102, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/b7/5c/cb/5e46701203912.mp3', NULL, 6, '2020-02-14 17:01:54', '2020-02-14 17:01:54', NULL, NULL, 'Lan test type 1 co danh sach', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (103, 92, 1, 1, 1, '', NULL, 'Với bệnh nhân V., sau khi xác định vợ và 2 con gái bệnh nhân bị mắc bệnh, TTKSBT tỉnh Vĩnh Phúc đã đưa bệnh nhân V. vào danh sách người tiếp xúc gần, được cách ly và theo dõi sức khoẻ hàng ngày. Trong quá trình theo dõi, bệnh nhân không có biểu hiện sốt, ho, khó thở. Tuy nhiên, ngày 11/2/2020, bệnh nhân cảm thấy mệt mỏi thoáng qua, được cán bộ y tế ghi nhận, lấy mẫu và gửi về Viện VSDTTƯ để xét nghiệm. Kết quả xét nghiệm cho thấy bệnh nhân dương tính với virus corona. Với bệnh nhân V., sau khi xác định vợ và 2 con gái bệnh nhân bị mắc bệnh, TTKSBT tỉnh Vĩnh Phúc đã đưa bệnh nhân V. vào danh sách người tiếp xúc gần, được cách ly và theo dõi sức khoẻ hàng ngày. Trong quá trình theo dõi, bệnh nhân không có biểu hiện sốt, ho, khó thở. Tuy nhiên, ngày 11/2/2020, bệnh nhân cảm thấy mệt mỏi thoáng qua, được cán bộ y tế ghi nhận, lấy mẫu và gửi về Viện VSDTTƯ để xét nghiệm. Kết quả xét nghiệm cho thấy bệnh nhân dương tính với virus corona.', NULL, 1, NULL, '/docs/61/8b/b6/5e4670dc7615f.txt', 6, '2020-02-14 17:05:16', '2020-02-14 17:05:16', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (104, 109, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/e5/81/1e/5e467185b13f7.mp3', NULL, 6, '2020-02-14 17:08:05', '2020-02-14 17:08:05', NULL, NULL, 'Lan test type 1 co danh sach', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (105, 109, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 17:09:02', '2020-02-14 17:09:02', NULL, NULL, 'Lan test type 1 co danh sach', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (106, 109, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 17:15:10', '2020-02-14 17:15:10', NULL, NULL, 'ten bai hat Lan test ten bai hat Lan test ten bai hat Lan test ten bai hat Lan test ten bai hat Lant', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (107, 109, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-14 17:21:12', '2020-02-14 17:21:12', NULL, NULL, 'Ten 1', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (108, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/7b/40/07/5e4677a666e41.mp3', NULL, 6, '2020-02-14 17:34:14', '2020-02-14 17:34:14', NULL, NULL, 'Ten 1', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (109, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/16/5f/f1/5e46784f08686.mp3', NULL, 6, '2020-02-14 17:37:03', '2020-02-14 17:37:03', NULL, NULL, 'Ten 1', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (110, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/ba/0b/bb/5e4678a0570c6.mp3', '/docs/38/a7/73/5e4678a053221.txt', 6, '2020-02-14 17:38:24', '2020-02-14 17:38:24', NULL, NULL, 'Ten 1', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (114, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a4/9f/fa/5e4679305221b.mp3', NULL, 6, '2020-02-14 17:40:48', '2020-02-14 17:40:48', NULL, NULL, 'Ten 1', 3, 'test');
INSERT INTO `epr_enterprise_file` VALUES (115, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/16/b1/11/5e467a1c40d25.mp3', NULL, 6, '2020-02-14 17:44:44', '2020-02-14 17:44:44', NULL, NULL, 'Ten 1', 0, 'test');
INSERT INTO `epr_enterprise_file` VALUES (116, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/81/a3/38/5e467a48c1ce1.mp3', NULL, 6, '2020-02-14 17:45:28', '2020-02-14 17:45:28', NULL, NULL, 'Ten 1', 1000, 'test');
INSERT INTO `epr_enterprise_file` VALUES (117, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/ce/17/7c/5e467a572c712.mp3', NULL, 6, '2020-02-14 17:45:43', '2020-02-14 17:45:43', NULL, NULL, 'Ten 1', 999, 'test');
INSERT INTO `epr_enterprise_file` VALUES (119, 110, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 0, 1, NULL, NULL, 6, '2020-02-14 17:50:50', '2020-02-14 17:50:50', NULL, NULL, 'Ten 1', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (124, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/b3/ab/bb/5e467f181b136.mp3', '/docs/b3/eb/bb/5e467f18195ff.txt', 6, '2020-02-14 18:06:00', '2020-02-14 18:06:00', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (125, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/a0/1c/ca/5e467f4f5bc25.mp3', '/docs/52/aa/a5/5e467f4f569ad.txt', 6, '2020-02-14 18:06:55', '2020-02-14 18:06:55', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (126, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/d7/fd/dd/5e467f6816065.mp3', '/docs/c4/6e/ec/5e467f68146ab.txt', 6, '2020-02-14 18:07:20', '2020-02-14 18:07:20', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (127, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/04/26/60/5e467f6c0c603.mp3', '/docs/e1/be/ee/5e467f6c0acf5.txt', 6, '2020-02-14 18:07:24', '2020-02-14 18:07:24', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (128, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/bc/25/5b/5e467f8a92e70.mp3', '/docs/cf/af/fc/5e467f8a8d5fd.txt', 6, '2020-02-14 18:07:54', '2020-02-14 18:07:54', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (129, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c0/22/2c/5e467fa71f827.mp3', '/docs/a6/f9/9a/5e467fa71dfd5.txt', 6, '2020-02-14 18:08:23', '2020-02-14 18:08:23', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (130, 92, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/20/19/92/5e468004b0823.mp3', '/docs/03/bc/c0/5e468004ab8ac.txt', 6, '2020-02-14 18:09:56', '2020-02-14 18:09:56', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (131, 110, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/5e/95/55/5e49f3aba9f12.mp3', NULL, 6, '2020-02-17 09:00:11', '2020-02-17 09:00:11', NULL, NULL, 'khong', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (132, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/9a/b7/79/5e49f3c434300.mp3', '/docs/35/17/73/5e49f3c429e39.txt', 6, '2020-02-17 09:00:36', '2020-02-17 09:00:36', NULL, NULL, 'abc', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (133, 110, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 0, 1, NULL, NULL, 6, '2020-02-17 09:02:09', '2020-02-17 09:02:09', NULL, NULL, 'khong', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (134, 110, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 09:04:35', '2020-02-17 09:04:35', NULL, NULL, 'a', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (135, 110, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 0, 1, NULL, NULL, 6, '2020-02-17 09:05:11', '2020-02-17 09:05:11', NULL, NULL, 'a', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (136, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/4c/51/14/5e49f5bb1b8d2.mp3', '/docs/99/94/49/5e49f5bb19dbc.txt', 6, '2020-02-17 09:08:59', '2020-02-17 09:08:59', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (137, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/da/30/0d/5e49f5be057bc.mp3', '/docs/90/37/79/5e49f5be03ae4.txt', 6, '2020-02-17 09:09:02', '2020-02-17 09:09:02', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (168, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/d0/c4/4d/5e49f7b67d520.mp3', '/docs/93/8d/d9/5e49f7b67b9b7.txt', 6, '2020-02-17 09:17:26', '2020-02-17 09:17:26', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (208, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/07/8f/f0/5e49fc9b6e938.mp3', '/docs/ef/2c/ce/5e49fc9b6cf19.txt', 6, '2020-02-17 09:38:19', '2020-02-17 09:38:19', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (209, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/2e/36/62/5e49fdc437e83.mp3', '/docs/de/7c/cd/5e49fdc4364d1.txt', 6, '2020-02-17 09:43:16', '2020-02-17 09:43:16', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (210, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/04/46/60/5e49fe1c02b4f.mp3', '/docs/ba/39/9b/5e49fe1c009cf.txt', 6, '2020-02-17 09:44:44', '2020-02-17 09:44:44', NULL, NULL, 'minh chau', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (214, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/7d/44/47/5e49fea66c799.mp3', '/docs/42/6e/e4/5e49fea66adb2.txt', 6, '2020-02-17 09:47:02', '2020-02-17 09:47:02', NULL, NULL, 'ab', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (215, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/1a/fe/e1/5e49feacdd942.mp3', '/docs/1b/54/41/5e49feacdbfb5.txt', 6, '2020-02-17 09:47:09', '2020-02-17 09:47:09', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (216, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/9a/2b/b9/5e49feaf7ec78.mp3', '/docs/37/43/33/5e49feaf7d2f8.txt', 6, '2020-02-17 09:47:11', '2020-02-17 09:47:11', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (217, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/ef/df/fe/5e4a0059390df.mp3', '/docs/49/34/44/5e4a0059377a5.txt', 6, '2020-02-17 09:54:17', '2020-02-17 09:54:17', NULL, NULL, 'minh chau', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (218, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/fa/24/4f/5e4a005c153cb.mp3', '/docs/36/6c/c3/5e4a005c0be9f.txt', 6, '2020-02-17 09:54:20', '2020-02-17 09:54:20', NULL, NULL, 'minh chau', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (219, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/5c/e7/75/5e4a0063a84d4.mp3', '/docs/9c/80/09/5e4a0063a691b.txt', 6, '2020-02-17 09:54:27', '2020-02-17 09:54:27', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (220, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/ae/cf/fa/5e4a0067181a3.mp3', '/docs/51/9a/a5/5e4a00671685f.txt', 6, '2020-02-17 09:54:31', '2020-02-17 09:54:31', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (267, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/09/7c/c0/5e4a068b2ecc2.mp3', '/docs/5a/70/05/5e4a068b29ac5.txt', 6, '2020-02-17 10:20:43', '2020-02-17 10:20:43', NULL, NULL, '1234', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (268, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/6a/d7/76/5e4a06938c0ff.mp3', '/docs/a1/e7/7a/5e4a06938a69a.txt', 6, '2020-02-17 10:20:51', '2020-02-17 10:20:51', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (269, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/c3/a3/3c/5e4a0738dcc1c.mp3', '/docs/cc/36/6c/5e4a0738db18c.txt', 6, '2020-02-17 10:23:37', '2020-02-17 10:23:37', NULL, NULL, 'Minh Chau', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (270, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/3b/d8/83/5e4a073bb4d6e.mp3', '/docs/4e/2b/b4/5e4a073bb32ff.txt', 6, '2020-02-17 10:23:39', '2020-02-17 10:23:39', NULL, NULL, 'Minh Chau', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (271, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/ef/f4/4e/5e4a074b063a6.mp3', '/docs/57/d3/35/5e4a074b04723.txt', 6, '2020-02-17 10:23:55', '2020-02-17 10:23:55', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (272, 111, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/f8/16/6f/5e4a0a471a9f5.mp3', '/docs/96/bf/f9/5e4a0a4715c38.txt', 6, '2020-02-17 10:36:39', '2020-02-17 10:36:39', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (273, 112, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 10:40:04', '2020-02-17 10:40:04', NULL, NULL, 'a', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (274, 112, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 10:40:24', '2020-02-17 10:40:24', NULL, NULL, 'a', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (275, 112, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 10:41:41', '2020-02-17 10:41:41', NULL, NULL, 'a', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (276, 112, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 10:42:50', '2020-02-17 10:42:50', NULL, NULL, 'a', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (279, 112, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 10:48:47', '2020-02-17 10:48:47', NULL, NULL, 'khong', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (280, 112, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 10:48:54', '2020-02-17 10:48:54', NULL, NULL, 'Ten', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (281, 113, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/ca/fc/cc/5e4a14d0de2c4.mp3', '/docs/ea/60/0e/5e4a14d0dc6f3.txt', 6, '2020-02-17 11:21:37', '2020-02-17 11:21:37', NULL, NULL, 'Ten', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (282, 114, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/d4/36/6d/5e4a14e998aa7.mp3', '/docs/3c/99/93/5e4a14e996ba7.txt', 6, '2020-02-17 11:22:01', '2020-02-17 11:22:01', NULL, NULL, 'Bien noi nho va em', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (283, 114, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/16/1d/d1/5e4a14ed78890.mp3', '/docs/86/d9/98/5e4a14ed73bc0.txt', 6, '2020-02-17 11:22:05', '2020-02-17 11:22:05', NULL, NULL, 'Dat nuoc loi ru', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (284, 114, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/77/5a/a7/5e4a152879465.mp3', '/docs/2d/e7/72/5e4a1528745e7.txt', 6, '2020-02-17 11:23:04', '2020-02-17 11:23:04', NULL, NULL, 'Bai ca cuoc doi', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (285, 114, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/e1/43/3e/5e4a152b9e001.mp3', '/docs/d3/60/0d/5e4a152b943c2.txt', 6, '2020-02-17 11:23:07', '2020-02-17 11:23:07', NULL, NULL, 'Dinh menh', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (286, 114, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/88/29/98/5e4a153dcbb0c.mp3', '/docs/dd/a7/7d/5e4a153dc673d.txt', 6, '2020-02-17 11:23:25', '2020-02-17 11:23:25', NULL, NULL, 'Toc gio thoi bay', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (287, 115, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/8e/0c/c8/5e4a16454f42e.mp3', '/docs/f7/38/8f/5e4a164545085.txt', 6, '2020-02-17 11:27:49', '2020-02-17 11:27:49', NULL, NULL, 'Que oi', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (291, 115, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, '/rbt/e2/0e/ee/5e4a1daf74ab8.mp3', '/docs/6a/68/86/5e4a1daf6f916.txt', 6, '2020-02-17 11:59:27', '2020-02-17 11:59:27', NULL, NULL, 'Toi yeu em', 470, 'test');
INSERT INTO `epr_enterprise_file` VALUES (292, 116, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 14:36:54', '2020-02-17 14:36:54', NULL, NULL, 'Bien chieu thuong nho', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (293, 117, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 14:38:39', '2020-02-17 14:38:39', NULL, NULL, 'Em van nhu ngay xua', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (294, 118, 2, 2, 2, '', NULL, 'Việc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt), Hưu ám chỉ sự suy giảm và Tù tượng trưng cho sự hạn chế. Để biết sinh con 2020 tháng nào tốt, bạn có thể theo dõi bảng tính ngay dưới đây. Những ngày gần đây, mẹ của Ngô Á Linh qua đời tại quê nhà Côn Minh, tỉnh Vân Nam sau khoảng thời gian nguy kịch vì căn bệnh bóc tách động mạViệc chọn tháng sinh con được các chuyên gia phong thủy Trung Quốc tính dựa trên bảng ngũ hành tứ vượng, theo tìm hiểu của Baogiadinh.vn thì Vượng nghĩa là sự thịnh vượng (tốt nhất), Tướng còn có nghĩa là vượng vừa (Tốt),`~!@#$%^&*()-_=+[]{}\\|;\',./:\"<>?', 1, 1, NULL, NULL, 6, '2020-02-17 14:39:17', '2020-02-17 14:39:17', NULL, NULL, 'Tinh yeu toi hat', 1, 'test');
INSERT INTO `epr_enterprise_file` VALUES (295, 123, 2, 1, 1, '/docs/e9/5e/ee/5e4a69f0e1b76.jpg', '/docs/07/3e/e0/5e4a69f0e2320.png', 'Anh thương em nhất, cớ sao bây giờ mình lại chia xa', 1, 1, NULL, '/docs/e8/07/7e/5e4a69f0e1edc.txt', 0, '2020-02-17 17:34:20', '2020-02-17 17:34:20', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (296, 123, NULL, NULL, NULL, '', '', NULL, NULL, 0, '/rbt/9b/db/b9/5e4b9f7aecd56.mp3', '/docs/e5/08/8e/5e4b9f7b1492a.txt', 6, '2020-02-18 15:35:02', '2020-02-18 15:35:02', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (298, 126, NULL, NULL, NULL, '/docs/c6/6f/fc/5e4ca41c44961.pdf', '/docs/ad/06/6a/5e4ca41c5a90e.pdf', NULL, NULL, 3, NULL, '/docs/9a/ff/f9/5e4ca41c4c9cf.txt', 6, '2020-02-19 09:57:32', '2020-02-19 09:57:32', NULL, NULL, 'abc', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (467, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, NULL, '/docs/ee/d9/9e/5e5de345c2ff6.txt', 0, '2020-03-03 12:05:14', '2020-03-03 12:05:14', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (468, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung ', NULL, 3, NULL, '/docs/94/95/59/5e5de38c6bb3c.txt', 0, '2020-03-03 12:06:24', '2020-03-03 12:06:24', NULL, NULL, 'Thu lam gi do', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (469, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung ', NULL, 3, '/uploads/vtcc/fd/37/7f/5e5de3e1d297e.mp3', '/docs/6f/c4/46/5e5de3e8828fa.txt', 0, '2020-03-03 12:07:56', '2020-03-03 12:07:56', NULL, NULL, 'Thu lam gi do 2', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (470, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', NULL, 3, '', '/docs/16/df/f1/5e5de476dd02e.txt', 0, '2020-03-03 12:10:19', '2020-03-03 12:10:19', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (471, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 kSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 k', NULL, 3, NULL, '/docs/9c/ff/f9/5e5de4c00532a.txt', 0, '2020-03-03 12:11:32', '2020-03-03 12:11:32', NULL, NULL, 'Thu lam gi do 34', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (472, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, '', '/docs/17/6d/d1/5e5df9aa5e553.txt', 0, '2020-03-03 13:40:46', '2020-03-03 13:40:46', NULL, NULL, 'Anh ghet em nhat ma haha', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (473, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', NULL, 3, '', '/docs/c9/26/6c/5e5dfa0334098.txt', 0, '2020-03-03 13:42:15', '2020-03-03 13:42:15', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (474, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, '', '/docs/e5/de/ee/5e5dfa3442e8b.txt', 0, '2020-03-03 13:43:04', '2020-03-03 13:43:04', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (475, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, '/uploads/vtcc/46/2c/c4/5e5dfb7b0e141.mp3', '/docs/86/c5/58/5e5dfbc90121b.txt', 0, '2020-03-03 13:49:49', '2020-03-03 13:49:49', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (476, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, '/uploads/vtcc/46/2c/c4/5e5dfb7b0e141.mp3', '/docs/15/9c/c1/5e5dfbeef202c.txt', 0, '2020-03-03 13:50:27', '2020-03-03 13:50:27', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (477, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, '/uploads/vtcc/8d/5d/d8/5e5dfc034642b.mp3', '/docs/f2/85/5f/5e5dfc099e799.txt', 0, '2020-03-03 13:50:54', '2020-03-03 13:50:54', NULL, NULL, 'aaaaaaaaaaaa', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (478, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.', NULL, 3, '/uploads/vtcc/37/3f/f3/5e5dfc3de1c08.mp3', '/docs/be/46/6b/5e5dfc4fdbb7a.txt', 0, '2020-03-03 13:52:04', '2020-03-03 13:52:04', NULL, NULL, 'aaaaaaaaaaaa', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (479, 125, NULL, NULL, NULL, '/docs/d5/dd/dd/5e5e036298b48.pdf', '', NULL, NULL, 3, NULL, '/docs/ee/10/0e/5e5e036298da8.txt', 0, '2020-03-03 14:22:15', '2020-03-03 14:22:15', NULL, NULL, 'That la buon', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (480, 125, NULL, NULL, NULL, '/docs/6a/b8/86/5e5e059faefac.pdf', '', NULL, NULL, 0, '/rbt/21/5f/f2/5e5e059fa1963.mp3', '/docs/96/96/69/5e5e059faf3a9.txt', 0, '2020-03-03 14:31:48', '2020-03-03 14:31:48', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (481, 125, NULL, NULL, NULL, '', '', NULL, NULL, 0, '/rbt/16/10/01/5e5e0bd8cf8ee.mp3', '/docs/18/f5/51/5e5e0bd8e0981.txt', 0, '2020-03-03 14:58:21', '2020-03-03 14:58:21', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (482, 125, NULL, NULL, NULL, '', '', NULL, NULL, 0, '/rbt/94/36/69/5e5e0ec88c9a9.mp3', '/docs/6a/8e/e6/5e5e0ec89aad7.txt', 0, '2020-03-03 15:10:53', '2020-03-03 15:10:53', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (483, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doacáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doa', NULL, 3, '/vtcc/56/d6/65/5e5e110fcdf14.mp3', '/docs/6a/2d/d6/5e5e113a5e2bb.txt', 0, '2020-03-03 15:21:18', '2020-03-03 15:21:18', NULL, NULL, 'Thu lam gi do', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (484, 125, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp', 0, 1, NULL, NULL, 0, '2020-03-03 16:19:27', '2020-03-03 16:19:27', NULL, NULL, 'Anh thuong em nhat ma huhu', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (485, 125, 1, 1, 1, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', 0, 1, NULL, '/docs/76/8c/c7/5e5e1f6b3cacf.txt', 0, '2020-03-03 16:19:48', '2020-03-03 16:21:51', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (486, 125, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', 0, 1, NULL, NULL, 0, '2020-03-03 16:22:20', '2020-03-03 16:22:20', NULL, NULL, 'Anh thuong em nhat ma hihi', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (487, 125, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', 0, 1, NULL, NULL, 0, '2020-03-03 16:23:02', '2020-03-03 16:23:02', NULL, NULL, 'Anh thuong em nhat ma huhu', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (488, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.QuýQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của', NULL, 3, '/vtcc/39/0a/a3/5e5e20125f9f2.mp3', '/docs/cf/dd/dc/5e5e202030b9c.txt', 0, '2020-03-03 16:24:52', '2020-03-03 16:24:52', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (489, 125, NULL, NULL, NULL, '', '', NULL, NULL, 0, '/rbt/20/23/32/5e5e26c9f378f.mp3', '/docs/20/42/22/5e5e26ca1200c.txt', 0, '2020-03-03 16:53:18', '2020-03-03 16:53:18', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (490, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo', NULL, 3, '', '/docs/f7/db/bf/5e5f7a45989ec.txt', 0, '2020-03-04 17:01:45', '2020-03-04 17:01:45', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (491, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650', NULL, 3, '', '/docs/7f/ae/e7/5e5f7a6f9b572.txt', 0, '2020-03-04 17:02:27', '2020-03-04 17:02:27', NULL, NULL, 'That la buon', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (492, 125, NULL, NULL, NULL, '', '', NULL, NULL, 0, '/rbt/e0/37/7e/5e5f7ac23411d.mp3', '/docs/9a/a3/39/5e5f7ac249f5b.txt', 0, '2020-03-04 17:03:49', '2020-03-04 17:03:49', NULL, NULL, 'Anh thuong em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (493, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ', NULL, 3, '', '/docs/31/d6/63/5e5f7b77c8b6f.txt', 0, '2020-03-04 17:06:51', '2020-03-04 17:06:51', NULL, NULL, 'Anh ghet em nhat ma', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (494, 125, NULL, NULL, NULL, '', '', 'Nội dung thu âm Giọng đọc và tốc độ đọc Nhạc nền Tên bài hát và mời cái nhạc chờ\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoNội dung thu âm Giọng đọc và tốc độ đọc Nhạc nền Tên bài hát và mời cái nhạc chờ\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoNội dung thu âm Giọng đọc và tốc độ đọc Nhạc nền Tên bài hát và mời cái nhạc chờ\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo', NULL, 3, '/vtcc/93/10/09/5e5f7de5ae3c5.mp3', '/docs/01/6e/e0/5e5f7e0792e53.txt', 0, '2020-03-04 17:17:47', '2020-03-04 17:17:47', NULL, NULL, 'aaaaaaaaaaaa', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (495, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáoQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo', NULL, 3, '/vtcc/be/98/8b/5e5f88e8615ab.mp3', '/docs/b4/6a/ab/5e5f88f7139af.txt', 0, '2020-03-04 18:04:26', '2020-03-04 18:04:26', NULL, NULL, 'aaaaaaaaaaaa A', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (496, 131, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', 0, 1, NULL, NULL, 0, '2020-03-05 15:39:41', '2020-03-05 15:39:41', NULL, NULL, 'bac', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (497, 131, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.', 0, 1, NULL, NULL, 0, '2020-03-05 16:17:45', '2020-03-05 16:17:45', NULL, NULL, 'sds', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (498, 131, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung qu', 0, 1, NULL, NULL, 0, '2020-03-05 16:25:46', '2020-03-05 16:25:46', NULL, NULL, 'a', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (499, 131, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung qu', 0, 1, NULL, NULL, 0, '2020-03-05 16:26:07', '2020-03-05 16:26:07', NULL, NULL, 'b', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (500, 131, 1, 1, 1, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.\r\n\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.\r\n\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.\r\n\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.\r\n\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.\r\n\r\nQuý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một n', 0, 1, NULL, '/docs/c2/8d/dc/5e60d58d41278.txt', 0, '2020-03-05 17:33:15', '2020-03-05 17:33:49', NULL, NULL, 'abc', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (501, 131, 1, 1, 1, NULL, NULL, 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung qu', 0, 1, NULL, NULL, 0, '2020-03-05 17:34:45', '2020-03-05 17:34:45', NULL, NULL, 'fds', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (502, 125, NULL, NULL, NULL, '', '', NULL, NULL, 0, '/rbt/22/64/42/5e60dc1fa3927.mp3', '/docs/5e/3b/b5/5e60dc207105d.txt', 3, '2020-03-05 18:01:52', '2020-03-05 18:01:52', NULL, NULL, 'Nhac cho doanh nghiep', 2, 'web');
INSERT INTO `epr_enterprise_file` VALUES (503, 125, NULL, NULL, NULL, '', '', 'Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.\r\nSố lượng ký tự để thu âm cho một nội dung quảng cáo từ 650', NULL, 3, '/vtcc/ce/c8/8c/5e66235e189a9.mp3', '/docs/34/03/33/5e662384e31b5.txt', 0, '2020-03-09 18:17:29', '2020-03-09 18:17:29', NULL, NULL, 'That la buon', 2, 'web');

-- ----------------------------
-- Table structure for epr_enterprise_rbt
-- ----------------------------
DROP TABLE IF EXISTS `epr_enterprise_rbt`;
CREATE TABLE `epr_enterprise_rbt`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tone_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Mã nhạc',
  `tone_id` bigint(20) NOT NULL COMMENT 'Tone ID',
  `enterprise_id` int(11) UNSIGNED NOT NULL COMMENT 'Doanh nghiệp',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT 'Tạo lúc',
  `created_by` int(11) UNSIGNED NULL DEFAULT NULL COMMENT 'Tạo bởi',
  `file_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'File',
  `enterprise_file_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 140 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_enterprise_rbt
-- ----------------------------
INSERT INTO `epr_enterprise_rbt` VALUES (1, '82521439', 2904273, 1, '2020-02-11 18:17:01', NULL, '/rbt/e8/58/8e/5e428d2cba106.mp3', 3);
INSERT INTO `epr_enterprise_rbt` VALUES (2, '82521442', 2904276, 1, '2020-02-12 10:27:26', NULL, '/rbt/07/1e/e0/5e43709cb9519.mp3', 5);
INSERT INTO `epr_enterprise_rbt` VALUES (3, '82521443', 2904277, 1, '2020-02-12 10:28:09', NULL, '/rbt/60/e9/96/5e4370c85e4a2.mp3', 6);
INSERT INTO `epr_enterprise_rbt` VALUES (4, '82521471', 2904305, 2, '2020-02-12 17:24:14', NULL, '/rbt/f4/d1/1f/5e43d24cebb76.mp3', 8);
INSERT INTO `epr_enterprise_rbt` VALUES (5, '82521478', 2904428, 13, '2020-02-13 11:11:22', NULL, '/rbt/3f/79/93/5e44cc69a932b.mp3', 10);
INSERT INTO `epr_enterprise_rbt` VALUES (6, '82521479', 2904429, 13, '2020-02-13 11:11:58', NULL, NULL, 11);
INSERT INTO `epr_enterprise_rbt` VALUES (7, '82521480', 2904430, 13, '2020-02-13 11:12:01', NULL, NULL, 12);
INSERT INTO `epr_enterprise_rbt` VALUES (8, '82521481', 2904437, 13, '2020-02-13 11:13:56', NULL, NULL, 13);
INSERT INTO `epr_enterprise_rbt` VALUES (9, '82521482', 2904438, 16, '2020-02-13 11:20:04', NULL, '/rbt/e4/8d/de/5e44ce739301a.mp3', 14);
INSERT INTO `epr_enterprise_rbt` VALUES (10, '82521483', 2904440, 2, '2020-02-13 11:30:25', NULL, '/rbt/fc/49/9f/5e44d0e06e3f0.mp3', 15);
INSERT INTO `epr_enterprise_rbt` VALUES (11, '82521484', 2904441, 2, '2020-02-13 11:31:14', NULL, '/rbt/2b/95/52/5e44d1115dd4d.mp3', 16);
INSERT INTO `epr_enterprise_rbt` VALUES (12, '82521485', 2904442, 16, '2020-02-13 11:39:45', NULL, '/rbt/bd/17/7b/5e44d31019a51.mp3', 17);
INSERT INTO `epr_enterprise_rbt` VALUES (13, '82521486', 2904443, 16, '2020-02-13 11:41:33', NULL, '/rbt/8d/22/28/5e44d37cbc95d.mp3', 18);
INSERT INTO `epr_enterprise_rbt` VALUES (14, '82521487', 2904444, 16, '2020-02-13 11:43:09', NULL, '/rbt/62/22/26/5e44d3dc64b18.mp3', 19);
INSERT INTO `epr_enterprise_rbt` VALUES (15, '82521489', 2904447, 2, '2020-02-13 12:02:17', NULL, '/rbt/9c/f9/99/5e44d858568f5.mp3', 20);
INSERT INTO `epr_enterprise_rbt` VALUES (16, '82521491', 2904559, 20, '2020-02-13 14:50:23', NULL, '/rbt/6c/50/06/5e44ffbdc479a.mp3', 22);
INSERT INTO `epr_enterprise_rbt` VALUES (17, '82521492', 2904561, 21, '2020-02-13 14:52:35', NULL, '/rbt/cc/e5/5c/5e45004213609.mp3', 23);
INSERT INTO `epr_enterprise_rbt` VALUES (18, '82521493', 2904585, 25, '2020-02-13 15:08:03', NULL, NULL, 31);
INSERT INTO `epr_enterprise_rbt` VALUES (19, '82521498', 2904629, 21, '2020-02-13 16:19:41', NULL, '/rbt/4b/75/54/5e4514abf3a5c.mp3', 32);
INSERT INTO `epr_enterprise_rbt` VALUES (20, '82521499', 2904630, 21, '2020-02-13 16:24:24', NULL, '/rbt/a9/1f/fa/5e4515c7991c0.mp3', 33);
INSERT INTO `epr_enterprise_rbt` VALUES (21, '82521500', 2904631, 21, '2020-02-13 16:30:18', NULL, '/rbt/b8/b9/9b/5e451729be28d.mp3', 34);
INSERT INTO `epr_enterprise_rbt` VALUES (22, '82521501', 2904632, 21, '2020-02-13 16:31:19', NULL, '/rbt/31/09/93/5e451764f22cf.mp3', 35);
INSERT INTO `epr_enterprise_rbt` VALUES (23, '82521502', 2904633, 27, '2020-02-13 16:31:34', NULL, '/rbt/a2/56/6a/5e451775c640e.mp3', 36);
INSERT INTO `epr_enterprise_rbt` VALUES (24, '82521503', 2904634, 29, '2020-02-13 16:33:15', NULL, '/rbt/85/0c/c8/5e4517da4ef3d.mp3', 37);
INSERT INTO `epr_enterprise_rbt` VALUES (25, '82521504', 2904635, 29, '2020-02-13 16:34:03', NULL, '/rbt/f9/6e/ef/5e45180aca7a2.mp3', 38);
INSERT INTO `epr_enterprise_rbt` VALUES (26, '82521505', 2904636, 29, '2020-02-13 16:36:12', NULL, '/rbt/01/88/80/5e45188b49294.mp3', 39);
INSERT INTO `epr_enterprise_rbt` VALUES (27, '82521509', 2904640, 2, '2020-02-13 16:41:19', NULL, '/rbt/fd/2a/af/5e4519be3466c.mp3', 40);
INSERT INTO `epr_enterprise_rbt` VALUES (28, '82521510', 2904641, 33, '2020-02-13 16:45:27', NULL, '/rbt/83/26/68/5e451ab68cacd.mp3', 41);
INSERT INTO `epr_enterprise_rbt` VALUES (29, '82521511', 2904642, 33, '2020-02-13 16:46:52', NULL, '/rbt/4a/a2/24/5e451b0b173e2.mp3', 42);
INSERT INTO `epr_enterprise_rbt` VALUES (30, '82521512', 2904643, 34, '2020-02-13 16:47:54', NULL, '/rbt/4e/43/34/5e451b49a97ea.mp3', 43);
INSERT INTO `epr_enterprise_rbt` VALUES (31, '82521513', 2904644, 35, '2020-02-13 16:48:31', NULL, '/rbt/b3/8f/fb/5e451b6e963b2.mp3', 44);
INSERT INTO `epr_enterprise_rbt` VALUES (32, '82521514', 2904645, 36, '2020-02-13 16:51:06', NULL, '/rbt/52/0b/b5/5e451c09f18fd.mp3', 45);
INSERT INTO `epr_enterprise_rbt` VALUES (33, '82521515', 2904647, 37, '2020-02-13 16:52:10', NULL, '/rbt/cf/83/3c/5e451c49d88f2.mp3', 46);
INSERT INTO `epr_enterprise_rbt` VALUES (34, '82521516', 2904648, 38, '2020-02-13 16:52:27', NULL, '/rbt/4f/11/14/5e451c5a4b324.mp3', 47);
INSERT INTO `epr_enterprise_rbt` VALUES (35, '82521519', 2904651, 38, '2020-02-13 17:07:51', NULL, '/rbt/c0/cf/fc/5e451ff62605d.mp3', 48);
INSERT INTO `epr_enterprise_rbt` VALUES (36, '82521520', 2904652, 38, '2020-02-13 17:08:19', NULL, '/rbt/a1/9c/ca/5e4520123cb15.mp3', 49);
INSERT INTO `epr_enterprise_rbt` VALUES (37, '82521521', 2904653, 38, '2020-02-13 17:09:37', NULL, '/rbt/f5/09/9f/5e452060eb642.mp3', 50);
INSERT INTO `epr_enterprise_rbt` VALUES (38, '82521522', 2904655, 38, '2020-02-13 17:13:28', NULL, '/rbt/4e/e6/64/5e452146d8a2f.mp3', 51);
INSERT INTO `epr_enterprise_rbt` VALUES (39, '82521523', 2904656, 38, '2020-02-13 17:13:46', NULL, '/rbt/52/78/85/5e4521592cd3d.mp3', 52);
INSERT INTO `epr_enterprise_rbt` VALUES (40, '82521524', 2904657, 38, '2020-02-13 17:14:19', NULL, '/rbt/c6/48/8c/5e45217a0e1d3.mp3', 53);
INSERT INTO `epr_enterprise_rbt` VALUES (41, '82521525', 2904658, 38, '2020-02-13 17:14:28', NULL, '/rbt/e3/37/7e/5e452183a5b85.mp3', 54);
INSERT INTO `epr_enterprise_rbt` VALUES (42, '82521526', 2904659, 38, '2020-02-13 17:15:49', NULL, '/rbt/7c/71/17/5e4521d40ea19.mp3', 55);
INSERT INTO `epr_enterprise_rbt` VALUES (43, '82521527', 2904661, 38, '2020-02-13 17:16:20', NULL, '/rbt/1f/f3/31/5e4521f395031.mp3', 56);
INSERT INTO `epr_enterprise_rbt` VALUES (44, '82521528', 2904662, 38, '2020-02-13 17:17:42', NULL, '/rbt/1d/84/41/5e45224523063.mp3', 57);
INSERT INTO `epr_enterprise_rbt` VALUES (45, '82521529', 2904663, 38, '2020-02-13 17:20:04', NULL, '/rbt/88/05/58/5e4522d3daa59.mp3', 58);
INSERT INTO `epr_enterprise_rbt` VALUES (46, '82521530', 2904664, 38, '2020-02-13 17:20:51', NULL, '/rbt/d3/9d/dd/5e452302b64dd.mp3', 59);
INSERT INTO `epr_enterprise_rbt` VALUES (47, '82521531', 2904665, 38, '2020-02-13 17:21:46', NULL, '/rbt/6e/a4/46/5e452339c4f95.mp3', 60);
INSERT INTO `epr_enterprise_rbt` VALUES (48, '82521532', 2904666, 38, '2020-02-13 17:23:20', NULL, '/rbt/5d/9e/e5/5e452397883e8.mp3', 61);
INSERT INTO `epr_enterprise_rbt` VALUES (49, '82521533', 2904667, 38, '2020-02-13 17:23:38', NULL, '/rbt/40/e9/94/5e4523a963b77.mp3', 62);
INSERT INTO `epr_enterprise_rbt` VALUES (50, '82521534', 2904668, 38, '2020-02-13 17:27:32', NULL, '/rbt/70/8f/f7/5e4524937460f.mp3', 63);
INSERT INTO `epr_enterprise_rbt` VALUES (51, '82521538', 2904687, 95, '2020-02-14 10:25:07', NULL, NULL, 64);
INSERT INTO `epr_enterprise_rbt` VALUES (52, '82521540', 2904690, 96, '2020-02-14 11:08:19', NULL, NULL, 65);
INSERT INTO `epr_enterprise_rbt` VALUES (53, '82521541', 2904691, 96, '2020-02-14 11:11:15', NULL, NULL, 66);
INSERT INTO `epr_enterprise_rbt` VALUES (54, '82521542', 2904692, 96, '2020-02-14 11:12:58', NULL, NULL, 67);
INSERT INTO `epr_enterprise_rbt` VALUES (55, '82521543', 2904693, 96, '2020-02-14 11:13:05', NULL, NULL, 68);
INSERT INTO `epr_enterprise_rbt` VALUES (56, '82521544', 2904694, 98, '2020-02-14 11:16:02', NULL, NULL, 69);
INSERT INTO `epr_enterprise_rbt` VALUES (57, '82521545', 2904695, 98, '2020-02-14 11:17:40', NULL, NULL, 70);
INSERT INTO `epr_enterprise_rbt` VALUES (58, '82521546', 2904696, 100, '2020-02-14 11:23:09', NULL, NULL, 71);
INSERT INTO `epr_enterprise_rbt` VALUES (59, '82521547', 2904697, 104, '2020-02-14 11:35:45', NULL, NULL, 72);
INSERT INTO `epr_enterprise_rbt` VALUES (60, '82521555', 2904705, 105, '2020-02-14 13:58:38', NULL, NULL, 73);
INSERT INTO `epr_enterprise_rbt` VALUES (61, '82521556', 2904706, 105, '2020-02-14 14:00:00', NULL, NULL, 74);
INSERT INTO `epr_enterprise_rbt` VALUES (62, '82521557', 2904707, 105, '2020-02-14 14:00:37', NULL, NULL, 75);
INSERT INTO `epr_enterprise_rbt` VALUES (63, '82521558', 2904708, 105, '2020-02-14 14:01:13', NULL, NULL, 76);
INSERT INTO `epr_enterprise_rbt` VALUES (64, '82521559', 2904709, 105, '2020-02-14 14:03:42', NULL, NULL, 77);
INSERT INTO `epr_enterprise_rbt` VALUES (65, '82521560', 2904710, 105, '2020-02-14 14:04:46', NULL, NULL, 78);
INSERT INTO `epr_enterprise_rbt` VALUES (66, '82521567', 2904717, 105, '2020-02-14 14:38:21', NULL, '/rbt/c6/f0/0c/5e464e6c0b5fb.mp3', 79);
INSERT INTO `epr_enterprise_rbt` VALUES (67, '82521568', 2904718, 105, '2020-02-14 14:38:40', NULL, '/rbt/3a/fd/d3/5e464e7f87e8d.mp3', 80);
INSERT INTO `epr_enterprise_rbt` VALUES (68, '82521572', 2904723, 109, '2020-02-14 15:28:16', NULL, '/rbt/eb/c7/7e/5e465a1f57fc2.mp3', 92);
INSERT INTO `epr_enterprise_rbt` VALUES (69, '82521573', 2904724, 109, '2020-02-14 15:31:12', NULL, '/rbt/db/dc/cd/5e465ace5d772.mp3', 93);
INSERT INTO `epr_enterprise_rbt` VALUES (70, '82521574', 2904725, 109, '2020-02-14 15:31:38', NULL, '/rbt/13/e9/91/5e465ae8f072e.mp3', 94);
INSERT INTO `epr_enterprise_rbt` VALUES (71, '82521575', 2904726, 109, '2020-02-14 15:34:15', NULL, '/rbt/d4/74/4d/5e465b8640c69.mp3', 95);
INSERT INTO `epr_enterprise_rbt` VALUES (72, '82521576', 2904727, 109, '2020-02-14 15:34:46', NULL, '/rbt/e5/42/2e/5e465ba558d93.mp3', 96);
INSERT INTO `epr_enterprise_rbt` VALUES (73, '82521577', 2904728, 109, '2020-02-14 15:35:05', NULL, '/rbt/a8/5d/da/5e465bb8e1ae4.mp3', 97);
INSERT INTO `epr_enterprise_rbt` VALUES (74, '82521585', 2904858, 92, '2020-02-14 16:46:48', NULL, NULL, 98);
INSERT INTO `epr_enterprise_rbt` VALUES (75, '82521586', 2904863, 109, '2020-02-14 16:58:14', NULL, '/rbt/6a/21/16/5e466f35b64fe.mp3', 99);
INSERT INTO `epr_enterprise_rbt` VALUES (76, '82521587', 2904864, 109, '2020-02-14 16:58:46', NULL, NULL, 100);
INSERT INTO `epr_enterprise_rbt` VALUES (77, '82521588', 2904865, 109, '2020-02-14 17:01:31', NULL, NULL, 101);
INSERT INTO `epr_enterprise_rbt` VALUES (78, '82521589', 2904866, 109, '2020-02-14 17:01:55', NULL, '/rbt/b7/5c/cb/5e46701203912.mp3', 102);
INSERT INTO `epr_enterprise_rbt` VALUES (79, '82521590', 2904867, 92, '2020-02-14 17:05:17', NULL, NULL, 103);
INSERT INTO `epr_enterprise_rbt` VALUES (80, '82521591', 2904868, 109, '2020-02-14 17:08:06', NULL, '/rbt/e5/81/1e/5e467185b13f7.mp3', 104);
INSERT INTO `epr_enterprise_rbt` VALUES (81, '82521592', 2904869, 109, '2020-02-14 17:09:03', NULL, NULL, 105);
INSERT INTO `epr_enterprise_rbt` VALUES (82, '82521593', 2904870, 109, '2020-02-14 17:15:11', NULL, NULL, 106);
INSERT INTO `epr_enterprise_rbt` VALUES (83, '82521597', 2904874, 109, '2020-02-14 17:21:13', NULL, NULL, 107);
INSERT INTO `epr_enterprise_rbt` VALUES (84, '82521598', 2904875, 110, '2020-02-14 17:34:15', NULL, '/rbt/7b/40/07/5e4677a666e41.mp3', 108);
INSERT INTO `epr_enterprise_rbt` VALUES (85, '82521599', 2904876, 110, '2020-02-14 17:37:04', NULL, '/rbt/16/5f/f1/5e46784f08686.mp3', 109);
INSERT INTO `epr_enterprise_rbt` VALUES (86, '82521600', 2904877, 110, '2020-02-14 17:38:25', NULL, '/rbt/ba/0b/bb/5e4678a0570c6.mp3', 110);
INSERT INTO `epr_enterprise_rbt` VALUES (87, '82521601', 2904878, 110, '2020-02-14 17:40:49', NULL, '/rbt/a4/9f/fa/5e4679305221b.mp3', 114);
INSERT INTO `epr_enterprise_rbt` VALUES (88, '82521602', 2904879, 110, '2020-02-14 17:44:45', NULL, '/rbt/16/b1/11/5e467a1c40d25.mp3', 115);
INSERT INTO `epr_enterprise_rbt` VALUES (89, '82521603', 2904880, 110, '2020-02-14 17:45:29', NULL, '/rbt/81/a3/38/5e467a48c1ce1.mp3', 116);
INSERT INTO `epr_enterprise_rbt` VALUES (90, '82521604', 2904881, 110, '2020-02-14 17:45:44', NULL, '/rbt/ce/17/7c/5e467a572c712.mp3', 117);
INSERT INTO `epr_enterprise_rbt` VALUES (91, '82521605', 2904882, 110, '2020-02-14 17:50:51', NULL, NULL, 119);
INSERT INTO `epr_enterprise_rbt` VALUES (92, '82521606', 2904883, 92, '2020-02-14 18:06:01', NULL, '/rbt/b3/ab/bb/5e467f181b136.mp3', 124);
INSERT INTO `epr_enterprise_rbt` VALUES (93, '82521607', 2904884, 92, '2020-02-14 18:06:56', NULL, '/rbt/a0/1c/ca/5e467f4f5bc25.mp3', 125);
INSERT INTO `epr_enterprise_rbt` VALUES (94, '82521608', 2904885, 92, '2020-02-14 18:07:21', NULL, '/rbt/d7/fd/dd/5e467f6816065.mp3', 126);
INSERT INTO `epr_enterprise_rbt` VALUES (95, '82521609', 2904886, 92, '2020-02-14 18:07:25', NULL, '/rbt/04/26/60/5e467f6c0c603.mp3', 127);
INSERT INTO `epr_enterprise_rbt` VALUES (96, '82521610', 2904887, 92, '2020-02-14 18:07:55', NULL, '/rbt/bc/25/5b/5e467f8a92e70.mp3', 128);
INSERT INTO `epr_enterprise_rbt` VALUES (97, '82521611', 2904888, 92, '2020-02-14 18:08:24', NULL, '/rbt/c0/22/2c/5e467fa71f827.mp3', 129);
INSERT INTO `epr_enterprise_rbt` VALUES (98, '82521612', 2904889, 92, '2020-02-14 18:09:57', NULL, '/rbt/20/19/92/5e468004b0823.mp3', 130);
INSERT INTO `epr_enterprise_rbt` VALUES (99, '82521619', 2905096, 110, '2020-02-17 09:00:12', NULL, '/rbt/5e/95/55/5e49f3aba9f12.mp3', 131);
INSERT INTO `epr_enterprise_rbt` VALUES (100, '82521620', 2905097, 111, '2020-02-17 09:00:37', NULL, '/rbt/9a/b7/79/5e49f3c434300.mp3', 132);
INSERT INTO `epr_enterprise_rbt` VALUES (101, '82521621', 2905098, 110, '2020-02-17 09:02:10', NULL, NULL, 133);
INSERT INTO `epr_enterprise_rbt` VALUES (102, '82521626', 2905103, 110, '2020-02-17 09:04:36', NULL, NULL, 134);
INSERT INTO `epr_enterprise_rbt` VALUES (103, '82521629', 2905106, 110, '2020-02-17 09:05:11', NULL, NULL, 135);
INSERT INTO `epr_enterprise_rbt` VALUES (104, '82521630', 2905107, 111, '2020-02-17 09:09:00', NULL, '/rbt/4c/51/14/5e49f5bb1b8d2.mp3', 136);
INSERT INTO `epr_enterprise_rbt` VALUES (105, '82521631', 2905108, 111, '2020-02-17 09:09:03', NULL, '/rbt/da/30/0d/5e49f5be057bc.mp3', 137);
INSERT INTO `epr_enterprise_rbt` VALUES (106, '82521632', 2905109, 111, '2020-02-17 09:17:27', NULL, '/rbt/d0/c4/4d/5e49f7b67d520.mp3', 168);
INSERT INTO `epr_enterprise_rbt` VALUES (107, '82521633', 2905110, 111, '2020-02-17 09:38:20', NULL, '/rbt/07/8f/f0/5e49fc9b6e938.mp3', 208);
INSERT INTO `epr_enterprise_rbt` VALUES (108, '82521634', 2905111, 111, '2020-02-17 09:43:17', NULL, '/rbt/2e/36/62/5e49fdc437e83.mp3', 209);
INSERT INTO `epr_enterprise_rbt` VALUES (109, '82521635', 2905120, 111, '2020-02-17 09:44:45', NULL, '/rbt/04/46/60/5e49fe1c02b4f.mp3', 210);
INSERT INTO `epr_enterprise_rbt` VALUES (110, '82521636', 2905121, 111, '2020-02-17 09:47:03', NULL, '/rbt/7d/44/47/5e49fea66c799.mp3', 214);
INSERT INTO `epr_enterprise_rbt` VALUES (111, '82521637', 2905122, 111, '2020-02-17 09:47:09', NULL, '/rbt/1a/fe/e1/5e49feacdd942.mp3', 215);
INSERT INTO `epr_enterprise_rbt` VALUES (112, '82521638', 2905123, 111, '2020-02-17 09:47:12', NULL, '/rbt/9a/2b/b9/5e49feaf7ec78.mp3', 216);
INSERT INTO `epr_enterprise_rbt` VALUES (113, '82521639', 2905124, 111, '2020-02-17 09:54:18', NULL, '/rbt/ef/df/fe/5e4a0059390df.mp3', 217);
INSERT INTO `epr_enterprise_rbt` VALUES (114, '82521640', 2905125, 111, '2020-02-17 09:54:21', NULL, '/rbt/fa/24/4f/5e4a005c153cb.mp3', 218);
INSERT INTO `epr_enterprise_rbt` VALUES (115, '82521641', 2905126, 111, '2020-02-17 09:54:28', NULL, '/rbt/5c/e7/75/5e4a0063a84d4.mp3', 219);
INSERT INTO `epr_enterprise_rbt` VALUES (116, '82521642', 2905127, 111, '2020-02-17 09:54:32', NULL, '/rbt/ae/cf/fa/5e4a0067181a3.mp3', 220);
INSERT INTO `epr_enterprise_rbt` VALUES (117, '82521645', 2905130, 111, '2020-02-17 10:20:44', NULL, '/rbt/09/7c/c0/5e4a068b2ecc2.mp3', 267);
INSERT INTO `epr_enterprise_rbt` VALUES (118, '82521646', 2905131, 111, '2020-02-17 10:20:52', NULL, '/rbt/6a/d7/76/5e4a06938c0ff.mp3', 268);
INSERT INTO `epr_enterprise_rbt` VALUES (119, '82521647', 2905132, 111, '2020-02-17 10:23:37', NULL, '/rbt/c3/a3/3c/5e4a0738dcc1c.mp3', 269);
INSERT INTO `epr_enterprise_rbt` VALUES (120, '82521648', 2905133, 111, '2020-02-17 10:23:40', NULL, '/rbt/3b/d8/83/5e4a073bb4d6e.mp3', 270);
INSERT INTO `epr_enterprise_rbt` VALUES (121, '82521649', 2905134, 111, '2020-02-17 10:23:56', NULL, '/rbt/ef/f4/4e/5e4a074b063a6.mp3', 271);
INSERT INTO `epr_enterprise_rbt` VALUES (122, '82521650', 2905135, 111, '2020-02-17 10:36:40', NULL, '/rbt/f8/16/6f/5e4a0a471a9f5.mp3', 272);
INSERT INTO `epr_enterprise_rbt` VALUES (123, '82521652', 2905137, 112, '2020-02-17 10:40:06', NULL, NULL, 273);
INSERT INTO `epr_enterprise_rbt` VALUES (124, '82521653', 2905138, 112, '2020-02-17 10:40:25', NULL, NULL, 274);
INSERT INTO `epr_enterprise_rbt` VALUES (125, '82521654', 2905139, 112, '2020-02-17 10:41:42', NULL, NULL, 275);
INSERT INTO `epr_enterprise_rbt` VALUES (126, '82521655', 2905140, 112, '2020-02-17 10:42:51', NULL, NULL, 276);
INSERT INTO `epr_enterprise_rbt` VALUES (127, '82521656', 2905141, 112, '2020-02-17 10:48:47', NULL, NULL, 279);
INSERT INTO `epr_enterprise_rbt` VALUES (128, '82521657', 2905142, 112, '2020-02-17 10:48:56', NULL, NULL, 280);
INSERT INTO `epr_enterprise_rbt` VALUES (129, '82521658', 2905144, 113, '2020-02-17 11:21:37', NULL, '/rbt/ca/fc/cc/5e4a14d0de2c4.mp3', 281);
INSERT INTO `epr_enterprise_rbt` VALUES (130, '82521659', 2905145, 114, '2020-02-17 11:22:02', NULL, '/rbt/d4/36/6d/5e4a14e998aa7.mp3', 282);
INSERT INTO `epr_enterprise_rbt` VALUES (131, '82521660', 2905146, 114, '2020-02-17 11:22:06', NULL, '/rbt/16/1d/d1/5e4a14ed78890.mp3', 283);
INSERT INTO `epr_enterprise_rbt` VALUES (132, '82521661', 2905147, 114, '2020-02-17 11:23:05', NULL, '/rbt/77/5a/a7/5e4a152879465.mp3', 284);
INSERT INTO `epr_enterprise_rbt` VALUES (133, '82521662', 2905148, 114, '2020-02-17 11:23:08', NULL, '/rbt/e1/43/3e/5e4a152b9e001.mp3', 285);
INSERT INTO `epr_enterprise_rbt` VALUES (134, '82521663', 2905149, 114, '2020-02-17 11:23:27', NULL, '/rbt/88/29/98/5e4a153dcbb0c.mp3', 286);
INSERT INTO `epr_enterprise_rbt` VALUES (135, '82521664', 2905150, 115, '2020-02-17 11:27:50', NULL, '/rbt/8e/0c/c8/5e4a16454f42e.mp3', 287);
INSERT INTO `epr_enterprise_rbt` VALUES (136, '82521669', 2905155, 115, '2020-02-17 11:59:28', NULL, '/rbt/e2/0e/ee/5e4a1daf74ab8.mp3', 291);
INSERT INTO `epr_enterprise_rbt` VALUES (137, '82521675', 2905161, 116, '2020-02-17 14:36:55', NULL, NULL, 292);
INSERT INTO `epr_enterprise_rbt` VALUES (138, '82521676', 2905162, 117, '2020-02-17 14:38:41', NULL, NULL, 293);
INSERT INTO `epr_enterprise_rbt` VALUES (139, '82521677', 2905163, 118, '2020-02-17 14:39:18', NULL, NULL, 294);

-- ----------------------------
-- Table structure for epr_info
-- ----------------------------
DROP TABLE IF EXISTS `epr_info`;
CREATE TABLE `epr_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` int(2) UNSIGNED NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `type`(`type`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for epr_menu
-- ----------------------------
DROP TABLE IF EXISTS `epr_menu`;
CREATE TABLE `epr_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(11) NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `data` blob NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent`(`parent`) USING BTREE,
  CONSTRAINT `epr_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `epr_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_menu
-- ----------------------------
INSERT INTO `epr_menu` VALUES (1, 'Quản lý', NULL, '/site/index', 1, NULL);
INSERT INTO `epr_menu` VALUES (2, 'Yêu cầu tạo nhạc chờ', 1, '/profile/index', 1, NULL);
INSERT INTO `epr_menu` VALUES (3, 'Yêu cầu thu âm', 1, '/profile/record', 2, NULL);
INSERT INTO `epr_menu` VALUES (4, 'Thuê bao đăng ký nhạc chờ', 1, '/user-rbt/index', 3, NULL);
INSERT INTO `epr_menu` VALUES (7, 'Admin', NULL, '/site/index', 1, NULL);
INSERT INTO `epr_menu` VALUES (8, 'Người dùng', 7, '/admin/user/index', NULL, NULL);
INSERT INTO `epr_menu` VALUES (10, 'Thống kê', NULL, '/site/index', 3, NULL);
INSERT INTO `epr_menu` VALUES (12, 'Trừ cước', 10, '/charging-log/index', NULL, NULL);
INSERT INTO `epr_menu` VALUES (14, 'Giới thiệu', 1, '/info/index', NULL, NULL);
INSERT INTO `epr_menu` VALUES (16, 'Nhạc nền', 1, '/background/index', NULL, NULL);
INSERT INTO `epr_menu` VALUES (18, 'Giọng đọc mẫu', 1, '/voices/index', NULL, NULL);
INSERT INTO `epr_menu` VALUES (20, 'Kênh bán', 1, '/profile/cp', NULL, NULL);

-- ----------------------------
-- Table structure for epr_mt_log
-- ----------------------------
DROP TABLE IF EXISTS `epr_mt_log`;
CREATE TABLE `epr_mt_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `msisdn` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Số điện thoại',
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Nội dung',
  `send_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT 'Gửi lúc',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT 'Loại',
  `returnCode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Mã lỗi',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 388 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_mt_log
-- ----------------------------
INSERT INTO `epr_mt_log` VALUES (1, '972333327', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: JohLUXA2. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-17 16:55:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (2, '972333327', 'Ma xac nhan cua Quy khach la: 927560', '2020-02-17 16:59:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (3, '329717979', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: ChTiHtIu. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-17 17:02:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (4, '966120686', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: yG5gBCDg. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-17 17:21:26', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (5, '326502205', 'Quy khach da cap nhat mat khau moi thanh cong. Xin cam on.', '2020-02-17 17:26:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (6, '326502205', 'Ma OTP cua Quy khach la 310961, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-17 17:34:28', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (7, '326502205', 'Ma OTP cua Quy khach la 883230, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-18 15:35:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (8, '972333327', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: V5aPKDEG. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-18 16:52:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (9, '972333327', 'Quy khach da cap nhat mat khau moi thanh cong. Xin cam on.', '2020-02-18 16:54:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (10, '972333327', 'Ma OTP cua Quy khach la 030476, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-18 16:56:37', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (11, '393636707', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: vH5ULV7h. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 09:56:21', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (12, '329717979', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: P1ZEHD34. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 10:01:58', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (13, '972333372', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: nz47kM2l. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 10:10:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (14, '972333327', 'Ma OTP cua Quy khach la 574926, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 14:21:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (15, '972333327', 'Ma OTP cua Quy khach la 726256, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 14:22:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (16, '972333327', 'Ma OTP cua Quy khach la 400949, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 14:23:00', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (17, '972333327', 'Ma OTP cua Quy khach la 958601, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 14:24:14', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (18, '972333327', 'Ma OTP cua Quy khach la 843651, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 14:24:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (19, '972333327', 'Ma OTP cua Quy khach la 647185, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-19 14:25:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (20, '972333327', 'Ma OTP cua Quy khach la 077173, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-22 11:33:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (21, '972333327', 'Ma OTP cua Quy khach la 110311, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 08:40:51', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (22, '972333327', 'Ma OTP cua Quy khach la 964388, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 08:40:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (23, '972333327', 'Ma OTP cua Quy khach la 343934, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 08:58:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (24, '972333327', 'Ma OTP cua Quy khach la 026300, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 08:58:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (25, '972333327', 'Ma OTP cua Quy khach la 974778, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:02:22', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (26, '972333327', 'Ma OTP cua Quy khach la 121686, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:02:26', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (27, '972333327', 'Ma OTP cua Quy khach la 080790, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:02:31', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (28, '972333327', 'Ma OTP cua Quy khach la 711977, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:07:31', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (29, '972333327', 'Ma OTP cua Quy khach la 120278, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:07:36', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (30, '972333327', 'Ma OTP cua Quy khach la 287674, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:07:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (31, '972333327', 'Ma OTP cua Quy khach la 922295, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:07:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (32, '972333327', 'Ma OTP cua Quy khach la 368556, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:08:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (33, '972333327', 'Ma OTP cua Quy khach la 197925, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:08:05', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (34, '972333327', 'Ma OTP cua Quy khach la 018224, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:08:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (35, '972333327', 'Ma OTP cua Quy khach la 531731, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:09:56', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (36, '972333327', 'Ma OTP cua Quy khach la 125097, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:12:00', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (37, '972333327', 'Ma OTP cua Quy khach la 133959, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:25:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (38, '972333327', 'Ma OTP cua Quy khach la 072635, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:33:36', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (39, '972333327', 'Ma OTP cua Quy khach la 762850, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:33:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (40, '972333327', 'Ma OTP cua Quy khach la 095388, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:34:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (41, '972333327', 'Ma OTP cua Quy khach la 772021, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:44:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (42, '972333327', 'Ma OTP cua Quy khach la 894774, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:44:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (43, '972333327', 'Ma OTP cua Quy khach la 454433, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:45:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (44, '972333327', 'Ma OTP cua Quy khach la 454914, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:45:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (45, '972333327', 'Ma OTP cua Quy khach la 166280, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-24 09:54:57', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (46, '329717979', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: wqPQFlhu. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-25 10:06:22', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (47, '972333327', 'Ma xac nhan cua Quy khach la: 794331', '2020-02-25 14:15:51', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (48, '972333327', 'Ma xac nhan cua Quy khach la: 756735', '2020-02-25 14:19:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (49, '329717979', 'Ma xac nhan cua Quy khach la: 436317', '2020-02-25 14:20:24', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (50, '972333327', 'Ma xac nhan cua Quy khach la: 769160', '2020-02-25 14:34:04', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (51, '972333327', 'Ma xac nhan cua Quy khach la: 897044', '2020-02-25 14:34:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (52, '329717979', 'Ma xac nhan cua Quy khach la: 171657', '2020-02-26 09:26:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (53, '329717979', 'Ma xac nhan cua Quy khach la: 235425', '2020-02-26 09:30:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (54, '329717979', 'Ma xac nhan cua Quy khach la: 269448', '2020-02-26 09:32:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (55, '329717979', 'Ma xac nhan cua Quy khach la: 757904', '2020-02-26 09:33:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (56, '329717979', 'Ma xac nhan cua Quy khach la: 658638', '2020-02-26 09:35:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (57, '329717979', 'Ma xac nhan cua Quy khach la: 294952', '2020-02-26 09:37:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (58, '329717979', 'Ma xac nhan cua Quy khach la: 370955', '2020-02-26 09:40:14', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (59, '329717979', 'Ma xac nhan cua Quy khach la: 872900', '2020-02-26 09:40:19', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (60, '329717979', 'Ma xac nhan cua Quy khach la: 737179', '2020-02-26 09:42:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (61, '329717979', 'Ma xac nhan cua Quy khach la: 123009', '2020-02-26 09:43:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (62, '329717979', 'Ma xac nhan cua Quy khach la: 860490', '2020-02-26 09:43:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (63, '329717979', 'Ma xac nhan cua Quy khach la: 553519', '2020-02-26 09:43:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (64, '972333327', 'Ma OTP cua Quy khach la 161873, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 10:34:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (65, '972333327', 'Ma OTP cua Quy khach la 262113, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 11:29:00', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (66, '972333327', 'Ma OTP cua Quy khach la 301314, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 11:29:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (67, '972333327', 'Ma OTP cua Quy khach la 192809, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 11:30:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (68, '972333327', 'Ma OTP cua Quy khach la 904231, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 11:30:20', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (69, '972333327', 'Ma OTP cua Quy khach la 380376, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 11:55:57', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (70, '972333327', 'Ma OTP cua Quy khach la 986975, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:03:57', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (71, '972333327', 'Ma OTP cua Quy khach la 421017, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:04:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (72, '972333327', 'Ma OTP cua Quy khach la 258378, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:04:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (73, '972333327', 'Ma OTP cua Quy khach la 489634, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:06:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (74, '972333327', 'Ma OTP cua Quy khach la 163701, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:06:45', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (75, '972333327', 'Ma OTP cua Quy khach la 413164, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:06:58', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (76, '972333327', 'Ma OTP cua Quy khach la 868775, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:07:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (77, '972333327', 'Ma OTP cua Quy khach la 933086, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:08:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (78, '972333327', 'Ma OTP cua Quy khach la 397746, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:08:23', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (79, '972333327', 'Ma OTP cua Quy khach la 804286, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:09:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (80, '972333327', 'Ma OTP cua Quy khach la 297148, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 12:41:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (81, '972333327', 'Ma OTP cua Quy khach la 922785, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 14:28:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (82, '972333327', 'Ma OTP cua Quy khach la 681545, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-26 14:31:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (83, '972333327', 'Ma OTP cua Quy khach la 660668, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 09:44:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (84, '972333327', 'Ma OTP cua Quy khach la 217930, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:07:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (85, '972333327', 'Ma OTP cua Quy khach la 202509, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:07:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (86, '972333327', 'Ma OTP cua Quy khach la 725313, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:08:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (87, '972333327', 'Ma OTP cua Quy khach la 039429, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:09:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (88, '972333327', 'Ma OTP cua Quy khach la 586321, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:15:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (89, '972333327', 'Ma OTP cua Quy khach la 579642, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:15:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (90, '972333327', 'Ma OTP cua Quy khach la 481477, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:16:27', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (91, '972333327', 'Ma OTP cua Quy khach la 396313, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:18:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (92, '972333327', 'Ma OTP cua Quy khach la 078097, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:18:17', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (93, '972333327', 'Ma OTP cua Quy khach la 561269, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:18:22', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (94, '972333327', 'Ma OTP cua Quy khach la 293159, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:19:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (95, '972333327', 'Ma OTP cua Quy khach la 619794, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:19:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (96, '972333327', 'Ma OTP cua Quy khach la 489619, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:20:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (97, '972333327', 'Ma OTP cua Quy khach la 530626, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 10:21:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (98, '972333327', 'Ma OTP cua Quy khach la 188332, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 15:16:05', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (99, '972333327', 'Ma OTP cua Quy khach la 449468, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 15:18:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (100, '972333327', 'Ma OTP cua Quy khach la 625218, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 15:20:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (101, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000385. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 15:20:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (102, '972333327', 'Ho so nhac cho doanh nghiep cua Quy khach da duoc khoi tao tren he thong, ma ho so: 000385. Vui long cho phe duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 15:20:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (103, '972333327', 'Ma OTP cua Quy khach la 873215, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:12:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (104, '972333327', 'Ma OTP cua Quy khach la 506270, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:45:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (105, '972333327', 'Ma OTP cua Quy khach la 797608, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:46:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (106, '972333327', 'Ma OTP cua Quy khach la 480023, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:47:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (107, '972333327', 'Ma OTP cua Quy khach la 343366, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:47:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (108, '972333327', 'Ma OTP cua Quy khach la 648305, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:47:56', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (109, '972333327', 'Tai khoan cua Quy khach khong du 550000 de thuc hien thanh toan nhac cho doanh nghiep. Vui long nap them tien va thuc hien lai. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:48:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (110, '972333327', 'Ma OTP cua Quy khach la 830992, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:50:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (111, '972333327', 'Ma OTP cua Quy khach la 490160, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:50:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (112, '972333327', 'Tai khoan cua Quy khach khong du 550000 de thuc hien thanh toan nhac cho doanh nghiep. Vui long nap them tien va thuc hien lai. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:50:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (113, '972333327', 'Ma OTP cua Quy khach la 146965, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:53:20', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (114, '972333327', 'Tai khoan cua Quy khach khong du 550000 de thuc hien thanh toan nhac cho doanh nghiep. Vui long nap them tien va thuc hien lai. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:54:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (115, '972333327', 'Ma OTP cua Quy khach la 217823, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:57:52', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (116, '972333327', 'Ma OTP cua Quy khach la 501520, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:57:56', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (117, '972333327', 'Ma OTP cua Quy khach la 835701, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:58:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (118, '972333327', 'Tai khoan cua Quy khach khong du 550000 de thuc hien thanh toan nhac cho doanh nghiep. Vui long nap them tien va thuc hien lai. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 16:59:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (119, '972333327', 'Ma OTP cua Quy khach la 925730, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:07:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (120, '972333327', 'Ma OTP cua Quy khach la 189256, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:08:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (121, '972333327', 'Ma OTP cua Quy khach la 021537, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:08:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (122, '972333327', 'Ma OTP cua Quy khach la 157393, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:08:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (123, '972333327', 'Ma OTP cua Quy khach la 073746, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:08:26', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (124, '972333327', 'Ma OTP cua Quy khach la 572132, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:09:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (125, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000387. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:10:00', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (126, '972333327', 'Ma OTP cua Quy khach la 877096, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:21:15', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (127, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000388. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:21:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (128, '972333327', 'Ma OTP cua Quy khach la 240453, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:23:51', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (129, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000389. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:25:24', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (130, '972333327', 'Ma OTP cua Quy khach la 566014, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:27:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (131, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000390. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-27 17:27:57', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (132, '972333327', 'Ma OTP cua Quy khach la 043665, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 08:41:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (133, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000391. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 08:51:59', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (134, '972333327', 'Ma OTP cua Quy khach la 050316, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:25:15', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (135, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000392. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:25:28', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (136, '972333327', 'Ma OTP cua Quy khach la 963378, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:27:25', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (137, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000393. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:27:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (138, '972333327', 'Ma OTP cua Quy khach la 357400, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:34:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (139, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000394. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:34:41', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (140, '972333327', 'Ma OTP cua Quy khach la 639058, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:36:59', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (141, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000395. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:37:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (142, '972333327', 'Ma OTP cua Quy khach la 280210, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:38:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (143, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000396. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:38:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (144, '972333327', 'Ma OTP cua Quy khach la 082462, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:39:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (145, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000397. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:40:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (146, '972333327', 'Ma OTP cua Quy khach la 557061, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:42:59', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (147, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000398. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:43:15', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (148, '972333327', 'Ma OTP cua Quy khach la 146930, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:46:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (149, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000399. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:46:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (150, '972333327', 'Ma OTP cua Quy khach la 766369, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:48:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (151, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000400. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:48:17', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (152, '972333327', 'Ma OTP cua Quy khach la 471351, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:49:35', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (153, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000401. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:49:41', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (154, '972333327', 'Ma OTP cua Quy khach la 860265, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:51:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (155, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000402. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:52:07', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (156, '972333327', 'Ma OTP cua Quy khach la 233579, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:53:41', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (157, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000403. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:54:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (158, '972333327', 'Ma OTP cua Quy khach la 407020, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:57:36', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (159, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000404. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:57:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (160, '972333327', 'Ma OTP cua Quy khach la 690962, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 09:58:23', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (161, '972333327', 'Ma OTP cua Quy khach la 083720, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 10:01:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (162, '972333327', 'Ma OTP cua Quy khach la 685499, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 10:04:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (163, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000406. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 10:07:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (164, '972333327', 'Ma OTP cua Quy khach la 425033, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 10:07:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (165, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000407. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 10:07:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (166, '972333327', 'Ma OTP cua Quy khach la 540462, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 10:15:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (167, '972333327', 'Quy khach da cap nhat ho so 000407 thanh cong. Vui long cho phan hoi phe duyet ho so. Xin cam on.', '2020-02-28 10:24:31', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (168, '972333327', 'Ma OTP cua Quy khach la 954930, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 14:11:56', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (169, '972333327', 'Ma OTP cua Quy khach la 414578, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-02-28 15:01:45', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (170, '972333326', 'Ma xac nhan cua Quy khach la: 143857', '2020-03-02 08:30:18', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (171, '329717978', 'Ma xac nhan cua Quy khach la: 639642', '2020-03-02 08:31:23', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (172, '972333329', 'Ma xac nhan cua Quy khach la: 678588', '2020-03-02 08:35:31', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (173, '972333329', 'Ma xac nhan cua Quy khach la: 884863', '2020-03-02 08:36:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (174, '321456789', 'Ma xac nhan cua Quy khach la: 220913', '2020-03-02 08:40:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (175, '972333321', 'Ma xac nhan cua Quy khach la: 804454', '2020-03-02 08:44:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (176, '972333321', 'Ma xac nhan cua Quy khach la: 216196', '2020-03-02 08:44:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (177, '972333321', 'Ma xac nhan cua Quy khach la: 447318', '2020-03-02 08:44:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (178, '972333321', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: phong!@#69A. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 08:44:56', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (179, '972333327', 'Ma OTP cua Quy khach la 474527, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 09:11:05', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (180, '972333327', 'Quy khach da thanh toan 550000 cho ho so nhac cho doanh nghiep, ma so 000414. Vui long cho ket qua tu nhan vien kiem duyet. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 09:11:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (181, '972333327', 'Ma OTP cua Quy khach la 481928, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 17:06:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (182, '972333327', 'Ma OTP cua Quy khach la 940271, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 17:17:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (183, '972333327', 'Ma OTP cua Quy khach la 739742, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 17:18:03', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (184, '972333327', 'Ma OTP cua Quy khach la 467385, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 17:22:11', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (185, '972333327', 'Ma OTP cua Quy khach la 438167, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-02 17:27:03', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (186, '972333327', 'Ma OTP cua Quy khach la 225097, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-03 11:02:58', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (187, '972333327', 'Ma OTP cua Quy khach la 272952, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-03 11:03:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (188, '972333327', 'Ma OTP cua Quy khach la 882179, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-03 13:41:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (189, '972333327', 'Ma OTP cua Quy khach la 127395, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-03 14:31:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (190, '972333327', 'Ma OTP cua Quy khach la 027817, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-03 14:58:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (191, '972333327', 'Ma OTP cua Quy khach la 861875, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 550000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-03 16:53:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (192, '326502205', 'Ma xac nhan cua Quy khach la: 536952', '2020-03-05 08:52:35', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (193, '973462530', 'Ma xac nhan cua Quy khach la: 215639', '2020-03-05 15:20:42', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (194, '973462530', 'Ma xac nhan cua Quy khach la: 492579', '2020-03-05 15:20:42', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (195, '973462530', 'Ma xac nhan cua Quy khach la: 302968', '2020-03-05 15:23:38', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (196, '973462530', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: Duong@123. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 15:23:54', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (197, '973462530', 'Ma OTP cua Quy khach la 737829, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 15:39:52', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (198, '973462530', 'Ma OTP cua Quy khach la 024807, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 15:40:24', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (199, '973462530', 'Ma OTP cua Quy khach la 749237, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 16:17:50', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (200, '973462530', 'Ma OTP cua Quy khach la 988908, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 16:26:09', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (201, '973462530', 'Ma OTP cua Quy khach la 658449, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 17:48:09', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (202, '973462530', 'Ma OTP cua Quy khach la 160810, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 17:53:56', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (203, '973462530', 'Ma OTP cua Quy khach la 054353, Quy khach dang thuc hien giao dich thanh toan phi DV Nhac cho doanh nghiep, so tien la 1050000 dong tai http://doanhnghiep.imuzik.vn. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-05 17:54:01', 1, '000000');
INSERT INTO `epr_mt_log` VALUES (204, '976332123', 'Ma xac nhan cua Quy khach la: 000241', '2020-03-06 09:28:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (205, '976332123', 'Ma xac nhan cua Quy khach la: 676949', '2020-03-06 09:28:14', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (206, '976332123', 'Ma xac nhan cua Quy khach la: 970783', '2020-03-06 09:28:18', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (207, '972333327', 'Ma xac nhan cua Quy khach la: 171516', '2020-03-06 17:06:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (208, '972333327', 'Ma xac nhan cua Quy khach la: 084698', '2020-03-06 17:07:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (209, '972333327', 'Ma xac nhan cua Quy khach la: 586020', '2020-03-06 17:18:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (210, '972333327', 'Ma xac nhan cua Quy khach la: 649928', '2020-03-06 17:18:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (211, '972333327', 'Ma xac nhan cua Quy khach la: 240301', '2020-03-06 17:22:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (212, '972333327', 'Ma xac nhan cua Quy khach la: 952839', '2020-03-06 17:22:37', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (213, '972333327', 'Ma xac nhan cua Quy khach la: 959564', '2020-03-06 19:02:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (214, '325333666', 'Ma xac nhan cua Quy khach la: 040667', '2020-03-06 19:04:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (215, '324566444', 'Ma xac nhan cua Quy khach la: 842616', '2020-03-06 19:12:23', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (216, '324714141', 'Ma xac nhan cua Quy khach la: 482418', '2020-03-06 19:14:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (217, '324714141', 'Ma xac nhan cua Quy khach la: 912322', '2020-03-06 19:16:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (218, '324714141', 'Ma xac nhan cua Quy khach la: 209061', '2020-03-06 19:16:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (219, '234567890', 'Ma xac nhan cua Quy khach la: 437541', '2020-03-06 19:18:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (220, '234567890', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: phong!@#69A. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-06 19:18:48', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (221, '966120686', 'Ma xac nhan cua Quy khach la: 994007', '2020-03-06 19:25:37', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (222, '972333327', 'Ma xac nhan cua Quy khach la: 774068', '2020-03-06 19:27:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (223, '972333327', 'Ma xac nhan cua Quy khach la: 176117', '2020-03-06 19:33:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (224, '972333327', 'Ma xac nhan cua Quy khach la: 993221', '2020-03-06 19:39:27', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (225, '972333327', 'Ma xac nhan cua Quy khach la: 901400', '2020-03-06 19:40:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (226, '972333327', 'Ma xac nhan cua Quy khach la: 239531', '2020-03-06 19:41:17', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (227, '214225252', 'Ma xac nhan cua Quy khach la: 574046', '2020-03-06 19:55:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (228, '214225252', 'Ma xac nhan cua Quy khach la: 460602', '2020-03-06 19:55:14', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (229, '321456123', 'Ma xac nhan cua Quy khach la: 149111', '2020-03-06 20:16:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (230, '234567891', 'Ma xac nhan cua Quy khach la: 274065', '2020-03-06 20:17:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (231, '972333328', 'Ma xac nhan cua Quy khach la: 783722', '2020-03-06 20:20:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (232, '972333328', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: phong!@#69A. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-06 20:22:15', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (233, '972333329', 'Ma xac nhan cua Quy khach la: 538772', '2020-03-06 20:25:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (234, '329717979', 'Ma xac nhan cua Quy khach la: 963240', '2020-03-06 20:29:01', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (235, '329717979', 'Ma xac nhan cua Quy khach la: 738551', '2020-03-06 20:31:31', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (236, '966120682', 'Ma xac nhan cua Quy khach la: 782474', '2020-03-06 20:36:48', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (237, '972333324', 'Ma xac nhan cua Quy khach la: 353174', '2020-03-06 20:38:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (238, '972333325', 'Ma xac nhan cua Quy khach la: 271867', '2020-03-06 20:41:50', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (239, '972333325', 'Ma xac nhan cua Quy khach la: 691260', '2020-03-06 20:41:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (240, '972333322', 'Ma xac nhan cua Quy khach la: 791305', '2020-03-06 20:44:36', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (241, '972333322', 'Ma xac nhan cua Quy khach la: 118860', '2020-03-06 20:45:48', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (242, '972333327', 'Ma xac nhan cua Quy khach la: 337138', '2020-03-08 16:59:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (243, '972333327', 'Ma xac nhan cua Quy khach la: 914477', '2020-03-08 17:02:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (244, '972333327', 'Ma xac nhan cua Quy khach la: 691416', '2020-03-08 17:04:18', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (245, '972333327', 'Ma xac nhan cua Quy khach la: 803535', '2020-03-08 17:06:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (246, '972333327', 'Ma xac nhan cua Quy khach la: 874344', '2020-03-08 17:08:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (247, '972333327', 'Ma xac nhan cua Quy khach la: 832243', '2020-03-08 17:12:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (248, '972333327', 'Ma xac nhan cua Quy khach la: 055976', '2020-03-08 17:17:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (249, '972333327', 'Ma xac nhan cua Quy khach la: 542918', '2020-03-08 17:18:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (250, '972333327', 'Ma xac nhan cua Quy khach la: 120955', '2020-03-08 17:36:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (251, '972333327', 'Ma xac nhan cua Quy khach la: 418670', '2020-03-08 17:47:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (252, '972333327', 'Ma xac nhan cua Quy khach la: 427485', '2020-03-08 17:48:56', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (253, '972333327', 'Ma xac nhan cua Quy khach la: 911119', '2020-03-08 17:52:41', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (254, '972333327', 'Ma xac nhan cua Quy khach la: 522702', '2020-03-08 17:54:16', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (255, '972333327', 'Ma xac nhan cua Quy khach la: 734259', '2020-03-08 17:57:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (256, '972333327', 'Ma xac nhan cua Quy khach la: 096001', '2020-03-08 17:59:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (257, '972333327', 'Ma xac nhan cua Quy khach la: 988364', '2020-03-08 18:02:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (258, '972333327', 'Ma xac nhan cua Quy khach la: 656036', '2020-03-08 18:03:17', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (259, '972333327', 'Ma xac nhan cua Quy khach la: 733833', '2020-03-08 18:06:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (260, '972333327', 'Ma xac nhan cua Quy khach la: 436411', '2020-03-08 18:11:58', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (261, '972333327', 'Ma xac nhan cua Quy khach la: 184043', '2020-03-08 18:13:57', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (262, '972333327', 'Ma xac nhan cua Quy khach la: 766127', '2020-03-08 18:16:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (263, '972333327', 'Ma xac nhan cua Quy khach la: 854380', '2020-03-08 18:17:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (264, '972333327', 'Ma xac nhan cua Quy khach la: 519139', '2020-03-08 18:20:45', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (265, '972333327', 'Ma xac nhan cua Quy khach la: 396856', '2020-03-08 18:20:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (266, '972333327', 'Ma xac nhan cua Quy khach la: 694457', '2020-03-08 18:21:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (267, '972333327', 'Ma xac nhan cua Quy khach la: 802245', '2020-03-08 18:22:22', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (268, '972333327', 'Ma xac nhan cua Quy khach la: 954866', '2020-03-08 18:22:37', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (269, '972333327', 'Ma xac nhan cua Quy khach la: 681459', '2020-03-08 18:24:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (270, '972333327', 'Ma xac nhan cua Quy khach la: 736802', '2020-03-08 18:24:45', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (271, '972333327', 'Ma xac nhan cua Quy khach la: 695150', '2020-03-08 18:25:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (272, '972333327', 'Ma xac nhan cua Quy khach la: 573484', '2020-03-08 18:25:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (273, '972333327', 'Ma xac nhan cua Quy khach la: 714392', '2020-03-08 18:25:54', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (274, '972333327', 'Ma xac nhan cua Quy khach la: 701696', '2020-03-08 18:26:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (275, '972333327', 'Ma xac nhan cua Quy khach la: 677068', '2020-03-08 18:27:20', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (276, '972333327', 'Ma xac nhan cua Quy khach la: 781043', '2020-03-08 18:27:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (277, '972333327', 'Ma xac nhan cua Quy khach la: 627419', '2020-03-08 18:27:59', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (278, '972333327', 'Ma xac nhan cua Quy khach la: 849687', '2020-03-08 18:30:28', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (279, '972333327', 'Ma xac nhan cua Quy khach la: 500486', '2020-03-08 18:31:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (280, '972333327', 'Ma xac nhan cua Quy khach la: 807024', '2020-03-08 18:31:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (281, '972333327', 'Ma xac nhan cua Quy khach la: 610017', '2020-03-08 18:33:50', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (282, '972333327', 'Ma xac nhan cua Quy khach la: 812125', '2020-03-08 18:34:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (283, '972333327', 'Ma xac nhan cua Quy khach la: 736225', '2020-03-08 18:35:05', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (284, '972333327', 'Ma xac nhan cua Quy khach la: 193100', '2020-03-08 18:35:16', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (285, '972333327', 'Ma xac nhan cua Quy khach la: 711018', '2020-03-08 18:35:22', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (286, '972333327', 'Ma xac nhan cua Quy khach la: 255806', '2020-03-08 18:41:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (287, '972333327', 'Ma xac nhan cua Quy khach la: 834902', '2020-03-08 18:41:17', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (288, '972333327', 'Ma xac nhan cua Quy khach la: 314374', '2020-03-08 18:42:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (289, '972333327', 'Ma xac nhan cua Quy khach la: 160715', '2020-03-08 18:43:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (290, '972333327', 'Ma xac nhan cua Quy khach la: 938957', '2020-03-08 18:43:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (291, '972333327', 'Ma xac nhan cua Quy khach la: 131516', '2020-03-08 18:44:59', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (292, '972333327', 'Ma xac nhan cua Quy khach la: 215323', '2020-03-08 18:45:26', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (293, '972333327', 'Ma xac nhan cua Quy khach la: 942181', '2020-03-08 18:49:03', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (294, '972333327', 'Ma xac nhan cua Quy khach la: 797356', '2020-03-08 18:49:29', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (295, '972333327', 'Ma xac nhan cua Quy khach la: 240763', '2020-03-08 18:53:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (296, '972333327', 'Ma xac nhan cua Quy khach la: 493364', '2020-03-08 18:53:42', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (297, '972333327', 'Ma xac nhan cua Quy khach la: 140316', '2020-03-08 18:54:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (298, '972333327', 'Ma xac nhan cua Quy khach la: 217150', '2020-03-08 18:54:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (299, '972333327', 'Ma xac nhan cua Quy khach la: 184752', '2020-03-08 18:55:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (300, '972333327', 'Quy khach da cap nhat mat khau moi thanh cong. Xin cam on.', '2020-03-08 18:56:16', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (301, '972333327', 'Ma xac nhan cua Quy khach la: 141249', '2020-03-08 19:09:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (302, '972333327', 'Ma xac nhan cua Quy khach la: 102866', '2020-03-08 19:09:51', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (303, '972333327', 'Ma xac nhan cua Quy khach la: 576874', '2020-03-08 19:11:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (304, '972333327', 'Ma xac nhan cua Quy khach la: 037383', '2020-03-08 19:31:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (305, '972333327', 'Ma xac nhan cua Quy khach la: 478510', '2020-03-08 19:31:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (306, '972333327', 'Ma xac nhan cua Quy khach la: 318124', '2020-03-08 19:33:36', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (307, '972333327', 'Ma xac nhan cua Quy khach la: 492576', '2020-03-08 19:35:17', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (308, '972333327', 'Ma xac nhan cua Quy khach la: 881360', '2020-03-08 19:36:04', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (309, '972333456', 'Ma xac nhan cua Quy khach la: 503637', '2020-03-08 19:37:46', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (310, '972333456', 'Ma xac nhan cua Quy khach la: 546301', '2020-03-08 19:38:21', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (311, '972345678', 'Ma xac nhan cua Quy khach la: 091958', '2020-03-08 19:42:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (312, '971532125', 'Ma xac nhan cua Quy khach la: 510934', '2020-03-08 19:44:10', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (313, '972581470', 'Ma xac nhan cua Quy khach la: 854621', '2020-03-08 19:45:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (314, '972581470', 'Ma xac nhan cua Quy khach la: 112384', '2020-03-08 19:46:58', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (315, '329712345', 'Ma xac nhan cua Quy khach la: 516961', '2020-03-08 19:47:35', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (316, '972333327', 'Ma xac nhan cua Quy khach la: 312543', '2020-03-08 19:47:50', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (317, '972145896', 'Ma xac nhan cua Quy khach la: 838889', '2020-03-08 19:50:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (318, '321478963', 'Ma xac nhan cua Quy khach la: 174073', '2020-03-08 19:52:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (319, '215256136', 'Ma xac nhan cua Quy khach la: 632188', '2020-03-08 19:53:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (320, '215256136', 'Ma xac nhan cua Quy khach la: 503138', '2020-03-08 19:53:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (321, '972233457', 'Ma xac nhan cua Quy khach la: 610246', '2020-03-08 19:55:32', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (322, '971477899', 'Ma xac nhan cua Quy khach la: 276732', '2020-03-08 19:57:33', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (323, '987897897', 'Ma xac nhan cua Quy khach la: 637247', '2020-03-08 19:58:40', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (324, '972332103', 'Ma xac nhan cua Quy khach la: 500434', '2020-03-08 20:10:04', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (325, '972222333', 'Ma xac nhan cua Quy khach la: 590662', '2020-03-08 20:11:23', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (326, '971325467', 'Ma xac nhan cua Quy khach la: 965291', '2020-03-08 20:12:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (327, '978978998', 'Ma xac nhan cua Quy khach la: 436595', '2020-03-08 20:14:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (328, '978978998', 'Ma xac nhan cua Quy khach la: 050080', '2020-03-08 20:15:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (329, '978978998', 'Ma xac nhan cua Quy khach la: 342414', '2020-03-08 20:15:48', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (330, '987989741', 'Ma xac nhan cua Quy khach la: 195759', '2020-03-08 20:16:25', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (331, '987989741', 'Ma xac nhan cua Quy khach la: 905926', '2020-03-08 20:18:24', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (332, '987989741', 'Ma xac nhan cua Quy khach la: 396424', '2020-03-08 20:19:26', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (333, '987989741', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: phong!@#69A. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-08 20:19:41', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (334, '976332123', 'Ma xac nhan cua Quy khach la: 561633', '2020-03-09 08:14:09', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (335, '976332123', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: phong!@#69A. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-09 08:15:59', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (336, '326502205', 'Ma xac nhan cua Quy khach la: 772320', '2020-03-09 08:17:20', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (337, '976322123', 'Ma xac nhan cua Quy khach la: 299209', '2020-03-09 08:19:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (338, '976322123', 'Quy khach da dang ky tai khoan khai bao nhac cho doanh nghiep cua Viettel. Mat khau dang nhap cua Quy khach la: phong!@#69A. Chi tiet LH 198 (mien phi). Xin cam on.', '2020-03-09 08:24:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (339, '972333327', 'Ma xac nhan cua Quy khach la: 669792', '2020-03-09 08:34:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (340, '972333327', 'Quy khach da cap nhat mat khau moi thanh cong. Xin cam on.', '2020-03-09 08:34:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (341, '972333327', 'Ma xac nhan cua Quy khach la: 219560', '2020-03-09 08:35:34', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (342, '972333327', 'Quy khach da cap nhat mat khau moi thanh cong. Xin cam on.', '2020-03-09 08:35:50', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (343, '972333327', 'Ma xac nhan cua Quy khach la: 642771', '2020-03-09 08:38:19', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (344, '972333327', 'Ma xac nhan cua Quy khach la: 507582', '2020-03-09 08:38:51', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (345, '972333327', 'Ma xac nhan cua Quy khach la: 837155', '2020-03-09 08:40:06', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (346, '972333327', 'Ma xac nhan cua Quy khach la: 284055', '2020-03-09 08:41:20', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (347, '972333327', 'Ma xac nhan cua Quy khach la: 729953', '2020-03-09 08:42:13', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (348, '972333327', 'Ma xac nhan cua Quy khach la: 352455', '2020-03-09 08:45:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (349, '972333327', 'Ma xac nhan cua Quy khach la: 513206', '2020-03-09 08:52:03', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (350, '972333327', 'Ma xac nhan cua Quy khach la: 856960', '2020-03-09 08:52:45', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (351, '972333327', 'Ma xac nhan cua Quy khach la: 083378', '2020-03-09 08:53:31', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (352, '972333327', 'Ma xac nhan cua Quy khach la: 702640', '2020-03-09 08:55:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (353, '972333327', 'Ma xac nhan cua Quy khach la: 609569', '2020-03-09 08:55:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (354, '972333327', 'Ma xac nhan cua Quy khach la: 534393', '2020-03-09 08:56:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (355, '972333327', 'Ma xac nhan cua Quy khach la: 756039', '2020-03-09 08:56:49', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (356, '972333327', 'Ma xac nhan cua Quy khach la: 131037', '2020-03-09 08:58:39', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (357, '972333327', 'Ma xac nhan cua Quy khach la: 641627', '2020-03-09 08:58:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (358, '972333327', 'Ma xac nhan cua Quy khach la: 259747', '2020-03-09 09:00:52', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (359, '972333327', 'Ma xac nhan cua Quy khach la: 409876', '2020-03-09 09:02:43', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (360, '972333327', 'Ma xac nhan cua Quy khach la: 366190', '2020-03-09 09:03:30', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (361, '329717777', 'Ma xac nhan cua Quy khach la: 994333', '2020-03-09 09:13:08', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (362, '972335327', 'Ma xac nhan cua Quy khach la: 588222', '2020-03-09 14:08:12', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (363, '972367327', 'Ma xac nhan cua Quy khach la: 932131', '2020-03-09 14:12:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (364, '329717979', 'Ma xac nhan cua Quy khach la: 927839', '2020-03-09 14:15:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (365, '329717979', 'Ma xac nhan cua Quy khach la: 541821', '2020-03-09 14:15:51', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (366, '329717979', 'Ma xac nhan cua Quy khach la: 723341', '2020-03-09 14:15:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (367, '972354327', 'Ma xac nhan cua Quy khach la: 277150', '2020-03-09 14:18:37', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (368, '972763327', 'Ma xac nhan cua Quy khach la: 767955', '2020-03-09 14:22:20', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (369, '972330927', 'Ma xac nhan cua Quy khach la: 572788', '2020-03-09 14:25:45', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (370, '972123327', 'Ma xac nhan cua Quy khach la: 379774', '2020-03-09 14:28:02', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (371, '972334827', 'Ma xac nhan cua Quy khach la: 578304', '2020-03-09 14:29:07', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (372, '972353127', 'Ma xac nhan cua Quy khach la: 226579', '2020-03-09 14:30:50', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (373, '972321327', 'Ma xac nhan cua Quy khach la: 006791', '2020-03-09 14:31:47', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (374, '972333627', 'Ma xac nhan cua Quy khach la: 400747', '2020-03-09 14:32:44', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (375, '972331227', 'Ma xac nhan cua Quy khach la: 347115', '2020-03-09 14:33:52', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (376, '972352327', 'Ma xac nhan cua Quy khach la: 404947', '2020-03-09 14:35:07', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (377, '972397327', 'Ma xac nhan cua Quy khach la: 248806', '2020-03-09 14:35:55', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (378, '972348627', 'Ma xac nhan cua Quy khach la: 918215', '2020-03-09 14:36:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (379, '971234327', 'Ma xac nhan cua Quy khach la: 437401', '2020-03-09 14:38:38', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (380, '972833627', 'Ma xac nhan cua Quy khach la: 692934', '2020-03-09 14:41:28', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (381, '972852327', 'Ma xac nhan cua Quy khach la: 265041', '2020-03-09 14:42:24', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (382, '972456727', 'Ma xac nhan cua Quy khach la: 379120', '2020-03-09 14:45:22', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (383, '972312327', 'Ma xac nhan cua Quy khach la: 236837', '2020-03-09 14:46:26', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (384, '972333327', 'Ma xac nhan cua Quy khach la: 816083', '2020-03-09 15:07:23', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (385, '972333327', 'Ma xac nhan cua Quy khach la: 239108', '2020-03-09 15:08:24', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (386, '972333327', 'Ma xac nhan cua Quy khach la: 839730', '2020-03-09 15:08:53', 1, NULL);
INSERT INTO `epr_mt_log` VALUES (387, '972333327', 'Ma xac nhan cua Quy khach la: 139362', '2020-03-09 15:09:23', 1, NULL);

-- ----------------------------
-- Table structure for epr_otp
-- ----------------------------
DROP TABLE IF EXISTS `epr_otp`;
CREATE TABLE `epr_otp`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `msisdn` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Số điện thoại',
  `otp` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'OTP',
  `expired_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT 'Hết hạn',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 307 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_otp
-- ----------------------------
INSERT INTO `epr_otp` VALUES (100, '972333326', '143857', '2020-03-02 09:00:13');
INSERT INTO `epr_otp` VALUES (101, '329717978', '639642', '2020-03-02 09:01:19');
INSERT INTO `epr_otp` VALUES (104, '321456789', '220913', '2020-03-02 09:10:29');
INSERT INTO `epr_otp` VALUES (130, '973462530', '054353', '2020-03-05 18:24:01');
INSERT INTO `epr_otp` VALUES (141, '325333666', '040667', '2020-03-06 19:33:58');
INSERT INTO `epr_otp` VALUES (142, '324566444', '842616', '2020-03-06 19:42:18');
INSERT INTO `epr_otp` VALUES (145, '324714141', '209061', '2020-03-06 19:46:35');
INSERT INTO `epr_otp` VALUES (147, '966120686', '994007', '2020-03-06 19:55:33');
INSERT INTO `epr_otp` VALUES (154, '214225252', '460602', '2020-03-06 20:25:10');
INSERT INTO `epr_otp` VALUES (155, '321456123', '149111', '2020-03-06 20:45:58');
INSERT INTO `epr_otp` VALUES (156, '234567891', '274065', '2020-03-06 20:47:45');
INSERT INTO `epr_otp` VALUES (158, '972333329', '538772', '2020-03-06 20:55:09');
INSERT INTO `epr_otp` VALUES (161, '966120682', '782474', '2020-03-06 21:06:44');
INSERT INTO `epr_otp` VALUES (162, '972333324', '353174', '2020-03-06 21:08:43');
INSERT INTO `epr_otp` VALUES (164, '972333325', '691260', '2020-03-06 21:11:50');
INSERT INTO `epr_otp` VALUES (166, '972333322', '118860', '2020-03-06 21:15:44');
INSERT INTO `epr_otp` VALUES (234, '972333456', '546301', '2020-03-08 20:08:17');
INSERT INTO `epr_otp` VALUES (235, '972345678', '091958', '2020-03-08 20:12:45');
INSERT INTO `epr_otp` VALUES (236, '971532125', '510934', '2020-03-08 20:14:06');
INSERT INTO `epr_otp` VALUES (238, '972581470', '112384', '2020-03-08 20:16:54');
INSERT INTO `epr_otp` VALUES (239, '329712345', '516961', '2020-03-08 20:17:31');
INSERT INTO `epr_otp` VALUES (241, '972145896', '838889', '2020-03-08 20:20:02');
INSERT INTO `epr_otp` VALUES (242, '321478963', '174073', '2020-03-08 20:22:04');
INSERT INTO `epr_otp` VALUES (244, '215256136', '503138', '2020-03-08 20:23:43');
INSERT INTO `epr_otp` VALUES (245, '972233457', '610246', '2020-03-08 20:25:28');
INSERT INTO `epr_otp` VALUES (246, '971477899', '276732', '2020-03-08 20:27:29');
INSERT INTO `epr_otp` VALUES (247, '987897897', '637247', '2020-03-08 20:28:36');
INSERT INTO `epr_otp` VALUES (248, '972332103', '500434', '2020-03-08 20:40:00');
INSERT INTO `epr_otp` VALUES (249, '972222333', '590662', '2020-03-08 20:41:19');
INSERT INTO `epr_otp` VALUES (250, '971325467', '965291', '2020-03-08 20:42:35');
INSERT INTO `epr_otp` VALUES (253, '978978998', '342414', '2020-03-08 20:45:44');
INSERT INTO `epr_otp` VALUES (258, '326502205', '772320', '2020-03-09 08:47:16');
INSERT INTO `epr_otp` VALUES (280, '329717777', '994333', '2020-03-09 09:43:04');
INSERT INTO `epr_otp` VALUES (281, '972335327', '588222', '2020-03-09 14:38:08');
INSERT INTO `epr_otp` VALUES (282, '972367327', '932131', '2020-03-09 14:42:34');
INSERT INTO `epr_otp` VALUES (285, '329717979', '723341', '2020-03-09 14:45:51');
INSERT INTO `epr_otp` VALUES (286, '972354327', '277150', '2020-03-09 14:48:33');
INSERT INTO `epr_otp` VALUES (287, '972763327', '767955', '2020-03-09 14:52:16');
INSERT INTO `epr_otp` VALUES (288, '972330927', '572788', '2020-03-09 14:55:41');
INSERT INTO `epr_otp` VALUES (289, '972123327', '379774', '2020-03-09 14:57:58');
INSERT INTO `epr_otp` VALUES (290, '972334827', '578304', '2020-03-09 14:59:03');
INSERT INTO `epr_otp` VALUES (291, '972353127', '226579', '2020-03-09 15:00:46');
INSERT INTO `epr_otp` VALUES (292, '972321327', '006791', '2020-03-09 15:01:43');
INSERT INTO `epr_otp` VALUES (293, '972333627', '400747', '2020-03-09 15:02:40');
INSERT INTO `epr_otp` VALUES (294, '972331227', '347115', '2020-03-09 15:03:48');
INSERT INTO `epr_otp` VALUES (295, '972352327', '404947', '2020-03-09 15:05:02');
INSERT INTO `epr_otp` VALUES (296, '972397327', '248806', '2020-03-09 15:05:51');
INSERT INTO `epr_otp` VALUES (297, '972348627', '918215', '2020-03-09 15:06:49');
INSERT INTO `epr_otp` VALUES (298, '971234327', '437401', '2020-03-09 15:08:34');
INSERT INTO `epr_otp` VALUES (299, '972833627', '692934', '2020-03-09 15:11:24');
INSERT INTO `epr_otp` VALUES (300, '972852327', '265041', '2020-03-09 15:12:20');
INSERT INTO `epr_otp` VALUES (301, '972456727', '379120', '2020-03-09 15:15:18');
INSERT INTO `epr_otp` VALUES (302, '972312327', '236837', '2020-03-09 15:16:22');
INSERT INTO `epr_otp` VALUES (306, '972333327', '139362', '2020-03-09 15:39:19');

-- ----------------------------
-- Table structure for epr_rbt_hot
-- ----------------------------
DROP TABLE IF EXISTS `epr_rbt_hot`;
CREATE TABLE `epr_rbt_hot`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `enterprise_file_di` bigint(20) UNSIGNED NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_rbt_hot
-- ----------------------------
INSERT INTO `epr_rbt_hot` VALUES (1, 'Viettel hot', 481, '../uploads/media1/images/rbt-hot\\ce/52/2c/eb7ab8bd90b6.png', '2020-03-09 11:23:39', 1, '2020-03-09 10:40:03', NULL);
INSERT INTO `epr_rbt_hot` VALUES (2, 'Viettel hot 2', 480, '../uploads/media1/images/rbt-hot\\df/42/2d/47b7b6ee4e06.png', '2020-03-09 11:23:33', 1, '2020-03-09 10:48:57', NULL);
INSERT INTO `epr_rbt_hot` VALUES (3, 'Viettel hot 3', 478, '../uploads/media1/images/rbt-hot\\6e/00/06/17af6db6ccfa.png', '2020-03-09 11:22:59', 1, '2020-03-09 10:49:13', NULL);
INSERT INTO `epr_rbt_hot` VALUES (4, 'Viettel hot 4', 477, '../uploads/media1/images/rbt-hot\\89/50/08/23cd6f221858.png', '2020-03-09 11:22:53', 1, '2020-03-09 10:49:33', NULL);
INSERT INTO `epr_rbt_hot` VALUES (5, 'Viettel hot 5', 476, '../uploads/media1/images/rbt-hot\\17/de/e1/46d032218711.png', '2020-03-09 11:22:47', 1, '2020-03-09 10:49:51', NULL);
INSERT INTO `epr_rbt_hot` VALUES (6, 'Viettel hot 6', 475, '../uploads/media1/images/rbt-hot\\e7/bc/ce/6ccbb26b9fcb.png', '2020-03-09 11:22:39', 1, '2020-03-09 10:50:14', NULL);

-- ----------------------------
-- Table structure for epr_recording_contents
-- ----------------------------
DROP TABLE IF EXISTS `epr_recording_contents`;
CREATE TABLE `epr_recording_contents`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recording_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Nội dung thu âm',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT 'Tạo lúc',
  `created_by` int(20) NOT NULL COMMENT 'Tạo bởi',
  `updated_at` datetime(0) NOT NULL COMMENT 'Cập nhật lúc',
  `updated_by` int(20) NULL DEFAULT NULL COMMENT 'Cập nhật bởi',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_recording_contents
-- ----------------------------
INSERT INTO `epr_recording_contents` VALUES (1, 'Công ty … kính chào quý khách! Quý khách đang gọi đến số hotline (1900…)\r\ncủa ….(công ty ) địa chỉ tại …. Quý khách vui lòng đợi trong giây lát , chuyên viên tư vấn chăm sóc khách hàng của công ty chúng tôi sẽ tiếp nhận và phục vụ quý khách ngay sau đây. Công ty chuyên phục vụ/cung cấp …. Cảm ơn quý khách đã lựa chọn công ty của chúng tôi. Chúng tôi sẽ phục vụ tận tâm, lấy chữ tín để phục vụ....(tên công ty) – chữ tín đảm bảo chất lượng!', '2020-03-09 16:38:11', 1, '2020-03-09 16:38:11', NULL);
INSERT INTO `epr_recording_contents` VALUES (2, 'Công ty … kính chào quý khách! Quý khách đang gọi đến số hotline (1900…)\r\ncủa ….(công ty ) địa chỉ tại …. Quý khách vui lòng đợi trong giây lát , chuyên viên tư vấn chăm sóc khách hàng của công ty chúng tôi sẽ tiếp nhận và phục vụ quý khách ngay sau đây. Công ty chuyên phục vụ/cung cấp …. Cảm ơn quý khách đã lựa chọn công ty của chúng tôi. Chúng tôi sẽ phục vụ tận tâm, lấy chữ tín để phục vụ....(tên công ty) – chữ tín đảm bảo chất lượng!', '2020-03-09 16:38:22', 1, '2020-03-09 16:38:22', NULL);

-- ----------------------------
-- Table structure for epr_user
-- ----------------------------
DROP TABLE IF EXISTS `epr_user`;
CREATE TABLE `epr_user`  (
  `id` bigint(20) NOT NULL DEFAULT 0,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `cp_id` int(11) UNSIGNED NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_user
-- ----------------------------
INSERT INTO `epr_user` VALUES (1, 's', 's', 's', 's', '', 10, 0, 0, NULL);
INSERT INTO `epr_user` VALUES (3, 'taila', 'c5x4lSks-WlngdQvmRasqDtI97i7_5cQ', '$2y$13$jenS5bctJRH8a1vPmHki/uPEkWsKy.jcbuIpzOauQX6MG17py2D1S', NULL, 'toanhv9@viettel.com.vn', 1, 1576748938, 1576748938, NULL);
INSERT INTO `epr_user` VALUES (4, 'toanhv9', 'wQajjtnKWcaaEetR1KZvuOQU3A-5ikfc', '$2y$13$YpvUz.Hvp7.uWySt5M87wOe9WovynV6q8Z9h6x.6FLwhOQihUBk2m', NULL, 'toanhv9@viettel.com.vn', 1, 1581409657, 1581409657, NULL);

-- ----------------------------
-- Table structure for epr_user_rbt
-- ----------------------------
DROP TABLE IF EXISTS `epr_user_rbt`;
CREATE TABLE `epr_user_rbt`  (
  `tone_id` bigint(20) NULL DEFAULT NULL COMMENT 'Tone ID',
  `tone_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Mã nhạc',
  `msisdn` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Số điện thoại',
  `register_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày đăng ký',
  `exprired_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày hết hạn',
  `created_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Tạo lúc',
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT 'Cập nhật lúc',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT 'Trạng thái',
  `enterprise_file_id` bigint(20) UNSIGNED NULL DEFAULT NULL COMMENT 'Bài hát',
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `msisdn_tone`(`tone_id`, `msisdn`) USING BTREE,
  INDEX `tone_id`(`tone_id`, `tone_code`) USING BTREE,
  INDEX `updated_at`(`updated_at`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_user_rbt
-- ----------------------------
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-14 18:07:21', '2020-02-14 18:07:21', 0, 126, 1);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-14 18:07:25', '2020-02-14 18:07:25', 0, 127, 2);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-14 18:07:55', '2020-02-14 18:07:55', 0, 128, 3);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-14 18:08:24', '2020-02-14 18:08:24', 0, 129, 4);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-14 18:09:57', '2020-02-14 18:09:57', 0, 130, 5);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:00:37', '2020-02-17 09:00:37', 0, 132, 6);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:09:00', '2020-02-17 09:09:00', 0, 136, 7);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:09:03', '2020-02-17 09:09:03', 0, 137, 8);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:17:27', '2020-02-17 09:17:27', 0, 168, 9);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:38:20', '2020-02-17 09:38:20', 0, 208, 10);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:43:17', '2020-02-17 09:43:17', 0, 209, 11);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:44:45', '2020-02-17 09:44:45', 0, 210, 12);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:47:03', '2020-02-17 09:47:03', 0, 214, 13);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:47:09', '2020-02-17 09:47:09', 0, 215, 14);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:47:12', '2020-02-17 09:47:12', 0, 216, 15);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:54:18', '2020-02-17 09:54:18', 0, 217, 16);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:54:21', '2020-02-17 09:54:21', 0, 218, 17);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:54:28', '2020-02-17 09:54:28', 0, 219, 18);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 09:54:32', '2020-02-17 09:54:32', 0, 220, 19);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 10:20:44', '2020-02-17 10:20:44', 0, 267, 20);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 10:20:52', '2020-02-17 10:20:52', 0, 268, 21);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 10:23:37', '2020-02-17 10:23:37', 0, 269, 22);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 10:23:40', '2020-02-17 10:23:40', 0, 270, 23);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 10:23:56', '2020-02-17 10:23:56', 0, 271, 24);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 10:36:40', '2020-02-17 10:36:40', 0, 272, 25);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:21:37', '2020-02-17 11:21:37', 0, 281, 26);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:22:02', '2020-02-17 11:22:02', 0, 282, 27);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:22:06', '2020-02-17 11:22:06', 0, 283, 28);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:23:05', '2020-02-17 11:23:05', 0, 284, 29);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:23:08', '2020-02-17 11:23:08', 0, 285, 30);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:23:27', '2020-02-17 11:23:27', 0, 286, 31);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:27:50', '2020-02-17 11:27:50', 0, 287, 32);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-17 11:59:28', '2020-02-17 11:59:28', 0, 291, 33);
INSERT INTO `epr_user_rbt` VALUES (NULL, NULL, '393636707', NULL, NULL, '2020-02-19 09:57:32', '2020-02-19 09:57:32', 0, 298, 34);

-- ----------------------------
-- Table structure for epr_voices
-- ----------------------------
DROP TABLE IF EXISTS `epr_voices`;
CREATE TABLE `epr_voices`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of epr_voices
-- ----------------------------
INSERT INTO `epr_voices` VALUES (51, 'Quỳnh Anh', 'Nữ miền Bắc', 'hn-quynhanh', '/vtcc/a3/02/2a/5e65aa94f07b4.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (52, 'Thanh Tùng', 'Nam miền Bắc', 'hn-thanhtung', '/vtcc/b8/11/1b/5e65aa97098d8.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (53, 'Mai Ngọc', 'Nữ miền Trung', 'hue-maingoc', '/vtcc/99/01/19/5e65aa98de73e.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (54, 'Bảo Quốc', 'Nam miền Trung', 'hue-baoquoc', '/vtcc/f5/f8/8f/5e65aa9a8e516.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (55, 'Minh Quân', 'Nam miền Nam', 'hcm-minhquan', '/vtcc/c8/6e/ec/5e65aa9c55c17.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (56, 'Diễm My', 'Nữ miền Nam', 'hcm-diemmy', '/vtcc/d9/d8/8d/5e65aa9e43c2c.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (57, 'Đoàn Ngọc Lê', 'Nữ miền Bắc', 'doanngocle', '/vtcc/25/4d/d2/5e65aaa0040c4.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (58, 'Trịnh Việt Trinh', 'Nữ miền Bắc', 'trinhthiviettrinh', '/vtcc/3d/4d/d3/5e65aaa208e06.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (59, 'Phạm Tiến Quân', 'Nam miền Bắc', 'phamtienquan', '/vtcc/3e/86/63/5e65aaa3e5206.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (60, 'Lê Thị Yến', 'Nữ miền Nam', 'lethiyen', '/vtcc/32/c9/93/5e65aaa5b63c3.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');
INSERT INTO `epr_voices` VALUES (61, 'Nguyễn Thị Thùy Duyên', 'Nữ miền Nam', 'nguyenthithuyduyen', '/vtcc/f2/8b/bf/5e65aaa79a006.mp3', 'Bạn đang sử dụng tính năng thu âm online của dịch vụ nhạc chờ doanh nghiệp của Viettel! Xin cám ơn!');

SET FOREIGN_KEY_CHECKS = 1;
