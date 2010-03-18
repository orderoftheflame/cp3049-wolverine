SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `wv_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `wv_assignment`;
CREATE TABLE `wv_assignment` (
  `IntAssignmentIDPK` int(11) NOT NULL,
  `IntProjectIDFK` int(11) NOT NULL,
  `VchAssignmentType` varchar(100) NOT NULL,
  PRIMARY KEY (`IntAssignmentIDPK`),
  UNIQUE KEY `assignment_pk` (`IntAssignmentIDPK`),
  KEY `assignmentupl_fk` (`IntProjectIDFK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_awardtype`
-- ----------------------------
DROP TABLE IF EXISTS `wv_awardtype`;
CREATE TABLE `wv_awardtype` (
  `IntAwardTypeIDPK` int(64) NOT NULL,
  `VchAwardTitle` varchar(256) NOT NULL,
  PRIMARY KEY (`IntAwardTypeIDPK`),
  UNIQUE KEY `AwardTypePK` (`IntAwardTypeIDPK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `wv_feedback`;
CREATE TABLE `wv_feedback` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  `IntProjectIDFK` int(11) NOT NULL,
  `BoolJournal` bit(1) NOT NULL,
  `BoolAttended` bit(1) NOT NULL,
  `IntOnTarget` int(11) DEFAULT NULL,
  `VchNotes` varchar(3000) DEFAULT NULL,
  `VchStudentFeedback` varchar(3000) DEFAULT NULL,
  `IntWeekNumber` int(11) NOT NULL,
  `VchMilestoneFeedback` varchar(5000) DEFAULT NULL,
  `VchMilestoneNotes` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `feedback_PK` (`IntProjectIDFK`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_grade`
-- ----------------------------
DROP TABLE IF EXISTS `wv_grade`;
CREATE TABLE `wv_grade` (
  `IntGradeIDPK` int(11) NOT NULL,
  `AssignmentIDFK` int(11) NOT NULL,
  `IntGradValue` int(11) NOT NULL,
  `VchFeedback` varchar(3000) NOT NULL,
  PRIMARY KEY (`IntGradeIDPK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_personstudentgrouplink`
-- ----------------------------
DROP TABLE IF EXISTS `wv_personstudentgrouplink`;
CREATE TABLE `wv_personstudentgrouplink` (
  `IntStudentGroupLinkIDPK` int(11) NOT NULL AUTO_INCREMENT,
  `IntGroupIDFK` int(11) NOT NULL,
  `VchPersonIDFK` varchar(256) NOT NULL,
  PRIMARY KEY (`IntStudentGroupLinkIDPK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_pr02`
-- ----------------------------
DROP TABLE IF EXISTS `wv_pr02`;
CREATE TABLE `wv_pr02` (
  `IntProjectIDFK` int(11) NOT NULL,
  `VchTitle` varchar(256) NOT NULL,
  PRIMARY KEY (`IntProjectIDFK`),
  UNIQUE KEY `pr02_PK` (`IntProjectIDFK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_project`
-- ----------------------------
DROP TABLE IF EXISTS `wv_project`;
CREATE TABLE `wv_project` (
  `IntProjectIDPK` int(11) NOT NULL AUTO_INCREMENT,
  `VchProjectTitle` varchar(256) NOT NULL,
  `VchProjectDetails` varchar(5000) DEFAULT NULL,
  `DateTimeSubmitted` datetime NOT NULL,
  `VchSubmittedByFK` varchar(256) NOT NULL,
  PRIMARY KEY (`IntProjectIDPK`),
  UNIQUE KEY `projectPK` (`IntProjectIDPK`),
  KEY `proj_subby_FK` (`VchSubmittedByFK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_projecttype`
-- ----------------------------
DROP TABLE IF EXISTS `wv_projecttype`;
CREATE TABLE `wv_projecttype` (
  `IntProjectTypeIDPK` int(11) NOT NULL DEFAULT '0',
  `VchProjectTypeTitle` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`IntProjectTypeIDPK`),
  UNIQUE KEY `project_type_PK` (`IntProjectTypeIDPK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_proojecttypelink`
-- ----------------------------
DROP TABLE IF EXISTS `wv_proojecttypelink`;
CREATE TABLE `wv_proojecttypelink` (
  `IntProjectIDFK` int(11) NOT NULL,
  `IntProjectTypeIDFK` int(11) NOT NULL,
  PRIMARY KEY (`IntProjectIDFK`,`IntProjectTypeIDFK`),
  KEY `project_type_link_PK` (`IntProjectIDFK`,`IntProjectTypeIDFK`),
  KEY `ptl_projTypeID_FK` (`IntProjectTypeIDFK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_staff`
-- ----------------------------
DROP TABLE IF EXISTS `wv_staff`;
CREATE TABLE `wv_staff` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  `BoolIsAdmin` tinyint(1) NOT NULL,
  `BoolIsModuleLeader` tinyint(1) NOT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `StaffPK` (`VchPersonIDFK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_staffstudentgrouplink`
-- ----------------------------
DROP TABLE IF EXISTS `wv_staffstudentgrouplink`;
CREATE TABLE `wv_staffstudentgrouplink` (
  `IntLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `IntGroupID` int(11) NOT NULL,
  `VchPersonIDFK` varchar(256) NOT NULL,
  PRIMARY KEY (`IntLinkID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `wv_studentgroups`
-- ----------------------------
DROP TABLE IF EXISTS `wv_studentgroups`;
CREATE TABLE `wv_studentgroups` (
  `IntGroupID` int(11) NOT NULL AUTO_INCREMENT,
  `VchGroupTitle` varchar(64) NOT NULL,
  `VchGroupDetails` varchar(512) NOT NULL,
  `VchGroupDay` varchar(16) NOT NULL,
  `TimeGroupMeeting` time NOT NULL,
  `DateTimeCreated` datetime NOT NULL,
  PRIMARY KEY (`IntGroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

---------------------------
-- Table structure for `wv_user`
-- ----------------------------
DROP TABLE IF EXISTS `wv_user`;
CREATE TABLE `wv_user` (
  `VchPersonIDFK` varchar(256) NOT NULL,
  `VchUserProjectYearStart` int(4) NOT NULL,
  `IntAwardTypeIDFK` int(64) NOT NULL,
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `userPK` (`IntAwardTypeIDFK`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`VchPersonIDFK`),
  UNIQUE KEY `upl_PK` (`IntProjectIDFK`) USING BTREE,
  KEY `upl_super_ID` (`VchSupervisorFK`),
  KEY `upl_reader_ID` (`VchReaderFK`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
