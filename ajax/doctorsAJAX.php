<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

$speciality = $_POST["speciality"];
$consultationType = $_POST["consultationType"];
$action = $_POST["action1"];

if ($action === "get_doctors") {
    $dbo = new Database();
    $pdo = new All_Info();

    $result = $pdo->get_all_info($dbo, "Doctors");

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
