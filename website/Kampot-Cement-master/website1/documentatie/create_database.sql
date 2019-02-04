SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+02:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS weatherapp DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE weatherapp;




CREATE TABLE Users (
User_id mediumint unsigned NOT NULL AUTO_INCREMENT,
Email varchar(100) NOT NULL UNIQUE,
Password varchar(50) NOT NULL,
Firstname varchar(255) NOT NULL,
Middlename varchar(25),
Lastname varchar (255) NOT NULL,
DateofBirth date,
Phonenumber varchar(30),
Rights varchar(1) DEFAULT '1',
PRIMARY KEY (User_id))
