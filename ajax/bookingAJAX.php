<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

$speciality = $_POST["speciality"];
$consultationType = $_POST["consultationType"];
$action = $_POST["action"];

if ($action === "get_all") {
    $dbo = new Database();
    $pdo = new All_Info();

    $result = $pdo->get_all_info($dbo, "appointmentsinfo");

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        
        echo $result;
    }
    exit();
}

if ($action === "get_appointmentsinfo") {
    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    $result = $pdo->get_appointment_info($dbo, $speciality, $consultationType);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        
        echo $result;
    }
    exit();
}
?>

