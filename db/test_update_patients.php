
<?php

// Include your database connection and Patients class
require_once "database.php"; // Change this to your actual database file
require_once "backend.php";

// Create a new instance of the Database class
$dbo = new Database();

// Create a new instance of the Patients class
$patients = new Patients();
$PatientID = $_POST["PatientID"];
    $FirstName = $_POST["firstName"];
    $LastName = $_POST["lastName"];
    $Email = $_POST["email"];
    $Birthdate = $_POST["birthdate"];
    $Gender = $_POST["gender"];
    $Address = $_POST["address"];
    $ContactNumber = $_POST["contactNumber"];
$patientID = 2; // Replace with an existing patient ID
$newData = [
    'FirstName' => 'Alexandra',
    'LastName' => 'Doe',
    'ContactNumber' => '1234567895',
    "Email" => "Alexandra.Doe@gmail.com"
];

$result = $patients->update_patient($dbo, $patientID, $newData);
echo "update_patient Test Result: " . $result . "\n";



?>