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
        url: "/EHR_system/ajax/calendarAJAX.php",
        type: "POST",
        dataType: "json",
        data: { speciality: speciality, clinic: clinic },
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
      

// Function to create the calendar
function createCalendar(data, type_consultation, speciality, clinic) {
  const calendarDiv = document.getElementById('calendar'); // Change this to your actual div ID
  calendarDiv.innerHTML = ''; // Clear existing content

  // Convert JSON object to an array
  const dataArray = Object.values(data);

  // Get unique dates from the data
  const uniqueDates = Array.from(new Set(dataArray.map(item => item.DATE)));

  // Iterate through each date
  uniqueDates.forEach(date => {
      const dateObject = new Date(date);
      const dayOfWeek = dateObject.toLocaleDateString('en-US', { weekday: 'short' });
      const day = dateObject.getDate();
      const monthAbbreviation = dateObject.toLocaleDateString('en-US', { month: 'short' });

      // Create a button for each date
      const dayElement = document.createElement('button');
      dayElement.classList.add('day', 'btn', 'btn-secondary', 'mb-2');
      dayElement.textContent = `${dayOfWeek}, ${day} ${monthAbbreviation}`;
      dayElement.addEventListener('click', () => {
          // Replace this with your logic to handle date selection
          // In this example, I'm logging the selected date to the console
          // Open the calendar modal
          timeslots(date, dataArray, type_consultation, speciality, clinic);
          console.log('Selected date:', date, type_consultation, speciality, clinic);
      });

      // Append the button to the calendar div
      calendarDiv.appendChild(dayElement);
  });
}


// Variable to keep track of the selected timeslot
let selectedTimeslot = null;

function timeslots(date, dataArray, type_consultation, speciality, clinic) {
  const calendarModal = document.getElementById('timeslots');
  const modalContent = calendarModal.querySelector('.modal-body');
  modalContent.innerHTML = ''; // Clear existing content

  // Open the calendar modal
  const bootstrapModal = new bootstrap.Modal(calendarModal);
  bootstrapModal.show();

  // Filter timeslots for the given date
  const timeslotsForDate = dataArray.filter(item => item.DATE === date);

  if (timeslotsForDate.length === 0) {
    modalContent.innerHTML = 'No available timeslots for the selected date.';
  } else {
    // Group timeslots into morning, afternoon, and evening
    const morningTimeslots = timeslotsForDate.filter(item => {
      const startTime = parseInt(item.StartTime.split(':')[0]);
      return startTime >= 9 && startTime < 12;
    });

    const afternoonTimeslots = timeslotsForDate.filter(item => {
      const startTime = parseInt(item.StartTime.split(':')[0]);
      return startTime >= 12 && startTime < 17;
    });

    const eveningTimeslots = timeslotsForDate.filter(item => {
      const startTime = parseInt(item.StartTime.split(':')[0]);
      return startTime >= 17;
    });

    // Function to create a group of timeslots
    const createTimeslotGroup = (group, groupName) => {
      if (group.length > 0) {
        const groupHeader = document.createElement('h6');
        groupHeader.textContent = `${groupName} Timeslots`;
        modalContent.appendChild(groupHeader);

        group.forEach(item => {
          // Extract hours and minutes from the StartTime
          const [hours, minutes] = item.StartTime.split(':');

          // Determine whether it's AM or PM
          const ampm = hours >= 12 ? 'PM' : 'AM';

          // Convert to 12-hour format and format the time
          const startTime = `${hours}:${minutes} ${ampm}`;

          // Create a button for each timeslot
          const timeslotElement = document.createElement('button');
          timeslotElement.classList.add('timeslot', 'btn', 'btn-light', 'mb-3', 'mr-3', 'ml-3');
          timeslotElement.textContent = `${startTime}`;
          timeslotElement.addEventListener('click', () => {
            const startTime = `${hours}:${minutes}`;
            handleTimeslotSelection(timeslotElement, startTime , date, dataArray, type_consultation, speciality, clinic);
          });

          // Append the button to the modal body
          modalContent.appendChild(timeslotElement);
        });

      
      }
    };

    // Create timeslot groups
    createTimeslotGroup(morningTimeslots, 'Morning');
    createTimeslotGroup(afternoonTimeslots, 'Afternoon');
    
    // Create input fields for phone number, email, and citizen ID
    const phoneNumberInput = createInputField('phoneNumberInput',"Phone Number");
    const emailInput = createInputField("emailInput", 'Email');
    const citizenIdInput = createInputField("citizenIDInput",'Citizen ID');

    // Append input fields to the modal body
    modalContent.appendChild(phoneNumberInput);
    modalContent.appendChild(emailInput);
    modalContent.appendChild(citizenIdInput);

    document.getElementById('bookAppointmentBtn').addEventListener('click', () => {
      // Retrieve form values
      const phoneNumberElement = document.getElementById('phoneNumberInput');
      const emailElement = document.getElementById('emailInput');
      const citizenIDElement = document.getElementById('citizenIDInput');
      const selectedTimeslotElement = document.querySelector('.timeslot.selected');
    
      const startTime = selectedTimeslotElement ? selectedTimeslotElement.textContent.trim().split(' ')[0] : '';
      const phoneNumber = phoneNumberElement ? phoneNumberElement.value.trim() : '';
      const email = emailElement ? emailElement.value.trim() : '';
      const citizenID = citizenIDElement ? citizenIDElement.value.trim() : '';
    
      // Check if the required elements exist
      if (citizenID !== '' && email !== '' && phoneNumber !== '' && startTime !== '') {
        // Proceed with booking appointment or display an error message
        if (validatePhoneNumber(phoneNumber) && validateEmail(email) && validateCitizenID(citizenID)) {
          // All values are valid, proceed with booking appointment
          if (selectedTimeslotElement) {
            console.log('Selected timeslot:', citizenID, email, phoneNumber, startTime, date, dataArray, type_consultation, speciality, clinic);
            book_appointment(startTime, date, dataArray, type_consultation, speciality, clinic, phoneNumber, email, citizenID);
          } else {
            alert("Please select a timeslot before booking.");
          }
        } else {
          // Display an error message or handle validation errors
          alert("Invalid input. Please check your information.");
        }
      } else {
        // Handle the case where one or more form elements are empty
        alert("Please fill in all the information before booking.");
      }
    });
    
    

  }
}

// Helper function to create input fields
function createInputField(input_name, placeholder) {
  const form = document.createElement('input');
  form.id = input_name;
  form.type = 'text';
  form.placeholder = placeholder;
  form.classList.add('form-control', 'mb-3');
  return form;
}

function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function validatePhoneNumber(phoneNumber) {
  const phoneRegex = /^\d{10}$/; // Assumes a 10-digit phone number
  return phoneRegex.test(phoneNumber);
}

function validateCitizenID(citizenID) {
  // Check if the personalausweisNumber is not empty
  if (!citizenID.trim()) {
    return false;
  }

  // German Personalausweis number format: 10 digits
  // Additional validation rules may apply
  if (!/^\d{10}$/.test(citizenID)) {
    return false;
  }
  return true;
}



function handleTimeslotSelection(timeslotElement, startTime, date, dataArray, type_consultation, speciality, clinic) {
  // Remove 'selected' class from the previously selected timeslot
  if (selectedTimeslot !== null) {
    selectedTimeslot.classList.remove('selected');
  }

  // Toggle the 'selected' class on the clicked timeslot button
  timeslotElement.classList.toggle('selected');

  // Update the selected timeslot
  selectedTimeslot = timeslotElement;

  // Get the selected timeslot's start time
  console.log('Selected timeslot:', startTime, date, dataArray, type_consultation, speciality, clinic);

}



function book_appointment(startTime, date, dataArray, type_consultation, speciality, clinic) {
  if (selectedTimeslot !== null) {
    $.ajax({
      url: "/EHR_system/ajax/appointementsAJAX.php",
      type: "POST",
      dataType: "json",
      data: { speciality, clinic, type_consultation, date, startTime, action: "action1" },
      success: function (response) {

        // Reload the current page
        alert(response.message);
        location.reload();
        
      },
      error: function (xhr) {
        console.log(xhr.responseText);
        alert("AJAX request failed. Check the console for details.");
      }
    });
  } else {
    alert("Please select a timeslot before booking.");
  }
}


