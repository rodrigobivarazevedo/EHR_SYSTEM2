<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to the login page
    header('Location: /EHR_SYSTEM/ui/MyFastCARE/login.php');
    exit(); // Make sure to stop execution after the redirect
}
?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>FastCARE</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
      
</head>
<body >   
    
    
    
    
    
    
    <header>
        <div class="px-3 py-2 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li>
                <a href="patient_portal.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg>
                    Home
                </a>
                </li>
                <li>
                <a href="medical_history.php" class="nav-link text-secondary">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"></use></svg>
                    Dashboard
                </a>
                </li>
                <li>
                <a href="MyFastCARE_booking.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"></use></svg>
                    Booking
                </a>
                </li>
                <li>
                <a href="account.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"></use></svg>
                    Account
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
        <div class="px-3 py-2 border-bottom mb-3">
        

            <div class="text-end">
            <a href="MyFastCARE_booking.php"><button type="button" class="btn btn-primary">Booking</button></a>
            </div>
        
        </div>
    </header>


     <!-- Second Navbar for Tabs -->
     <ul class="nav nav-tabs mt-3" id="myTabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#documentationTab">Documents</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#testsTab">Tests/Exams</a>
        </li>
    </ul>




<div class="container mt-3">
    <div class="tab-content">
        <!-- Documentation Tab Content -->
        <div id="documentationTab" class="tab-pane fade show active">
            <h2>Medical History</h2>
        </br>
            <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        <p>January 15, 2024</p>
                        <h6>document Title</h6>
                        <p>hospital name</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <p>February 5, 2024</p>
                        <h6>Document Title</h6>
                        <p>Hospital name</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <p>February 5, 2024</p>
                        <h6>Document Title</h6>
                        <p>Hospital name</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Tests/Exams Tab Content -->
        <div id="testsTab" class="tab-pane fade">
            <h2>Test/Exam Results</h2>
        </br>
            <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        <p>January 15, 2024</p>
                        <h6>Result Title</h6>
                        <p>Hospital name</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <p>February 5, 2024</p>
                        <h6>Exam Title</h6>
                        <p>Hospital name</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <div>
                        <p>February 5, 2024</p>
                        <h6>Exam Title</h6>
                        <p>Hospital name</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>


  <!-- JavaScript links for bootstrap functions -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  
</body>

</html>