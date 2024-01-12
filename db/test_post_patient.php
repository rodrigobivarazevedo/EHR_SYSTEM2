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
$firstName = "Kelly";
$lastName = "Khalil";
$email = "kellykhalil@example.com";
$birthdate = "1999-11-23";
$gender = "Female";
$address = "123 Main St";
$contactNumber = "961929298";

$result = $patients->post_patient($dbo, $doctorID, $firstName, $lastName, $email, $birthdate, $gender, $address, $contactNumber);

echo "post_patient Test Result: " . $result . "\n";


