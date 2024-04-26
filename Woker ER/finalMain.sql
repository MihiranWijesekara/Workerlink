-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.32 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for workdb
CREATE DATABASE IF NOT EXISTS `workdb` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `workdb`;

-- Dumping structure for table workdb.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(100) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.admin: ~1 rows (approximately)
INSERT INTO `admin` (`admin_id`, `admin_email`, `fname`, `lname`, `verification_code`) VALUES
	(1, 'thusharajayanga1@gmail.com', 'Thushara', 'Jayanga', '6588450056fe0');

-- Dumping structure for table workdb.category
CREATE TABLE IF NOT EXISTS `category` (
  `cate_id` int NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) DEFAULT NULL,
  `cate_disc` text,
  `cate_img_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.category: ~7 rows (approximately)
INSERT INTO `category` (`cate_id`, `cate_name`, `cate_disc`, `cate_img_path`) VALUES
	(1, 'Carpenter', 'You\'ll find artisans skilled in woodwork, ranging from furniture making to building structures. Explore their craftsmanship in carpentry, turning wood into functional and aesthetic creations for diverse projects.', 'img/carpenter.avif'),
	(2, 'Electricion', 'You\'ll discover skilled professionals adept at handling electrical systems. From installations to repairs and upgrades, they ensure safety and efficiency in powering homes and businesses. Explore their expertise and services here.', 'img/electrician.avif'),
	(3, 'Home Maiden', 'Explore to discover experienced professionals offering domestic assistance. These experts specialize in various tasks, from cleaning and organizing to household chores, ensuring a clean, orderly, and inviting home. Discover their range of services here.', 'img/home_maiden.avif'),
	(4, 'Plumber', 'Here, skilled professionals specialize in plumbing systems. They excel in installations, repairs, and maintenance, ensuring efficient water flow and functionality for homes and businesses. Explore their services and expertise.', 'img/plumber.avif'),
	(5, 'Mansonry', 'Here, skilled artisans showcase expertise in brick, stone, and concrete work. They excel in building, repairing, and enhancing structures, creating durable and appealing architectural elements. Explore their projects.', 'img/masonry_Main.avif'),
	(6, 'Motor Mechanic', 'Discover proficient professionals specializing in vehicle maintenance and repairs. Their expertise lies in diagnosing and addressing various automotive issues, ensuring safe and efficient vehicle functionality. Explore their services and skills.', 'img/motor_mechanic.avif'),
	(7, 'Welder', 'Here, skilled professionals specialize in plumbing systems. They excel in installations, repairs, and maintenance, ensuring efficient water flow and functionality for homes and businesses. Explore their services and expertise.', 'img/welder.avif');

-- Dumping structure for table workdb.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) DEFAULT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district2_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district2` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.city: ~6 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Galle', 1),
	(2, 'Hikkaduwa', 1),
	(3, 'Ambalangoda', 1),
	(4, 'Matara', 2),
	(5, 'Weligama', 2),
	(6, 'Thangalle', 3);

-- Dumping structure for table workdb.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(50) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province2_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province2` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.district: ~3 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Galle', 1),
	(2, 'Matara', 1),
	(3, 'Hambantota', 1);

-- Dumping structure for table workdb.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table workdb.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.province: ~3 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Southern'),
	(2, 'Western'),
	(3, 'Northern');

-- Dumping structure for table workdb.status
CREATE TABLE IF NOT EXISTS `status` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.status: ~3 rows (approximately)
INSERT INTO `status` (`s_id`, `status`) VALUES
	(1, 'Deactivate'),
	(2, 'Activate'),
	(3, 'Prohibit');

-- Dumping structure for table workdb.user
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `nic` varchar(12) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `varification_code` varchar(20) DEFAULT NULL,
  `pro_path` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `gender_id` int NOT NULL,
  `status_s_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  KEY `fk_user_status1_idx` (`status_s_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_s_id`) REFERENCES `status` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.user: ~1 rows (approximately)
INSERT INTO `user` (`email`, `fname`, `lname`, `nic`, `password`, `mobile`, `varification_code`, `pro_path`, `regdate`, `gender_id`, `status_s_id`) VALUES
	('nelkanelum1@gmail.com', 'Nelka', 'Nelum', NULL, '123456', '0719250275', NULL, NULL, '2023-10-26 08:35:24', 1, 2);

-- Dumping structure for table workdb.user_address
CREATE TABLE IF NOT EXISTS `user_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad_line1` varchar(50) DEFAULT NULL,
  `ad_line2` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `city_city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_addrees_user1_idx` (`user_email`),
  KEY `fk_user_address_city1_idx` (`city_city_id`),
  CONSTRAINT `fk_addrees_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_user_address_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.user_address: ~0 rows (approximately)

-- Dumping structure for table workdb.user_img
CREATE TABLE IF NOT EXISTS `user_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_pro_img` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.user_img: ~0 rows (approximately)

-- Dumping structure for table workdb.woker_img
CREATE TABLE IF NOT EXISTS `woker_img` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `profile_path` varchar(100) DEFAULT NULL,
  `cover_img_path` varchar(100) DEFAULT NULL,
  `worker_email` varchar(100) NOT NULL,
  PRIMARY KEY (`w_id`),
  KEY `fk_woker_img_worker1_idx` (`worker_email`),
  CONSTRAINT `fk_woker_img_worker1` FOREIGN KEY (`worker_email`) REFERENCES `worker` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.woker_img: ~2 rows (approximately)
INSERT INTO `woker_img` (`w_id`, `profile_path`, `cover_img_path`, `worker_email`) VALUES
	(1, 'doc//profile_images//200228103140_654f11116bdc3.jpeg', NULL, 'thusharajayanga1@gmail.com'),
	(2, 'doc//profile_images//200228103140_655dbd930c0d4.jpeg', NULL, 'bandula@gmail.com');

-- Dumping structure for table workdb.worker
CREATE TABLE IF NOT EXISTS `worker` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `nic` varchar(12) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `varification_code` varchar(20) DEFAULT NULL,
  `payment` varchar(4) DEFAULT NULL,
  `discription` text,
  `file_path` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `gender_id` int NOT NULL,
  `category_id` int NOT NULL,
  `status_s_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_worker_gender1_idx` (`gender_id`),
  KEY `fk_worker_category1_idx` (`category_id`),
  KEY `fk_worker_status1_idx` (`status_s_id`),
  CONSTRAINT `fk_worker_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`cate_id`),
  CONSTRAINT `fk_worker_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_worker_status1` FOREIGN KEY (`status_s_id`) REFERENCES `status` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.worker: ~11 rows (approximately)
INSERT INTO `worker` (`email`, `fname`, `lname`, `nic`, `password`, `mobile`, `varification_code`, `payment`, `discription`, `file_path`, `regdate`, `gender_id`, `category_id`, `status_s_id`) VALUES
	('a@gmail.com', 'Abcd', 'efghijk', NULL, '56892', '0718014487', NULL, NULL, NULL, NULL, '2023-12-21 14:41:10', 1, 3, 1),
	('achintha@gmail.com', 'Achintha', 'Mihiran', NULL, '12er34', '0712345678', NULL, NULL, NULL, 'doc//cv//Achintha_0712345678.zip', '2023-12-16 14:12:06', 1, 2, 1),
	('b@gmail.com', 'ghfghjdbhj jhnjkgmnlk j', 'ngnfmnlk fdnjdnj', NULL, 'jghkgjg', '0712367890', NULL, NULL, NULL, NULL, '2023-12-21 14:42:38', 1, 1, 1),
	('bandula@gmail.com', 'Bandula', 'sena', '200228103140', '12345', '0719250285', NULL, '4568', 'hi kk', 'doc//cv//Bandula_0719250285.zip', '2023-11-22 14:02:41', 1, 2, 1),
	('c@gmail.com', 'vdhjbfhj ', 'mnfmgds njgn', NULL, 'yuokreol', '0722367984', NULL, NULL, NULL, NULL, '2023-12-21 14:44:13', 1, 3, 1),
	('d@gmail.com', 'ghhgnjjjjjjjjjj ', 'lllllllllllllllllluuuuuoooooo uu ', NULL, 'hhhhhh', '0715122384', NULL, NULL, NULL, NULL, '2023-12-21 14:45:44', 1, 6, 1),
	('jaye@gmail.com', 'Hashan', 'Buddhika', NULL, 'jaye123', '0712629341', NULL, NULL, NULL, NULL, '2023-12-22 13:11:12', 1, 6, 1),
	('kavindu@gmail.com', 'Kavindu', 'Udana', NULL, '12345', '0782535656', NULL, NULL, NULL, 'doc//cv//Kavindu_0782535656.zip', '2023-12-21 20:35:36', 1, 3, 2),
	('sadeesha1@gmail.com', 'Sadeesha', 'Erandaka', NULL, 'sadiya', '0740112496', NULL, NULL, NULL, 'doc//cv//Sadeesha_0715122324.zip', '2023-12-21 19:48:42', 1, 4, 2),
	('samare@gmail.com', 'Dilhara', 'Samaranayeka', NULL, 'saaaaa', '0715369775', NULL, NULL, NULL, 'doc//cv//Dilhara_0715369775.zip', '2023-12-21 20:22:21', 1, 7, 2),
	('thusharajayanga1@gmail.com', 'Thushara', 'Jayanga', '200228103140', '123456', '0703112496', NULL, '456', 'Hi Kohomada ', 'doc//cv//Thushara_0703112496.zip', '2023-12-21 19:47:45', 1, 4, 2);

-- Dumping structure for table workdb.worker_address
CREATE TABLE IF NOT EXISTS `worker_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `add_line1` varchar(50) DEFAULT NULL,
  `add_line2` varchar(50) DEFAULT NULL,
  `worker_email` varchar(100) NOT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `city_city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_worker_address_worker1_idx` (`worker_email`),
  KEY `fk_worker_address_city1_idx` (`city_city_id`),
  CONSTRAINT `fk_worker_address_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_worker_address_worker1` FOREIGN KEY (`worker_email`) REFERENCES `worker` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table workdb.worker_address: ~2 rows (approximately)
INSERT INTO `worker_address` (`id`, `add_line1`, `add_line2`, `worker_email`, `postal_code`, `city_city_id`) VALUES
	(1, 'No 444/B', 'Peekwella', 'thusharajayanga1@gmail.com', '12346', 2),
	(3, 'matara', 'matara', 'bandula@gmail.com', '12345', 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
workeruserblogpost