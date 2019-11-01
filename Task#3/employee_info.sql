/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.36-MariaDB : Database - employee_info
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`employee_info` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `employee_info`;

/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `activity_log` */

insert  into `activity_log`(`id`,`user_id`,`description`,`created_at`,`updated_at`) values (1,1,'Jon Stephens added work experience details.','2019-10-30 22:20:32',NULL),(2,1,'Jon Stephens added education details.','2019-10-30 22:25:42',NULL);

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_code` char(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `language` */

insert  into `language`(`id`,`language_code`) values (1,'en'),(2,'fr'),(3,'es');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `ssn` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_current_employee` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`birth_date`,`ssn`,`email`,`phone`,`address`,`is_current_employee`,`created_at`,`updated_at`) values (1,'Jon Stephens','1995-03-15','521-99-6747','john@mail.com','6172235589','23 Workhaven Lane',1,'2019-10-30 22:14:33',NULL);

/*Table structure for table `user_education` */

DROP TABLE IF EXISTS `user_education`;

CREATE TABLE `user_education` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `language_id` int(11) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institute` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `user_education_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_education_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_education` */

insert  into `user_education`(`id`,`user_id`,`language_id`,`parent_id`,`start_date`,`end_date`,`degree`,`institute`,`created_at`,`updated_at`) values (1,1,1,0,'2012-01-01','2016-12-31','Bachelor','California State University','2019-10-30 21:42:49',NULL),(2,1,3,1,'2012-01-01','2016-12-31','Soltero','Universidad Estatal de California','2019-11-01 07:58:50',NULL),(3,1,2,1,'2012-01-01','2016-12-31','Bachelier','Université d\'État de Californie','2019-11-01 08:00:30',NULL);

/*Table structure for table `user_experience` */

DROP TABLE IF EXISTS `user_experience`;

CREATE TABLE `user_experience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_experience` */

insert  into `user_experience`(`id`,`user_id`,`start_date`,`end_date`,`created_at`,`updated_at`) values (1,1,'2017-01-02',NULL,'2019-10-30 21:43:43',NULL);

/*Table structure for table `user_experience_translation` */

DROP TABLE IF EXISTS `user_experience_translation`;

CREATE TABLE `user_experience_translation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_experience_id` int(11) unsigned NOT NULL,
  `language_id` int(11) unsigned NOT NULL,
  `work_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `job_description` text CHARACTER SET latin1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`),
  KEY `user_experience_id` (`user_experience_id`),
  CONSTRAINT `user_experience_translation_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  CONSTRAINT `user_experience_translation_ibfk_2` FOREIGN KEY (`user_experience_id`) REFERENCES `user_experience` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_experience_translation` */

insert  into `user_experience_translation`(`id`,`user_experience_id`,`language_id`,`work_at`,`job_title`,`job_description`,`created_at`,`updated_at`) values (1,1,1,'Grooming Technologies','Web Developer','Designed and developed user-friendly website, including optimized check-out page that increased user clicks, and subsequently customer purchases.','2019-10-30 21:51:34',NULL),(2,1,3,'Tecnologías de aseo','Desarrollador web','Diseño y desarrollo de un sitio web fácil de usar, que incluye una página de pago optimizada que aumentó los clics del usuario y, posteriormente, las compras de los clientes.','2019-10-30 21:51:56',NULL),(3,1,2,'Technologies de toilettage','Développeur web','Site Web convivial conçu et développé, comprenant une page de contrôle optimisée augmentant le nombre de clics d’utilisateur, puis les achats des clients.','2019-10-30 21:52:40',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
