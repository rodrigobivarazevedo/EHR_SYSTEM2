<?php
session_start();

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

$action = $_POST["action"];

if ($action === "appointments") {
    $UserID = $_SESSION["UserID"];
    $dbo = new Database();
    $pdo = new Appointmentsinfo();
    $result = $pdo->get_appointments($dbo, $UserID);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}

if ($action === "medications") {
    $UserID = $_SESSION["UserID"];
    
    $dbo = new Database();
    $pdo = new History();

    $result = $pdo->medication($dbo, $UserID);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}

if ($action === "get_messages") {
    $UserID = $_SESSION["UserID"];
    
    $dbo = new Database();
    $pdo = new Messages();

    $result = $pdo->get_messages($dbo, $userID);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        echo $result;
    }
    exit();
}

if ($action === "send_messages") {
    $UserID = $_SESSION["UserID"];
    $doctors_name = $_SESSION["Doctor_name"];

    $dbo = new Database();
    $pdo = new Messages();

    $result = $pdo->send_message($dbo, $UserID, $receiverID, $content)

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