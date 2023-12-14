 // Function to create the calendar
 function createCalendar(data) {
    const calendar = document.getElementById('calendar');
    console.log(data);
  
    // Get unique dates from the data
    const uniqueDates = [];
    for (const item of data) {
        if (!uniqueDates.includes(item.DATE)) {
            uniqueDates.push(item.DATE);
        }
    }
  
    // Iterate through each date
    uniqueDates.forEach(date => {
        const dateObject = new Date(date);
        const dayOfWeek = dateObject.toLocaleDateString('en-US', { weekday: 'short' });
        const day = dateObject.getDate();
        const monthAbbreviation = dateObject.toLocaleDateString('en-US', { month: 'short' });
  
        // Find the first item with the matching date
        let matchingItem;
        for (const item of data) {
            if (item.DATE === date) {
                matchingItem = item;
                break;
            }
        }
  
        if (matchingItem) {
            const startTime = matchingItem.StartTime;
            const year = dateObject.getFullYear();
  
            const dayElement = document.createElement('button');
            dayElement.classList.add('day');
  
            // Check if the date has available time slots
            let hasAvailableSlots = false;
            for (const item of data) {
                if (item.DATE === date) {
                    hasAvailableSlots = true;
                    break;
                }
            }
  
            if (hasAvailableSlots) {
                dayElement.classList.add('available');
            }
  
            dayElement.textContent = `${dayOfWeek}, ${day} ${monthAbbreviation} ${year}`;
  
            // Add a click event listener to handle appointment creation
            dayElement.addEventListener('click', () => {
                // Replace this with your appointment creation logic
                get_timeslots(date);
            });
  
            calendar.appendChild(dayElement);
        }
    });
  }
  