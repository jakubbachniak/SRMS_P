--
-- Database: SRMS_P
--
--------------------------------------------------------------------------------
--
-- Create table therapy
--
Create table if not exists `therapy` (
	`therapyId` varchar(10) not null unique,
    `therapyName` varchar(50) not null,
    `tCategory` varchar(6) not null,
    `tType` varchar(10) not null,
    `tReviewDate` date not null,
    `isOffered` varchar(1) not null,
    check (isOffered in ("Y", "N")),
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    check (tCategory in ("health", "beauty")),
    constraint primary key (`therapyId`)
);
--
-- Create table equipment
--
Create table if not exists `equipment` (
	`eIdNumber` varchar(6) not null unique,
    `eName` varchar(50) not null,
    `eMntValue` varchar(10) not null,
    `eReviewDate` date not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    check(eMntValue in ("consumable", "shared")),
    constraint primary key (`eIdNumber`)
);
--
-- Create table staff
--
Create table if not exists `staff` (
	`staffNo` varchar(6) not null unique,
    `fName` varchar(15) not null,
    `lName` varchar(25) not null,
    `enabled` varchar(1) not null,
    `staffLogin` varchar(15) not null,
    `staffPassword` varchar(4) not null,
    -- password limited to four characters
    -- for the purposes of this exercise and for simplicity
    -- default password for all users is 'pass'
    `accessLevel` varchar(1) not null,
    check (accessLevel in ("1", "2", "3")),
    -- constrain values for accessLevel to:
    -- "1" for Manager / HR staff
    -- "2" marketing staff
    -- "3" therapist
    check (enabled in ("Y", "N")),
    constraint primary key (`staffNo`)
);
--
-- Create table manager/HRstaff
--
Create table if not exists `manager_HR` (
	`managerNo` varchar(6) not null unique,
    `staffNo` varchar(6) not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint primary key (`managerNo`)
);
--
-- Create table marketingStaff
--
create table if not exists `marketingStaff` (
	`marketingStaffNo` varchar(6) not null unique,
    `staffNo` varchar(6) not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint primary key (`marketingStaffNo`),
    constraint foreign key (`staffNo`) references staff (`staffNo`)
		on delete no action on update cascade
);
--
-- Create table therapist
--
create table if not exists `therapist` (
	`staffNo` varchar(6) not null unique,
    `phoneNo` varchar(15) not null,
    `roomNo` varchar(3) not null,
    `managerNo` varchar(6) not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint
		primary key (`staffNo`),
        foreign key (`staffNo`) references staff (`staffNo`)
			on delete no action on update cascade,
        foreign key (`managerNo`) references manager_HR (`managerNo`)
			on delete no action on update cascade
);
--
-- Create table qualifications
--
Create table if not exists `qualifications` (
	`qId` varchar(10) not null unique,
    `qName` varchar(100) not null,
    `qLevel` varchar(12) not null,
    `qAccBody` varchar(100) not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    check(qLevel in ("basic", "intermediate", "advanced")),
    constraint primary key (`qId`)
);
--
-- Create table room
--
Create table if not exists `room` (
	`roomNo` varchar(3) not null unique,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint primary key (`roomNo`)
);
--
-- Create table therapySession
--
Create table if not exists `therapySession` (
	`sessionId` varchar(8) not null unique,
    `therapyId` varchar(10) not null,
    `staffNo` varchar(6) not null,
    `sDate` date not null,
    `startTime` time,
    `finishTime` time,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint
		primary key (`sessionId`),
        foreign key (`therapyId`) references therapy (`therapyId`)
			on delete no action on update cascade,
        foreign key (`staffNo`) references therapist (`staffNo`)
			on delete no action on update cascade
);
--
-- Create table therapistQualifications
--
Create table if not exists `therapistQualifications` (
	`staffNo` varchar(6) not null unique,
    `qId` varchar(10) not null,
    `dateQualified` date not null,
    `qExpiryDdate` date not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint
		primary key (`staffNo`, `qId`),
        foreign key (`staffNo`) references therapist (`staffNo`)
			on delete no action on update cascade,
        foreign key (`qId`) references qualifications (`qId`)
			on delete no action on update cascade
);
--
-- Create table therapyEquipment
--
create table if not exists `therapyEquipment` (
	`therapyId` varchar(10) not null,
    `eIdNumber` varchar(6) not null,
    `enabled` varchar(1) not null,
    check (enabled in ("Y", "N")),
    constraint
		primary key (`therapyId`, `eIdNumber`),
        foreign key (`therapyId`) references therapy (`therapyId`)
			on delete no action on update cascade,
        foreign key (`eIdNumber`) references equipment (`eIdNumber`)
			on delete no action on update cascade
);

--
-- create view in the databse therapyPopularity
-- which shows the results of calculating the total number of session archives
-- per therapy, ranked by popularity. Ensure the name of the therapy is displayed
-- alongside the number of sessions booked for each one.
-- Part of the implementation of the custom sql statement
-- course work tasks UAT's section 3 bullet point no 5

create view therapyPopularity (`Therapy`, `Total number of sessions`) as
select therapyName , count(sessionId) as `total number of sessions` 
from therapy t, therapySession ts
where ts.therapyId = t.therapyId
group by ts.therapyId
order by `total number of sessions` desc;
