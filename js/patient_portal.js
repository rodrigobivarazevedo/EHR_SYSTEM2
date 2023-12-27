$(document).ready(
    function() {
    loadAppointments();
    loadPrescriptions();  
    loadMessages();
  
  });



// Function to fetch and display appointments
function loadAppointments() {
    $.ajax({
        url: '/your-php-endpoint-for-appointments.php',
        type: 'GET',
        dataType: 'json',
        success: function (appointments) {
            const appointmentsTab = document.getElementById('appointmentsTab');
            renderData(appointments, appointmentsTab);
        },
        error: function (error) {
            console.error('Error fetching appointments:', error);
        }
    });
}

// Function to fetch and display prescriptions
function loadPrescriptions() {
    $.ajax({
        url: '/your-php-endpoint-for-prescriptions.php',
        type: 'GET',
        dataType: 'json',
        success: function (prescriptions) {
            const medicationTab = document.getElementById('medicationTab');
            renderData(prescriptions, medicationTab);
        },
        error: function (error) {
            console.error('Error fetching prescriptions:', error);
        }
    });
}

// Function to fetch and display messages
function loadMessages() {
    $.ajax({
        url: '/your-php-endpoint-for-messages.php',
        type: 'GET',
        dataType: 'json',
        success: function (messages) {
            const messagesTab = document.getElementById('messagesTab');
            renderData(messages, messagesTab);
        },
        error: function (error) {
            console.error('Error fetching messages:', error);
        }
    });
}

// Helper function to render data in a tab
function renderData(data, tabElement) {
    const listGroup = tabElement.querySelector('.list-group');
    listGroup.innerHTML = '';

    data.forEach(item => {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item');

        const contentDiv = document.createElement('div');

        const dateParagraph = document.createElement('p');
        dateParagraph.textContent = item.date; // Replace with the actual property name
        contentDiv.appendChild(dateParagraph);

        const titleHeading = document.createElement('h6');
        titleHeading.textContent = item.title; // Replace with the actual property name
        contentDiv.appendChild(titleHeading);

        const hospitalParagraph = document.createElement('p');
        hospitalParagraph.textContent = item.hospital; // Replace with the actual property name
        contentDiv.appendChild(hospitalParagraph);

        listItem.appendChild(contentDiv);
        listGroup.appendChild(listItem);
    });
}




