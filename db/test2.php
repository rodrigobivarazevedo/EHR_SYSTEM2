<?php
require_once "database.php";
$dboject = new Database(); // creating a database instance to connect to the database

// execute SQL commands

// Use placeholders in the SQL query
$cmd = "SELECT * FROM appointmentsinfo WHERE consultation_type = :consultation_type";
$statement = $dboject->conn->prepare($cmd);

// Bind parameters
$consultation_type = 'Exam'; // Example value, replace with user input
$statement->bindParam(':consultation_type', $consultation_type, PDO::PARAM_STR);

// execute statement
$statement->execute();

$returned_value = $statement->fetchAll(PDO::FETCH_ASSOC); // retrieve all rows as an associative array

// display the content of the array
// print_r($returned_value);

// encode the array as JSON and echo it
echo json_encode($returned_value);
?>