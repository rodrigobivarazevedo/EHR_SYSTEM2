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
                <a href="doctor_portal.php" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg>
                    Dashboard
                </a>
                </li>
                <li>
                <a href="patients.php" class="nav-link text-secondary">
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
            <input type="search" class="form-control" placeholder="Search by patient name..." aria-label="Search">
            </form>

            <div class="text-end">
                <button type="button" class="btn btn-light text-dark me-2" id="teleMedButton">Send Message</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal">Add New Patient</button>

            </div>

            
        </div>
        </div>
    </header>


    <main>

  <section class="py-5 text-center container">
    <div class="container mt-5">

        <h1>Search Patient</h1>

        <div class="findcaredropdowns">
            <div>
                <select id="consultationType" class="form-control-file dropdown_item">
                    <option disabled selected value="">Select Gender...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div>
                <select id="searchField" class="form-select" onchange="updatePlaceholder()">
                    <option disabled selected value="">Select More...</option>
                    <option value="firstName">First Name</option>
                    <option value="lastName">Last Name</option>
                    <option value="dob">Date of Birth</option>
                    <option value="contactNumber">Contact Number</option>
                    <!-- Add more options based on your needs -->
                </select>
            </div>

            <!-- Updated Input Group with Dynamic Placeholder -->
            <div class="input-group mt-3">
                <input type="text" class="form-control" id="searchQuery" placeholder="Search for a patient">
                <button class="btn btn-primary" type="button" onclick="searchPatients()">Search</button>
            </div>
                 
            <!-- Autocomplete Results Container -->
            <div id="autocompleteResults" class="mt-3"></div>
          

          
        </div>
      
      
            
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">
      <h2>Search Results</h2>
      <div id="calendar" class="container mt-5 mb-3"> </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="content">
        <!-- Cards will be updated dynamically  -->
        
      
      </div>
    </div>
  </div>


  <div id="timeslots" class="modal" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Available TimeSlots</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>Available TimeSlots:</p>
                  <!-- Timeslots will be dynamically added here by JavaScript -->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-secondary" id="bookAppointmentBtn">Book Appointment</button>
              </div>
          </div>
      </div>
  </div>



    <!-- Create Patient Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="messageModalLabel">Create a New Patient</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <!-- Patient Creation Form -->
            <form id="createPatientForm" class="mt-3">
                <div class="mb-3">
                    <label for="patientName" class="form-label">Patient Name:</label>
                    <input type="text" class="form-control" id="patientName" placeholder="Enter patient name" required>
                </div>
                <div class="mb-3">
                    <label for="patientEmail" class="form-label">Patient Email:</label>
                    <input type="email" class="form-control" id="patientEmail" placeholder="Enter patient email" required>
                </div>
                <div class="mb-3">
                    <label for="patientBirthdate" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="patientBirthdate" required>
                </div>
                <div class="mb-3">
                    <label for="patientGender" class="form-label">Gender:</label>
                    <select id="patientGender" class="form-select" required>
                        <option disabled selected value="">Select gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="patientAddress" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="patientAddress" placeholder="Enter patient address">
                </div>
                <div class="mb-3">
                    <label for="patientContactNumber" class="form-label">Contact Number:</label>
                    <input type="tel" class="form-control" id="patientContactNumber" placeholder="Enter contact number">
                </div>

    
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-secondary" onclick="createPatient()">Create Patient</button>
      </div>
    </div>
  </div>
</div>

<!-- FOOTER -->

<footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>© 2023 FastCARE, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
</footer>
</main>

<script>



</script>


<script src="/EHR_system/global/jquery.js"></script>
<script src="/EHR_system/js/doctor_portal.js"></script>


</body>

</html>
