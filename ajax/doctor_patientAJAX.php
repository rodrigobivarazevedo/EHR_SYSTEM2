<?php
session_start();

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

$action = $_POST["action"];

if ($action === "create_patient") {
    $UserID = $_SESSION["UserID"];
    $dbo = new Database();
    $patients = new Patients();

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $contactNumber = $_POST["contactNumber"];

    $statement = $dbo->conn->prepare(
        "SELECT DoctorID FROM doctors WHERE UserID = :UserID"
    );
    $statement->bindParam(':UserID', $UserID, PDO::PARAM_INT);
 
    $statement->execute();
    
    $Doctor = $statement->fetch(PDO::FETCH_ASSOC);
    $doctorID = $Doctor["DoctorID"];
    
    if (!$doctorID) {
        echo json_encode(["error" => "DoctorID not found"]);
        exit(); // Terminate script execution after sending the response
    }


    
    $result = $patients->post_patient($dbo, $doctorID, $firstName, $lastName, $email, $birthdate, $gender, $address, $contactNumber);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}


if ($action === "update_patient") {
    $UserID = $_SESSION["UserID"];
    
    $dbo = new Database();
    $patients = new Patients();
    $newData = $_POST["newData"];

    $patientID = 2; // Replace with an existing patient ID
    $newData = [
        'FirstName' => 'Alexandra',
        'LastName' => 'Doe',
        'ContactNumber' => '1234567895',
        "Email" => "Alexandra.Doe@gmail.com"
    ];

    $result = $patients->update_patient($dbo, $patientID, $newData);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}

if ($action === "delete_patient") {
    $UserID = $_SESSION["UserID"];
    
    $dbo = new Database();
    $patients = new Patients();

    $patientID = $_POST["patientID"];

    $statement = $dbo->conn->prepare(
        "SELECT DoctorID FROM doctors WHERE UserID = :UserID"
    );
    $statement->bindParam(':UserID', $UserID, PDO::PARAM_INT);
    $statement->execute();
    
    $Doctor = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$Doctor) {
        echo json_encode(["error" => "Doctor not found"]);
        exit(); // Terminate script execution after sending the response
    }


    // Test post_patient function
    $doctorID = $Doctor["DoctorID"];

    $result = $patients->delete_patient($dbo, $patientID, $doctorID);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}



if ($action === "search_patients") {
    $UserID = $_SESSION["UserID"];
    $parameter = $_POST["parameter"];
    $input = $_POST["searchQueryInputValue"];

    $dbo = new Database();
    $patients = new Patients();

    $statement = $dbo->conn->prepare(
        "SELECT DoctorID FROM doctors WHERE UserID = :UserID"
    );
    $statement->bindParam(':UserID', $UserID, PDO::PARAM_INT);
    $statement->execute();

    $Doctor = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$Doctor) {
        echo json_encode(["error" => "Doctor not found"]);
        exit(); // Terminate script execution after sending the response
    }

    // Test get_patients function
    $doctorID = $Doctor["DoctorID"];

    $result = $patients->search_patients($dbo, $doctorID, $parameter, $input);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}



?>