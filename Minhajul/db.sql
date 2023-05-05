


CREATE TABLE imageSlider (
  `imageID` INT NOT NULL AUTO_INCREMENT,
  `path` TEXT NOT NULL,
  `name` VARCHAR(255),
  `description` TEXT NOT NULL,
  PRIMARY KEY (`imageID`)
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