<?php

// Include your database connection and Patients class
require_once "database.php"; // Change this to your actual database file
require_once "backend.php";

// Create a new instance of the Database class
$dbo = new Database();

// Create a new instance of the Patients class
$patients = new Patients();

// Replace these values with actual data for testing
$doctorID = 1; // Replace with an existing doctor ID from your database
$parameter = 'contactNumber'; // Choose the search parameter ('name', 'contactNumber', or 'email')
$input = '96'; // Replace with the input data based on the chosen parameter

// Test the search_patients function
$result = $patients->search_patients($dbo, $doctorID, $parameter, $input);

// Display the result
echo $result;

?>