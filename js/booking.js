function get_appointmentInfo(selectedSpeciality="", selectedConsultationType="",action="get_all") {
    $.ajax({
        url: "/EHR_system/ajax/bookingAJAX.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { speciality: selectedSpeciality, consultationType: selectedConsultationType, action1: action },
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

$(document).ready(function() {
    get_appointmentInfo();

});

    const consultationType = document.getElementById('consultationType');
    const specialities = document.getElementById('specialities');

    // Event Listeners
    specialities.addEventListener('change', checkAndUpdateCardUI);
    consultationType.addEventListener('change', checkAndUpdateCardUI);

    function checkAndUpdateCardUI() {
        const selectedSpeciality = specialities.value;
        const selectedConsultationType = consultationType.value;

        get_appointmentInfo(selectedSpeciality, selectedConsultationType, 'get_appointmentsinfo');

        
    }

// Wait for the document to be ready before attaching the event listener
$(document).ready(function() {
  // Add an event listener to the document that delegates the click event to .view-book-btn elements
  $(document).on('click', '#view-book-btn', function() {
      // Handle button click here, for example, redirect to booking_login.php
      window.location.href = 'booking_login.php';
  });
});

function updateCardUI(data) {
    // Clear existing cards
    $('#content').empty();

    // Create and append new cards based on the data from the backend
    data.forEach(appointment => {
        const card = `
        <div class="col" >
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">${appointment.speciality}</h5>
                      <p class="card-text">${appointment.consultation_type} ${appointment.clinic}</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="view-book-btn">View/Book</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        `;

        $('#content').append(card);
    });
}

