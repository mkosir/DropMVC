# noinspection SqlNoDataSourceInspectionForFile

/*
 Navicat Premium Data Transfer

 Source Server         : Vagrant-MariaDB
 Source Server Type    : MariaDB
 Source Server Version : 100213
 Source Host           : localhost:33060
 Source Schema         : dropline

 Target Server Type    : MariaDB
 Target Server Version : 100213
 File Encoding         : 65001

 Date: 22/02/2018 14:19:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for drops
-- ----------------------------
DROP TABLE IF EXISTS `drops`;
CREATE TABLE `drops`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `body` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `create_date` datetime(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `drops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of drops
-- ----------------------------
INSERT INTO `drops` VALUES (1, 24, 'Test drop 1 string', 'Vitae pharetra vitae egestas libero vestibulum, adipisicing amet non hac magna id, vitae taciti at in nibh magna quis. Mi ac, aliquam urna diam. Arcu magna, mauris mollis volutpat vestibulum gravida eros. Non ut sapien egestas, mollis suspendisse wisi hac amet molestie. Montes orci sed dictum aliquam, sit ut mattis, nascetur in est sed venenatis mauris, libero adipiscing lacus eu mauris. Massa eu neque id facilisi, lorem suspendisse commodo non eget ullam et, pulvinar aliquam at libero pellentesque.', 'http://test.com', '2017-11-17 14:24:30');
INSERT INTO `drops` VALUES (2, 3, 'Testing string drop 2', 'Lorem ipsum dolor sit amet, quod ornare nunc non posuere fusce, diam suspendisse in in aliquet id, id lacus turpis nec magna. Porttitor et turpis purus vehicula tincidunt, tempor quam consectetuer nullam tellus, nascetur eu. Sodales imperdiet nullam justo dui. In lacinia tincidunt varius amet praesent, sit eu egestas morbi, neque erat at nostra, elit mi velit augue at bibendum urna, nisl amet wisi lectus. Nulla lectus risus nec nulla vivamus amet, nunc porttitor quam diam et, viverra accumsan est turpis in tellus, earum neque arcu pellentesque vivamus neque, vehicula sed molestie ac sed. Aliquam dictumst eros laoreet urna gravida auctor, pellentesque donec risus in turpis posuere, at in dolor eu fringilla venenatis. Nulla dolor praesent orci imperdiet laoreet, a auctor sollicitudin quam nunc mus, fusce cras, volutpat eros class pede. Morbi vitae wisi amet vivamus sem, in justo pede, nunc ligula enim. Iaculis fusce, rerum conubia. Ac enim, habitasse vitae donec ac eleifend, ultricies nulla magni dolor amet tortor, sit in sed ultricies pede tellus, sem libero enim a habitasse nibh tempus. Felis nascetur lectus vestibulum pede, porta cras ut consectetuer urna fermentum, eu libero integer velit lacinia sed, iaculis et tincidunt integer amet enim.', 'http://google.com', '2017-11-17 17:44:12');
INSERT INTO `drops` VALUES (3, 24, 'My drop 444', 'Testing  sdgdfgrd345345 457 sdfraw r78 dfgsddrwafbf', 'http://test.com', '2017-11-18 13:29:41');
INSERT INTO `drops` VALUES (4, 3, 'Drop Testing', 'aaaaaaaaffffffffrrrrrreeeeeeeeee\r\nsdfsd\r\nawd', 'http://google.com', '2017-11-18 19:45:25');
INSERT INTO `drops` VALUES (5, 24, 'My Drop VVCC', 'Tilde photo booth helvetica, hot chicken neutra squid post-ironic coloring book austin kombucha williamsburg viral. Hoodie selfies vice, trust fund jianbing slow-carb paleo marfa meditation vape. Next level brooklyn venmo kickstarter. Drinking vinegar 8-bit occupy skateboard 90&#39;s fashion axe, kombucha blog keffiyeh lyft plaid hot chicken. Post-ironic man braid before they sold out, vice taxidermy man bun drinking vinegar normcore freegan scenester locavore. Salvia four loko air plant lumbersexual, bushwick truffaut green juice knausgaard. Fanny pack dreamcatcher ethical biodiesel readymade tumeric cornhole sartorial marfa four dollar toast taxidermy heirloom.', 'dsfsdf', '2017-11-20 13:30:17');
INSERT INTO `drops` VALUES (8, 24, 'Lorem ipsum dolor', 'Vitae pharetra vitae egestas libero vestibulum, adipisicing amet non hac magna id, vitae taciti at in nibh magna quis. Mi ac, aliquam urna diam.', 'test', '2017-11-20 21:33:44');
INSERT INTO `drops` VALUES (9, 8, 'Lorem ipsum ipsum vitae lorem', 'Nulla dolor praesent orci imperdiet laoreet, a auctor sollicitudin quam nunc mus, fusce cras, volutpat eros class pede. Morbi vitae wisi amet vivamus sem, in justo pede, nunc ligula enim. Iaculis fusce, rerum conubia. Ac enim, habitasse vitae donec ac eleifend, ultricies nulla magni dolor amet tortor, sit in sed ultricies pede tellus, sem libero enim a habitasse nibh tempus. Felis nascetur lectus vestibulum pede, porta cras ut consectetuer urna fermentum, eu libero integer velit lacinia sed, iaculis et tincidunt integer amet enim.', 'eewww', '2017-11-20 21:35:43');
INSERT INTO `drops` VALUES (30, 8, 'Title string111', 'Text222', 'nolink', '2017-11-20 21:53:31');
INSERT INTO `drops` VALUES (31, 8, 'Title of a drop', 'blabla bla bla', 'asd', '2017-11-26 09:23:39');
INSERT INTO `drops` VALUES (32, 8, 'Test Title', '<strong>bla bla blablah</strong>', 'sdfd', '2017-11-26 11:51:06');
INSERT INTO `drops` VALUES (34, 8, 'Title 327', '<script>alert(\'XSS Gotcha!\')</script>', 'sdd', '2017-11-26 12:18:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `register_date` datetime(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (3, 'Marko', 'mail@mail.com', '$2y$10$FCvpgZYPjVPIgWHvTGOB9eS6HmFwhx.SrsUyLDrBkwlao7L.91u.e', '2017-11-20 13:28:35');
INSERT INTO `users` VALUES (8, 'a', 'a', '$2y$10$BTtzFrdPSyx8s.JcVXMBVOMIWKuBjNKyyzmnAAkVUcyvmFUm4baiy', '2017-11-20 21:53:10');
INSERT INTO `users` VALUES (24, 'UserTest', 'usertest', '$2y$10$lz7m0bii8BLqLJbOIEkIWermoutEepSu8XsPhSBjRRrM21XQ16mHm', '2017-11-18 17:30:40');
INSERT INTO `users` VALUES (25, 'dummy_row_name', 'dummy_row_email', 'dummy_row_password', '2018-01-19 18:27:03');

-- ----------------------------
-- Procedure structure for Activity_UsersDrops
-- ----------------------------
DROP PROCEDURE IF EXISTS `Activity_UsersDrops`;
delimiter ;;
CREATE PROCEDURE `Activity_UsersDrops`(
	OUT `out_Drops_TotalNumOfDrops` INT(11),
	OUT `out_Users_TotalNumOfUsers` INT(11),
	OUT `out_Drops_PostedPerDayAvg` FLOAT,
	OUT `out_Drops_LastPostedDrop` DATETIME,
	OUT `out_Drops_LastPostedUser` VARCHAR(255),
	OUT `out_Drops_AvgLength` FLOAT,
	OUT `out_Users_MostDropsName` VARCHAR(255),
	OUT `out_Users_MostDropsNum` INT(11)



)
BEGIN
-- ###################
-- out_Drops_TotalNumOfDrops
SELECT count(*) INTO out_Drops_TotalNumOfDrops
        FROM drops;
-- debug
-- SET out_Drops_TotalNumOfDrops = 1111;
-- ###################

-- ###################
-- out_Users_TotalNumOfUsers
SELECT count(*) INTO out_Users_TotalNumOfUsers
        FROM users;
-- debug
-- SET out_Users_TotalNumOfUsers = 2222;
-- ###################

-- ###################
-- out_Drops_PostedPerDayAvg
SELECT count(*) INTO out_Drops_PostedPerDayAvg
        FROM drops;
-- debug
SET out_Drops_PostedPerDayAvg = 3333;
-- ###################

-- ###################
-- out_Drops_LastPostedDrop
SELECT MAX(drops.create_date) AS LastDate INTO out_Drops_LastPostedDrop
        FROM drops;
-- debug
-- SET out_Drops_LastPostedDrop = '4444-00-00 00:00:00';
-- ###################

-- ###################
-- out_Drops_LastPostedUser
/*SELECT users.name AS Username , MAX(drops.create_date) AS LastDate
        FROM users
		  JOIN drops ON users.id = shares.user_id;
*/
SELECT MAX(drops.create_date) AS LastDate , users.name = out_Drops_LastPostedUser
        FROM drops
				INNER JOIN users on drops.user_id = users.id;
-- SET out_Drops_LastPostedUser = BBB;
-- debug  
-- SET out_Drops_LastPostedUser = '5555 TestUser';
-- ###################

-- ###################  
-- out_Drops_AvgLength
SELECT AVG(CHAR_LENGTH(drops.body)) INTO out_Drops_AvgLength
				FROM drops;
-- debug  
-- SET out_Drops_AvgLength = 6666;
-- ###################

-- ###################
-- out_Users_MostDropsName
/*SELECT count(*) INTO out_Users_MostDropsName
        FROM drops;*/
-- debug  
SET out_Users_MostDropsName = '7777 TestUser';
-- ###################

-- ###################
-- out_Users_MostDropsNum
SELECT count(*) INTO out_Users_MostDropsNum
        FROM drops;
-- debug  
SET out_Users_MostDropsNum = 8888;
-- ###################
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_AddDrop
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_AddDrop`;
delimiter ;;
CREATE PROCEDURE `Drops_AddDrop`(IN `in_title` VARCHAR(255), IN `in_body` TEXT, IN `in_link` VARCHAR(255), IN `in_user_id` INT(11))
BEGIN
INSERT INTO drops (title, body, link, user_id) VALUES(in_title, in_body, in_link, in_user_id);
SELECT LAST_INSERT_ID();
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_DeleteDropById
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_DeleteDropById`;
delimiter ;;
CREATE PROCEDURE `Drops_DeleteDropById`(IN `in_drops_id` INT(11))
BEGIN
DELETE FROM drops
	WHERE drops.id = in_drops_id
	LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_EditDropById
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_EditDropById`;
delimiter ;;
CREATE PROCEDURE `Drops_EditDropById`(
	IN `in_drop_id` INT(11),
	IN `in_title` VARCHAR(255),
	IN `in_body` TEXT,
	IN `in_link` VARCHAR(255),
	IN `in_user_id` INT(11)



)
BEGIN
UPDATE drops
SET drops.title=in_title, drops.body=in_body, drops.link=in_link, 
drops.user_id=in_user_id, drops.create_date=CURRENT_TIMESTAMP()
WHERE drops.id = in_drop_id
LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetAll
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetAll`;
delimiter ;;
CREATE PROCEDURE `Drops_GetAll`()
BEGIN
   SELECT * FROM drops
   ORDER BY drops.id DESC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetAllWithUsername
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetAllWithUsername`;
delimiter ;;
CREATE PROCEDURE `Drops_GetAllWithUsername`()
BEGIN
SELECT drops.id, users.name as user_name, users.id as user_id, drops.title, drops.body, drops.link, drops.create_date 
                  FROM drops INNER JOIN users
                  ON drops.user_id = users.id
                  ORDER BY drops.id DESC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetAvgDropsPostedPerDay
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetAvgDropsPostedPerDay`;
delimiter ;;
CREATE PROCEDURE `Drops_GetAvgDropsPostedPerDay`()
BEGIN

SELECT (count(drops.id) / DATEDIFF(MAX(drops.create_date), MIN(drops.create_date))) AS Drops_GetAvgDropsPostedPerDay
# Casting to decimal type example
#SELECT CAST((count(drops.id) / DATEDIFF(MAX(drops.create_date), MIN(drops.create_date)))AS DECIMAL(12,6)) AS Drops_GetAvgDropsPostedPerDay
FROM drops;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetDropAvgLength
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetDropAvgLength`;
delimiter ;;
CREATE PROCEDURE `Drops_GetDropAvgLength`()
BEGIN
SELECT AVG(CHAR_LENGTH(drops.body)) AS Drops_GetDropAvgLength
	FROM drops;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetDropByIdWithUsername
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetDropByIdWithUsername`;
delimiter ;;
CREATE PROCEDURE `Drops_GetDropByIdWithUsername`(
	IN `in_drops_id` INT(11)
)
BEGIN

SELECT drops.id, users.name as user_name, users.id as user_id, drops.title, drops.body, drops.link, drops.create_date 
	FROM drops INNER JOIN users
	ON drops.user_id = users.id
	WHERE drops.id = in_drops_id
	LIMIT 1;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetLatestDrop
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetLatestDrop`;
delimiter ;;
CREATE PROCEDURE `Drops_GetLatestDrop`()
BEGIN

# Get the latest drop in database
# IN usage - Could be implemented with ORDER BY and LIMIT 1
SELECT drops.title AS DropTitle, drops.body AS DropBody, drops.link AS DropLink, drops.create_date AS DropCreateDate,
users.id AS UserId, users.name AS UserName, users.email AS UserEmail, users.register_date AS UserRegisterDate
FROM drops 
INNER JOIN users on drops.user_id = users.id
WHERE drops.create_date IN 
(SELECT MAX(drops.create_date)
 FROM drops
);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetLatestDropForAllUsers
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetLatestDropForAllUsers`;
delimiter ;;
CREATE PROCEDURE `Drops_GetLatestDropForAllUsers`()
BEGIN

# Get latest drop for each user
# IN usage
SELECT drops.title AS DropTitle, drops.body AS DropBody, drops.link AS DropLink, drops.create_date AS DropCreateDate,
users.id AS UserId, users.name AS UserName, users.email AS UserEmail, users.register_date AS UserRegisterDate
FROM drops 
INNER JOIN users on drops.user_id = users.id
WHERE (drops.user_id, drops.create_date) IN 
(SELECT drops.user_id, MAX(drops.create_date)
 FROM drops
 GROUP BY drops.user_id
);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetTotalNumOfDrops
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetTotalNumOfDrops`;
delimiter ;;
CREATE PROCEDURE `Drops_GetTotalNumOfDrops`()
BEGIN
SELECT count(drops.id) AS Drops_GetTotalNumOfDrops
	FROM drops;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Drops_GetWordsDropsTitles
-- ----------------------------
DROP PROCEDURE IF EXISTS `Drops_GetWordsDropsTitles`;
delimiter ;;
CREATE PROCEDURE `Drops_GetWordsDropsTitles`(
	IN `in_numOfLastTitlesLimit` INT(11)

)
BEGIN
	# Get count of words frequency in drops
SELECT GROUP_CONCAT(SubQuery_LastDropsTitles.title SEPARATOR ' ') AS `LastDropsTitles`
	FROM (SELECT drops.title
		FROM drops
		ORDER BY drops.create_date DESC
		LIMIT in_numOfLastTitlesLimit) # Limit return titles to the most relative
		AS `SubQuery_LastDropsTitles`;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Users_AddUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `Users_AddUser`;
delimiter ;;
CREATE PROCEDURE `Users_AddUser`(
	IN `in_name` VARCHAR(255),
	IN `in_email` VARCHAR(255),
	IN `in_password` VARCHAR(255)

)
BEGIN
INSERT INTO users (name, email, password) VALUES(in_name, in_email, in_password);
SELECT LAST_INSERT_ID(); -- needed for working with PDO
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Users_GetNumOfDropsForEachUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `Users_GetNumOfDropsForEachUser`;
delimiter ;;
CREATE PROCEDURE `Users_GetNumOfDropsForEachUser`()
BEGIN

# Get number of drops for each user
# IN usage
SELECT users.id AS UserId, users.name AS UserName, users.email AS UserEmail, users.register_date AS UserRegisterDate,
COUNT(drops.id) AS UserNumberOfDrops # count number of rows (can be any column)
FROM drops 
RIGHT JOIN users on  drops.user_id = users.id # RIGHT JOIN - if user has 0 drops posted
GROUP BY users.id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Users_GetTotalNumOfUsers
-- ----------------------------
DROP PROCEDURE IF EXISTS `Users_GetTotalNumOfUsers`;
delimiter ;;
CREATE PROCEDURE `Users_GetTotalNumOfUsers`()
BEGIN
SELECT count(users.id) AS Users_GetTotalNumOfUsers
	FROM users;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Users_GetUserByEmail
-- ----------------------------
DROP PROCEDURE IF EXISTS `Users_GetUserByEmail`;
delimiter ;;
CREATE PROCEDURE `Users_GetUserByEmail`(
	IN `in_email` VARCHAR(255)
)
BEGIN
SELECT * FROM users WHERE email = in_email
LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Users_GetUserByName
-- ----------------------------
DROP PROCEDURE IF EXISTS `Users_GetUserByName`;
delimiter ;;
CREATE PROCEDURE `Users_GetUserByName`(
	IN `in_name` VARCHAR(255)
)
BEGIN
SELECT * FROM users WHERE name = in_name
LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for User_GetUserWithMostNumOfDrops
-- ----------------------------
DROP PROCEDURE IF EXISTS `User_GetUserWithMostNumOfDrops`;
delimiter ;;
CREATE PROCEDURE `User_GetUserWithMostNumOfDrops`()
BEGIN

# Get user with the most drops posted
# ORDER BY and LIMIT 1 usage
SELECT users.id AS UserId, users.name AS UserName, users.email AS UserEmail, users.register_date AS UserRegisterDate,
COUNT(drops.id) AS UserNumberOfDrops # count number of rows (can be any column)
FROM drops 
RIGHT JOIN users on  drops.user_id = users.id # RIGHT JOIN - if user has 0 drops posted
GROUP BY users.id
ORDER BY UserNumberOfDrops DESC
LIMIT 1;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
