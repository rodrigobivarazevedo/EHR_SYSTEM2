<?php

// Include your database connection and Patients class
require_once "database.php"; // Change this to your actual database file
require_once "backend.php";

// Create a new instance of the Database class
$dbo = new Database();

// Create a new instance of the Patients class
$patients = new Patients();

// Test post_patient function
$doctorID = 1; // Replace with an existing doctor ID from your database


$result = $patients->get_patients($dbo, $doctorID);

echo "get_patients Test Result: " . $result . "\n";


?>