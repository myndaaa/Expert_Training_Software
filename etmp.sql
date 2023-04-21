DROP DATABASE IF EXISTS `expert-db`;
CREATE DATABASE `expert-db`;
USE `expert-db`;

CREATE TABLE employee (
  employeeID INT AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  employeeRank VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL CHECK(LENGTH(password) >= 8),
  email VARCHAR(255) NOT NULL UNIQUE,
  icNumber CHAR(10) NOT NULL UNIQUE,
  passport VARCHAR(255) NOT NULL UNIQUE,
  phone CHAR(10) NOT NULL UNIQUE,
  address VARCHAR(255) NOT NULL
  
);

CREATE TABLE customer (
  customerID INT AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL CHECK(LENGTH(password) >= 8),
  email VARCHAR(255) NOT NULL UNIQUE,
  icNumber CHAR(10) NOT NULL UNIQUE,
  passport VARCHAR(255) NOT NULL UNIQUE,
  phone CHAR(10) NOT NULL UNIQUE,
  organization VARCHAR(255),
  postalCode CHAR(5) NOT NULL,
  street VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL
  
);

CREATE TABLE workshop (
  workshopID INT AUTO_INCREMENT PRIMARY KEY,
  prerequisite VARCHAR(255),
  subject VARCHAR(255),
  outcome VARCHAR(255),
  about VARCHAR(255)
);

CREATE TABLE WorksWith (
  serialNo INT AUTO_INCREMENT PRIMARY KEY,
  employeeID INT NOT NULL,
  customerID INT NOT NULL,
  workshopID INT NOT NULL,
  FOREIGN KEY (employeeID) REFERENCES employee (employeeID),
  FOREIGN KEY (customerID) REFERENCES customer (customerID),
  FOREIGN KEY (workshopID) REFERENCES workshop (workshopID)
);

CREATE TABLE training (
  TrainingID INT AUTO_INCREMENT PRIMARY KEY,
  employeeID INT NOT NULL,
  customerID INT NOT NULL,
  startDate DATE,
  endDate DATE,
  Duration VARCHAR(50),
  FOREIGN KEY (employeeID) REFERENCES employee (employeeID),
  FOREIGN KEY (customerID) REFERENCES customer (customerID)
);

CREATE TABLE payment (
  PaymentID INT AUTO_INCREMENT PRIMARY KEY,
  customerID INT NOT NULL,
  TrainingID INT NOT NULL,
  status VARCHAR(50),
  amountPaid DECIMAL(10, 2),
  date DATE,
  FOREIGN KEY (customerID) REFERENCES customer (customerID),
  FOREIGN KEY (TrainingID) REFERENCES training (TrainingID)
);

CREATE TABLE feedback (
  feedbackID INT AUTO_INCREMENT PRIMARY KEY,
  employeeID INT,
  status VARCHAR(50),
  date DATE,
  phone CHAR(10),
  email VARCHAR(255),
  FOREIGN KEY (employeeID) REFERENCES employee (employeeID)
);

CREATE TABLE notification (
  NotificationID INT AUTO_INCREMENT PRIMARY KEY,
  customerID INT,
  employeeID INT,
  text VARCHAR(255),
  FOREIGN KEY (customerID) REFERENCES customer (customerID),
  FOREIGN KEY (employeeID) REFERENCES employee (employeeID)
);

CREATE TABLE enquiry (
  enquiryID INT AUTO_INCREMENT PRIMARY KEY,
  customerID INT,
  status VARCHAR(50),
  date DATE,
  FOREIGN KEY (customerID) REFERENCES customer (customerID)
);

CREATE TABLE message (
  lineNo INT NOT NULL,
  messageID INT NOT NULL,
  customerID INT,
  employeeID INT,
  senderName VARCHAR(50),
  receiverName VARCHAR(50),
  date DATE,
  time TIME,
  text VARCHAR(255),
  PRIMARY KEY (lineNo, messageID),
  FOREIGN KEY (customerID) REFERENCES customer (customerID),
  FOREIGN KEY (employeeID) REFERENCES employee (employeeID)
);


CREATE TABLE imageSlider (
  `imageID` INT NOT NULL AUTO_INCREMENT,
  `path` TEXT NOT NULL,
  `name` VARCHAR(255),
  `description` TEXT NOT NULL,
  PRIMARY KEY (`imageID`)
);


CREATE TABLE popup (
  `popupID` INT NOT NULL AUTO_INCREMENT,
  `imagePath` TEXT NOT NULL,
  `name` VARCHAR(255),
  `description` TEXT NOT NULL,
  PRIMARY KEY (`popupID`)
);


CREATE TABLE testimonials (
  `testimonialID` INT NOT NULL AUTO_INCREMENT,
  `imagePath` TEXT NOT NULL,
  `personName` VARCHAR(255),
  `description` TEXT NOT NULL,
  `companyName` VARCHAR(255),
  `position` VARCHAR(255),
  PRIMARY KEY (`testimonialID`)
);

CREATE TABLE feedbackHomepage (
  feedbackID INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL
);

INSERT INTO `popup` (`imagePath`, `name`, `description`) VALUES ('images/cover.jpg', 'VENISON', '<h2>10<sup>%</sup><span>off</span></h2><p>For the first 20 customers</p>'), ('images/cover.jpg', 'NAME 2', '<h2>10<sup>%</sup><span>off</span></h2><p>DESCRIPTION 2</p>');

INSERT INTO `testimonials` (`imagePath`, `personName`, `description`, `companyName`, `position`) VALUES ('images/cover.jpg', 'Person 1', 'Description 1', 'Company 1', 'Position 1'), ('images/cover.jpg', 'Person 2', 'Description 2', 'Company 2', 'Position 2');

INSERT INTO `imageslider` (`imageID`, `path`, `name`, `description`) VALUES (NULL, 'images/cover.jpg', 'Image 1', 'Description 1'), (NULL, 'images/cover.jpg', 'Image 2', 'Description 2'), (NULL, 'images/cover.jpg', 'Image 3', 'Description 3');