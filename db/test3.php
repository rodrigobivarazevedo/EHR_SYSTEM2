<?php
require_once "database.php";
require_once "backend.php";

$dbo=new Database();
$pdo=new Appointmentsinfo();
//$pdo=new Doctorsinfo();
//$pdo=new Clinicsinfo();
// Bind parameters
$speciality = 'Gastroenterologist'; // Example value, replace with user input
$consultation_type = 'Exam'; // Example value, replace with user input
$clinic = null;

//$returned_value=$pdo->get_appointment_info($dbo, $speciality, $consultation_type);

//$returned_value=$pdo->get_doctors_info($dbo, $speciality, $clinic);
$returned_value=$pdo->get_appointment_info($dbo, $speciality, $consultation_type);
echo($returned_value);
?>