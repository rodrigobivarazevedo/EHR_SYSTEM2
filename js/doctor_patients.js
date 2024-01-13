function updatePlaceholder() {
    const searchField = document.getElementById('searchField').value;
    const searchQueryInput = document.getElementById('searchQuery');

    // Update the placeholder based on the selected search field and gender
    switch (searchField) {
        case 'name':
            searchQueryInput.placeholder = `Enter Patient's first and last name`;
            break;
        case 'email':
            searchQueryInput.placeholder = `Enter Patient's email`;
            break;
        case 'contactNumber':
            searchQueryInput.placeholder = `Enter Patient's contact number`;
            break;
        // Add more cases as needed
        default:
            searchQueryInput.placeholder = 'Enter search query';
    }
}

function searchPatients(){
    const searchQueryInputValue = document.getElementById('searchQuery').value;
    const parameter = document.getElementById('searchField').value;
    get_patients(parameter, searchQueryInputValue);
}


function get_patients(parameter, searchQueryInputValue) {
    $.ajax({
        url: "/EHR_system/ajax/doctor_patientAJAX.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { parameter: parameter, searchQueryInputValue: searchQueryInputValue, action: "advanced_search_patients" },
        success: function(response) {
            updateCardUI(response)
            
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

function updateCardUI(data) {
    // Clear existing cards
    const content = document.getElementById('patients');
    content.innerHTML = '';
    // Create and append new cards based on the data from the backend
    data.forEach(patient => {
        const card = `
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">${patient.FirstName} ${patient.LastName}</h5>
                        <p class="card-text">ID: ${patient.PatientID}, Email: ${patient.Email}</p>
                        <p class="card-text">Contact Number:${patient.ContactNumber}</p>
                      
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="view-edit-btn">View/Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        const cardElement = document.createElement('div');
        cardElement.innerHTML = card;      
        content.appendChild(cardElement);
    });
}


function createPatient() {
    // Check if all required values are filled
    const firstName = document.getElementById('firstname').value;
    const lastName = document.getElementById('lastname').value;
    const email = document.getElementById('patientEmail').value;
    const birthdate = document.getElementById('patientBirthdate').value;
    const gender = document.getElementById('patientGender').value;

    if (!firstName || !lastName || !email || !birthdate || !gender) {
        // Display an alert if any required field is empty
        alert('Please fill in all required fields.');
        return;
    }

    // Show a confirmation alert
    const confirmResult = window.confirm('Are you sure you want to create this patient?');

    // Check if the user clicked "OK" in the confirmation alert
    if (confirmResult) {
        // Event listener for form submission
        document.getElementById('createPatientForm').addEventListener('submit', function (event) {
            event.preventDefault();
            // Implement your logic for creating a patient
            
            const address = document.getElementById('patientAddress').value;
            const contactNumber = document.getElementById('patientContactNumber').value;
            // Add more patient data properties as needed

            post_patient(firstName, lastName, email, birthdate, gender, address, contactNumber);
            console.log('Creating patient:', patientData);
            // You may submit the form via AJAX or perform other actions

            // Close the modal after submission
            $('#createPatientModal').modal('hide');
        });
    }
}


function deletePatient() {
    // Check if all required values are filled
    const patientID = document.getElementById('patientID').value;
    if (!patientID) {
        // Display an alert if any required field is empty
        alert('Please enter patient ID.');
        return;
    }

    $.ajax({
        url: "/EHR_system/ajax/doctor_patientAJAX.php",
        type: "POST",
        dataType: "json",
        data: { parameter: "PatientID", searchQueryInputValue: patientID, action: "advanced_search_patients" },
        success: function(response) {
            console.log(response)
            const FirstName = response[0].FirstName; 
            const LastName = response[0].LastName;
            confirmation(FirstName, LastName, patientID);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

function confirmation(firstName, lastName, patientID) {
    const confirmResult = window.confirm(`Are you sure you want to delete ${firstName} ${lastName}?`);

    if (confirmResult) {
        // Trigger the form submission
        delete_patient(patientID);
    }
}

// Event listener for form submission
document.getElementById('deletePatientForm').addEventListener('submit', function (event) {
    event.preventDefault();
    // Handle form submission if needed
});

function delete_patient(patientID) {
    $.ajax({
        url: "/EHR_system/ajax/doctor_patientAJAX.php",
        type: "POST",
        dataType: "json",
        data: { patientID: patientID, action: "delete_patient" },
        success: function(response) {
            if (response.success){
                alert(response.success);
                // Close the modal after submission
                $('#deleteModal').modal('hide');
            } else if (response.error){
                alert(response.error);
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert("AJAX request failed. Check the console for details.");
        }
    });
}




function post_patient(firstName, lastName, email, birthdate, gender, address, contactNumber) {
    $.ajax({
        url: "/EHR_system/ajax/doctor_patientAJAX.php",
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


function update_patient() {
    $.ajax({
        url: "/EHR_system/ajax/doctor_patientAJAX.php",
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



