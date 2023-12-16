<?php
require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Users();

$Username = "";
$UsernameOrEmail = "kellykhalil048@gmail.com";
$ContactNumber = "";
$Password = "$2y$10$4I9Aj29KJ4Bw5HlnDPWZwuqyrkl.lHpKKZb2qZdDs0p.FXkDRDrgC";

// Call the method to post appointment information
$returned_value = $pdo->login($dbo, $UsernameOrEmail, $Password);

echo $returned_value;
?>