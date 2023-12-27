<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Appointmentsinfo();


$UserID = 1;

// Call the method to post appointment information
$returned_value = $pdo->get_next_appointments($dbo, $UserID);

echo $returned_value;
?>