<?php
require_once "database.php";
$pdo = new Database();
// Include your database connection code here

// Step 1: Hash the common password
$commonPassword = '123';
$hashedCommonPassword = password_hash($commonPassword, PASSWORD_DEFAULT);


$query = "UPDATE Users SET Password = :hashedCommonPassword";
$statement = $pdo->conn->prepare($query);
$statement->bindParam(':hashedCommonPassword', $hashedCommonPassword, PDO::PARAM_STR);
$result = $statement->execute();

if ($result) {
    echo 'Passwords updated successfully.';
} else {
    echo 'Error updating passwords.';
}


?>
