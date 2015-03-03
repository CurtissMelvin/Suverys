#SurveySez.php
#ITC 250
#Winter 2015

Source and target columns must have the same data type, there must be an index on the target columns and referenced data must exist.

drop table if exists wn15_Surveys;
create table wn15_Questions(
AdminID int unsigned not null auto_increment primary key,
LastName varchar(50) DEFAULT '',
FirstName varchar(50) DEFAULT '',
Email varchar(120) DEFAULT '',
NumLogins int DEFAULT 0,
DateAdded DATETIME,
LastLogin DATETIME
);

drop table if exists wn15_Questions;
create table wn15_Questions(
AdminID int unsigned not null auto_increment primary key,
LastName varchar(50) DEFAULT '',
FirstName varchar(50) DEFAULT '',
Email varchar(120) DEFAULT '',
NumLogins int DEFAULT 0,
DateAdded DATETIME,
LastLogin DATETIME
);

drop table if exists wn15_Responses;
create table wn15_Responses(
AdminID int unsigned not null auto_increment primary key,
LastName varchar(50) DEFAULT '',
FirstName varchar(50) DEFAULT '',
Email varchar(120) DEFAULT '',
NumLogins int DEFAULT 0,
DateAdded DATETIME,
LastLogin DATETIME
);

