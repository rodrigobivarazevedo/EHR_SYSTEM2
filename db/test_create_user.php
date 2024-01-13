<?php
try {
    require_once "database.php";
    require_once "backend.php";

  
    $dbo = new Database();
    $pdo = new Users();

    // Validate and sanitize inputs
    $username = 'Alexandre Maria';
    $password = '123';
    $email = 'alexandre.maria@gmail.com';
    $contactNumber = "931213431";

    $FirstName = 'Alexandre';
    $LastName = 'Maria';
    $gender = 'Male';
    $birthdate = "1999-12-04";


    $result = $pdo->create_user($dbo, $username, $password, $email, $contactNumber, $FirstName, $LastName, $gender, $birthdate);


    // Return success message or any other information
    echo json_encode(["message" => "$result"]);
} catch (PDOException $e) {
    // Handle exceptions, log errors, or return an error message
    echo json_encode(["error" => "Error inserting user: " . $e->getMessage()]);
}
?>