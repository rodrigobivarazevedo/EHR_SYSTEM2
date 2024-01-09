<?php
try {
    require_once "database.php";
    $dboject = new Database(); // creating a database instance to connect to the database

    // Get user input (replace these with your actual input methods)
    $username = 'David Johnson';
    $user_password = '123'; // Replace this with the actual user-inputted password
    $ContactNumber = "0545032212";
    // Hash the user-inputted password
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $email = 'davidjohnson@gmail.com';
    $role = 'doctor';

    // Use placeholders in the SQL query
    $cmd = "INSERT INTO Users (Username, Password, Email, Role, ContactNumber) VALUES (:username, :password, :email, :role, :ContactNumber)";
    $statement = $dboject->conn->prepare($cmd);

    // Bind parameters
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR); // Store the hashed password
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':role', $role, PDO::PARAM_STR);
    $statement->bindParam(':ContactNumber', $ContactNumber, PDO::PARAM_INT);

    // Execute statement
    $statement->execute();

    // Return success message or any other information
    echo json_encode(["message" => "User $username inserted successfully"]);
} catch (PDOException $e) {
    // Handle exceptions, log errors, or return an error message
    echo json_encode(["error" => "Error inserting user: " . $e->getMessage()]);
}
?>
