function get_appointmentInfo() {
    $.ajax({
        url: "/EHR_system/ajax/bookingAJAX.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { speciality: "Gastroenterologist", consultationType: "Exam", action1: "get_appointmentsInfo" },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            // Log the response to the console for debugging
            let x = JSON.stringify(response)
            console.log(response);
            alert(x);
            
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


function updateCardUI(data) {
    // Clear existing cards
    $('#content').empty();

    // Create and append new cards based on the data from the backend
    data.forEach(appointment => {
        const card = `
            <div class="col">
                <div class="card shadow-sm">
                    <!-- Customize the card content based on the appointment data -->
                    <div class="card-body">
                        <p class="card-text">${appointment.clinic}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View/Book Appointment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#content').append(card);
    });
}