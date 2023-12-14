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

$(document).ready(
  function() {
  get_appointmentInfo();  
  // Add event listener to the button
  $(document).on('click', '#view-book-btn', function() {
    const card = $(this).closest('.card');
    const speciality = card.find('.card-title').text().trim();
    const clinic = card.find('.card-text').text().trim();
    // Make the POST request
    $.ajax({
        url: "/EHR_system/ajax/calendarAJAX.php",
        type: "POST",
        dataType: "json",
        data: { speciality: speciality, clinic: clinic },
        success: function (response) {
            createCalendar(response);
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
  
          const cardElement = document.createElement('div');
          cardElement.innerHTML = card;      
          content.appendChild(cardElement);
      });
  }
  
             

 // Function to create the calendar
 function createCalendar(data) {
  // Clear existing cards
  const content = document.getElementById('content');
  content.innerHTML = '';

  const calendar = document.getElementById('calendar');

  // Get unique dates from the data
  const uniqueDates = [...new Set(data.map(item => item.DATE))];

  // Iterate through each date
  uniqueDates.forEach(date => {
      const dateObject = new Date(date);
      const dayOfWeek = dateObject.toLocaleDateString('en-US', { weekday: 'short' });
      const day = dateObject.getDate();
      const monthAbbreviation = dateObject.toLocaleDateString('en-US', { month: 'short' });
      const startTime = data.find(item => item.DATE === date).StartTime;
      const year = dateObject.getFullYear();

      const dayElement = document.createElement('button');
      dayElement.classList.add('day');

      // Check if the date has available time slots
      const availableSlots = data.filter(item => item.DATE === date);
      if (availableSlots.length > 0) {
          dayElement.classList.add('available');
      }

      dayElement.textContent = `${dayOfWeek}, ${day} ${monthAbbreviation} ${year}`;

      // Add a click event listener to handle appointment creation
      dayElement.addEventListener('click', () => {
          // Replace this with your appointment creation logic
          get_timeslots(date);
      });

      calendar.appendChild(dayElement);
  });
}

 