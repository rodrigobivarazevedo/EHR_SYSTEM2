<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

$action = $_POST["action"];

if ($action === "booking") {
    // Retrieve data from the POST request
    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    $speciality = $_POST['speciality'];
    $clinic = $_POST['clinic'];
    // Fetch ClinicID from the database based on clinic name
    $statement = $dbo->conn->prepare("SELECT ClinicID FROM clinics WHERE Name = :clinic");
    $statement->bindParam(':clinic', $clinic, PDO::PARAM_STR);
            
    // Execute statement
    $statement->execute();

    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$return) {
        // Clinic not found, handle appropriately (e.g., send an error response)
        echo json_encode(array('error' => 'Clinic not found'));
        exit();
    }

    $clinicID = $return['ClinicID'];

    // Perform database queries and get the result
    $result = $pdo->check_available_timeslots($dbo, $clinicID, $speciality, $DoctorID = "");

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        // Handle the success, for example, send the result back to the client
        echo ($result);
    }
    exit();
}

if ($action === "booking_doctor") {
    // Retrieve data from the POST request
    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    $speciality = $_POST['speciality'];
    $clinicName = $_POST['clinic'];
    $Doctor_Name = $_POST['Doctor_Name'];

    // Split the full name into an array using a space as the delimiter
    $nameParts = explode(' ', $Doctor_Name, 2);
    $names = explode(' ', $nameParts[1], 2);

    $FirstName = $nameParts[0] . ' ' . $names[0];
    $LastName = $names[1];

    // Fetch DoctorID from the database based on the first and last name
    $statement = $dbo->conn->prepare("SELECT DoctorID FROM doctors WHERE FirstName = :FirstName AND LastName = :LastName");
    $statement->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
    $statement->bindParam(':LastName', $LastName, PDO::PARAM_STR);

    // Execute statement
    $statement->execute();

    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$return) {
        // Doctor not found, handle appropriately (e.g., send an error response)
        echo json_encode(array('error' => 'Doctor not found'));
        exit();
    }

    $DoctorID = $return['DoctorID'];
    

    // Fetch ClinicID from the database based on clinic name
    $clinicStatement = $dbo->conn->prepare("SELECT ClinicID FROM clinics WHERE Name = :clinicName");
    $clinicStatement->bindParam(':clinicName', $clinicName, PDO::PARAM_STR);

    // Execute statement
    $clinicStatement->execute();

    // Fetch results
    $clinicReturn = $clinicStatement->fetch(PDO::FETCH_ASSOC);

    if (!$clinicReturn) {
        // Clinic not found, handle appropriately (e.g., send an error response)
        echo json_encode(array('error' => 'Clinic not found'));
        exit();
    }

    $clinicID = $clinicReturn['ClinicID'];
    // Perform database queries and get the result
    $result = $pdo->check_available_timeslots($dbo, $clinicID, $speciality, $DoctorID);
    
    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        // Handle the success, for example, send the result back to the client
        echo ($result);
    }
    exit();
}


?>