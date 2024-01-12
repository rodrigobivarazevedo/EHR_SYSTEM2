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
    $doctorID = $DoctorID["DoctorID"]
    
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
    $pdo = new History();

    $result = $pdo->medication($dbo, $UserID);

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
    $pdo = new Messages();

    $result = $pdo->get_messages($dbo, $UserID);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}

if ($action === "get_patients") {
    $UserID = $_SESSION["UserID"];
    $doctors_name = $_POST["Doctor_name"];
    $content = $_POST["content"];

    $dbo = new Database();
    $pdo = new Messages();

    
    $nameArray = explode(' ', $doctors_name);

    // Check if the array has at least two elements
    if (count($nameArray) >= 2) {
        // Now $nameArray will contain two elements, the first and last name
        $FirstName = $nameArray[0];
        $LastName = $nameArray[1];

        // Rest of your code here
    } else {
        // Handle the case where the name is not in the expected format
        echo json_encode(["error" => "Invalid name format"]);
        exit(); // Terminate script execution after sending the response
    }

    $statement = $dbo->conn->prepare(
        "SELECT UserID FROM doctors WHERE FirstName = :FirstName AND LastName = :LastName"
    );
    $statement->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
    $statement->bindParam(':LastName', $LastName, PDO::PARAM_STR);
    $statement->execute();
    
    $Doctor_User_ID = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$Doctor_User_ID) {
        echo json_encode(["error" => "Doctor not found"]);
        exit(); // Terminate script execution after sending the response
    }

    
    $result = $pdo->send_message($dbo, $UserID, $Doctor_User_ID["UserID"], $content);

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