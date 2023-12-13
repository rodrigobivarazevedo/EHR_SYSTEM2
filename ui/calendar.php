<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .day {
            padding: 10px;
            border: 1px solid #ddd;
            cursor: pointer;
            font-size: 14px;
        }

        .available {
            background-color: lightgreen;
        }
    </style>
</head>
<body>

<div id="calendar" class="container mt-5"></div>

<script>
      
    var calendarData = <?php $result; ?>;

    <script src="/EHR_system/js/calendar.js"></script>
    
  
</script>

</body>
</html>


<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . "/EHR_system/db/database.php";
include_once $root . "/EHR_system/db/backend.php";

// Handle the incoming GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve data from the GET request
    $dbo = new Database();
    $pdo = new Appointmentsinfo();

    $speciality = $_GET['speciality'];
    $consultation_type = $_GET['consultation_type'];
    $clinic = $_GET['clinic'];

    // Fetch ClinicID from the database based on clinic name
    $statement = $dbo->conn->prepare("SELECT ClinicID FROM clinics WHERE Name = :clinic");
    $statement->bindParam(':clinic', $clinic, PDO::PARAM_STR);
            
    // Execute statement
    $statement->execute();

    // Fetch results
    $return = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$return) {
        // Clinic not found, handle appropriately (e.g., send an error response)
        echo json_encode(array('error' => 'Clinic not found'));
        exit();
    }

    $clinicID = $return['ClinicID'];

    // Perform database queries and get the result
    $result = $pdo->check_available_timeslots($dbo, $clinicID, $speciality);

    // Check if the result is an error
    if (isset($result["error"])) {
        // Handle the error, for example, send an appropriate response to the client
        echo json_encode($result);
    } else {
        // Handle the success, for example, send the result back to the client
        echo json_encode($result);
    }
    exit();
}

?>
