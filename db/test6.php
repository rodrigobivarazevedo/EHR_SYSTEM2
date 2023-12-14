<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Doctorsinfo();

$ClinicID = 1;
$DoctorID = 3;
$speciality = "Endocrinology";

// Call the method to post appointment information
$returned_value = $pdo->check_available_timeslots($dbo, $DoctorID, $ClinicID, $speciality);

echo $returned_value;
?>
