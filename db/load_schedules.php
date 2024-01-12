<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$doctorScheduler = new DoctorScheduler($dbo);

// Data for doctors' schedules
$doctorsSchedules = [
    // Passau Clinic
    ['DoctorID' => 1, 'ClinicID' => 1, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('13:00:00'), 'speciality' => "Cardiology"],
    ['DoctorID' => 3, 'ClinicID' => 1, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('13:00:00'), 'speciality' => "Endocrinology"],
    ['DoctorID' => 9, 'ClinicID' => 1, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Nephrology"],
    ['DoctorID' => 11, 'ClinicID' => 1, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Gastroenterology"],

    // Rottal-In Clinic
    ['DoctorID' => 2, 'ClinicID' => 2, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('12:00:00'), 'speciality' => "Cardiology"],
    ['DoctorID' => 4, 'ClinicID' => 2, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('11:00:00'), 'endTime' => new DateTime('14:00:00'), 'speciality' => "Endocrinology"],
    ['DoctorID' => 10, 'ClinicID' => 2, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Nephrology"],
    ['DoctorID' => 13, 'ClinicID' => 2, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Dermatology"],

    // Eggenfelden Clinic
    ['DoctorID' => 17, 'ClinicID' => 3, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('16:00:00'), 'speciality' => "Gynecology and Obstetrics"],
    ['DoctorID' => 16, 'ClinicID' => 3, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('13:00:00'), 'speciality' => "Dentistry"],

    // Munich Clinic
    ['DoctorID' => 5, 'ClinicID' => 4, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('13:00:00'), 'speciality' => "Rheumatology"],
    ['DoctorID' => 6, 'ClinicID' => 4, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Rheumatology"],
    ['DoctorID' => 15, 'ClinicID' => 4, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('14:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Dentistry"],

    // Muhldorf Clinic
    ['DoctorID' => 8, 'ClinicID' => 5, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('15:00:00'), 'speciality' => "Rheumatology"],
    ['DoctorID' => 14, 'ClinicID' => 5, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Dermatology"],
    ['DoctorID' => 20, 'ClinicID' => 5, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('12:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Family Doctor"],

    // Borghassen Clinic
    ['DoctorID' => 14, 'ClinicID' => 6, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('15:00:00'), 'speciality' => "Dermatology"],
    ['DoctorID' => 7, 'ClinicID' => 6, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('14:00:00'), 'speciality' => "Rheumatology"],
    ['DoctorID' => 12, 'ClinicID' => 6, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('12:00:00'), 'speciality' => "Gastroenterology"],

    // Pocking Clinic
    ['DoctorID' => 7, 'ClinicID' => 7, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('14:00:00'), 'speciality' => "Rheumatology"],
    ['DoctorID' => 16, 'ClinicID' => 7, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('12:00:00'), 'speciality' => "Dentistry"],
    ['DoctorID' => 20, 'ClinicID' => 7, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('15:00:00'), 'speciality' => "Family Doctor"],

    // Augsburg Clinic
    ['DoctorID' => 19, 'ClinicID' => 8, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('13:00:00'), 'speciality' => "Family Doctor"],
    ['DoctorID' => 8, 'ClinicID' => 8, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('13:00:00'), 'speciality' => "Rheumatology"],
    
    // Bayreuth Clinic
    ['DoctorID' => 18, 'ClinicID' => 9, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('13:00:00'), 'endTime' => new DateTime('17:00:00'), 'speciality' => "Gynecology and Obstetrics"],
    ['DoctorID' => 12, 'ClinicID' => 9, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [2, 4], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('14:00:00'), 'speciality' => "Gastroenterology"],
    ['DoctorID' => 17, 'ClinicID' => 9, 'startDate' => new DateTime('2024-01-01'), 'endDate' => new DateTime('2024-01-30'), 'workingDays' => [1, 3, 5], 'startTime' => new DateTime('09:00:00'), 'endTime' => new DateTime('14:00:00'), 'speciality' => "Gynecology and Obstetrics"],
];


foreach ($doctorsSchedules as $schedule) {
    $DoctorID = $schedule['DoctorID'];
    $ClinicID = $schedule['ClinicID'];
    $startDate = $schedule['startDate'];
    $endDate = $schedule['endDate'];
    $workingDays = $schedule['workingDays'];
    $startTime = $schedule['startTime'];
    $endTime = $schedule['endTime'];
    $speciality = $schedule['speciality'];

    $returned_value = $doctorScheduler->createDoctorSchedule($dbo, $DoctorID, $ClinicID, $startDate, $endDate, $workingDays, $startTime, $endTime, $speciality);
    echo $returned_value;
}


?>
