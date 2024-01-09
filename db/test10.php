<?php

require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Messages();




// Assuming you have the sender ID, receiver ID, and message content
$senderID = 24; // replace with actual sender ID
$receiverID = 3; // replace with actual receiver ID
$content = "Hello, this is a test message."; // replace with actual message content


$response = $pdo->send_message($dbo, $senderID, $receiverID, $content);

// Handle the response as needed
echo $response;

?>