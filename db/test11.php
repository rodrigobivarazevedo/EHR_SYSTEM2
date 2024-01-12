<?php

require_once "database.php";
require_once "backend.php";

$dbo = new Database();
$pdo = new Messages();




// Assuming you have the sender ID, receiver ID, and message content
$userID = 19;


$response = $pdo->get_messages($dbo, $userID);

// Handle the response as needed
echo $response;

?>

$doctorSpecialityMap = [
    'Emily Turner' => 'Cardiology',
    'Benjamin Hayes' => 'Cardiology',
    'Sarah Mitchell' => 'Endocrinology',
    'Kevin Rodriguez' => 'Endocrinology',
    'Amanda Foster' => 'Rheumatology',
    'Robert Hughes' => 'Rheumatology',
    'Jessica Wong' => 'Nephrology',
    'Michael Patel' => 'Nephrology',
    'Laura Reynolds' => 'Gastroenterology',
    'Brian Lewis' => 'Gastroenterology',
    'Rachel Carter' => 'Dermatology',
    'Jonathan Kim' => 'Dermatology',
    'Melissa Thompson' => 'Rheumatology',
    'Christopher Harris' => 'Rheumatology',
    'Kimberly Davis' => 'Dentistry',
    'Jordan Carter' => 'Dentistry',
    'Alexandra Taylor' => 'Gynecology and Obstetrics',
    'Samuel Rodriguez' => 'Gynecology and Obstetrics',
    'Jennifer White' => 'Family Doctor',
    'David Johnson' => 'Family Doctor',
];