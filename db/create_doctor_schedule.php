<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$doctorScheduler = new DoctorScheduler($dbo);

// Replace with the actual DoctorID, ClinicID, start date, end date, working days, start time, and end time
$DoctorID = 15;
$ClinicID = 7;
$startDate = new DateTime('2024-01-01');
$endDate = new DateTime('2024-01-30');
$workingDays = [2, 4]; // 1 (Monday)  3 (Wednesday) 5 (Friday)
$startTime = new DateTime('09:00:00');
$endTime = new DateTime('13:00:00');
$speciality = "Gynecology and Obstetrics";

$returned_value = $doctorScheduler->createDoctorSchedule($dbo,$DoctorID, $ClinicID, $startDate, $endDate, $workingDays, $startTime, $endTime, $speciality);
echo $returned_value;
?>
