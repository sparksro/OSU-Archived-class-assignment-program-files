DROP TABLE IF EXISTS `gradebook_assignment`;
DROP TABLE IF EXISTS `student_assignment`;
DROP TABLE IF EXISTS `parent`;
DROP TABLE IF EXISTS `student_class`;
DROP TABLE IF EXISTS `grade`;
DROP TABLE IF EXISTS `gradebook`;
DROP TABLE IF EXISTS `assignment`;
DROP TABLE IF EXISTS `class`;
DROP TABLE IF EXISTS `contact`;
DROP TABLE IF EXISTS `user`;

#main table
CREATE TABLE `user` (
`id` INT( 10 ) NULL AUTO_INCREMENT COMMENT 'main user id',
`username` VARCHAR( 35 ) NOT NULL UNIQUE ,
`fname` VARCHAR( 35 ) NOT NULL,
`lname` VARCHAR( 35 ) NOT NULL,
`title` VARCHAR( 35 ) NULL DEFAULT 'student' ,
`dob` DATE NOT NULL ,
`enr_date` DATE NOT NULL ,
`pw` VARCHAR( 130 ) NOT NULL ,
`usr_lvl` TINYINT NOT NULL DEFAULT '5',
PRIMARY KEY ( `id` )
) ENGINE = INNODB;

#contact info
CREATE TABLE `contact` (
`id` INT( 10 ) NULL AUTO_INCREMENT ,  
`uid` INT( 10 ) NOT NULL ,
`address` VARCHAR( 75 ) NULL ,
`city` VARCHAR( 30 ) NULL, 
`state` VARCHAR( 30 ) NULL ,
`zip` INT( 11 ) NULL ,
`email` VARCHAR( 50 ) NULL ,
`phone` VARCHAR( 20 ) NULL ,
PRIMARY KEY ( `id` ),
FOREIGN KEY (uid) REFERENCES user(id) ON DELETE CASCADE
) ENGINE = InnoDB;  

#class table
CREATE TABLE `class` (
`id` INT( 10 ) NULL AUTO_INCREMENT ,
`cname` VARCHAR( 50 ) NOT NULL ,
`teacher_id` INT( 10 ) NOT NULL ,
PRIMARY KEY ( `id` ),
FOREIGN KEY (teacher_id) REFERENCES user(id) ON DELETE CASCADE
) ENGINE = InnoDB;

#assignment table
CREATE TABLE `assignment` (
`id` INT( 12 ) NULL AUTO_INCREMENT,
`subject` VARCHAR( 25 ) NOT NULL,
`name` VARCHAR( 50 ) NOT NULL UNIQUE,
`descript` VARCHAR( 255 ) NULL ,
`ppoints` INT( 4 ) NULL ,
`due` DATE NOT NULL,
`class_id` INT( 10 ) NOT NULL ,
PRIMARY KEY ( `id` ),
FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE
) ENGINE = InnoDB;

#gradebook
CREATE TABLE `gradebook` (
`id` INT( 10 ) NULL AUTO_INCREMENT,
`sid` INT( 10 ) NOT NULL ,
`points` INT( 4 ) NULL DEFAULT '0',
`comment` VARCHAR( 255 ) NULL ,
`percent` INT( 4 ) NOT NULL,
PRIMARY KEY ( `id` ),
FOREIGN KEY (sid) REFERENCES user(id) ON DELETE CASCADE
) ENGINE = InnoDB;

#grade
CREATE TABLE `grade` (
`percent_v` int( 4 ) NULL ,
`grade` VARCHAR( 4 ) NOT NULL,
PRIMARY KEY ( `percent_v` )
) ENGINE = InnoDB;

#student relation class m x m table
CREATE TABLE `student_class` (
`class_id` int( 10 ) NOT NULL ,
`sid` int( 10 ) NOT NULL,
FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE,
FOREIGN KEY (sid) REFERENCES user(id) ON DELETE CASCADE,
PRIMARY KEY ( `class_id`, `sid` )
) ENGINE = InnoDB;

#parent relation student m x m table
CREATE TABLE `parent` (
`uid` int( 10 ) NOT NULL,
`sid` int( 10 ) NOT NULL,
FOREIGN KEY (uid) REFERENCES user(id) ON DELETE CASCADE,
FOREIGN KEY (sid) REFERENCES user(id) ON DELETE CASCADE,
PRIMARY KEY ( `uid`, `sid` )
) ENGINE = InnoDB;

#student relation assignment table m x m table
CREATE TABLE `student_assignment` (
`assignment_id` int( 10 ) NOT NULL,
`sid` int( 10 ) NOT NULL,
`percent` INT( 4 ) NOT NULL,
FOREIGN KEY (assignment_id) REFERENCES assignment(id) ON DELETE CASCADE,
FOREIGN KEY (sid) REFERENCES user(id) ON DELETE CASCADE,
PRIMARY KEY ( `assignment_id`, `sid` )
) ENGINE = InnoDB;

#gradebook relation assignment table m x m table
CREATE TABLE `gradebook_assignment` (
`gradebook_id` int( 10 ) NOT NULL,
`assignment_id` int( 10 ) NOT NULL,
FOREIGN KEY (gradebook_id) REFERENCES gradebook(id) ON DELETE CASCADE,
FOREIGN KEY (assignment_id) REFERENCES assignment(id) ON DELETE CASCADE,
PRIMARY KEY ( `gradebook_id`, `assignment_id` )
) ENGINE = InnoDB;


#user entered data almost exclusivly at registration with the exception of id and usr_lvl which are auto generated.
INSERT INTO `user` (`id`,`username`,`fname`,`lname`,`title`,`dob`,`enr_date`,`pw`,`usr_lvl`)
VALUES ('1','admin1','Rob', 'Sparks', 'DB administrator' , '1976-04-11' , '2015-05-12' ,'1234', '0'),
 (NULL, 'jsmith' , 'John' , 'Smith' , 'Principal' , '1975-1-7' , '2015-5-13' , '1234', '1'),
 (NULL, 'teacher1', 'S', 'Sparks' , 'Teacher' , '1977-04-01' , '2015-5-13' , '1234' , '2'),
 (NULL, 'ksparks', 'Kayleanna', 'Sparks', 'student', '2008-09-11','2015-5-13', '1234', '4'),
 (NULL, 'teacher2' , 'M', 'Smith' , 'Teacher', '1968-01-07', '2015-5-13','1234', '2'),
 (NULL, 'jjames' , 'Jimmy', 'James' , 'student', '2008-01-14', '2015-5-14','1234', '4'),
 (NULL, 'jillsmith' , 'Jill', 'Smith' , 'student', '2008-02-21' , '2015-5-14' , '1234' , '4'),
 (NULL, 'ajames' , 'Anne' , 'James' , 'parent' , '1992-11-21' , '2015-5-14' ,  '1234' , '3'),
 (NULL, 'tsmith' , 'Tom' , 'Smith' , 'parent' , '1991-7-14' , '2015-5-14' , '1234' , '3'),
 (NULL, 'jajames' , 'Jamie' , 'James' , 'student' , '1990-11-21' , '2015-5-14',  '1234' , '4'),
 (NULL, 'Osmith', 'Olivia' , 'Smith'  , 'student' , '1990-7-14' , '2015-5-14' , '1234',  '4'),
 (NULL, 'teacher3', 'J' , 'Olson'  , 'teacher' , '1985-1-24' , '2015-5-24' , '1234',  '2');

# id auto incremented in the table. All remaining values user entered either by registering parent or new employee.
INSERT INTO `contact` (`id`,`uid`, `address`, `city`, `state`, `zip`, `email`, `phone`)
VALUES ('1',(SELECT id from user WHERE username = "admin1"), '25679 Perkins', 'Eugene', 'Or', '97402', 'sparksro@onid.oregonstate.edu', '514-905-7612'),
(NULL,(SELECT id from user WHERE username = "jsmith"), '1234 Any rd', 'Albany', 'Or', '97401', 'jsmith@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "teacher1"), '25679 Perkins', 'Eugene', 'Or', '97402', 'ssparks@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "ksparks"), '25679 Perkins', 'Eugene', 'Or', '97402', 'ssparks@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "teacher2"), '1234 Any rd', 'Albany', 'Or', '97401', 'msmith@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "jjames"), '7563 place rd', 'Albany', 'Or', '97401', 'jjames@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "jillsmith"), '4321 next rd', 'Albany', 'Or', '97401', 'jillsmith@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "ajames"), '7563 place rd', 'Albany', 'Or', '97401', 'ajames@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "tsmith"), '4321 next rd', 'Albany', 'Or', '97401', 'tsmith@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "jajames"), '7563 place rd', 'Albany', 'Or', '97401', 'jjames@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "Osmith"), '4321 next rd',  'Albany', 'Or', '97401', 'jillsmith@fakeemail.com', '541-987-6543'),
(NULL,(SELECT id from user WHERE username = "teacher3"), '4321 next rd',  'Albany', 'Or', '97401', 'jolson@fakeemail.com', '541-987-6543');

# uid id 
INSERT INTO `parent` (`uid` ,`sid`)
VALUES ('1', '4'),
('3', '4'),
('8', '6'),
('9', '7');

# id is auto entered [cname] [tid] entered as teachers are hired or initially by db anmin.
INSERT INTO `class` (`id` ,`cname` ,`teacher_id`)
VALUES ('1', 'First Grade', '3'), (NULL, 'Second Grade', '5'), (NULL, 'Third Grade', '12') ;

# class_id / user id relatioship table.
INSERT INTO `student_class` (`class_id`,`sid`)
VALUES ('1', '4'), ('1', '6'), ('1', '7'),('2', '10'),('2', '11');


# [subject] selected from drop down id and cid auto assigned [name] [descript] [ppoints] entered by teacher.
INSERT INTO `assignment` (`id` ,`subject`,`name` ,`descript` ,`ppoints` ,`due`, `class_id`)
VALUES ('1', 'Math' ,'math', 'learn 1-10', '10', '2015-04-22','1'),
(NULL, 'Art' ,'art 1', 'color', '5', '2015-05-13' , '1'),
(NULL, 'Art' ,'coloring 1', 'color a tree', '5', '2015-05-02', '1'),
(NULL, 'Reading' ,'reading 2', 'read book 2', '10', '2015-06-08', '2'),
(NULL, 'Writing' ,'Letters 2', 'Write j- p', '10', '2015-06-08', '1'),
(NULL, 'Math' ,'math 2', 'subtracting 1-100', '10', '2015-07-08', '2'),
(NULL, 'Art' ,'art 2', 'water color paint', '5', '2015-07-08', '2'),
(NULL, 'Math' ,'math 1', 'adding small numbers', '10', '2015-07-08', '1'),
(NULL, 'Art' ,'art 3', 'color a tree', '5', '2015-07-08', '1');

# [points] [comment] values inserted by the teacher. I would like to make percent auto calculated based on assignment points and this value.
# Student id, uid, aid and cid entered select from student name. 
INSERT INTO `gradebook` (`id`,`sid`,`points` ,`comment`, `percent`)
VALUES ('1','4', '10', 'Good job', '100' ),
(NULL,'6', '1', 'Nice', '90'),
(NULL,'7', '1', 'Nice', '90');

# Grades will be added to tables bellow where appropriate - note: not added yet as I am not quite sure
# how, I would like to add based on a calc of which grade the students grade is closest to.  I don't know 
# possible and need to do more resurch.  Might neeed to make this an table of 100 values each with a letter grade.
INSERT INTO `grade` (`percent_v` ,`grade`)
VALUES   ('59', 'F'),('60', 'D'),('61', 'D'),('62', 'D'),('63', 'D'),('64', 'D'),('65', 'D'),('66', 'D'),
         ('67', 'D'),('68', 'C-'),('69', 'C-'),('70', 'C-'),('71', 'C-'),('72', 'C-'),
         ('73', 'C'),('74', 'C'),('75', 'C'),('76', 'C'),
         ('77', 'C+'),('78', 'C+'),('79', 'C+'),
         ('80', 'B-'),('81', 'B-'),('82', 'B-'),
         ('83', 'B'),('84', 'B'),('85', 'B'),('86', 'B'),
         ('87', 'B'),('88', 'B'),('89', 'B'),
         ('90', 'A-'),('91', 'A-'),('92', 'A-'),('93', 'A-'),
         ('94', 'A'),('95', 'A'),('96', 'A'),('97', 'A'),('98', 'A'),
         ('99', 'A+'),('100', 'A+');



#All assigned grades - select where [username] will be variable via html drop down. Like a teacher in a class might view.
SELECT u.fname, u.lname, u.id, c.cname, a.id AS "assignment id" , a.name, gb.points, gb.percent
FROM user u
LEFT JOIN class c ON c.id = u.cid
LEFT JOIN assignment a ON a.cid = c.id
INNER JOIN gradebook gb on gb.aid = a.id
WHERE u.username = "ksparks";

#All asignments - graded and not graded select where [username] will be variable (student or parent view )
SELECT u.fname, u.lname, u.id, c.cname, a.id AS "assignment id" , a.name, gb.percent, a.due
FROM user u
LEFT JOIN class c ON c.id = u.cid
LEFT JOIN assignment a ON a.cid = c.id
LEFT JOIN gradebook gb on gb.aid = a.id
WHERE u.username = "ksparks";


#All asignments comming up or not assigned a grade - student or parient view of upcomming assignments uses [student or parent user name]
SELECT u.fname, u.lname, u.id, c.cname, a.id AS "assignment id" , a.name, a.descript, gb.percent, a.due
FROM user u
LEFT JOIN class c ON c.id = u.cid
LEFT JOIN assignment a ON a.cid = c.id
LEFT JOIN gradebook gb on gb.aid = a.id
WHERE u.username = "ksparks"
AND gb.percent is NULL;

# All grades for a certian [assignment]
SELECT c.cname, a.name, gb.percent FROM class c 
LEFT JOIN assignment a ON a.cid = c.id
LEFT JOIN gradebook gb ON gb.aid = a.id
WHERE c.cname = "First Grade" AND a.name = "math"

# All grades averaged for a certian [assignment]
SELECT c.cname, a.name, ROUND (AVG(gb.percent),2) FROM class c 
LEFT JOIN assignment a ON a.cid = c.id
LEFT JOIN gradebook gb ON gb.aid = a.id
WHERE c.cname = "First Grade" AND a.name = "math"
GROUP by a.name;


# *******  The following are planned but untested, all above querries tested and known to work  ************************.

# The following querries are for the partent to update info and the only querrys that are yet untested.
# store obtained userid as $uid
SELECT p.uid, p.sid1, p.sid2, p.sid3, p.opid FROM parent p WHERE (SELECT u.id FROM user u WHERE u.usename = [$login_username] ) = p.uid;

#next loop through uid, sid1, sid2, sid3 and opid and insert data into a form feilds for possible update.
SELECT c.address, c.city, c.state, c.zip, c.email, c.phone FROM contact c WHERE c.uid = [$uid];

#Select from contact based on ids and update data.
UPDATE contact c SET c.address =[address], c.city=[city], c.state=[state], c.zip=[zip],
 c.email=[email], c.phone=[phone] WHERE c.uid = [$uid]; #or sid#, opid

#principles update tool

SELECT lname FROM user; #Auto populate a drop down. Selection = [$lname]
SELECT fname FROM user WHERE lname = [$lname]; #Auto populate a drop down. Selection = [$lname]

SELECT u.id, u.fname, u.lname, u.dob, u.entr_date, u.title, u.usr_lvl
FROM user WHERE (SELECT u.id FROM user u WHERE u.fname = [$fname] AND u.fname = [$lname] )
# Add a button to add grades look up for a student.  Not sure how to do this at this point.

# set u.id = [$uid], u.title = [$title], u.usr_lvl = [$usr_lvl]
UPDATE user u SET u.title=[$title], u.usr_lvl=[$usr_lvl] WHERE u.id = [$uid]; # only to feilds the principle can change but he can view just about all info.
