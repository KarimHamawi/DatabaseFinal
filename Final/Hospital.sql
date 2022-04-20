CREATE DATABASE hospital;      -- Creating a blank DB 

USE hospital;                  -- Accessing the DB 

CREATE TABLE IF NOT EXISTS  NURSE
(
 nurseID VARCHAR(3) NOT NULL, CHECK(nurseID LIKE 'N%'),
 fname VARCHAR(20) NOT NULL, 
 lname VARCHAR(20) NOT NULL,
 password VARCHAR(20)NOT NULL DEFAULT 'asd',
 yearOfBirth DATE, 
 sex CHAR(1) DEFAULT 'F', CHECK (sex IN ('M','F','m','f')),
 email VARCHAR(400), CHECK( email LIKE '%@hos.com'),
 salary INT, CHECK( salary <= 1000000),
shift VARCHAR(8), CHECK(shift IN ('6am-2pm','2pm-10pm','10pm-6am')),
 address VARCHAR(200),

 
 PRIMARY KEY (nurseID)
);

/*chkY CHECK (yearOfBirth >= CURRENT_DATE);*/

CREATE TABLE IF NOT EXISTS MANAGER
(
 managerID VARCHAR(4) NOT NULL, CHECK(managerID LIKE 'MA%'),
 fname VARCHAR(20)NOT NULL,
 lname VARCHAR(20)NOT NULL,
 password VARCHAR(20) NOT NULL DEFAULT 'asd', /* constraints to be added on the end*/
 yearOfBirth DATE, /* constraint to be added due to issues with mysql*/
 sex CHAR(1) DEFAULT 'F', CHECK (sex IN ('M','F','m','f')),
 email VARCHAR(400), CHECK(email LIKE '%@hos.com'),
 salary INT, CHECK( salary <= 1000000),
 shift VARCHAR(8), CHECK(shift IN ('6am-2pm','2pm-10pm','10pm-6am')),
 address VARCHAR(200),

 managerLevel VARCHAR(100), CHECK ( managerLevel IN ('upper','lower')),
 
 PRIMARY KEY (managerID)

);

CREATE TABLE IF NOT EXISTS DEPARTMENT 
(
departmentID VARCHAR(4) NOT NULL, 
depFunctionality VARCHAR(100), /* The functionality of the department is its title and main focus*/
CHECK(depFunctionality IN('CARDIOLOGY','NEUROLOGY','EMERGNECY')),
floorLevel INT, CHECK (floorLevel <=7),
nbOfRooms INT, CHECK (nbOfRooms <=40),
extensionNb INT, CHECK (extensionNb <=999),

PRIMARY KEY (departmentID)

);

CREATE TABLE IF NOT EXISTS TREATMENT
(
treatmentID VARCHAR(4) NOT NULL, CHECK(treatmentID LIKE 'T%'),
name VARCHAR(100)NOT NULL,
duration DECIMAL(5,1), /* in number of months*/
price DECIMAL(5,1),

PRIMARY KEY (treatmentID)

);

CREATE TABLE IF NOT EXISTS PATIENT
(
 patientID VARCHAR(5) NOT NULL, CHECK(patientID LIKE 'PAT%'),
 fname VARCHAR(20) NOT NULL, 
 lname VARCHAR(20) NOT NULL,
 yearOfBirth DATE, 
  sex CHAR(2) DEFAULT 'F', CHECK (sex IN ('M','F','m','f')),
 bloodType VARCHAR(3) NOT NULL DEFAULT 'A+', CHECK (bloodType IN ('A+','A-','B+','B-','AB+','AB-','O+','O-')),
conditions VARCHAR(200),
allergies VARCHAR(100),
healthHabits VARCHAR(100), 

 
 PRIMARY KEY (patientID)
);

CREATE TABLE IF NOT EXISTS  DOCTOR
(
 docID VARCHAR(100) NOT NULL, CHECK (docID LIKE 'D%'),
 fname VARCHAR(20) NOT NULL, 
 lname VARCHAR(20) NOT NULL,
 password VARCHAR(20)NOT NULL DEFAULT 'asd',
 yearOfBirth DATE, /* constraint to be added */
 sex CHAR(1) DEFAULT 'F', CHECK (sex IN ('M','F','m','f')),
 email VARCHAR(400), CHECK( email LIKE '%@hos.com'),
 address VARCHAR(200),
 level_doc VARCHAR(50) DEFAULT 'ASSISTANT', CHECK( level_doc IN ('HEAD','ASSISTANT')),
 doctor_rate INT, CHECK ( (doctor_rate > 1) AND (doctor_rate <1000)),
 area_of_expertise VARCHAR(10), 

 PRIMARY KEY (docID)
);

CREATE TABLE IF NOT EXISTS STORAGE
(
storageID VARCHAR(3) NOT NULL, CHECK(storageID LIKE 'S%'),
storageSpace DECIMAL(10,1),
nbOfItems INT,

PRIMARY KEY(storageID)
);

CREATE TABLE IF NOT EXISTS MEDICINE
(
medicineID VARCHAR(100) NOT NULL, CHECK (medicineID LIKE 'ME%'),
medicineName VARCHAR(20) NOT NULL,
quantity INT DEFAULT 10, CHECK (quantity <=1000),
expiryDate DATE, /*CHECK (expirayDate NOT <= CURRENT_DATE()),*/

storageID VARCHAR(3), 
CONSTRAINT fk_storage FOREIGN KEY (storageID) REFERENCES STORAGE(storageID),

PRIMARY KEY (medicineID)
);

CREATE TABLE IF NOT EXISTS ASSISTS
(
startDate DATE, 
endDate DATE, CHECK (endDate >= startDate),

docID VARCHAR(4) NOT NULL,
CONSTRAINT fk_doctor FOREIGN KEY (docID) REFERENCES DOCTOR(docID),

nurseID VARCHAR(3) NOT NULL,
CONSTRAINT fk_nurse FOREIGN KEY (nurseID) REFERENCES NURSE(nurseID),

PRIMARY KEY (docID, nurseID)

);

CREATE TABLE IF NOT EXISTS GIVES
(
quatityGiven INT,
timeGiven TIME,
dateGiven DATE,

medicineID VARCHAR(5),
 CONSTRAINT fk_medicine FOREIGN KEY (medicineID) REFERENCES MEDICINE(medicineID),
 
nurseID VARCHAR(3),
CONSTRAINT fk_nurse1 FOREIGN KEY (nurseID) REFERENCES NURSE(nurseID),

patientID VARCHAR(5),
CONSTRAINT fk_pateint FOREIGN KEY (patientID) REFERENCES PATIENT(patientID),

PRIMARY KEY(medicineID,nurseID,patientID,dateGiven)
);

CREATE TABLE IF NOT EXISTS EQUIPMENT
(
 equipmentID VARCHAR(100) NOT NULL, CHECK (equipmentID LIKE 'EQ%'),
 typeUsed VARCHAR(100),
 quantity INT,
 
 PRIMARY KEY(equipmentID)
);

CREATE TABLE IF NOT EXISTS MEDICALHISTORY
(
recordID VARCHAR(100) NOT NULL, CHECK (recordID LIKE 'RE%'),
previousTreatments VARCHAR(100), 
dateTaken DATE,

PRIMARY KEY (recordID,dateTaken),

patientID VARCHAR(5),
CONSTRAINT fk_pateint1 FOREIGN KEY (patientID) REFERENCES PATIENT(patientID)

); 

CREATE TABLE IF NOT EXISTS ROOM
(
roomID VARCHAR(100) NOT NULL, 
peopleAllowed INT, CHECK (peopleAllowed <=10),
specifiedFor VARCHAR(100),
nbOfBeds INT, CHECK(nbOfBeds <=4),
roomCost DECIMAL(6,2) DEFAULT 100.00,

PRIMARY KEY (roomID),

departmentID VARCHAR(100),
CONSTRAINT fk_dep FOREIGN KEY (departmentID) REFERENCES DEPARTMENT(departmentID)

);

CREATE TABLE IF NOT EXISTS BED
(
bedID VARCHAR(100) NOT NULL, 
status VARCHAR(1), CHECK (status IN ('E','F')),

PRIMARY KEY (bedID),

roomID VARCHAR(100),
CONSTRAINT fk_room FOREIGN KEY (roomID) REFERENCES ROOM(roomID)

);

CREATE TABLE IF NOT EXISTS CASHIER
(
 cashierID VARCHAR(100) NOT NULL, CHECK (cashierID LIKE 'CA%'),
 fname VARCHAR(20) NOT NULL, 
 lname VARCHAR(20) NOT NULL,
 password VARCHAR(20)NOT NULL DEFAULT 'asd',
 yearOfBirth DATE, /* constraint to be added */
 sex CHAR(1) DEFAULT 'F', CHECK (sex IN ('M','F','m','f')),
 email VARCHAR(400), CHECK( email LIKE '%@hos.com'),
 salary INT, CHECK( salary <= 1000000),
 address VARCHAR(200),
 
 PRIMARY KEY(cashierID)
);

CREATE TABLE IF NOT EXISTS PAYMENT
(
paymentID int NOT NULL AUTO_INCREMENT,
purpose VARCHAR(100),
total DECIMAL(5,2) ,
datePaid DATE,
processed VARCHAR(1), CHECK( processed IN ('Y','y','n','N')),

PRIMARY KEY (paymentID),

docID VARCHAR(100),
CONSTRAINT fk_doctor3 FOREIGN KEY (docID) REFERENCES DOCTOR(docID),
treatmentID VARCHAR(100),
CONSTRAINT fk_treatment2 FOREIGN KEY (treatmentID) REFERENCES TREATMENT(treatmentID)

);

CREATE TABLE IF NOT EXISTS PROVIDES
(
startDate DATE,
endDate DATE, CHECK (endDate >= startDate),

docID VARCHAR(100),
CONSTRAINT fk_doc1 FOREIGN KEY (docID) REFERENCES DOCTOR(docID),

treatmentID VARCHAR(100),
CONSTRAINT fk_treatment FOREIGN KEY (treatmentID) REFERENCES TREATMENT(treatmentID),

patientID VARCHAR(100),
CONSTRAINT fk_patient FOREIGN KEY (patientID) REFERENCES PATIENT(patientID),

PRIMARY KEY(docID,treatmentID,patientID,startDate)

);

CREATE TABLE IF NOT EXISTS REQUIRES
(
quantity INT,

treatmentID VARCHAR(100),
CONSTRAINT fk_treatment1 FOREIGN KEY (treatmentID) REFERENCES TREATMENT(treatmentID),

equipmentID VARCHAR(100),
CONSTRAINT fk_equipment FOREIGN KEY (equipmentID) REFERENCES EQUIPMENT(equipmentID),

PRIMARY KEY(treatmentID, equipmentID)
);

CREATE TABLE IF NOT EXISTS WORKSIN 
(
startDate DATE,
endDate DATE, CHECK (endDate >= startDate),

nurseID VARCHAR(100),
CONSTRAINT fk_nurse2 FOREIGN KEY (nurseID) REFERENCES NURSE(nurseID),

departmentID VARCHAR(100),
CONSTRAINT fk_dep1 FOREIGN KEY (departmentID) REFERENCES DEPARTMENT(departmentID),

PRIMARY KEY(nurseID, departmentID)
);

CREATE TABLE IF NOT EXISTS OCCUPIES 
(
startDate DATE,
endDate DATE, CHECK (endDate >= startDate),

patientID VARCHAR(100),
CONSTRAINT fk_pateint2 FOREIGN KEY (patientID) REFERENCES PATIENT(patientID),

bedID VARCHAR(100),
CONSTRAINT fk_bed FOREIGN KEY (bedID) REFERENCES BED(bedID),

PRIMARY KEY(patientID,bedID,startDate)
);

CREATE TABLE IF NOT EXISTS PAYS 
(

patientID VARCHAR(100),
CONSTRAINT fk_pateint3 FOREIGN KEY (patientID) REFERENCES PATIENT(patientID),

paymentID int NOT NULL AUTO_INCREMENT,
CONSTRAINT fk_payment FOREIGN KEY (paymentID) REFERENCES PAYMENT(paymentID),

cashierID VARCHAR(100),
CONSTRAINT fk_cashier FOREIGN KEY (cashierID) REFERENCES CASHIER(cashierID),

PRIMARY KEY(patientID,paymentID,cashierID)
);
