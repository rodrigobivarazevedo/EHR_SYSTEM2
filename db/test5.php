<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$doctorScheduler = new DoctorScheduler($dbo);

// Replace with the actual DoctorID, ClinicID, start date, end date, working days, start time, and end time
$DoctorID = 1;
$ClinicID = 1;
$startDate = new DateTime('2024-01-01');
$endDate = new DateTime('2024-01-30');
$workingDays = [1, 3, 5]; // 1 (Monday)  3 (Wednesday) 5 (Friday)
$startTime = new DateTime('09:00:00');
$endTime = new DateTime('17:00:00');

$returned_value = $doctorScheduler->createDoctorSchedule($dbo,$DoctorID, $ClinicID, $startDate, $endDate, $workingDays, $startTime, $endTime);
echo $returned_value;
?>
