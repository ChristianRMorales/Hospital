create database hospital;
use hospital;

create table user (
	userId INT AUTO_INCREMENT,
	userName varChar(50),
    pass varChar(50),
    email varChar(255),
	
	PRIMARY KEY (userId)
);

select * from user;
SELECT * FROM user WHERE userName = "paulIrvin";


create table patient (
	patientId INT AUTO_INCREMENT,
    patientName varChar(50), 	
    patientAddress varChar(255),
    patientBirth date,
    patientPhone varChar(20),
    emergencyContact varChar(255),
	patientDateRegistered date,
	PRIMARY KEY (patientId)
);


create table doctor (
	doctorId INT AUTO_INCREMENT,
    doctorName varchar(50),
    doctorAddress varChar(255),
    doctorPhone varchar(20),
    doctorPassword varchar(50),
	PRIMARY KEY (doctorId)
);

insert into doctor values(0,'chanly mae dizown', 'llc', '09166598876');

create table bed (
	bedId INT AUTO_INCREMENT,
    bedName varchar(50),
    ratePerDay float(10),
    bedType varChar(50),
    PRIMARY KEY (bedId)
);


insert into bed values(0,'NoBED', 0, 'No BED');
insert into bed values(0,'bed1', 113, 'king size');
select * from bed;
delete from bed where bedId = 1;

create table visit (
	visitId INT AUTO_INCREMENT,
    patientId int(5),
    patientType int(5),
    doctorId int(5),
    bedId int(5),
    dateOfVisit date,
    dateOfDischarge date,
    symptoms varchar(1000),
    disease varchar(1000),
    treatment varchar(1000),
    completed int(5),
    hasBed int(5),
    PRIMARY KEY (visitId),
	FOREIGN KEY (patientId) REFERENCES patient( patientId ) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (doctorId) REFERENCES doctor(doctorId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (bedId) REFERENCES bed(bedId) ON UPDATE CASCADE ON DELETE CASCADE
    
);

insert into visit values(0, 2, "out", 1, 1, "2000-10-31", "2000-11-30" ,'secret', 'secret', 'secret');
select * from visit;

insert into patient values(0,"Paul Irvin Alas", "Pusok, Lapu-Lapu City", "2000-10-31", "0916 659 8876", "", "2023-5-9" );
insert into patient values(0,"Christian Morales", "Pusok, Lapu-Lapu City", "2001-11-01", "0916 659 8876", "", "2023-5-9" );
insert into patient values(0,"Christian Paul Mandawe", "Mandaue City", "2001-11-01", "0916 659 8876", "", "2022-5-5" );
insert into patient values(0,"Gabriel Tejana", "Pusok, Lapu-Lapu City", "2001-11-01", "0916 659 8876", "", "2021-1-9" );
insert into patient values(0,"Angelo Baricuatro", "Pusok, Lapu-Lapu City", "2001-11-01", "0916 659 8876", "", "2022-8-20" );
select * from patient;
delete from patient where patientId > 6;

SELECT * FROM patient WHERE CONCAT(patientId,patientName,patientDateRegistered) LIKE 1;

 
INSERT INTO doctor (doctorId, doctorName, doctorAddress, doctorPhone, doctorPassword) VALUES 
(NULL, 'Gems Lyle Hubac', 'Lacion Loan', '70043', 'pass'),
(NULL, 'Mark Ligo', 'Mingla Parkmall', '70040', 'pass'),
(NULL, 'Gab Barinan', 'Mandaue City', '70028', 'pass'),
(NULL, 'Paul Wei Yu', 'Lapu-Lapu City', '70032', 'pass'),
(NULL, 'Jeeriel Orat', 'Cebu City', '70065', 'pass');
select * from doctor;
delete from doctor where doctorId > 0;

iNSERT INTO bed (bedId, bedName, ratePerDay, bedType) VALUES
(NULL, 'NOBED', '0', 'OUTPATIENT'),
(NULL, 'Single Bed', '500', 'Public-Ward'),
(NULL, 'Double Bed', '800', 'Private'),
(NULL, 'Super Single Bed', '1000', 'Premium');
select * from bed;
insert into visit values(null, 1,1, 1, 2, "2000-10-31",  "2023-5-9", "asdasd", "asdasdasd", "ASDASDASD",0,0 );
insert into visit values(null, 2,1, 1, 2, "2000-10-31",  "2023-5-9", "asdasd", "asdasdasd", "ASDASDASD",0,0 );



