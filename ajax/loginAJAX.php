<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";


$UsernameOrEmail = $_POST["UsernameOrEmail"];
$password = $_POST["password"];
$action = $_POST["action"];

if ($action === "login") {
    $dbo = new Database();
    $pdo = new Users();

    $result = $pdo->login($dbo, $UsernameOrEmail, $password);

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