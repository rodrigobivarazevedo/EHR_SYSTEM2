CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    ContactNumber VARCHAR(20) NOT NULL UNIQUE,
    Role VARCHAR(50) NOT NULL DEFAULT 'user' -- Default role is set to 'user'
);


-- Doctors table
CREATE TABLE Doctors (
    DoctorID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Speciality VARCHAR(255) NOT NULL,
    ContactNumber VARCHAR(20),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE Languages (
    LanguageID INT PRIMARY KEY AUTO_INCREMENT,
    LanguageName VARCHAR(50) NOT NULL
);

-- Create a new table for the many-to-many relationship
CREATE TABLE DoctorLanguages (
    DoctorID INT,
    LanguageID INT,
    PRIMARY KEY (DoctorID, LanguageID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID),
    FOREIGN KEY (LanguageID) REFERENCES Languages(LanguageID)
);


-- Appointments table
CREATE TABLE Appointments (
    AppointmentID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    DoctorID INT,
    ClinicID INT,
    TimeSlotID INT, -- New column referencing SlotID in TimeSlots table
    AppointmentDateTime DATETIME,
    ConsultationType VARCHAR(255), -- Assuming consultation type is a string
    Speciality VARCHAR(255),
    Status VARCHAR(20) DEFAULT 'Scheduled', -- Default status is set to 'Scheduled'
    -- Add other appointment-related information as needed
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID),
    FOREIGN KEY (ClinicID) REFERENCES Clinics(ClinicID),
    FOREIGN KEY (TimeSlotID) REFERENCES TimeSlots(SlotID) -- Reference TimeSlotID to SlotID in TimeSlots table
);

CREATE TABLE TimeSlots (
    SlotID INT PRIMARY KEY AUTO_INCREMENT,
    DoctorID INT,
    ClinicID INT,
    Date DATE,
    StartTime TIME,
    EndTime TIME,
    AvailabilityStatus VARCHAR(20),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID),
    FOREIGN KEY (ClinicID) REFERENCES Clinics(ClinicID)
);



-- Clinics table
CREATE TABLE Clinics (
    ClinicID INT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Location VARCHAR(255) NOT NULL
);

CREATE TABLE ClinicSpecialities (
    ClinicID INT,
    SpecialityID INT,
    PRIMARY KEY (ClinicID, SpecialityID),
    FOREIGN KEY (ClinicID) REFERENCES Clinics(ClinicID),
    FOREIGN KEY (SpecialityID) REFERENCES Specialities(SpecialityID)
);

CREATE TABLE Specialities (
    SpecialityID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL
);


-- Create a new table for the many-to-many relationship between doctors and clinics
CREATE TABLE DoctorClinic (
    DoctorID INT,
    ClinicID INT,
    PRIMARY KEY (DoctorID, ClinicID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID),
    FOREIGN KEY (ClinicID) REFERENCES Clinics(ClinicID)
);


CREATE TABLE MedicationPrescriptions (
    PrescriptionID INT AUTO_INCREMENT PRIMARY KEY,
    PatientID INT,
    UserID,
    DoctorID INT,
    MedicationName VARCHAR(255),
    Dosage VARCHAR(50),
    Frequency VARCHAR(50),
    PrescriptionDate DATE,
    Instructions TEXT,
    Duration INT,
    FOREIGN KEY (UserID) REFERENCES users(UserID),
    FOREIGN KEY (PatientID) REFERENCES patients(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID)
);


CREATE TABLE Messages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    SenderID INT,
    ReceiverID INT,
    Content TEXT,
    Timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    IsRead BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (SenderID) REFERENCES Users(UserID),
    FOREIGN KEY (ReceiverID) REFERENCES Users(UserID)
);




-- Patients table
CREATE TABLE patients (
    PatientID INT PRIMARY KEY AUTO_INCREMENT,
    DoctorID INT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Birthdate DATE NOT NULL,
    Gender ENUM('Male', 'Female', 'Other') NOT NULL,
    Address VARCHAR(255),
    ContactNumber VARCHAR(20),
    PRIMARY KEY (PatientID, DoctorID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID)
    -- Add other relevant patient information
);

-- Health Records table
CREATE TABLE HealthRecords (
    RecordID INT PRIMARY KEY AUTO_INCREMENT,
    PatientID INT,
    DoctorID INT,
    DateRecorded DATE NOT NULL,
    Diagnosis TEXT,
    Medications TEXT,
    Procedures TEXT,
    Comments TEXT,
    PRIMARY KEY (RecordID, PatientID, DoctorID),
    FOREIGN KEY (PatientID, DoctorID) REFERENCES Patients(PatientID, DoctorID)
    -- Add other relevant health record information
);
