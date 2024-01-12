function updatePlaceholder() {
    const searchField = document.getElementById('searchField').value;
    const genderField = document.getElementById('consultationType').value;
    const searchQueryInput = document.getElementById('searchQuery');

    // Update the placeholder based on the selected search field and gender
    switch (searchField) {
        case 'firstName':
            searchQueryInput.placeholder = `Enter ${genderField ? genderField + " Patient's " : ""}first name`;
            break;
        case 'lastName':
            searchQueryInput.placeholder = `Enter ${genderField ? genderField + " Patient's " : ""}last name`;
            break;
        case 'Email':
            searchQueryInput.placeholder = `Enter ${genderField ? genderField + " Patient's " : ""}email`;
            break;
        case 'contactNumber':
            searchQueryInput.placeholder = `Enter ${genderField ? genderField + " Patient's " : ""}contact number`;
            break;
        // Add more cases as needed
        default:
            searchQueryInput.placeholder = 'Enter search query';
    }
}




function createPatient() {
    // Show a confirmation alert
    const confirmResult = window.confirm('Are you sure you want to create this patient?');

    // Check if the user clicked "OK" in the confirmation alert
    if (confirmResult) {
        // Event listener for form submission
        document.getElementById('createPatientForm').addEventListener('submit', function (event) {
            event.preventDefault();
            // Implement your logic for creating a patient
            
            firstName = document.getElementById('firstname').value,
            lastName = document.getElementById('lastname').value,
            email = document.getElementById('patientEmail').value,
            birthdate = document.getElementById('patientBirthdate').value,
            gender = document.getElementById('patientGender').value,
            address = document.getElementById('patientAddress').value,
            contactNumber = document.getElementById('patientContactNumber').value,
            // Add more patient data properties as needed
            post_patient(firstName, lastName, email, birthdate, gender, address, contactNumber);
            console.log('Creating patient:', patientData);
            // You may submit the form via AJAX or perform other actions

            // Close the modal after submission
            $('#createPatientModal').modal('hide');
        });
    }
}



function post_patient(firstName, lastName, email, birthdate, gender, address, contactNumber) {
    $.ajax({
        url: "/EHR_system/ajax/doctor_portal_ajax.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { firstName: firstName, lastName: lastName, email: email, birthdate: birthdate, gender: gender, address: address, contactNumber: contactNumber, action: "create_patient" },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            alert(response);
            
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

function get_patient(firstName, lastName, email, birthdate, gender, address, contactNumber) {
    $.ajax({
        url: "/EHR_system/ajax/doctor_portal_ajax.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { firstName: firstName, lastName: lastName, email: email, birthdate: birthdate, gender: gender, address: address, contactNumber: contactNumber, action: "get_patient" },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            alert(response);
            
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

function update_patient() {
    $.ajax({
        url: "/EHR_system/ajax/doctor_portal_ajax.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { firstName: firstName, lastName: lastName, email: email, birthdate: birthdate, gender: gender, address: address, contactNumber: contactNumber, action: "create_patient" },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            alert(response);
            
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}


function delete_patient(firstName, lastName, email, birthdate, gender, address, contactNumber) {
    $.ajax({
        url: "/EHR_system/ajax/doctor_portal_ajax.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { firstName: firstName, lastName: lastName, email: email, birthdate: birthdate, gender: gender, address: address, contactNumber: contactNumber, action: "create_patient" },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            alert(response);
            
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

