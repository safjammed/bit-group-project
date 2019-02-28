/*
 Navicat Premium Data Transfer

 Source Server         : Dipro
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : demoewsd

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 28/02/2019 06:23:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_adminstrator
-- ----------------------------
DROP TABLE IF EXISTS `tbl_adminstrator`;
CREATE TABLE `tbl_adminstrator`  (
  `AdminId` int(11) NOT NULL AUTO_INCREMENT,
  `AdminPassword` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `userID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`AdminId`) USING BTREE,
  INDEX `fk_user_admin`(`userID`) USING BTREE,
  CONSTRAINT `fk_user_admin` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_adminstrator
-- ----------------------------
INSERT INTO `tbl_adminstrator` VALUES (1, 'admin', NULL);

-- ----------------------------
-- Table structure for tbl_comments
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE `tbl_comments`  (
  `commentsID` int(11) NOT NULL AUTO_INCREMENT,
  `CommentTitle` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CommentDescription` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contibutionsID` int(7) NULL DEFAULT 0,
  `faculty_member_ID` int(7) NULL DEFAULT NULL,
  PRIMARY KEY (`commentsID`) USING BTREE,
  INDEX `fk_comment_contribution`(`contibutionsID`) USING BTREE,
  INDEX `fk_comment_faculty_member`(`faculty_member_ID`) USING BTREE,
  CONSTRAINT `fk_comment_contribution` FOREIGN KEY (`contibutionsID`) REFERENCES `tbl_contributions` (`ContributionsID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comment_faculty_member` FOREIGN KEY (`faculty_member_ID`) REFERENCES `tbl_faculty_member` (`faculty_member_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_contributions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contributions`;
CREATE TABLE `tbl_contributions`  (
  `ContributionsID` int(7) NOT NULL DEFAULT '0' AUTO_INCREMENT,
  `studentID` int(7) NULL DEFAULT NULL,
  `Type` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ContributionTitle` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `wordFile` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ContributionDescription` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `dateLineCount` int(11) NOT NULL DEFAULT 14,
  `FileURL` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ContributionsID`) USING BTREE,
  INDEX `fk_contribution_student`(`studentID`) USING BTREE,
  CONSTRAINT `fk_contribution_student` FOREIGN KEY (`studentID`) REFERENCES `tbl_students` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_email_notification
-- ----------------------------
DROP TABLE IF EXISTS `tbl_email_notification`;
CREATE TABLE `tbl_email_notification`  (
  `notificationID` int(11) NOT NULL AUTO_INCREMENT,
  `notificationTitle` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notificationDescription` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`notificationID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_faculty
-- ----------------------------
DROP TABLE IF EXISTS `tbl_faculty`;
CREATE TABLE `tbl_faculty`  (
  `facultyId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AcademicYear` int(4) NOT NULL,
  `Startdate` datetime(0) NOT NULL,
  `Closuredate` datetime(0) NOT NULL,
  PRIMARY KEY (`facultyId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_faculty
-- ----------------------------
INSERT INTO `tbl_faculty` VALUES (1, 'Biochemestry', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_faculty` VALUES (2, 'Information Technology', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_faculty` VALUES (3, 'Nuclear Science', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_faculty` VALUES (4, 'Business Management', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_faculty` VALUES (5, 'Genetic Engineering', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for tbl_faculty_member
-- ----------------------------
DROP TABLE IF EXISTS `tbl_faculty_member`;
CREATE TABLE `tbl_faculty_member`  (
  `faculty_member_ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NULL DEFAULT NULL,
  `facultyID` int(11) NULL DEFAULT NULL,
  `faculty_member_type_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`faculty_member_ID`) USING BTREE,
  INDEX `fk_faculty_member`(`facultyID`) USING BTREE,
  INDEX `fk_member_user`(`userID`) USING BTREE,
  INDEX `fk_member_type`(`faculty_member_type_id`) USING BTREE,
  CONSTRAINT `fk_faculty_member` FOREIGN KEY (`facultyID`) REFERENCES `tbl_faculty` (`facultyId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_member_user` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_member_type` FOREIGN KEY (`faculty_member_type_id`) REFERENCES `tbl_faculty_member_type` (`faculty_member_type_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_faculty_member_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_faculty_member_type`;
CREATE TABLE `tbl_faculty_member_type`  (
  `faculty_member_type_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Types` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`faculty_member_type_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_faculty_member_type
-- ----------------------------
INSERT INTO `tbl_faculty_member_type` VALUES (1, 'Marketing Manager');
INSERT INTO `tbl_faculty_member_type` VALUES (2, 'Marketing Coordinator');
INSERT INTO `tbl_faculty_member_type` VALUES (3, 'Guest');

-- ----------------------------
-- Table structure for tbl_imagecontributed
-- ----------------------------
DROP TABLE IF EXISTS `tbl_imagecontributed`;
CREATE TABLE `tbl_imagecontributed`  (
  `Image_Contribution_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ContributionID` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ImageID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Image_Contribution_ID`) USING BTREE,
  INDEX `fk_image_contribution`(`ContributionID`) USING BTREE,
  INDEX `fk_contribution_image`(`ImageID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_images
-- ----------------------------
DROP TABLE IF EXISTS `tbl_images`;
CREATE TABLE `tbl_images`  (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `Imagename` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Image` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ImageURL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `StudentID` int(7) NULL DEFAULT NULL,
  PRIMARY KEY (`ImageID`) USING BTREE,
  INDEX `fk_image_student`(`StudentID`) USING BTREE,
  CONSTRAINT `fk_image_student` FOREIGN KEY (`StudentID`) REFERENCES `tbl_students` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_notified_coordinator
-- ----------------------------
DROP TABLE IF EXISTS `tbl_notified_coordinator`;
CREATE TABLE `tbl_notified_coordinator`  (
  `Notified_Coordinator` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_member_ID` int(7) NULL DEFAULT NULL,
  `NotificationID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Notified_Coordinator`) USING BTREE,
  INDEX `fk_notification_coordinator`(`NotificationID`) USING BTREE,
  INDEX `fk_faculty_member_notification`(`faculty_member_ID`) USING BTREE,
  CONSTRAINT `fk_notification_coordinator` FOREIGN KEY (`NotificationID`) REFERENCES `tbl_email_notification` (`notificationID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_faculty_member_notification` FOREIGN KEY (`faculty_member_ID`) REFERENCES `tbl_faculty_member` (`faculty_member_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_publications
-- ----------------------------
DROP TABLE IF EXISTS `tbl_publications`;
CREATE TABLE `tbl_publications`  (
  `PublicationID` int(11) NOT NULL AUTO_INCREMENT,
  `ContributionID` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `CoordinatorID` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`PublicationID`) USING BTREE,
  INDEX `fk_contribution_publications`(`ContributionID`) USING BTREE,
  INDEX `fk_coordinator_publications`(`CoordinatorID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_students
-- ----------------------------
DROP TABLE IF EXISTS `tbl_students`;
CREATE TABLE `tbl_students`  (
  `studentID` int(11) NOT NULL AUTO_INCREMENT,
  `facultyID` int(7) NULL DEFAULT NULL,
  `userID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`studentID`) USING BTREE,
  INDEX `studentID`(`studentID`) USING BTREE,
  INDEX `studentID_2`(`studentID`) USING BTREE,
  INDEX `studentID_3`(`studentID`) USING BTREE,
  INDEX `studentID_4`(`studentID`) USING BTREE,
  INDEX `fk_student_faculty`(`facultyID`) USING BTREE,
  INDEX `studentID_5`(`studentID`) USING BTREE,
  INDEX `studentID_6`(`studentID`) USING BTREE,
  INDEX `studentID_7`(`studentID`) USING BTREE,
  INDEX `studentID_8`(`studentID`) USING BTREE,
  INDEX `fk_student_user`(`userID`) USING BTREE,
  CONSTRAINT `fk_student_user` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_student_faculty` FOREIGN KEY (`facultyID`) REFERENCES `tbl_faculty` (`facultyId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_students
-- ----------------------------
INSERT INTO `tbl_students` VALUES (1, NULL, NULL);
INSERT INTO `tbl_students` VALUES (2, NULL, NULL);
INSERT INTO `tbl_students` VALUES (3, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_termsagreed
-- ----------------------------
DROP TABLE IF EXISTS `tbl_termsagreed`;
CREATE TABLE `tbl_termsagreed`  (
  `Terms_Student_ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(7) NULL DEFAULT NULL,
  `TermsID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Terms_Student_ID`) USING BTREE,
  INDEX `fk_terms_student`(`TermsID`) USING BTREE,
  INDEX `fk_student_terms`(`StudentID`) USING BTREE,
  CONSTRAINT `fk_terms_student` FOREIGN KEY (`TermsID`) REFERENCES `tbl_termsandconditions` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_student_terms` FOREIGN KEY (`StudentID`) REFERENCES `tbl_students` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_termsandconditions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_termsandconditions`;
CREATE TABLE `tbl_termsandconditions`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `termtitle` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `termlink` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `termdescription` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_termsandconditions
-- ----------------------------
INSERT INTO `tbl_termsandconditions` VALUES (1, 'Rules And Regulations', 'n/a', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.&nbsp;</p>');
INSERT INTO `tbl_termsandconditions` VALUES (2, 'Conditions', 'n/a', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on');
INSERT INTO `tbl_termsandconditions` VALUES (3, 'sdadsa', 'n/a', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `Password` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Country_Code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Phone` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Two_Factor` tinyint(1) NULL DEFAULT NULL,
  `Remember_Token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Created_at` timestamp(0) NULL DEFAULT NULL,
  `Updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`userID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Triggers structure for table tbl_adminstrator
-- ----------------------------
DROP TRIGGER IF EXISTS `tg_admin_id`;
delimiter ;;
CREATE TRIGGER `tg_admin_id` BEFORE INSERT ON `tbl_adminstrator` FOR EACH ROW BEGIN
	INSERT INTO adminid VALUES (NULL);
	SET NEW.adminid = CONCAT('SAD', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_contributions
-- ----------------------------
DROP TRIGGER IF EXISTS `tg_contributions_id`;
delimiter ;;
CREATE TRIGGER `tg_contributions_id` BEFORE INSERT ON `tbl_contributions` FOR EACH ROW BEGIN
	INSERT INTO contributionsid VALUES (NULL);
	SET NEW.contributionsid = CONCAT('CNTR', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_faculty
-- ----------------------------
DROP TRIGGER IF EXISTS `tg_faculty_id`;
delimiter ;;
CREATE TRIGGER `tg_faculty_id` BEFORE INSERT ON `tbl_faculty` FOR EACH ROW BEGIN
	INSERT INTO facultyid VALUES (NULL);
	SET NEW.facultyid = CONCAT('FAC', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_publications
-- ----------------------------
DROP TRIGGER IF EXISTS `tg_publications_id`;
delimiter ;;
CREATE TRIGGER `tg_publications_id` BEFORE INSERT ON `tbl_publications` FOR EACH ROW BEGIN
	INSERT INTO publicationsid VALUES (NULL);
	SET NEW.publicationid = CONCAT('PUB', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_students
-- ----------------------------
DROP TRIGGER IF EXISTS `tg_student_id`;
delimiter ;;
CREATE TRIGGER `tg_student_id` BEFORE INSERT ON `tbl_students` FOR EACH ROW BEGIN
	INSERT INTO studentid VALUES (NULL);
	SET NEW.studentID = CONCAT('S', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
