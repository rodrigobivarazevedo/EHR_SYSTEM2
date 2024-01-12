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
    <link rel="stylesheet" href="../MyFastCARE_styles.css">
      
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
                <a href="doctor_portal.php" class="nav-link text-secondary">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg>
                    Dashboard
                </a>
                </li>
                <li>
                <a href="patients.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"></use></svg>
                    Patients 
                </a>
                </li>
                <li>
                <a href="health_records.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"></use></svg>
                    Health Records 
                </a>
                </li>
                <li>
                <a href="profile.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"></use></svg>
                    Profile 
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
        <div class="px-3 py-2 border-bottom mb-3">
            <div class="container d-flex flex-wrap justify-content-center">
                <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
                    <input type="search" class="form-control" placeholder="Search clinic..." aria-label="Search">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-light text-dark me-2" id="teleMedButton">Send Message</button>
                    <a href="health_records.php"><button type="button" class="btn btn-primary">View Health Record</button></a>
                </div>
            </div>

                
        </div>
            
    
            
        
        </div>
    </header>

    <main>


     <!-- Second Navbar for Tabs -->
     <ul class="nav nav-tabs mt-15" id="myTabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#appointmentsTab">Appointments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#patientsTab">Patients</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messagesTab">Messages</a>
        </li>
    </ul>




    <div class="container mt-3">
    <div class="tab-content">
        <!-- Appointments Tab Content -->
        <div id="appointmentsTab" class="tab-pane fade show active">
            <h2>Appointments</h2>
            <ul class="list-group">
                <!-- Data will be populated here dynamically -->
            </ul>
        </div>

        <!-- Documentation Tab Content -->
        <div id="patientsTab" class="tab-pane fade">
            <h2>Your Patients</h2>
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div id="calendar" class="container mt-5 mb-3"> </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="patients">
                        <!-- Cards will be updated dynamically  -->
                        
                        </div>
                    </div>
                </div>
        </div>

        <!-- Tests/Exams Tab Content -->
        <div id="messagesTab" class="tab-pane fade">
            <h2>Messages</h2>
            <ul class="list-group">
                <!-- Data will be populated here dynamically -->
            </ul>
        </div>
    </div>
</div>




         

  <!-- JavaScript links for bootstrap functions -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="/EHR_system/js/doctor_dashboard.js"></script>
  <script src="/EHR_system/global/jquery.js"></script>
  
</body>

</html>

