
-- Therapy

INSERT INTO `therapy` (`therapyId`, `therapyName`, `tCategory`, `tType`, `tReviewDate`, `isOffered`, `enabled`) VALUES
('PPRFTTR01', 'Pampering Foot Treatment', 'health', 'individual', '2018-01-01', 'Y', 'Y'),
('DTISMSG01', 'Deep Tissue Massage', 'beauty', 'individual', '2018-06-01', 'Y', 'Y'),
('INDHDMSG01', 'Indian Head Massage', 'health', 'individual', '2018-01-01', 'Y', 'Y'),
('SWMCOCH01', 'Swimming Coaching', 'health', 'group', '2018-01-01', 'Y', 'Y'),
('ACUPT01', 'Acupuncture', 'health', 'individual', '2018-03-01', 'Y', 'Y'),
('ANGEL01', 'Angel Workshop', 'health', 'group', '2018-03-01', 'Y', 'Y'),
('BDYBAL01', 'Body Balancing', 'health', 'group', '2018-01-01', 'Y', 'Y'),
('BNSMA01', 'Back Neck Shoulder Massage', 'health', 'individual', '2018-06-01', 'Y', 'Y'),
('HTSTSTR01', 'Hot Stone Stress Away', 'health', 'individual', '2018-01-01', 'Y', 'Y'),
('RENGHTST01', 'Re-energising heated stones', 'health', 'individual', '2018-06-01', 'Y', 'Y'),
('REFLEXLG01', 'Reflexology', 'health', 'group', '2018-06-01', 'Y', 'Y'),
('SFTTISRM01', 'Soft Tissue Remedial Therapy', 'beauty', 'individual', '2018-03-01', 'Y', 'Y'),
('DMUMA01', 'Deep Muscule Massage', 'health', 'individual', '2018-03-01', 'Y', 'Y'),
('MCDBSY01', 'Microdermabrasy', 'beauty', 'individual', '2018-06-01', 'Y', 'Y');

-- Equipment

INSERT INTO `equipment` (`eIdNumber`, `eName`, `eMntValue`, `eReviewDate`, `enabled`) VALUES
('MHTC01', 'Microdermabrasion Machine With Hot Towel Cabinet', 'shared', '2018-01-01', 'Y'),
('CMDM01', 'Crystal Microdermabrasion Machine', 'shared', '2018-06-01', 'Y'),
('PPEM01', 'Papaya Enzyme Mask', 'consumable', '2018-01-01', 'Y'),
('HDGM01', 'Hydrating Gel Mosturizer', 'consumable', '2018-01-01', 'Y'),
('ESTT01', 'Electric Spa Treatment Table', 'shared', '2018-03-01', 'Y'),
('CFTB01', 'Cosmo Facial Treatment Bed', 'shared', '2018-03-01', 'Y'),
('ESMF01', 'Elegance Spa Massage Facial Bed', 'shared', '2018-01-01', 'Y'),
('ECOS01', 'Econo Hydrolic Stool', 'shared', '2018-06-01', 'Y'),
('DESS10', 'Designer Stool', 'shared', '2018-01-01', 'Y'),
('ELTS01',	'Elite beauty Stool', 'shared', '2018-06-01', 'Y'),
('BASH01',	'Basalt Polish Hot Stone Massage Kit', 'shared', '2018-06-01', 'Y'),
('QRTW02',	'Quart Massage Stone Warmer', 'shared', '2018-03-01', 'Y'),
('MOSG02',	'General use mosturizer', 'consumable', '2018-03-01', 'Y'),
('60HS01',	'60 Piece Hot Stone Massage Kit', 'shared', '2018-06-01', 'Y'),
('TWLG25',	'Towel large', 	'consumable', '2018-06-01', 'Y'),
('TWSM65',	'Towel small', 	'consumable', '2018-03-01', 'Y'),
('FCTW22',	'Face towel', 	'consumable', '2018-03-01', 'Y'),
('FCCR64',	'Face  cream', 	'consumable', '2018-06-01', 'Y');

-- Staff

INSERT INTO `staff` (`staffNo`, `fName`, `lName`, `enabled`, `staffLogin`, `staffPassword`, `accessLevel`) VALUES
('SN9230', 'Arthur', 'Bryant', 'Y', 'Arthur', 'pass', '1'),
('SN0447', 'Jennifer', 'Diaz', 'Y', 'Jennifer', 'pass', '2'),
('SN0772', 'Theresa', 'Bailey', 'Y', 'Theresa', 'pass', '3'),
('SN3735', 'Ronald', 'Rodriguez', 'Y', 'Ronald', 'pass', '3'),
('SN5495', 'Andrew', 'White', 'Y', 'Andrew', 'pass', '3'),
('SN2594', 'Fred', 'Brooks', 'Y', 'Fred', 'pass', '3'),
('SN2663', 'Amanda', 'Coleman', 'Y', 'Amanda', 'pass', '3'),
('SN9024', 'Sean', 'Wright', 'Y', 'Sean', 'pass', '3'),
('SN4145', 'Samuel', 'Stewart', 'Y', 'Samuel', 'pass', '3'),
('SN8805', 'Ruth', 'Ramirez', 'Y', 'Ruth', 'pass', '3'),
('SN2152', 'Phyllis', 'Lopez', 'Y', 'Phyllis', 'pass', '3'),
('SN3143', 'Ryan', 'Patterson', 'Y', 'Ryan', 'pass', '3'),
('SN6581', 'Diana', 'Cooper', 'Y', 'Diana', 'pass', '3'),
('SN5664', 'Amy', 'Anderson', 'Y', 'Amy', 'pass', '3'),
('SN3817', 'Jonathan', 'Rogers', 'Y', 'Jonathan', 'pass', '3');

-- Manager/HR // there is only one manager unless we decide otherwise

INSERT INTO `manager_HR` (`managerNo`, `staffNo`, `enabled`) VALUES
('SN9230', 'SN9230', 'Y'),
('SN0772', 'SN0772', 'Y');


-- Marketing Staff // // there is only one, unless we decide otherwise

INSERT INTO `marketingStaff` (`marketingStaffNo`, `staffNo`, `enabled`) VALUES
('SN0447', 'SN0447', 'Y');

-- Therapist

INSERT INTO `therapist` (`staffNo`, `phoneNo`, `roomNo`, `managerNo`, `enabled`) VALUES
('SN0772', '44258536348647', 'B03', 'SN9230', 'Y'),
('SN3735', '85796117366589', 'A01', 'SN9230', 'Y'),
('SN5495', '18218750702803', 'A05', 'SN9230', 'Y'),
('SN2594', '44258536348647', 'B01', 'SN9230', 'Y'),
('SN2663', '68472915438008', 'B02', 'SN9230', 'Y'),
('SN9024', '80272563440394', 'B01', 'SN9230', 'Y'),
('SN4145', '59752378844170', 'A01', 'SN9230', 'Y'),
('SN8805', '10039596213550', 'B01', 'SN9230', 'Y'),
('SN2152', '94992465660354', 'B03', 'SN9230', 'Y'),
('SN3143', '84713015410762', 'A02', 'SN9230', 'Y'),
('SN6581', '76077688771107', 'A03', 'SN9230', 'Y'),
('SN5664', '17269619263899', 'A03', 'SN9230', 'Y'),
('SN3817', '33641344378672', 'B02', 'SN9230', 'Y');

-- Qualificatons

INSERT INTO	`qualifications` (`qId`, `qName`, `qLevel`, `qAccBody`, `enabled`) VALUES
('R16U5EVMW4', 'Certificate in Body Therapy Treatments', 'Intermediate', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('6BFFZI9NIA', 'Certificate in Body Electrical Treatments', 'intermediate', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('113AIQ4FCT', 'Certificate in Body Electrical Treatments', 'advanced', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('1A96CHIEE8', 'Certificate in Body Therapy Treatments', 'advanced', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('94BXTZ7SUR', 'Certificate in Facial Electrical Treatments', 'basic', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('N4LA9ICIPJ', 'Certificate in Facial Electrical Treatments', 'advanced', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('TIFJMVF2AU', 'Masseur', 'Intermediate', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('95K8VMB8CM', 'Masseur', 'advanced', 'Confederation of International Beauty Therapy & Cosmetology', 'Y'),
('0SGX0IYT13', 'Masseur', 'basic', 'Confederation of International Beauty Therapy & Cosmetology', 'Y');

-- Room

INSERT INTO	`room` (`roomNo`, `enabled`) VALUES
('A01', 'Y'),
('A05', 'Y'),
('B01', 'Y'),
('B02', 'Y'),
('B03', 'Y'),
('A02', 'Y'),
('A03', 'Y');

-- TherapySession

-- Intentionally no therapy sessions for therapist no: SN0772

INSERT INTO `therapySession` (`sessionId`, `therapyId`, `staffNo`, `sDate`, `startTime`, `finishTime`, `enabled`) VALUES
('TP76YU83', 'REFLEXLG01', 'SN3735', '2016-02-17', '10:47:24', '11:47:24', 'Y'),
('CF58RM97', 'MCDBSY01', 'SN5495', '2016-04-10', '08:58:31', '09:58:31', 'Y'),
('DO26NE24', 'DTISMSG01', 'SN2594', '2015-06-19', '08:55:17', '09:55:17', 'Y'),
('OF97MB91', 'ANGEL01', 'SN2663', '2016-10-09', '11:11:07', '12:11:07', 'Y'),
('GA66KP30', 'SFTTISRM01', 'SN9024', '2015-04-17', '10:48:15', '11:48:15', 'Y'),
('DE19NM45', 'BNSMA01', 'SN4145', '2015-12-10', '13:30:54', '14:30:54', 'Y'),
('TL37FZ65', 'DMUMA01', 'SN8805', '2015-10-21', '07:32:07', '08:32:07', 'Y'),
('NN49ZY14', 'BDYBAL01', 'SN2152', '2016-11-25', '09:45:16', '10:45:16', 'Y'),
('AS46CI66', 'HTSTSTR01', 'SN3143', '2016-03-23', '14:02:10', '15:02:10', 'Y'),
('LY59EW30', 'MCDBSY01', 'SN6581', '2015-12-20', '10:19:33', '11:19:33', 'Y'),
('WY67UO36', 'REFLEXLG01', 'SN5664', '2016-08-07', '13:28:25', '14:28:25', 'Y'),
('FU13PR21', 'ACUPT01', 'SN3817', '2016-06-30', '14:22:48', '15:22:48', 'Y'),
('OI90TG11', 'MCDBSY01', 'SN3735', '2015-08-30', '12:57:54', '13:57:54', 'Y'),
('RT85FQ60', 'INDHDMSG01', 'SN5495', '2015-08-05', '07:12:03', '08:12:03', 'Y'),
('RZ63KC93', 'BDYBAL01', 'SN2594', '2016-05-17', '07:08:39', '08:08:39', 'Y');

-- Therapist qualifications

INSERT INTO `therapistQualifications` (`staffNo`, `qId`, `dateQualified`, `qExpiryDdate`, `enabled`) VALUES
('SN0772', 'R16U5EVMW4', '2015-10-03', '2018-06-11', 'Y'),
('SN3735', '6BFFZI9NIA', '2014-04-15', '2018-12-09', 'Y'),
('SN5495', '113AIQ4FCT', '2015-08-11', '2018-04-27', 'Y'),
('SN2594', '1A96CHIEE8', '2014-06-09', '2018-12-04', 'Y'),
('SN2663', '94BXTZ7SUR', '2015-10-09', '2018-03-26', 'Y'),
('SN9024', 'N4LA9ICIPJ', '2015-01-22', '2017-11-09', 'Y'),
('SN4145', 'TIFJMVF2AU', '2014-11-19', '2018-07-21', 'Y'),
('SN8805', '95K8VMB8CM', '2015-01-05', '2018-12-12', 'Y'),
('SN2152', '0SGX0IYT13', '2015-12-28', '2018-11-10', 'Y'),
('SN3143', 'R16U5EVMW4', '2015-08-07', '2017-08-06', 'Y'),
('SN6581', '6BFFZI9NIA', '2014-08-08', '2018-09-03', 'Y'),
('SN5664', '113AIQ4FCT', '2015-02-09', '2018-03-29', 'Y'),
('SN3817', '1A96CHIEE8', '2015-02-22', '2017-08-14', 'Y');

-- Therapy Equipment

-- Therapies without associated equipment:
-- SWMCOCH01	Swimming Coaching
-- BDYBAL01	Body Balancing
-- REFLEXLG01	Reflexology
-- DMUMA01	Deep Muscule Massage

INSERT INTO `therapyEquipment` (`therapyId`, `eIdNumber`, `enabled`) VALUES
('PPRFTTR01', 'HDGM01', 'Y'),
('PPRFTTR01', 'ECOS01', 'Y'),
('PPRFTTR01', 'TWSM65', 'Y'),
('INDHDMSG01', 'ESMF01', 'Y'),
('INDHDMSG01', 'PPEM01', 'Y'),
('INDHDMSG01', 'TWSM65', 'Y'),
('ACUPT01', 'ESTT01', 'Y'),
('ANGEL01', 'PPEM01', 'Y'),
('ANGEL01', 'TWLG25', 'Y'),
('HTSTSTR01', 'BASH01', 'Y'),
('SFTTISRM01', 'PPEM01', 'Y'),
('SFTTISRM01', 'TWSM65', 'Y'),
('SFTTISRM01', 'ESMF01', 'Y'),
('MCDBSY01', 'MHTC01', 'Y');
