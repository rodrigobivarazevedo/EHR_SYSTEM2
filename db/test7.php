<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Users();

$Username = "rodrigo";
$UsernameOrEmail = "rodrigobivarazevedo@gmail.com";


// Call the method to post appointment information
$returned_value = $pdo->check_user($dbo, $UsernameOrEmail);

echo $returned_value;
?>
