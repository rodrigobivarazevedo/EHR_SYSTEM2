<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Appointmentsinfo();

$ClinicID = 1;

$speciality = "Cardiology";

// Call the method to post appointment information
$returned_value = $pdo->check_available_timeslots($dbo, $ClinicID, $speciality);

echo $returned_value;
?>
