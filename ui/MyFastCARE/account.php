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
                <a href="medical_history.php" class="nav-link text-white">
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
                <a href="account.php" class="nav-link text-secondary">
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
            <button type="button" class="btn btn-light text-dark me-2">Sign Out</button>
            <a href="MyFastCARE_booking.php"><button type="button" class="btn btn-primary">Booking</button></a>
            </div>
        </div>
    </header>


    <div class="container mt-3">
        <h2>Account Details</h2>
    </br>
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="accountTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#personalDataTab">Personal Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#insuranceTab">Insurance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#walletTab">Wallet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#securityTab">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#dataProtectionTab">Data Protection</a>
            </li>
        </ul>
        
        <div class="tab-content">
            <!-- Personal Data Tab Content -->
            <div id="personalDataTab" class="tab-pane fade show active mt-3">
            
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber" placeholder="Phone Number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address">
                        </div>
                    </div>
                
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="postalCode">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" placeholder="Postal Code">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" placeholder="City">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="socialSecurityNumber">Social Security Number</label>
                        <input type="text" class="form-control" id="socialSecurityNumber" placeholder="Social Security Number">
                    </div>
                </form>
                
            </div>
            
            
            <!-- Insurance Tab Content -->
            <div id="insuranceTab" class="tab-pane fade mt-3">
                
                <div class="insurance-info">
                    <h2>Insurance Information</h2>
                    <p>Your insurance details:</p>
                    <ul>
                        <li>Insurance provider: [Provider Name]</li>
                        <li>Policy number: [Policy Number]</li>
                        <li>Contact: [Contact Info]</li>
                    </ul>
                </div>
            

                <form>
                    <div class="form-group">
                        <label for="insuranceProvider">Insurance Provider</label>
                        <input type="text" class="form-control" id="insuranceProvider" placeholder="Insurance Provider">
                    </div>
                    <div class="form-group">
                        <label for="policyNumber">Policy Number</label>
                        <input type="text" class="form-control" id="policyNumber" placeholder="Policy Number">
                    </div>
                    <div class="form-group">
                        <label for="insuranceContact">Contact</label>
                        <input type="text" class="form-control" id="insuranceContact" placeholder="Insurance Contact Info">
                    </div>
                </form>
            </div>

            <!-- Wallet Tab Content -->
            <div id="walletTab" class="tab-pane fade mt-3">
            
                <form>
                    <div class="form-group">
                        <label for="insuranceProvider">Card</label>
                        <input type="text" class="form-control" id="insuranceProvider" placeholder="Insurance Provider">
                    </div>
                    <div class="form-group">
                        <label for="policyNumber">Payment Method</label>
                        <input type="text" class="form-control" id="policyNumber" placeholder="Policy Number">
                    </div>
                </form>
            
            </div>
            
            <!-- Security Tab Content -->
            <div id="securityTab" class="tab-pane fade mt-3">
            
                <form>
                    <div class="form-group">
                        <label for="change-password">Change Password</label>
                        <input type="text" class="form-control" id="change-password" placeholder="Change Password">
                    </div>
                    <div class="form-group">
                        <label for="policyNumber">Policy Number</label>
                        <input type="text" class="form-control" id="policyNumber" placeholder="Policy Number">
                    </div>
                    <div class="form-group">
                        <label for="insuranceContact">Contact</label>
                        <input type="text" class="form-control" id="insuranceContact" placeholder="Insurance Contact Info">
                    </div>
                </form>
            
            </div>
            
            <!-- Data Protection Tab Content -->
            <div id="dataProtectionTab" class="tab-pane fade mt-3">
                <form>
                    <!-- Data protection fields here -->
                </form>
            
                <p>Privacy policy: [Privacy policy link]</p>
                <p>Preferences: [Preferences information]</p>
            </div>
        </div>
    </div>

    
    

    



  <!-- JavaScript links for bootstrap functions -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  
</body>

</html>