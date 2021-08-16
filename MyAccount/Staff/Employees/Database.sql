create database TheTeaCulturePH2;

create table admins (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

create table users (
    EmployeeNumber VARCHAR(50) NOT NULL PRIMARY KEY,
	LastName varchar(30) NOT NULL,
	FirstName varchar(30) NOT NULL,
	SSS varchar(30) NOT NULL,
	PagIbig varchar(30) NOT NULL,
	PhilHealth varchar(30) NOT NULL,
	DaySchedule int(2) NOT NULL,
	HourSchedule int(2) NOT NULL,
    password VARCHAR(255) NOT NULL
);

create table employees (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Days int(1) NOT NULL,
	EmployeeNumber varchar(10) NOT NULL,
	WorkDate date NOT NULL,
	TimeIn varchar(30) NOT NULL,
	TimeOut varchar(30) NOT NULL,
	Hours varchar(30) NOT NULL,
	BasicPay varchar(30) NOT NULL,
	HolidayPay varchar(30) NOT NULL,
	OvertimePay varchar(30) NOT NULL,
	GrossPay varchar(30) NOT NULL
);

create table salary (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	TimePeriod varchar(30) NOT NULL,
	EmployeeNumber varchar(10) NOT NULL,
	WorkDate varchar(30) NOT NULL,
	Hours varchar(30) NOT NULL,
	BasicPay varchar(30) NOT NULL,
	HolidayPay varchar(30) NOT NULL,
	OvertimePay varchar(30) NOT NULL,
	GrossPay varchar(30) NOT NULL,
	TardinessAbsences varchar(30) NOT NULL,
	SSS varchar(30) NOT NULL,
	PagIbig varchar(30) NOT NULL,
	PHIC varchar(30) NOT NULL,
	TotalDeductions varchar(30) NOT NULL,
	NetPay varchar(30) NOT NULL
);

create table benefits (
	id INT NOT NULL PRIMARY KEY,
	SSS float(30) NOT NULL,
	PagIbig float(30) NOT NULL,
	PHIC float(30) NOT NULL
);

