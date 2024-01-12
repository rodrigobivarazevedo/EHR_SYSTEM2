<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to the login page
    header('Location: /EHR_SYSTEM/ui/MyFastCARE/login.php');
    exit(); // Make sure to stop execution after the redirect
} else {
    $user_role = $_SESSION['Role']; // Corrected variable name

    // Redirect based on the user's role
    switch ($user_role) {
        case 'doctor':
            header('Location: /EHR_SYSTEM/ui/MyFastCARE/Doctors/doctor_portal.php'); // Redirect doctors to the doctor's dashboard
            exit();
        case 'user':
            header('Location: /EHR_SYSTEM/ui/MyFastCARE/patient_portal.php'); // Redirect regular users to the user's dashboard
            exit();
        default:
            // Handle other roles or unexpected cases
            header('Location: /EHR_SYSTEM/ui/MyFastCARE/login.php');
            exit();
    }
}
?>




