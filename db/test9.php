<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new History();


$UserID = 1;

// Call the method to post appointment information
$returned_value = $pdo->medication($dbo, $UserID);

echo $returned_value;
?>