<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Users();

$Username = "";
$UsernameOrEmail = "rodrigo";
$ContactNumber = "";
$Password = "123";

// Call the method to post appointment information
$returned_value = $pdo->login($dbo, $UsernameOrEmail, $Password);

echo $returned_value;
?>