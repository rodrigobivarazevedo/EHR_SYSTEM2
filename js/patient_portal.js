$(document).ready(
    function() {
    
    // Use AJAX to fetch user data
    loadAppointments();
    loadPrescriptions();  
    loadMessages();

    // Handle TeleMed button click
    $('#teleMedButton').on('click', function() {
        // Open the message modal
        $('#messageModal').modal('show');
    });
  
  });

// Function to handle sending a message
function sendMessage() {
    // Add your logic to send the message here
    // For example, you can use AJAX to send the data to the server
    const recipient = $('#Doctor_name').val();
    const messageContent = $('#messageContent').val();

    $.ajax({
        url: '/EHR_system/ajax/patient_portalAJAX.php',
        type: 'POST',
        dataType: 'json',
        data: {Doctor_name: recipient, content: messageContent, action: "send_message"},
        success: function (sendMessagesData) {
            if(sendMessagesData.success){
                alert(sendMessagesData.success);
                // Close the modal after sending the message
                $('#messageModal').modal('hide');
            } else if (sendMessagesData.error) {
                alert(sendMessagesData.error);
            }
        },
        error: function (error) {
            console.error('Error fetching messages:', error);
        }
    });
}

// Function to fetch and display messages
function loadMessages() {
    $.ajax({
        url: '/EHR_system/ajax/patient_portalAJAX.php',
        type: 'POST',
        dataType: 'json',
        data: {action: "get_messages"},
        success: function (messagesData) {
            console.log(messagesData)
            renderMessages(messagesData);
        },
        error: function (error) {
            console.error('Error fetching messages:', error);
        }
    });
}

// Function to fetch and display appointments
function loadAppointments() {
    $.ajax({
        url: '/EHR_system/ajax/patient_portalAJAX.php',
        type: 'POST',
        dataType: 'json',
        data: {action: "appointments"},
        success: function (appointmentsData) {
            renderAppointments(appointmentsData);
        },
        error: function (error) {
            console.error('Error fetching appointments:', error);
        }
    });
}

// Function to fetch and display prescriptions
function loadPrescriptions() {
    $.ajax({
        url: '/EHR_system/ajax/patient_portalAJAX.php',
        type: 'POST',
        dataType: 'json',
        data: {action: "medications"},
        success: function (medicationsData) {
            renderMedications(medicationsData);
        },
        error: function (error) {
            console.error('Error fetching prescriptions:', error);
        }
    });
}


// Helper functions to render data in a tab
function renderAppointments(data) {
    const appointmentsTab = document.getElementById('appointmentsTab');
    const listGroup = appointmentsTab.querySelector('.list-group');
    listGroup.innerHTML = '';

    data.forEach(item => {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item');

        const contentDiv = document.createElement('div');

        const dateParagraph = document.createElement('p');
        dateParagraph.textContent = `Date: ${item.DATE}`; // Update property name
        contentDiv.appendChild(dateParagraph);

        const titleHeading = document.createElement('h6');
        titleHeading.textContent = `Appointment Title: ${item.ConsultationType}`; // Update property name
        contentDiv.appendChild(titleHeading);

        const doctorParagraph = document.createElement('p');
        doctorParagraph.textContent = `Doctor: ${item.FirstName} ${item.LastName}`; // Update property names
        contentDiv.appendChild(doctorParagraph);

        listItem.appendChild(contentDiv);
        listGroup.appendChild(listItem);
    });
}


function renderMedications(data) {
    const medicationTab = document.getElementById('medicationTab');
    const listGroup = medicationTab.querySelector('.list-group');
    listGroup.innerHTML = '';

    data.forEach(item => {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item');

        const contentDiv = document.createElement('div');

        const nameParagraph = document.createElement('p');
        nameParagraph.textContent = `Medication: ${item.MedicationName}`;
        contentDiv.appendChild(nameParagraph);

        const dosageParagraph = document.createElement('p');
        dosageParagraph.textContent = `Dosage: ${item.Dosage}`;
        contentDiv.appendChild(dosageParagraph);

        const frequencyParagraph = document.createElement('p');
        frequencyParagraph.textContent = `Frequency: ${item.Frequency}`;
        contentDiv.appendChild(frequencyParagraph);

        const dateParagraph = document.createElement('p');
        dateParagraph.textContent = `Prescription Date: ${item.PrescriptionDate}`;
        contentDiv.appendChild(dateParagraph);

        const instructionsParagraph = document.createElement('p');
        instructionsParagraph.textContent = `Instructions: ${item.Instructions}`;
        contentDiv.appendChild(instructionsParagraph);

        listItem.appendChild(contentDiv);
        listGroup.appendChild(listItem);
    });
}


function renderMessages(data) {
    const messagesTab = document.getElementById('messagesTab');
    const listGroup = messagesTab.querySelector('.list-group');
    listGroup.innerHTML = '';

    data.forEach(item => {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item');

        const contentDiv = document.createElement('div');

        const dateParagraph = document.createElement('p');
        dateParagraph.textContent = `Date: ${item.Timestamp}`; // 
        contentDiv.appendChild(dateParagraph);

        const contentParagraph = document.createElement('p');
        contentParagraph.textContent = `Content: ${item.Content}`;
        contentDiv.appendChild(contentParagraph);

        const nameParagraph = document.createElement('p');
        nameParagraph.textContent = `From: ${item.FirstName} ${item.LastName}`;
        contentDiv.appendChild(nameParagraph);

        listItem.appendChild(contentDiv);
        listGroup.appendChild(listItem);
    });
}






