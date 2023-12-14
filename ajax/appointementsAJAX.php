<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

$speciality = $_POST["speciality"];
$consultationType = $_POST["type_consultation"];
$action = $_POST["action"];
$startTime = $_POST["startTime"];
$date = $_POST["date"];
$clinic = $_POST["clinic"];

if ($action === "action1") {
    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    // Fetch ClinicID from the database based on clinic name
    $statement = $dbo->conn->prepare("SELECT ClinicID FROM clinics WHERE Name = :clinic");
    $statement->bindParam(':clinic', $clinic, PDO::PARAM_STR);
    // Execute statement
    $statement->execute();
    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);
    echo ($return)
    $clinicID = $return['ClinicID'];

    // Fetch TimeSlotID and DoctorID from the timeslots table
    $statement = $dbo->conn->prepare("SELECT TimeSlotID, DoctorID FROM timeslots WHERE 
        startTime = :startTime AND
        clinicID = :clinicID AND
        Date = :date AND
        speciality = :speciality");

    $statement->bindParam(':startTime', $startTime, PDO::PARAM_STR);
    $statement->bindParam(':clinicID', $clinicID, PDO::PARAM_INT);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);

    // Execute statement
    $statement->execute();

    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);
    echo ($return)
    $DoctorID = $return["DoctorID"];
    $TimeSlotID = $return["TimeSlotID"];

    // Check if TimeSlotID and DoctorID are fetched successfully
    if (!$DoctorID || !$TimeSlotID) {
        echo json_encode(["error" => "Invalid TimeSlot or Doctor information"]);
        exit();
    }

    $result = $pdo->post_appointment_info($dbo, $UserID = "", $DoctorID, $ClinicID, $TimeSlotID, $ConsultationType, $Speciality);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo "Appointment Created";
    }
    exit();
}
