<?php
require_once "database.php";
$dboject = new Database(); // creating a database instance to connect to the database

// Execute SQL commands

// Use placeholders in the SQL query
$cmd = "SELECT * FROM appointmentsinfo WHERE speciality = :speciality AND consultation_type = :consultation_type";
$statement = $dboject->conn->prepare($cmd);

// Bind parameters
$speciality = 'Cardiology'; // Example value, replace with user input
$consultation_type = 'Exam'; // Example value, replace with user input

$statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
$statement->bindParam(':consultation_type', $consultation_type, PDO::PARAM_STR);

// Execute statement
$statement->execute();

// Fetch results
$returned_value = $statement->fetchAll(PDO::FETCH_ASSOC);

// Display the content of the array
// print_r($returned_value);

// Encode the array as JSON and echo it
echo json_encode($returned_value);
?>

