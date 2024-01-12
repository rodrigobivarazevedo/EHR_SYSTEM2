
<?php

// Include your database connection and Patients class
require_once "database.php"; // Change this to your actual database file
require_once "backend.php";

// Create a new instance of the Database class
$dbo = new Database();

// Create a new instance of the Patients class
$patients = new Patients();

$patientID = 2; // Replace with an existing patient ID
$DoctorID = 1;

$result = $patients->delete_patient($dbo, $patientID, $DoctorID);
echo "update_patient Test Result: " . $result . "\n";



?>