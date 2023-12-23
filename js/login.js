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
    
    
    
    
    
    
    
    
    


