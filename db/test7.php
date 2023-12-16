<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Users();

$Username = "rodrigo";
$Email = "rodrigobivarazevedo@gmail.com";
$ContactNumber = "";
$Password = "";

// Call the method to post appointment information
$returned_value = $pdo->check_user($dbo, $Username, $Password, $Email, $ContactNumber);

echo $returned_value;
?>
