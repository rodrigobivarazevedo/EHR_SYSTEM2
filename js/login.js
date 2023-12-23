function login() {
    var UsernameOrEmail = document.getElementById("UsernameOrEmail").value;
    var password = document.getElementById("password").value;

    $.ajax({
        url: "/EHR_system/ajax/loginAJAX.php",
        type: "POST",
        dataType: "json", 
        data: { UsernameOrEmail: UsernameOrEmail, password: password, action: "login"},
        success: function(response) {
            // Check if the login was successful
            if ("user" in response) {
                // Redirect to patient_portal.php
                window.location.href = "patient_portal.php";
            } else {
                // Handle unsuccessful login (e.g., display an error message)
                console.log(response.error || response.message);
                alert("Login failed. Please check your credentials.");
            }
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
} 

    
function register() {
    // Prevent multiple submissions
    var submitButton = document.getElementById("registerButton");

    // Check if the button is already disabled
    if (submitButton.disabled) {
        return;
    }

    submitButton.disabled = true;

    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var contactNumber = document.getElementById("contactNumber").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    // Check if any of the required fields are empty
    if (!username || !email || !contactNumber || !password || !confirmPassword) {
        alert("All required fields must be provided.");
        submitButton.disabled = false;  // Re-enable the submit button
        return;
    }

    // Check if passwords match
    if (confirmPassword !== password) {
        alert("Passwords do not match. Please enter matching passwords.");
        submitButton.disabled = false;  // Re-enable the submit button
        return;
    }

    // Perform AJAX call for registration
    $.ajax({
        url: "/EHR_system/ajax/loginAJAX.php",  // Adjust the URL for registration
        type: "POST",
        dataType: "json",
        data: {
            username: username,
            email: email,
            contactNumber: contactNumber,
            password: password,
            action: "register"  // Adjust the action for registration
        },
        success: function (response) {
            // Check if the registration was successful
            if (response.message === "Registration successful") {
                // Redirect to a success page or handle as needed
                alert("Registration successful! You can now log in.");
                window.location.href = "login.php";  // Adjust the redirection URL
            } else {
                // Handle unsuccessful registration (e.g., display an error message)
                console.log(response.error || response.message);
                alert("Registration failed. Please check your information and try again.");
            }
        },
        error: function (xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);

            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        },
        complete: function () {
            // Re-enable the submit button after the AJAX request completes
            submitButton.disabled = false;
        }
    });
}



    
    
    
    
    
    
    


