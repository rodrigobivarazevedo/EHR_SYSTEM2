<?php
try {
    require_once "database.php";
    $dboject = new Database(); // creating a database instance to connect to the database

    // Get user input (replace these with your actual input methods)
    $username = 'Kelly';
    $user_password = '123'; // Replace this with the actual user-inputted password

    // Hash the user-inputted password
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $email = 'kellykhalil048@gmail.com';
    $role = 'admin';

    // Use placeholders in the SQL query
    $cmd = "INSERT INTO Users (Username, Password, Email, Role) VALUES (:username, :password, :email, :role)";
    $statement = $dboject->conn->prepare($cmd);

    // Bind parameters
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR); // Store the hashed password
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':role', $role, PDO::PARAM_STR);

    // Execute statement
    $statement->execute();

    // Return success message or any other information
    echo json_encode(["message" => "User inserted successfully"]);
} catch (PDOException $e) {
    // Handle exceptions, log errors, or return an error message
    echo json_encode(["error" => "Error inserting user: " . $e->getMessage()]);
}
?>
