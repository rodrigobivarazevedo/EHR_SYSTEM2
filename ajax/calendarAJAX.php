<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

// Handle the incoming GET request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    $speciality = $_POST['speciality'];
    $consultation_type = $_POST['consultation_type'];
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
    $result = $pdo->check_available_timeslots($dbo, $clinicID, $speciality);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        // Handle the success, for example, send the result back to the client
        echo json_encode($result);
    }
    exit();
}

?>