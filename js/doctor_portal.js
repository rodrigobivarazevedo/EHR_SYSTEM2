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
        case 'dob':
            searchQueryInput.placeholder = `Enter ${genderField ? genderField + " Patient's " : ""}date of birth`;
            break;
        case 'contactNumber':
            searchQueryInput.placeholder = `Enter ${genderField ? genderField + " Patient's " : ""}contact number`;
            break;
        // Add more cases as needed
        default:
            searchQueryInput.placeholder = 'Enter search query';
    }
}



// Sample data (replace this with actual patient data)
const patients = [
    { id: 1, firstName: 'John', lastName: 'Doe', email: 'john.doe@example.com' },
    { id: 2, firstName: 'Jane', lastName: 'Smith', email: 'jane.smith@example.com' },
    { id: 3, firstName: 'Rodrigo', lastName: 'Azevedo', email: 'jane.smith@example.com' },
    // Add more patient data
];

// Event listener for input changes
document.getElementById('searchQuery').addEventListener('input', handleInput);

// Handle input changes
function handleInput() {
    const searchQuery = document.getElementById('searchQuery').value.toLowerCase();
    const autocompleteResults = document.getElementById('autocompleteResults');

    // Clear previous results
    autocompleteResults.innerHTML = '';

    // Filter patients based on the search query
    const filteredPatients = patients.filter(patient =>
        patient.firstName.toLowerCase().includes(searchQuery) ||
        patient.lastName.toLowerCase().includes(searchQuery) 
    );

    // Display autocomplete results
    filteredPatients.forEach(patient => {
        const resultItem = document.createElement('div');
        resultItem.textContent = `${patient.firstName} ${patient.lastName}`;
        resultItem.addEventListener('click', () => selectPatient(patient));
        autocompleteResults.appendChild(resultItem);
    });
}

// Handle selecting a patient from autocomplete results
function selectPatient(patient) {
    // Implement your logic for handling the selected patient
    console.log('Selected patient:', patient);
    // You may redirect to the patient's profile page or perform other actions
}

// Function to trigger search (you can customize this based on your needs)
function searchPatients() {
    const searchQuery = document.getElementById('searchQuery').value.toLowerCase();
    // Implement your search logic here
    console.log('Searching for patients:', searchQuery);
    // You may perform an AJAX request to the server to get search results
}


 // Event listener for form submission
 document.getElementById('createPatientForm').addEventListener('submit', function (event) {
    event.preventDefault();
    // Implement your logic for creating a patient
    
    name =  document.getElementById('patientName').value,
    email =  document.getElementById('patientEmail').value,
    birthdate = document.getElementById('patientBirthdate').value,
    gender = document.getElementById('patientGender').value,
    address =  document.getElementById('patientAddress').value,
    contactNumber = document.getElementById('patientContactNumber').value,
    // Add more patient data properties as needed
    post_patient(firstName, lastName, email, birthdate, gender, address, contactNumber)
    console.log('Creating patient:', patientData);
    // You may submit the form via AJAX or perform other actions

    // Close the modal after submission
    $('#createPatientModal').modal('hide');
});




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


function get_patients() {
    $.ajax({
        url: "/EHR_system/ajax/doctor_portal_ajax.phpp",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { action: "get_patients" },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            updateCardUI(response);
            
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

$(document).ready(
  function() {
    get_patients();  

  // Variable to keep track of the selected card
  let selectedCard = null;
  // Add event listener to the button
  $(document).on('click', '#view-book-btn', function() {

    if (selectedCard !== null) {
        selectedCard.removeClass('selected-card');
    }

    // Add the green color to the parent card of the clicked button
    const card1 = $(this).closest('.card');
    card1.addClass('selected-card');

    // Update the selected card
    selectedCard = card1;

    const card = $(this).closest('.card');
    const speciality = card.find('.card-title').text().trim();
    // Extract only the first two words from the string
    const clinic = card.find('.card-text').text().trim().split(',').slice(0, 1).join(',');
    const type_consultation = card.find('.card-text').text().trim().split(',').slice(1).join('');;
    // Make the POST request
    $.ajax({
        url: "/EHR_system/ajax/AJAX.php",
        type: "POST",
        dataType: "json",
        data: { speciality: speciality, clinic: clinic, action: "patientinfo" },
        success: function (response) {
            createCalendar(response, type_consultation, speciality, clinic);
        },
        error: function (xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);

            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
  });

});




    const consultationType = document.getElementById('consultationType');
    const specialities = document.getElementById('specialities');

    // Event Listeners
    specialities.addEventListener('change', checkAndUpdateCardUI);
    consultationType.addEventListener('change', checkAndUpdateCardUI);

    function checkAndUpdateCardUI() {
        const calendar = document.getElementById('calendar');
        calendar.innerHTML = '';
        const selectedSpeciality = specialities.value;
        const selectedConsultationType = consultationType.value;

        get_appointmentInfo(selectedSpeciality, selectedConsultationType, 'get_appointmentsinfo');

        
    }

    function updateCardUI(data) {
      // Clear existing cards
      const content = document.getElementById('content');
      content.innerHTML = '';
      // Create and append new cards based on the data from the backend
      data.forEach(appointment => {
          const card = `
              <div class="col">
                  <div class="card shadow-sm">
                      <div class="card-body">
                          <h5 class="card-title">${appointment.speciality}</h5>
                          <p class="card-text">${appointment.clinic}, ${appointment.consultation_type}</p>
                        
                          <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-outline-secondary" id="view-book-btn">View/Book</button>
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