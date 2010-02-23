/*
Navicat MySQL Data Transfer

Source Server         : WAMP
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : noirenex_cp3049

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2010-02-23 19:29:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `wv_admin`
-- ----------------------------
DROP TABLE IF EXISTS `wv_admin`;
CREATE TABLE `wv_admin` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `admin_PK` (`VchPersonIDFK`) USING BTREE,
  CONSTRAINT `admin_person_fk` FOREIGN KEY (`VchPersonIDFK`) REFERENCES `wv_person` (`VchPersonIDPK`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_awardtype`
-- ----------------------------
DROP TABLE IF EXISTS `wv_awardtype`;
CREATE TABLE `wv_awardtype` (
  `IntAwardTypeIDPK` int(64) NOT NULL,
  `VchAwardTitle` varchar(256) NOT NULL,
  PRIMARY KEY (`IntAwardTypeIDPK`),
  UNIQUE KEY `AwardTypePK` (`IntAwardTypeIDPK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_awardtype
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_moduleleader`
-- ----------------------------
DROP TABLE IF EXISTS `wv_moduleleader`;
CREATE TABLE `wv_moduleleader` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `moduleleader_PK` (`VchPersonIDFK`),
  CONSTRAINT `ml_person_FK` FOREIGN KEY (`VchPersonIDFK`) REFERENCES `wv_person` (`VchPersonIDPK`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_moduleleader
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_person`
-- ----------------------------
DROP TABLE IF EXISTS `wv_person`;
CREATE TABLE `wv_person` (
  `VchPersonIDPK` varchar(256) NOT NULL,
  `VchPersonForeName` varchar(256) NOT NULL,
  `VchPersonLastName` varchar(256) NOT NULL,
  `VchPersonEmail` varchar(256) NOT NULL,
  `VchPersonPassword` varchar(256) NOT NULL,
  `DateTimePersonRegistered` datetime NOT NULL,
  PRIMARY KEY (`VchPersonIDPK`),
  UNIQUE KEY `PersonPK` (`VchPersonIDPK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_person
-- ----------------------------
INSERT INTO `wv_person` VALUES ('0601163', 'Danny', 'Dawes', 'd.dawes@wlv.ac.uk', 'e860705d2b061a6853517cac9b524be4bf41bace', '0000-00-00 00:00:00');
INSERT INTO `wv_person` VALUES ('0607658', 'Ben', 'Mitchell', 'ben.mitchell@wlv.ac.uk', '4a9a355ddb627100671cd4774209fde5effd76d3', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `wv_project`
-- ----------------------------
DROP TABLE IF EXISTS `wv_project`;
CREATE TABLE `wv_project` (
  `IntProjectIDPK` int(11) NOT NULL,
  `VchProjectTitle` varchar(256) NOT NULL,
  `VchProjectDetails` varchar(5000) DEFAULT NULL,
  `DateTimeSubmitted` datetime NOT NULL,
  `VchSubmittedByFK` varchar(256) NOT NULL,
  PRIMARY KEY (`IntProjectIDPK`),
  UNIQUE KEY `projectPK` (`IntProjectIDPK`),
  KEY `proj_subby_FK` (`VchSubmittedByFK`),
  CONSTRAINT `proj_subby_FK` FOREIGN KEY (`VchSubmittedByFK`) REFERENCES `wv_person` (`VchPersonIDPK`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_project
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_projecttype`
-- ----------------------------
DROP TABLE IF EXISTS `wv_projecttype`;
CREATE TABLE `wv_projecttype` (
  `IntProjectTypeIDPK` int(11) NOT NULL DEFAULT '0',
  `VchProjectTypeTitle` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`IntProjectTypeIDPK`),
  UNIQUE KEY `project_type_PK` (`IntProjectTypeIDPK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_projecttype
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_proojecttypelink`
-- ----------------------------
DROP TABLE IF EXISTS `wv_proojecttypelink`;
CREATE TABLE `wv_proojecttypelink` (
  `IntProjectIDFK` int(11) NOT NULL,
  `IntProjectTypeIDFK` int(11) NOT NULL,
  PRIMARY KEY (`IntProjectIDFK`,`IntProjectTypeIDFK`),
  KEY `project_type_link_PK` (`IntProjectIDFK`,`IntProjectTypeIDFK`),
  KEY `ptl_projTypeID_FK` (`IntProjectTypeIDFK`),
  CONSTRAINT `ptl_projTypeID_FK` FOREIGN KEY (`IntProjectTypeIDFK`) REFERENCES `wv_projecttype` (`IntProjectTypeIDPK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ptl_projID_FK` FOREIGN KEY (`IntProjectIDFK`) REFERENCES `wv_project` (`IntProjectIDPK`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_proojecttypelink
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_staff`
-- ----------------------------
DROP TABLE IF EXISTS `wv_staff`;
CREATE TABLE `wv_staff` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `StaffPK` (`VchPersonIDFK`),
  CONSTRAINT `staff_person_FK` FOREIGN KEY (`VchPersonIDFK`) REFERENCES `wv_person` (`VchPersonIDPK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_staff
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_user`
-- ----------------------------
DROP TABLE IF EXISTS `wv_user`;
CREATE TABLE `wv_user` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  `VchUserProjectYearStart` int(4) NOT NULL,
  `IntAwardTypeIDFK` int(64) NOT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `userPK` (`IntAwardTypeIDFK`) USING BTREE,
  CONSTRAINT `user_awardtype_FK` FOREIGN KEY (`IntAwardTypeIDFK`) REFERENCES `wv_awardtype` (`IntAwardTypeIDPK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_person_FK` FOREIGN KEY (`VchPersonIDFK`) REFERENCES `wv_person` (`VchPersonIDPK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_user
-- ----------------------------

-- ----------------------------
-- Table structure for `wv_userprojectlink`
-- ----------------------------
DROP TABLE IF EXISTS `wv_userprojectlink`;
CREATE TABLE `wv_userprojectlink` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  `IntProjectIDFK` int(11) NOT NULL,
  `DateTimeApproved` datetime DEFAULT NULL,
  `VchSupervisorFK` varchar(256) DEFAULT NULL,
  `VchReaderFK` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`VchPersonIDFK`,`IntProjectIDFK`),
  UNIQUE KEY `upl_PK` (`VchPersonIDFK`,`IntProjectIDFK`),
  KEY `upl_proj_ID` (`IntProjectIDFK`),
  KEY `upl_super_ID` (`VchSupervisorFK`),
  KEY `upl_reader_ID` (`VchReaderFK`),
  CONSTRAINT `upl_reader_ID` FOREIGN KEY (`VchReaderFK`) REFERENCES `wv_staff` (`VchPersonIDFK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `upl_proj_ID` FOREIGN KEY (`IntProjectIDFK`) REFERENCES `wv_project` (`IntProjectIDPK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `upl_super_ID` FOREIGN KEY (`VchSupervisorFK`) REFERENCES `wv_staff` (`VchPersonIDFK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `upl_user_ID` FOREIGN KEY (`VchPersonIDFK`) REFERENCES `wv_user` (`VchPersonIDFK`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wv_userprojectlink
-- ----------------------------
