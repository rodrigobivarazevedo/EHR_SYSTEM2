$(document).ready(function() {
    get_clinics();

});

function get_clinics(selectedSpeciality="",action="get_all") {
    $.ajax({
        url: "/EHR_system/ajax/clinicsAJAX.php",
        type: "POST",
        dataType: "json", 
        data: { speciality: selectedSpeciality, action1: action },
        success: function(response) {
            updateCardUI(response);
            console.log(response);
        },
        error: function(xhr) {
            // Log detailed error information to the console
            console.log(xhr.responseText);
            
            // Display a user-friendly error message
            alert("AJAX request failed. Check the console for details.");
        }
    });
}

    const speciality = document.getElementById('speciality');

    // Event Listeners
    speciality.addEventListener('change', checkAndUpdateCardUI);

    function checkAndUpdateCardUI() {
        const selectedSpeciality = speciality.value;
        
        get_clinics(selectedSpeciality, 'get_clinics');  
    }


function updateCardUI(data) {
    // Clear existing cards
    $('#content').empty();

    // Create and append new cards based on the data from the backend
    data.forEach(clinic => {
        const card = `
        <div class="col" >
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">${clinic.Name}</h5>
                      <p class="card-text"></p>
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