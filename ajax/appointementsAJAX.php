<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";


$action = $_POST["action"];


if ($action === "action1") {

    $speciality = $_POST["speciality"];
    $consultationType = $_POST["type_consultation"];
    $startTime = $_POST["startTime"];
    $date = $_POST["date"];
    $clinic = $_POST["clinic"];
    $UserID = $_POST["UserID"];

    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    // Fetch ClinicID from the database based on clinic name
    $statement = $dbo->conn->prepare("SELECT ClinicID FROM clinics WHERE Name = :clinic");
    $statement->bindParam(':clinic', $clinic, PDO::PARAM_STR);
    // Execute statement
    $statement->execute();
    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);
    
    $clinicID = $return['ClinicID'];

    // Fetch TimeSlotID and DoctorID from the timeslots table
    $statement = $dbo->conn->prepare("SELECT SlotID, DoctorID FROM timeslots WHERE 
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
    
    $DoctorID = $return["DoctorID"];
    $TimeSlotID = $return["SlotID"];

    // Check if TimeSlotID and DoctorID are fetched successfully
    if (!$DoctorID || !$TimeSlotID) {
        echo json_encode(["error" => "Invalid TimeSlot or Doctor information"]);
        exit();
    }

    $result = $pdo->post_appointment_info($dbo, $UserID, $DoctorID, $clinicID, $TimeSlotID, $consultationType, $speciality);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo ($result);
    }
    exit();
}

if ($action === "action2") {
    
    $DoctorID = $_POST["DoctorID"];
    $speciality = $_POST["speciality"];
    $consultationType = $_POST["type_consultation"];
    $startTime = $_POST["startTime"];
    $date = $_POST["date"];
    $clinic = $_POST["clinic"];
    $UserID = $_POST["UserID"];

    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    // Fetch ClinicID from the database based on clinic name
    $statement = $dbo->conn->prepare("SELECT ClinicID FROM clinics WHERE Name = :clinic");
    $statement->bindParam(':clinic', $clinic, PDO::PARAM_STR);
    // Execute statement
    $statement->execute();
    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);
    
    $clinicID = $return['ClinicID'];

    // Fetch TimeSlotID and DoctorID from the timeslots table
    $statement = $dbo->conn->prepare("SELECT SlotID FROM timeslots WHERE 
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
    
    $TimeSlotID = $return["SlotID"];

    // Check if TimeSlotID and DoctorID are fetched successfully
    if (!$TimeSlotID) {
        echo json_encode(["error" => "Invalid TimeSlot or Doctor information"]);
        exit();
    }

    $result = $pdo->post_appointment_info($dbo, $UserID, $DoctorID, $clinicID, $TimeSlotID, $consultationType, $speciality);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo ($result);
    }
    exit();

}

?>