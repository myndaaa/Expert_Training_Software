CREATE DATABASE training_portal;
USE training_portal;

CREATE TABLE employee (
  employeeID INT AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  employeeRank VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  icNumber CHAR(10) NOT NULL UNIQUE,
  passport VARCHAR(255) NOT NULL UNIQUE,
  phone CHAR(10) NOT NULL UNIQUE,
  address VARCHAR(255) NOT NULL
  
);

CREATE TABLE login (
 username VARCHAR(50) NOT NULL PRIMARY KEY,
 password VARCHAR(255) NOT NULL CHECK(LENGTH(password) >= 8)
);

CREATE TABLE customer (
  customerID INT AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
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
  Title VARCHAR(255) NOT NULL,
  Sector VARCHAR(255) NOT NULL,
  Description TEXT NOT NULL,
  Duration INT NOT NULL,
  Cost_Per_Person DECIMAL(10, 2) NOT NULL,
  Format VARCHAR(255) NOT NULL,
  Instructor VARCHAR(255) NOT NULL

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


CREATE TABLE customerReview(
    feedbackID INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `msg` TEXT NOT NULL
)