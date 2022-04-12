/*
SQLyog Community Edition- MySQL GUI v5.22a
Host - 5.5.8-log : Database - php_efarmer
*********************************************************************
Server version : 5.5.8-log
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `php_efarmer`;

USE `php_efarmer`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `bids` */

DROP TABLE IF EXISTS `bids`;

CREATE TABLE `bids` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `crop_id` varchar(255) DEFAULT NULL,
  `mandi_id` varchar(255) DEFAULT NULL,
  `duration` int(5) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bids` */

insert  into `bids`(`id`,`user_id`,`crop_id`,`mandi_id`,`duration`,`price`,`created`) values (2,6,'14','6',7,'1800','2018-04-29 02:49:07'),(3,6,'15','7',10,'1500','2018-04-29 02:57:54'),(4,6,'16','8',7,'1500','2018-04-29 08:45:31'),(5,2,'16','8',7,'1800','2018-04-29 08:46:50');

/*Table structure for table `chatting` */

DROP TABLE IF EXISTS `chatting`;

CREATE TABLE `chatting` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `read_status` char(1) NOT NULL DEFAULT '0' COMMENT '0=>Unread, 1=>Read',
  `receiver_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `chatting` */

insert  into `chatting`(`ID`,`user_id`,`user_name`,`message`,`created`,`read_status`,`receiver_id`) values (1,1,'Administrator','Hello Kartik','2018-04-29 01:23:04','1',7),(2,1,'Administrator','Hello Hemant how are you','2018-04-29 01:23:23','1',9),(3,8,'Kamal Kant','Hello Admin','2018-04-29 01:25:36','1',1),(4,1,'Administrator','helllooo ','2018-04-29 08:34:49','0',8),(5,1,'Administrator','bytyyyhhghh\n','2018-04-29 08:35:46','0',8),(6,9,'Hemant Kumar','how are you','2021-02-28 09:26:23','1',5),(7,5,'shruti','fine and what about you','2021-02-28 09:26:48','1',9);

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(16) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `adding_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `contact` */

insert  into `contact`(`id`,`name`,`email`,`phone_no`,`subject`,`message`,`adding_date`) values (1,'gautam','ram@gmail.com','7820866619','text','i am a student','2015-01-25 09:41:32'),(2,'gautam','ram@gmail.com','7820866619','ram','compleate project','2015-01-26 11:07:02'),(10,'gautam','ram@gmail.com','7820866619','php','ghansmaddfvdf','2015-02-02 08:51:03'),(11,'gautam','divya@gmail.com','7820866619','i have successfully registred','i have successfully registred','2015-02-02 08:57:07'),(12,'hsj','sjdb@gmail.com','dshjkhjkjn','uh',' jkdkfsbf','2015-04-19 06:45:53'),(13,'newone','newone@gmail.com','9897456495','problem no 2','i have problem in all the subjects.. please help','2015-04-19 07:22:21'),(14,'Kamal Kant','info@itprojectshub.com','9898989898','testing message','testing message','2018-04-29 12:56:06');

/*Table structure for table `crops` */

DROP TABLE IF EXISTS `crops`;

CREATE TABLE `crops` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` varchar(254) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `crops` */

insert  into `crops`(`id`,`name`,`imgpath`,`price`,`description`,`quantity`,`add_date`,`status`) values (14,'Wheet','uploads/crops/f2018011326.jpg','1500','1500 Per Quintal','Every Quintal','2018-04-29 01:13:26','1'),(15,'Patato','uploads/crops/f2018011503.jpg','1000','Every Qunital','Every Quintal','2018-04-29 01:15:03','1'),(16,'Rice','uploads/crops/f2018084426.jpg','1000','asjdklfjaslkdjflskdf','50','2018-04-29 08:44:26','1');

/*Table structure for table `faqs` */

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(255) NOT NULL,
  `faq` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `question_date` datetime DEFAULT NULL,
  `answer_date` datetime DEFAULT NULL,
  `replyby` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `adding_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `faqs` */

insert  into `faqs`(`id`,`user_id`,`faq`,`answer`,`question_date`,`answer_date`,`replyby`,`image`,`adding_date`) values (3,8,'Rotain Patato','keep in dry place','2018-04-29 01:36:21','2018-04-29 01:49:42','1','uploads/faq/f2018013621.jpg','2018-04-29 01:36:21'),(8,8,'have a problem in harvest','go to hell','2018-04-29 08:37:15','2018-04-29 08:37:40','1','uploads/faq/f2018083715.jpg','2018-04-29 08:37:15'),(9,8,'Rotain Banana',NULL,'2018-04-29 08:42:29',NULL,NULL,'uploads/faq/f2018084229.jpg','2018-04-29 08:42:29');

/*Table structure for table `mandies` */

DROP TABLE IF EXISTS `mandies`;

CREATE TABLE `mandies` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `address` varchar(550) DEFAULT NULL,
  `adding_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mandies` */

insert  into `mandies`(`id`,`name`,`address`,`adding_date`) values (4,'Bodella ','Wz 17 C block vikaspuri','2018-04-27 09:48:43'),(6,'Ajadpur','Near Metro Station','2018-04-29 01:11:26'),(7,'Kesopur','Near Bus Stand','2018-04-29 01:11:48'),(8,'Okhla','near metro station\r\n','2018-04-29 08:43:46');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `phone_no` varchar(10) DEFAULT NULL,
  `gender` varchar(16) NOT NULL DEFAULT '',
  `dob` varchar(25) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pin_no` varchar(6) DEFAULT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `user_type` varchar(20) DEFAULT 'farmer',
  `adding_date` datetime DEFAULT NULL,
  `login_status` char(1) DEFAULT '0' COMMENT '0 => Offline, 1=>Online',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`phone_no`,`gender`,`dob`,`city`,`state`,`address`,`country`,`pin_no`,`imgpath`,`status`,`user_type`,`adding_date`,`login_status`) values (1,'Administrator','admin@gmail.com','admin','8459811826','Male','7-1-1993','delhi','new delhi','connaught please','india','100126','uploads/documents/f2018011003.png','1','admin','2015-01-26 16:08:20','0'),(2,'Shaurya','shaurya@gmail.com','shaurya','9871685669','','7-1-1993','new deljhi','delhi','c-144 ','india','110065','uploads/userspic/f2015072338.jpg','1','vender','2015-03-23 06:25:34','0'),(5,'shruti','shruti@gmail.com','shruti','9650572216','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','farmer','2015-04-19 07:15:03','1'),(6,'Ghanshyam','ghanshyam@gmail.com','12345','9818637154','Male','2000-04-13','New Delhi','Delhi','Connaught Place','India','110018',NULL,'1','vender','2018-04-27 09:36:53','0'),(7,'Kartik','kartik@gmail.com','12345','9818637154','','1985-04-11','New Delhi','Delhi','Connaught Place','India','110018','uploads/documents/f2018015741.jpg','1','expert','2018-04-28 06:37:32','0'),(8,'Kamal Kant','kamal@gmail.com','admin','9898989898','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','farmer','2018-04-29 12:56:44','1'),(9,'Hemant Kumar','hemant@gmail.com','admin','8989898989','',NULL,NULL,NULL,NULL,NULL,NULL,'uploads/documents/f2018011757.png','1','expert','2018-04-29 01:17:57','1');

/*Table structure for table `weather` */

DROP TABLE IF EXISTS `weather`;

CREATE TABLE `weather` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` varchar(254) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `weather` */

insert  into `weather`(`id`,`name`,`imgpath`,`price`,`description`,`quantity`,`add_date`,`status`) values (1,'16','uploads/crops/f2021090142.png','34','Delhi','15','2021-02-28 09:01:42','1'),(2,'12','uploads/crops/f2021092007.png','25','Mumbai it is rainy day','20','2021-02-28 09:20:07','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
