$(document).ready(function() {
    get_all_patients();  
});

function get_all_patients() {
    $.ajax({
        url: "/EHR_system/ajax/doctor_portal_ajax.php",
        type: "POST",
        dataType: "json",
        data: { action: "get_all_patients" },
        success: function(response) {
            try {
                console.log(response)
                updateCardUI(response)
            } catch (error) {
                console.error('Invalid JSON response:', response);
                alert('Invalid JSON response. Check the console for details.');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
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