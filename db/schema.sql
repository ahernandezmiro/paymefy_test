create database if not exists `database`;

USE `database`;

/*Table structure for table `test` */

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(254) NOT NULL,   
  `name` varchar(50) NOT NULL,       
  `phone` varchar(30) NOT NULL,     
  `company`  varchar(50) DEFAULT '',     
   PRIMARY KEY  (`email`)
);