$(document).ready(function() {
    get_doctorsInfo();
});

function get_doctorsInfo(selectedspeciality="", selectedclinic="",action="get_all") {
    $.ajax({
        url: "/EHR_system/ajax/doctorsAJAX.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { speciality: selectedspeciality, clinic: selectedclinic, action1: action },
        beforeSend: function() {
            // Add any code to run before the request is sent (optional)
        },
        success: function(response) {
            console.log(response);
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

    const clinic = document.getElementById('clinic');
    const speciality = document.getElementById('speciality');

    // Event Listeners
    speciality.addEventListener('change', checkAndUpdateCardUI);
    clinic.addEventListener('change', checkAndUpdateCardUI);

    function checkAndUpdateCardUI() {
        const selectedspeciality = speciality.value;
        const selectedclinic = clinic.value;

        get_doctorsInfo(selectedspeciality, selectedclinic, 'get_doctors');

        
    }


function updateCardUI(data) {
    // Clear existing cards
    $('#content').empty();

    // Create and append new cards based on the data from the backend
    data.forEach(doctor => {
        const card = `
        <div class="col" >
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">${doctor.FirstName} ${doctor.LastName}</h5>
                      <p class="card-text">${doctor.Speciality}</p>
                      <p class="card-text">${doctor.clinic}</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View/Book</button>
               
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
        `;

        $('#content').append(card);
    });
}