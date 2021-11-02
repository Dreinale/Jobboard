DROP DATABASE IF EXISTS `job_board`;
CREATE DATABASE `job_board`;
USE `job_board`;

CREATE TABLE `Advertisements` (
    ad_ID int NOT NULL,
    publish_date date NOT NULL,
    company_ID int NOT NULL,
    company_name varchar(50) NOT NULL,
    published_by varchar(50) NOT NULL,
    position varchar(50) NOT NULL,
    salary int NOT NULL,
    location varchar(50) NOT NULL,
    job_description varchar(50) NOT NULL,
    requirements varchar(50) NOT NULL
);

CREATE TABLE `Companies` (
    `company_ID` int NOT NULL,
    `company_name` varchar(50) NOT NULL,
    `company_description` varchar(50) NOT NULL,
    `website` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `People` (
    `user_ID` int NOT NULL,
    `status` int NOT NULL,
    `full_name` varchar(50) NOT NULL,
    `age` int NOT NULL,
    `location` varchar(50) NOT NULL,
    `current_lastJob` varchar(50) NOT NULL,
    `clearance_lvl` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `JA` (
    `job_application_ID` int NOT NULL,
    `email` varchar(50) NOT NULL,
    `subject` varchar(50) NOT NULL,
    `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
