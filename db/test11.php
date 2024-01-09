<?php

require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Messages();




// Assuming you have the sender ID, receiver ID, and message content
$userID = 3;


$response = $pdo->get_messages($dbo, $userID);

// Handle the response as needed
echo $response;

?>