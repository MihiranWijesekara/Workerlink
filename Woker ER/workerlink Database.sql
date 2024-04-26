-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.36 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table workdb.admin: ~0 rows (approximately)
INSERT INTO `admin` (`admin_id`, `admin_email`, `fname`, `lname`, `verification_code`) VALUES
	(1, 'achinthamihiran654@gmail.com', 'Achintha', 'Mihiran', '65d3a3ba31fdf');

-- Dumping data for table workdb.category: ~7 rows (approximately)
REPLACE INTO `category` (`cate_id`, `cate_name`, `cate_disc`, `cate_img_path`) VALUES
	(1, 'Carpenter', 'You\\\'ll find artisans skilled in woodwork, ranging from furniture making to building structures. Explore their craftsmanship in carpentry, turning wood into functional and aesthetic creations for diverse projects.', 'img/carpenter.avif'),
	(2, 'Electricion', 'You\\\'ll discover skilled professionals adept at handling electrical systems. From installations to repairs and upgrades, they ensure safety and efficiency in powering homes and businesses. Explore their expertise and services here.', 'img/electrician.avif'),
	(3, 'Home Maiden', 'Explore to discover experienced professionals offering domestic assistance. These experts specialize in various tasks, from cleaning and organizing to household chores, ensuring a clean, orderly, and inviting home. Discover their range of services here.', 'img/home_maiden.avif'),
	(4, 'Plumber', 'Here, skilled professionals specialize in plumbing systems. They excel in installations, repairs, and maintenance, ensuring efficient water flow and functionality for homes and businesses. Explore their services and expertise.', 'img/plumber.avif'),
	(5, 'Mansonry', 'Here, skilled artisans showcase expertise in brick, stone, and concrete work. They excel in building, repairing, and enhancing structures, creating durable and appealing architectural elements. Explore their projects.', 'img/masonry_Main.avif'),
	(6, 'Motor Mechanic', 'Discover proficient professionals specializing in vehicle maintenance and repairs. Their expertise lies in diagnosing and addressing various automotive issues, ensuring safe and efficient vehicle functionality. Explore their services and skills.', 'img/motor_mechanic.avif'),
	(7, 'Welder', 'Here, skilled professionals specialize in plumbing systems. They excel in installations, repairs, and maintenance, ensuring efficient water flow and functionality for homes and businesses. Explore their services and expertise.', 'img/welder.avif');

-- Dumping data for table workdb.city: ~0 rows (approximately)
REPLACE INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Galle', 1);

-- Dumping data for table workdb.district: ~0 rows (approximately)
REPLACE INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Galle', 1),
	(2, 'Matara', 1),
	(3, 'Hambantota', 1);

-- Dumping data for table workdb.gender: ~2 rows (approximately)
REPLACE INTO `gender` (`id`, `gender`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping data for table workdb.order: ~0 rows (approximately)
REPLACE INTO `order` (`order_id`, `order_code`, `order_time`, `order_status_order_st_id`, `user_email`, `worker_email`) VALUES
	(1, NULL, '2024-02-20 02:42:51', 4, 'achinthamihiran654@gmail.com', 'achinthamihiran295@gmail.com');

-- Dumping data for table workdb.order_status: ~0 rows (approximately)
REPLACE INTO `order_status` (`order_st_id`, `order_st_name`) VALUES
	(1, 'Active'),
	(2, 'Cancel'),
	(4, 'Pending'),
	(5, 'Complete');

-- Dumping data for table workdb.province: ~0 rows (approximately)
REPLACE INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Southern'),
	(2, 'Western'),
	(3, 'Northern');

-- Dumping data for table workdb.review: ~0 rows (approximately)

-- Dumping data for table workdb.save_profile: ~0 rows (approximately)

-- Dumping data for table workdb.status: ~3 rows (approximately)
REPLACE INTO `status` (`s_id`, `status`) VALUES
	(1, 'Deactivate'),
	(2, 'Activate'),
	(3, 'Prohibit');

-- Dumping data for table workdb.user: ~1 rows (approximately)
REPLACE INTO `user` (`email`, `fname`, `lname`, `nic`, `password`, `mobile`, `varification_code`, `pro_path`, `regdate`, `gender_id`, `status_s_id`, `Notify`) VALUES
	('achinthamihiran654@gmail.com', 'Achintha', 'Mihiran', '200224103410', '12345', '+94788329244', '123', NULL, '2024-02-17 00:08:32', 1, 2, 1);

-- Dumping data for table workdb.user_address: ~0 rows (approximately)
REPLACE INTO `user_address` (`id`, `ad_line1`, `ad_line2`, `user_email`, `postal_code`, `city_city_id`) VALUES
	(1, 'Nayoma,paramulla Road', ',Matara', 'achinthamihiran654@gmail.com', '81000', 1);

-- Dumping data for table workdb.user_img: ~0 rows (approximately)

-- Dumping data for table workdb.woker_img: ~0 rows (approximately)
REPLACE INTO `woker_img` (`w_id`, `profile_path`, `cover_img_path`, `worker_email`) VALUES
	(1, 'doc//profile_images//200224103410_65d3c433935d6.png', NULL, 'achinthamihiran295@gmail.com'),
	(2, 'doc//profile_images//200224103410_65d3cdb27cbd7.jpeg', NULL, 'achinthamihiran299@gmail.com'),
	(3, 'doc//profile_images//200224103410_65d3ced14d7f3.jpeg', NULL, 'achinthamihiran297@gmail.com'),
	(4, 'doc//profile_images//200224103410_65d3ceffc8e9c.jpeg', NULL, 'achinthamihiran298@gmail.com'),
	(5, 'doc//profile_images//200224103410_65d3cf766a7ed.jpeg', NULL, 'achinthamihiran296@gmail.com'),
	(6, 'doc//profile_images//200224103410_65d3d126beb22.jpeg', NULL, 'achinthamihiran284@gmail.com'),
	(7, 'doc//profile_images//200224103410_65d3d17f34f81.jpeg', NULL, 'achinthamihiran283@gmail.com'),
	(8, 'doc//profile_images//200224103410_65d3d1c19a5fe.jpeg', NULL, 'achinthamihiran282@gmail.com'),
	(9, 'doc//profile_images//200224103410_65d3d22d0d0da.jpeg', NULL, 'achinthamihiran281@gmail.com');

-- Dumping data for table workdb.worker: ~0 rows (approximately)
REPLACE INTO `worker` (`email`, `fname`, `lname`, `nic`, `password`, `mobile`, `varification_code`, `payment`, `discription`, `file_path`, `regdate`, `gender_id`, `category_id`, `status_s_id`, `r_Like`, `Notify`) VALUES
	('achinthamihiran280@gmail.com', 'Amelia', 'Clara', NULL, '12345', '+94788329250', NULL, NULL, NULL, 'doc//cv//Amelia_+94788329250.zip', '2024-02-20 03:34:00', 2, 3, 2, 0, NULL),
	('achinthamihiran281@gmail.com', 'Jane', 'Clara', '200224103410', '12345', '+94788329251', NULL, '800', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Jane_+94788329251.zip', '2024-02-20 03:34:24', 2, 3, 2, 0, NULL),
	('achinthamihiran282@gmail.com', 'Olivia', 'Clara', '200224103410', '12345', '+94788329252', NULL, '560', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Olivia_+94788329252.zip', '2024-02-20 03:34:51', 2, 3, 2, 0, NULL),
	('achinthamihiran283@gmail.com', 'Ava', 'Clara', '200224103410', '12345', '+94788329253', NULL, '100', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Ava_+94788329253.zip', '2024-02-20 03:35:09', 2, 3, 2, 0, NULL),
	('achinthamihiran284@gmail.com', 'Camila', 'Clara', '200224103410', '12345', '+94788329254', NULL, '780', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Camila_+94788329254.zip', '2024-02-20 03:35:25', 2, 3, 2, 0, NULL),
	('achinthamihiran295@gmail.com', 'Achintha', 'Mihiran', '200224103410', '12345', '+94771500747', '', '500', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Achintha_+94771500747.zip', '2024-02-19 22:47:30', 1, 1, 2, 0, 1),
	('achinthamihiran296@gmail.com', 'Achintha', 'Lakshan', '200224103410', '12345', '+94788329245', NULL, '750', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Achintha_+94788329245.zip', '2024-02-20 02:51:18', 1, 1, 2, 0, NULL),
	('achinthamihiran297@gmail.com', 'Pasindu', 'Lakshan', '200224103410', '12345', '+94788329247', NULL, '450', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Pasindu_+94788329247.zip', '2024-02-20 02:51:33', 1, 1, 2, 0, NULL),
	('achinthamihiran298@gmail.com', 'Pasan', 'Thathsarana', '200224103410', '12345', '+94788329248', NULL, '350', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Pasan_+94788329248.zip', '2024-02-20 02:51:52', 1, 1, 2, 0, NULL),
	('achinthamihiran299@gmail.com', 'Vihara', 'Thathsarana', '200224103410', '12345', '+94788329249', NULL, '700', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta sodales justo at viverra. Ut suscipit, turpis id aliquam volutpat, quam dui cursus risus, vitae efficitur turpis lectus et urna. Quisque consectetur at metus in pellentesque. Donec semper tincidunt lobortis. Aliquam mattis justo ut ante sodales sodales. Integer tempor, diam non tincidunt pulvinar, risus mauris dapibus sem, quis pulvinar nisl quam in sapien. Nunc luctus nulla sit amet dolor consequat tincidunt. Mauris quis pellentesque augue, vel pulvinar metus. Aenean euismod, metus sit amet dictum vehicula, mauris dui efficitur nunc, at mattis urna libero in enim. Etiam faucibus elit non tellus maximus pretium. Praesent a magna ex. Phasellus sit amet facilisis tortor.', 'doc//cv//Vihara_+94788329249.zip', '2024-02-20 02:52:05', 1, 1, 2, 0, NULL);

-- Dumping data for table workdb.worker_address: ~0 rows (approximately)
REPLACE INTO `worker_address` (`id`, `add_line1`, `add_line2`, `worker_email`, `postal_code`, `city_city_id`) VALUES
	(1, 'Nayoma,paramulla Road,', 'Matara', 'achinthamihiran295@gmail.com', '12345', 1),
	(2, 'Nayoma,Paramulla Road', 'Matara', 'achinthamihiran299@gmail.com', '12345', 1),
	(3, 'Nayoma,Paramulla Road', 'Matara', 'achinthamihiran298@gmail.com', '12345', 1),
	(4, 'Nayoma,Paramulla Road', 'Matara', 'achinthamihiran297@gmail.com', '12345', 1),
	(5, 'Nayoma,Paramulla Road', 'Matara', 'achinthamihiran296@gmail.com', '20285', 1),
	(6, 'Nayoma,Paramulla Road', 'Matara', 'achinthamihiran284@gmail.com', '20456', 1),
	(7, 'Nayoma , Paramulla Road', 'Matara', 'achinthamihiran283@gmail.com', '40785', 1),
	(8, 'Nayoma,Paramulla Road', 'Matara', 'achinthamihiran282@gmail.com', '12904', 1),
	(9, 'Nayoma', 'Matara', 'achinthamihiran281@gmail.com', '34578', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
