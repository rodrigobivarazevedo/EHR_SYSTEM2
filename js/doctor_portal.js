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
        patient.lastName.toLowerCase().includes(searchQuery) ||
        patient.email.toLowerCase().includes(searchQuery)
    );

    // Display autocomplete results
    filteredPatients.forEach(patient => {
        const resultItem = document.createElement('div');
        resultItem.textContent = `${patient.firstName} ${patient.lastName} - ${patient.email}`;
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
    const patientData = {
        name: document.getElementById('patientName').value,
        email: document.getElementById('patientEmail').value,
        birthdate: document.getElementById('patientBirthdate').value,
        gender: document.getElementById('patientGender').value,
        address: document.getElementById('patientAddress').value,
        contactNumber: document.getElementById('patientContactNumber').value,
        // Add more patient data properties as needed
    };
    console.log('Creating patient:', patientData);
    // You may submit the form via AJAX or perform other actions
});




 // Event listener for form submission
 document.getElementById('createPatientForm').addEventListener('submit', function (event) {
    event.preventDefault();
    // Implement your logic for creating a patient
    const patientData = {
        // Retrieve form data similar to the previous example
    };
    console.log('Creating patient:', patientData);
    // You may submit the form via AJAX or perform other actions

    // Close the modal after submission
    $('#createPatientModal').modal('hide');
});