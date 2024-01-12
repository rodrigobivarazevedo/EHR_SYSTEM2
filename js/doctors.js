function get_doctorsInfo(selectedspeciality="", selectedclinic="",action="get_all") {
    $.ajax({
        url: "/EHR_system/ajax/doctorsAJAX.php",
        type: "POST",
        dataType: "json", // Changed "JSON" to "json"
        data: { speciality: selectedspeciality, clinic: selectedclinic, action1: action },
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
      const content = document.getElementById('content');
      content.innerHTML = '';
  
      // Create and append new cards based on the data from the backend
      data.forEach(doctor => {
        const card = `
        <div class="col" >
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">${doctor.FirstName} ${doctor.LastName}</h5>
                      <p class="card-text">${doctor.Speciality}, ${doctor.clinic}</p>
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


$(document).ready(
  function() {
  get_doctorsInfo();  

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
    const Doctor_Name = card.find('.card-title').text().trim();
    // Extract only the first two words from the string
    const speciality = card.find('.card-text').text().trim().split(',').slice(0,1).join(',');
    const clinic = card.find('.card-text').text().trim().split(',').slice(1).join(',').trim();
    const Doctor_FirstName = card.find('.card-title').text().trim().split(' ').slice(0,1);
    const Doctor_LastName = card.find('.card-title').text().trim().split(' ').slice(1,2);
  
    // Make the POST request
    $.ajax({
        url: "/EHR_system/ajax/calendarAJAX.php",
        type: "POST",
        dataType: "json",
        data: { speciality: speciality, clinic: clinic, Doctor_FirstName: Doctor_FirstName, Doctor_LastName: Doctor_LastName, action: "booking_doctor"},
        success: function (response) {
          //console.log(response)
          createCalendar(response, speciality, clinic, response[0].DoctorID);
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

    
// Function to create the calendar
function createCalendar(data, speciality, clinic, DoctorID) {
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
          timeslots(date, dataArray, speciality, clinic, DoctorID);
          console.log('Selected date:', date, speciality, clinic, DoctorID);
      });

      // Append the button to the calendar div
      calendarDiv.appendChild(dayElement);
  });
}


// Variable to keep track of the selected timeslot
let selectedTimeslot = null;

function timeslots(date, dataArray, speciality, clinic, DoctorID) {
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
            handleTimeslotSelection(timeslotElement, startTime , date, dataArray, speciality, clinic, DoctorID);
          });

          // Append the button to the modal body
          modalContent.appendChild(timeslotElement);
        });

      
      }
    };

    // Create timeslot groups
    createTimeslotGroup(morningTimeslots, 'Morning');
    createTimeslotGroup(afternoonTimeslots, 'Afternoon');
    
    // Create input fields for  email, and password
    const emailInput = createInputField("emailInput", 'Email',"text");
    const passwordInput = createInputField("passwordInput", 'password',"password");
    
    // Append input fields to the modal body
    modalContent.appendChild(emailInput);
    modalContent.appendChild(passwordInput);
    
    document.getElementById('bookAppointmentBtn').addEventListener('click', async () => {
      try {
        // Retrieve form values
        const emailElement = document.getElementById('emailInput');
        const selectedTimeslotElement = document.querySelector('.timeslot.selected');
        const startTime = selectedTimeslotElement ? selectedTimeslotElement.textContent.trim().split(' ')[0] : '';
        const email = emailElement ? emailElement.value.trim() : '';
        const password = document.getElementById("passwordInput").value;
        
    
        // Check if the required elements exist
        if (email !== '' && startTime !== '' && password !== '') {
          const response = await check_user(email, password);
          UserID = response.UserID;
          if (UserID && response.message ==="Login successful") {
            // Proceed with booking appointment or display an error message
            if (validateEmail(email)) {
              // All values are valid, proceed with booking appointment
              if (selectedTimeslotElement) {
                console.log('Selected timeslot:',  email,startTime, date, dataArray, speciality, clinic, UserID,DoctorID);
                book_appointment(startTime, date, speciality, clinic, DoctorID, UserID);
              } else {
                alert("Please select a timeslot before booking.");
              }
            } else {
              // Display an error message or handle validation errors
              alert("Invalid input. Please check your information.");
            }
          } else {
            alert("Invalid credentials. If not registered please create account");
            // Give a direction to the registration.php page
            //window.location.href = "/EHR_system/ui/MyFastCARE/registration.php";
          }
        } else {
          alert("Please fill in all the required information before booking.");
        }
      } catch (error) {
        console.error(error);
        alert("An error occurred while checking user registration. Please try again.");
      }
    });
    
    

  }
}

// Helper function to create input fields
function createInputField(input_name, placeholder, type) {
  const form = document.createElement('input');
  form.id = input_name;
  form.type = type;
  form.placeholder = placeholder;
  form.classList.add('form-control', 'mb-3');
  return form;
}

function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}


function handleTimeslotSelection(timeslotElement, startTime, date, dataArray, speciality, clinic, DoctorID) {
  // Remove 'selected' class from the previously selected timeslot
  if (selectedTimeslot !== null) {
    selectedTimeslot.classList.remove('selected');
  }

  // Toggle the 'selected' class on the clicked timeslot button
  timeslotElement.classList.toggle('selected');

  // Update the selected timeslot
  selectedTimeslot = timeslotElement;

  // Get the selected timeslot's start time
  console.log('Selected timeslot:', startTime, date, dataArray, speciality, clinic, DoctorID);

}

// Return a promise from the check_user function
function check_user(email,password) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "/EHR_system/ajax/loginAJAX.php",
      type: "POST",
      dataType: "json",
      data: { UsernameOrEmail: email, password: password, action: "login" },
      success: function (response) {
        // Resolve the promise with the response
        resolve(response);
      },
      error: function (xhr) {
        console.log(xhr.responseText);
        // Reject the promise with the error message
        reject("AJAX request failed. Check the console for details.");
      }
    });
  });
}


function book_appointment(startTime, date, speciality, clinic, DoctorID, UserID) {
  if (selectedTimeslot !== null) {
    console.log(DoctorID)
    $.ajax({
      url: "/EHR_system/ajax/appointementsAJAX.php",
      type: "POST",
      dataType: "json",
      data: {UserID: UserID, speciality: speciality, clinic: clinic, type_consultation : "Appointment", date: date, startTime: startTime, DoctorID: DoctorID, action: "action2" },
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
