<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Appointmentsinfo();

// Bind parameters
$UserID = 1; // replace with the actual UserID
$DoctorID = 1; // replace with the actual DoctorID
$ClinicID = 1;
// Assign a test value to AppointmentDateTime
$AppointmentDateTime = "2023-12-22 14:30:00";
$TimeSlotID	= 1;
$ConsultationType = "Exam";
$Speciality = "Cardiology";

// Call the method to post appointment information
$returned_value = $pdo->post_appointment_info($dbo, $UserID, $DoctorID, $ClinicID, $TimeSlotID, $ConsultationType, $Speciality);

echo $returned_value;
?>
